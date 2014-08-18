<?php
/**
 * J. Mulle, for app, 5/14/14 5:16 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 */

extract( $assets );
extract( $rset[ "data" ][ "params" ] );
?>
<?php echo $this->element( "layout/slide_title", array(  "header"    => $slide['title'],
		                                                  "subheader" =>$slide['subtitle'],
		                                                  "separator" => ":",
                                                          "infobar" => $infobar)
		);?>
<?php echo $this->Element("layout/instructions", array("content" => $slide['text']['instructions']));?>
<?php foreach ( $sections as $sectionName => $include ):
	if ( $sectionName != "slide-instructions" && $sectionName != "slide-title"):?>
	<section id="<?php echo ___strToSel( array( $sectionName, "section" ) ); ?>" class="slide-section">
		<!-- TaskSection: Behavior Counting 1 -->
<?php switch ($sectionName):
		case "ethogram_instruction_video":
			echo $this->element( 'layout/section_title', array( "header"    => $slide[ 'title' ],
			                                                   "subheader" => $slide[ 'subtitle' ],
			                                                   "separator" => ":",
			                                                   "sectionName" => $sectionName
			                                            )
			);?>
		<div class="row">
				<div class="small-10 small-centered columns">
					<?php echo $this->element( "lab_ui/html5v", array( "id_parts" => array( $slide[ "name" ] ),
					                                                   "path"     => $ethogram_instructions[ 'path' ],
					                                                   "data"     => $ethogram_instructions[ 'properties' ],
					                                                   "controls" => array( "buttons" => array( array( "action"  => "refresh",
					                                                                                                   "string"  => "Reload",
					                                                                                                   "options" => array() ),
					                                                                                            array( "action"  => "pause",
					                                                                                                   "string"  => "Pause",
					                                                                                                   "options" => array() ),
					                                                                                            array( "action"  => "play",
					                                                                                                   "string"  => "Play",
					                                                                                                   "options" => array(),
					                                                                                            ) ),
					                                                                        "style"   => array( "button_size" => "small" ),
					                                                                        "wrap"    => true
					                                                   ) )
					); ?>
				</div>

		</div>
	</div>
			<?php   break;
							case "footer":
								echo $this->element("layout/footer");
								break;
						endswitch;?>
						</section>
					<?php endif; //if:sectionName == slide-instructions
					endforeach; //section printing ?>
