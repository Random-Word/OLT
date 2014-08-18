<?php
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
		case "research_methods_in_psychology":
			echo $this->element( 'layout/section_title', array( "header"    => "Research Methods in Psychology",
			                                                   "subheader" => "Creating & Using Operational Definitions",
			                                                   "separator" => ":",
			                                                   "sectionName" => $sectionName
			                                            )
			);?>

			<div class="row">
				<div class="small-12 columns">
					<h3>Learning Outcomes:</h3>

					<p>By the end of this activity, you should be able to:</p>
					<ol>
						<li>Use an ethogram to describe, define, and measure behaviour in humans and other animals.</li>
						<li>Create specific and reliable operational definitions for measuring behaviour.</li>
						<li>Identify and explain the research design used in this activity.</li>
					</ol>
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