<?php
/**
 * J. Mulle, for app, 7/13/14 1:17 AM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 */
extract( $assets );
extract( $rset[ 'data' ][ 'params' ] );

echo $this->element( "layout/slide_title", array(  "header"    => $slide['title'],
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
		case "demo_task":
			echo $this->element( 'layout/section_title', array( "header"    => "Research Methods in Psychology",
			                                                   "subheader" => "Creating & Using Operational Definitions",
			                                                   "separator" => ":",
			                                                   "sectionName" => $sectionName
			                                            )
			);?>
			<?php   break;
							case "footer":
								echo $this->element("layout/footer");
								break;
						endswitch;?>
						</section>
					<?php endif; //if:sectionName == slide-instructions
					endforeach; //section printing ?>