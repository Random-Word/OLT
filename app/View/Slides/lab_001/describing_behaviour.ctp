<?php

extract( $assets );
extract( $rset[ "data" ][ "params" ] );
$taskName = "describing_behaviour";
$taskNameCss = "describing-behaviour";
$controls_array = array( "buttons" => array( array( "action"  => "refresh",
                                                    "string"  => "Reload",
                                                    "options" => array() ),
                                             array( "action"  => "pause",
                                                    "string"  => "Pause",
                                                    "options" => array() ),
                                             array( "action"  => "play",
                                                    "string"  => "Play",
                                                    "options" => array(),
												),
),
                         "style"   => array( "button_size" => "small" ),
                         "wrap"    => true
);
?>

<?php echo $this->element( "layout/slide_title", array( "header"    => $slide[ 'title' ],
                                                  "subheader" => $slide[ 'subtitle' ],
                                                  "separator" => ":",
                                                  "infobar" => $infobar
                                           )
);?>

<?php echo $this->Element( "layout/instructions", array( "content" => $slide[ 'text' ][ 'instructions' ] ) ); ?>

<?php foreach ( $sections as $sectionName => $include ):
	if ( $sectionName != "slide-instructions" && $sectionName != "slide-title"):?>
	<section id="<?php echo ___strToSel( array( $sectionName, "section" ) ); ?>" class="slide-section">
		<!-- TaskSection: Behavior Counting 2 -->
<?php switch ($sectionName):
		case "behaviour_description":
			echo $this->element( 'layout/section_title', array( "header"    => $slide[ 'title' ],
			                                                   "subheader" => $slide[ 'subtitle' ],
			                                                   "separator" => ":",
			                                                   "sectionName" => $sectionName
			                                            )
			);?>
		<div class="row">
			<div class="small-6 columns">
			<?php
			$form_id = AppController::str_to_selector( array( $slide[ 'name' ], "form" ));
			echo $this->Form->create(false, array("id" => $form_id, "action" => false));
			echo $this->Form->input( "Description of Behavior", array( "type"            => "textarea",
			                                                           "id"              => AppController::str_to_selector( array( $slide[ 'name' ],
			                                                                                                                       "operationalized-behaviour","description" )
				                                                           ),
			                                                           "name" => AppController::cakeforms_name(array("response","describing-behaviour","behaviour_description")),
			                                                           "placeholder"     => "Undergraduate student sits at keyboard; completes answer to question found on internet learning website.",
			                                                           "class"           => array( "olt-rfield", "olt-param" ),
			                                                           "data-olt-rfield" => true,
			                                                           "data-olt-param"  => true,
			                                                           "data-requierd"   => true,
			                                                           "data-type"       => "textarea",
			                                                           "value" => $rset['data']['response']['describing_behaviour']['behaviour_description'])
			);
			echo $this->Form->end();

			echo $this->Element("lab_ui".DS."save_button", array("target" => $form_id, "class" =>null, "text"=> null, "data" => null));
			?>
			</div>
			<div class="small-6 columns">
							<?php echo $this->element( "lab_ui/html5v", array( "id_parts" => array($slide[ "name" ], $taskName),
							                                                   "path"     => $video_1['path'],
							                                                   "data"     => $video_1['properties'],
							                                                   "controls" => $controls_array )
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
