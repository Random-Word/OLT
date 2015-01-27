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
<?php echo $this->element( "layout/slide_title", array( "header"    => $slide[ 'title' ],
                                                  "subheader" => $slide[ 'subtitle' ],
                                                  "separator" => ":",
                                                  "infobar" => $infobar
                                           )
);?>
<?php echo $this->Element( "layout/instructions", array( "content" => $slide[ 'text' ][ 'instructions' ] ) ); ?>
<?php

$form_id = AppController::str_to_selector( array( $slide[ 'name' ], "form" ) );
echo $this->Form->create( false, array( "id" => $form_id, "action" => false, "class" => "nice") );?>

<?php foreach ( $sections as $sectionName => $include ):
	if ( $sectionName != "slide-instructions" && $sectionName != "slide-title"):?>
	<section id="<?php echo ___strToSel( array( $sectionName, "section" ) ); ?>" class="slide-section">
		<!-- TaskSection: Behavior Counting 2 -->
<?php switch ($sectionName):
		case "research_design":
			echo $this->element( 'layout/section_title', array( "header"    => "Question #1",
			                                                   "subheader" => "Research Design",
			                                                   "separator" => ":",
			                                                   "sectionName" => $sectionName
			                                            )
			);?>
			<div class="row">
				<div class="small-12 columns">
					<p>Based upon what you have learned throughout Unit 1 (think back to Chapter 2), what type of research design have you just completed?</p>
				</div>
			</div>
			<div class="row">
									<div class="small-12 small-centered columns">
										<fieldset>
											<legend>Research Design</legend>

											<input type="hidden" name="data[response][post_activity][research_design]"
											       id="post-activity_operational-definitions-knowledge__" value=""/>

											<div class="row">
												<div class="small-1 columns">
													<input type="radio" name="data[response][post_activity][research_design]"
													       id="post-activity_operational-definitions-knowledge_0" class="olt-rfield olt-param" data-type="input"
													       value="0"/>
												</div>
												<div class="small-11 columns"><label for="post-activity_operational-definitions-knowledge_0">a.
													Descriptive</label>
												</div>
											</div>
											<div class="row">
												<div class="small-1 columns">
													<input type="radio" name="data[response][post_activity][research_design]"
													       id="post-activity_operational-definitions-knowledge_1" class="olt-rfield olt-param" data-type="input"
													       value="1"/>
												</div>
												<div class="small-11 columns"><label for="post-activity_operational-definitions-knowledge_1">b.
													Correlational</label>
												</div>
											</div>
											<div class="row">
												<div class="small-1 columns">
													<input type="radio" name="data[response][post_activity][research_design]"
													       id="post-activity_operational-definitions-knowledge_2" class="olt-rfield olt-param" data-type="input"
													       value="2"/>
												</div>
												<div class="small-11 columns"><label for="post-activity_operational-definitions-knowledge_2">c.
													Experimental</label>
												</div>
											</div>
											<div class="row">
												<div class="small-1 columns">
													<input type="radio" name="data[response][post_activity][research_design]"
													       id="post-activity_operational-definitions-knowledge_3" class="olt-rfield olt-param" data-type="input"
													       value="3"/>
												</div>
												<div class="small-11 columns"><label for="post-activity_operational-definitions-knowledge_3">d.
													Pseudo-experimental</label>
												</div>
											</div>
											<div class="row">
												<div class="small-1 columns">
													<input type="radio" name="data[response][post_activity][research_design]"
													       id="post-activity_operational-definitions-knowledge_4" class="olt-rfield olt-param" data-type="input"
													       value="4"/>
												</div>
												<div class="small-11 columns"><label for="post-activity_operational-definitions-knowledge_4">e. Tallying
													behaviours is not research</label></div>
											</div>
										</fieldset>

					<?php echo $this->Element( "lab_ui" . DS . "save_button", array( "target" => $form_id, "class" => null,
					                                                           "text"   => null, "data" => null )
					);
					?>
									</div>
								</div>
<?php       break;
		case "research_design_reflection":
			echo $this->element( 'layout/section_title', array( "header"    => "Question #2",
						                                                   "subheader" => "Research Design Reflection",
						                                                   "separator" => ":",
						                                                   "sectionName" => $sectionName
						                                            )
						);?>
						<div class="row">
							<div class="small-12 columns">
								<p>Why did you select the answer you chose for Question 1, <em>Research Design</em>?</p>
							</div>
						</div>
						<div class="row">
							<div class="small-12 small-centered columns">
								<fieldset>
									<legend>Research Design Reflection</legend>
									<input type="hidden" name="data[response][post_activity][research_design_reflection]"
									       id="post-activity_research-design-reflection__" value=""/>

									<div class="row">
										<div class="small-1 columns">
											<input type="radio" name="data[response][post_activity][research_design_reflection]"
											       id="post-activity_research-design-reflection_0" class="olt-rfield olt-param" data-type="input"
											       value="0"/>
										</div>
										<div class="small-11 columns"><label for="post-activity_research-design-reflection_0">a. Because there was an
											independent and a dependent variable</label>
										</div>
									</div>
									<div class="row">
										<div class="small-1 columns">
											<input type="radio" name="data[response][post_activity][research_design_reflection]"
											       id="post-activity_research-design-reflection_1" class="olt-rfield olt-param" data-type="input"
											       value="1"/>
										</div>
										<div class="small-11 columns"><label for="post-activity_research-design-reflection_1">b. Because we manipulated
											variables in order to measure behaviour</label>
										</div>
									</div>
									<div class="row">
										<div class="small-1 columns">
											<input type="radio" name="data[response][post_activity][research_design_reflection]"
											       id="post-activity_research-design-reflection_2" class="olt-rfield olt-param" data-type="input"
											       value="2"/>
										</div>
										<div class="small-11 columns"><label for="post-activity_research-design-reflection_2">c. Because we did not
											manipulate the variables we only observed behaviour</label>
										</div>
									</div>
									<div class="row">
										<div class="small-1 columns">
											<input type="radio" name="data[response][post_activity][research_design_reflection]"
											       id="post-activity_research-design-reflection_3" class="olt-rfield olt-param" data-type="input"
											       value="3"/>
										</div>
										<div class="small-11 columns"><label for="post-activity_research-design-reflection_3">d. Because we analyzed the
											relationship between two variables</label>
										</div>
									</div>
									<div class="row">
										<div class="small-1 columns">
											<input type="radio" name="data[response][post_activity][research_design_reflection]"
											       id="post-activity_research-design-reflection_4" class="olt-rfield olt-param" data-type="input"
											       value="4"/>
										</div>
										<div class="small-11 columns">
											<label for="post-activity_research-design-reflection_4">e. Because we assigned participants into
												groups</label>
										</div>
									</div>
								</fieldset>
								<?php echo $this->Element( "lab_ui" . DS . "save_button", array( "target" => $form_id, "class" => null,
													                                                           "text"   => null, "data" => null )
													);
													?>
							</div>
						</div>

			<?php       break;
	case "operational_definitions_knowledge":
		echo $this->element( 'layout/section_title', array( "header"    => "Question #3",
					                                                   "subheader" => "Operational Definitions",
					                                                   "separator" => ":",
					                                                   "sectionName" => $sectionName
					                                            )
					);?>
					<div class="row">
						<div class="small-12 columns">
							<p>Which of the following statements about operational definitions is <em>false</em>?</p>
						</div>
					</div>
		<div class="row">
						<div class="small-12 small-centered columns">
							<fieldset>
								<legend>Operational Definitions Knowledge</legend>
								<input type="hidden" name="data[response][post_activity][research_design]" id="post-activity_post-activity_"
								       value=""/>

								<div class="row">
									<div class="small-1 columns">
										<input type="radio" name="data[response][post_activity][research_design]"
										       id="post-activity_research-design_0" class="olt-rfield olt-param olt-radio" data-type="input"
										       value="0"/>
									</div>
									<div class="small-11 columns">
										<label for="post-activity_research-design_0">a. Operational definitions are essential to ensure good
											inter-rater reliability.</label>
									</div>
								</div>
								<div class="row">
									<div class="small-1 columns">
										<input type="radio" name="data[response][post_activity][research_design]"
										       id="post-activity_research-design_1" class="olt-rfield olt-param olt-radio" data-type="input"
										       value="1"/>
									</div>
									<div class="small-11 columns">
										<label for="post-activity_research-design_1">b. Operational definitions allow abstract concepts, like fear
											or happiness, to be measured.</label>
									</div>
								</div>
								<div class="row">
									<div class="small-1 columns">
										<input type="radio" name="data[response][post_activity][research_design]"
										       id="post-activity_research-design_2" class="olt-rfield olt-param olt-radio" data-type="input"
										       value="2"/>
									</div>
									<div class="small-11 columns">
										<label for="post-activity_research-design_2">c. Operational definitions work well when measuring animal
											behaviour, but are not applicable to human behaviour.</label>
									</div>
								</div>
								<div class="row">
									<div class="small-1 columns">
										<input type="radio" name="data[response][post_activity][research_design]"
										       id="post-activity_research-design_3" class="olt-rfield olt-param olt-radio" data-type="input"
										       value="3"/>
									</div>
									<div class="small-11 columns">
										<label for="post-activity_research-design_3">d. Operational definitions explain to others what exactly it is
											that you are measuring.</label>
									</div>
								</div>
								<div class="row">
									<div class="small-1 columns">
										<input type="radio" name="data[response][post_activity][research_design]"
										       id="post-activity_research-design_4" class="olt-rfield olt-param olt-radio" data-type="input"
										       value="4"/>
									</div>
									<div class="small-11 columns">
										<label for="post-activity_research-design_4">e. Operational definitions help to ensure that others will
											understand what it is that you measured in your study.</label>
									</div>
								</div>
							</fieldset>
							<?php echo $this->Element( "lab_ui" . DS . "save_button", array( "target" => $form_id, "class" => null,
												                                                           "text"   => null, "data" => null )
												);
												?>
						</div>
					</div>

		<?php       break;
	case "complete":
					echo $this->element( 'layout/section_title', array( "header"    => "Completion",
					                                                   "subheader" => "Ethogram Lab",
					                                                   "separator" => ":",
					                                                   "sectionName" => $sectionName
					                                            )
					);?>
					<div class="row">
						<div class="small-12 columns">
							<p>That's it, you're all finished. You're free to visit pages you've already completed to review or change your answers if you like. Then, when you are sure you're ready, press <kbd>complete</kbd> below to finalize your answers and complete the Ethogram Lab. Congratulations!</p>
                          <h1 class="huge button expand lab-finalize-button" data-finalize>Finalize & Submit</h1>
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
