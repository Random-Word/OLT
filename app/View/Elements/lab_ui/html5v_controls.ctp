<?php
/**
 * J. Mulle, for app, 5/21/14 9:07 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 *
 * @name html5v_controls
 * @desc
 * @opt  (array) $controls[buttons]
 * @opt (array) $controls[style]
 * @opt (bool) $controls[wrap]
 */


//todo: move this list somewhere global once you establish which things it'll need to contain
$action_keys = array( "play"           => "play",
                      "playFor"        => "play",
                      "pause"          => "pause",
                      "stop"           => "stop",
                      "jumpList"       => "list",
                      "jumpTo"         => false,
                      "jumpBy"         => false,
                      "refresh"        => "refresh",
                      "next"           => "next",
                      "previous"       => "previous",
                      "increaseVolume" => "volume",
                      "decreaseVolume" => "volume-none",
                      "toggleMute"           => "volume-strike"
);

$volumeControls = array("decreaseVolume"=>"-0.1", "increaseVolume" => "0.1",  "toggleMute"=>true);
function implicitJumpList($interval, $start, $stop) {
	$list = array();
	// create list
	$range_magnitude = $stop - $start;
	$list_length     = floor( $range_magnitude / $interval );
	for ( $i = 1; $i <= $list_length; $i++ ) {
		$time                                              = $start + ( $i * $interval );
		$list[ AppController::asClockTime( $time, SECS ) ] = $time;
	}

	return $list;
}


// Prepare vars needed for the main loop
// todo: an array, "style", gets passed to this page and should determine aesthetics of the button array; it is barely even implemented yet
$buttonCount = count( $buttons ) + 1; // +1 == clock;
$_default_style = array( "button_size" => "small" );
$style = array_merge( $_default_style, $style );

// create ids for controlbar & irregular elements thereof like clocks & dropdowns
$controlbar_id = ___strToSel( array_merge( $html5v_id_parts, array( "html5v", "control" ) ) );
$volume_id = ___strToSel( array_merge( $html5v_id_parts, array( "volume" ) ) );
$clock_id = ___strToSel( array_merge( $html5v_id_parts, array( "clock" ) ) );
$dropdown_trigger_id = ___strToSel( array_merge( $html5v_id_parts, array( "control", "dropdown" ) ) );


// create classes for three types of buttons for readability below
$control_class_array = array( $style[ 'button_size' ], "html5v-control" );
$dropdown_class = array( $style[ 'button_size' ], "dropdown", "html5v-dropdown" );
$dropdownListClass = array( "f-dropdown", "full-width", "monospaced" );
$dropdownMenuItemClass = array( "html5v-f-dropdown", OLT_HTML5V, OLT_HTML5V_CTRL_CLASS );

$include_dropdown = false;
?>
<div class="<?php echo OLT_UI_HTML5V; ?>">
	<!--enter primary loop-->
	<ul id="<?php echo $controlbar_id; ?>"
	    class="html5v-controls small-block-grid-<?php echo $buttonCount - 1; ?>">
		<?php   foreach ( $buttons as $data ) {
			extract( $data ); // $action, $string, $options
			extract( $options );
			$selectorParts = array_merge( $html5v_id_parts, array( "html5v", "control", $action ) );?>
			<?php

			/* PROCESS FORMATTING REQUIREMENTS OF EACH ACTION */
			switch ( $action ) {
				case "jumpList": //todo: create one of these for every action, it'll be necessary come adding-formatting-time
					?>
					<?php
					$include_dropdown = true;
					$dropdown_id      = ___strToSel( array_merge( $selectorParts, array( "dropdown" ) ) );
					$data_attr        = array( "bind"          => false,
					                           "video-control" => null,
					                           "for"           => ___strToSel( $html5v_id_parts ),
					                           "action"        => false,
					                           "options"       => "align:top",
					                           "dropdown"      => $dropdown_id
					);
					$jump_list        = array();
					if ( $implicit ) {
						$jump_list = implicitJumpList( $interval, $start, $stop );
					}
					else {
						foreach ( $toc as $str => $time_in_sec ) {
							$jump_list[ $str ] = ___asClockTime( $time_in_sec );
						}
					}?>
					<li id="<?php echo $dropdown_trigger_id; ?>" <?php echo ___dA( $data_attr, "'" ); ?> <?php echo ___cD( $dropdown_class ); ?>>
						<?php echo ( $action_keys[ $action ] ) ? ___i( $action_keys[ $action ], 0, false, true ) : ucwords( $string ); ?>
					</li>
					<?php
					break;

				default:
					$data_attr = array_merge( $options, array( "bind"          => "click",
					                                           "video-control" => null,
					                                           "for"           => ___strToSel( $html5v_id_parts ),
					                                           "action"        => $action )
					);?>
						<li <?php echo ___cD( $control_class_array ); ?> <?php echo ___dA( $data_attr ); ?>>
							<a href="#_">
								<?php echo ( $action_keys[ $action ] ) ? ___i( $action_keys[ $action ], 0, false, true ) : ucwords( $string ); ?>
							</a>
						</li>
					<?php break;
			}
		}
		?>
		<?php if ( $include_dropdown ): ?>
			<ul id="<?php echo $dropdown_id; ?>" data-dropdown-content <?php echo ___cD( $dropdownListClass ); ?>>
				<?php foreach ( $jump_list as $str => $time ):
					$data_attr = array( "bind"          => "click",
					                    "action"        => "jumpTo",
					                    "video-control" => null,
					                    "for"           => ___strToSel( $html5v_id_parts ),
					                    "playhead"      => $time,
					                    "autoplay"      => $autoplay ); ?>
					<li <?php echo ___cD( $dropdownMenuItemClass ); ?> <?php echo ___dA( $data_attr ); ?>>
						<?php echo $str; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; //if: $include_dropdown ?>
	</ul>

	<!-- these elements are floated within the video element -->
	<div id="<?php echo $clock_id; ?>" <?php echo ___cD( [ [ "html5v", "clock" ] ] ); ?>>00:00:00</div>
	<div id="<?php echo $volume_id; ?>" <?php echo ___cD( [ [ "html5v", "volume", "controls", "wrapper" ] ] ); ?>>
		<ul class="html5v-volume-controls">
		<?php foreach($volumeControls as $vc => $val) {
			$dataAttr = array("bind" => "click",
			                   "action" => $vc,
			                   "video-control" => null,
			                   "for" => ___strToSel( $html5v_id_parts ) );
			if ($val) $dataAttr['adjust'] = $val;
		?>
			<li <?php echo ___cD( [ "html5v-control" ] ); ?> <?php echo ___dA($dataAttr);?>>
				<?php echo ___i( $action_keys[ $vc ], 0, false, true ); ?>
			</li>
		<?php } ?>
		</ul>
	</div>
</div>
