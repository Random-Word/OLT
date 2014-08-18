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

$taskName = "operationalized_behaviour";
$controls_array = array( "buttons" => array( array( "action"  => "refresh",
                                                    "string"  => "Reload",
                                                    "options" => array() ),
                                             array( "action"  => "pause",
                                                    "string"  => "Pause",
                                                    "options" => array() ),
                                             array( "action" => "play",
                                                    "string" => "Play", ),
),
                         "style"   => array( "button_size" => "small" ),
                         "wrap"    => true
);
?>


<?php echo $this->element( "layout/slide_title", array( "header"    => $slide[ 'title' ],
                                                        "subheader" => $slide[ 'subtitle' ],
                                                        "separator" => ":",
                                                        "infobar"   => $infobar
                                                 )
);?>

<?php echo $this->Element( "layout/instructions", array( "content" => $slide[ 'text' ][ 'instructions' ] ) ); ?>

<?php foreach ( $sections as $sectionName => $include ):
	if ( $sectionName != "slide-instructions" && $sectionName != "slide-title" ):?>
		<section id="<?php echo ___strToSel( array( $sectionName, "section" ) ); ?>" class="slide-section">
			<!-- TaskSection: Creating an Operational Definition -->
			<?php switch ( $sectionName ):
				case "create_an_operational_definition":
					echo $this->element( 'layout/section_title', array( "header"      => $slide[ 'title' ],
					                                                    "subheader"   => $slide[ 'subtitle' ],
					                                                    "separator"   => ":",
					                                                    "sectionName" => $sectionName
					                                             )
					);?>
					<div class="row">
						<div class="small-6 columns text-center">
							<?php
							$form_id = AppController::str_to_selector( array( $slide[ 'name' ], "form" ) );
							echo $this->Form->create( false, array( "id" => $form_id, "action" => false ) );
							echo $this->Form->input( "Name of Behavior to Operationalize", array( "type"            => "input",
							                                                                      "id"              => AppController::str_to_selector( array( $slide[ 'name' ],
							                                                                                                                                  "operationalized-behaviour",
							                                                                                                                                  "label" )
								                                                                      ),
							                                                                      "name"            => AppController::cakeforms_name( array( "params",
							                                                                                                                                 "operationalized-behaviour",
							                                                                                                                                 "label" )
								                                                                      ),
							                                                                      "label"           => false,
							                                                                      "placeholder"     => "Tail Flicking",
							                                                                      "class"           => array( "olt-rfield",
							                                                                                                  "olt-param" ),
							                                                                      "data-olt-rfield" => null,
							                                                                      "data-olt-param"  => null,
							                                                                      "data-type"       => "input",
							                                                                      "value"           => $operationalized_behaviour[ 'label' ] )
							);
							echo $this->Form->input( "Operational Description", array( "type"            => "textarea",
							                                                           "id"              => ___strToSel( array( $slide[ 'name' ],
							                                                           							                              "operationalized-behaviour",
							                                                           							                              "description" )
							                                                           							),
							                                                           "name"            => AppController::cakeforms_name( array( "params",
							                                                                                                                      "operationalized-behaviour",
							                                                                                                                      "description" )
								                                                           ),
							                                                           "placeholder"     => "Choose and describe one behaviour...",
							                                                           "class"           => array( "olt-rfield",
							                                                                                       "olt-param" ),
							                                                           "data-olt-rfield" => true,
							                                                           "data-olt-param"  => true,
							                                                           "data-requierd"   => true,
							                                                           "data-type"       => "textarea",
							                                                           "value"           => $operationalized_behaviour[ 'description' ] )
							);
							echo $this->Form->end();

							?>
						</div>
						<div class="small-6 columns" data-twin=1>
							<?php echo $this->element( "lab_ui/html5v", array( "id_parts" => array( $slide[ "name" ],
							                                                                        $taskName ),
							                                                   "path"     => $video_4[ 'path' ],
							                                                   "data"     => $video_4[ 'properties' ],
							                                                   "controls" => $controls_array )
							); ?>
						</div>
						<div class="row">
							<div class="small-12 columns">
								<?php
								echo $this->Element( "lab_ui/save_button", array( "text"   => "Save",
								                                                  "class"  => array( " giant-button" ),
								                                                  "write"  => array(),
								                                                  "data"   => array( "create-keys"        => true,
								                                                                     "create-after-depth" => 2 ),
								                                                  "target" => $form_id )
								);?>
							</div>
						</div>
					</div>
					<?php   break;
				case "footer":
					echo $this->element( "layout/footer" );
					break;
			endswitch;?>
		</section>
	<?php endif; //if:sectionName == slide-instructions
endforeach; //section printing
?>