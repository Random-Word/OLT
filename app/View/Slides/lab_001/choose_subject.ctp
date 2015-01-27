<?php
extract( $assets );
extract( $rset[ 'data' ][ 'params' ] );
$taskName = "research_subject";
echo $this->element( "layout/slide_title", array( "header"    => $slide[ 'title' ],
                                                  "subheader" => $slide[ 'subtitle' ],
                                                  "separator" => ":",
                                                  "infobar" => $infobar
                                           )
);?>

<?php echo $this->Element("layout/instructions", array("content" => $slide['text']['instructions']));?>

<?php foreach ( $sections as $sectionName => $include ):
	if ( $sectionName != "slide-instructions" && $sectionName != "slide-title"):?>
	<section id="<?php echo ___strToSel( array( $sectionName, "section" ) ); ?>" class="slide-section">
<?php switch ($sectionName):
		case "research_subject":
			echo $this->element( 'layout/section_title', array( "header"    => $slide[ 'title' ],
			                                                   "subheader" => $slide[ 'subtitle' ],
			                                                   "separator" => ":",
			                                                   "sectionName" => $sectionName
			                                            )
			);?>

			<div class="row">
				<div class="small-4 columns">
					<h3 class="text-center">I would prefer videos of:</h3>
					<?php
					// prepare dynamic selectors
					$form_id = ___strToSel( array($slide[ 'name' ], $taskName, "form") );
					$param_input_id = ___strToSel( array( $slide[ 'name' ], "research-subject" ) );

					// build save buttons
					foreach ( $params_scheme[ 'research_subject' ][ 'data' ][ 'options' ] as $opt ) {
						$__class         = $research_subject == $opt[ 'value' ] ? array( "medium", "actionable", "active" ) : array( "medium", "actionable" );
						$__write         = array(array("to" => $param_input_id, "value" => $opt[ 'value' ]));
						$opDefs = json_encode($opt['operational_definitions']);


						echo $this->Element( "lab_ui" . DS . "save_button", array( "text"   => $opt[ 'string' ],
						                                                           "class"  => $__class,
						                                                           "target" => $form_id,
						                                                           "write"  => $__write,
						                                                           "data"   => array("param-group" => $taskName, "on" =>"click", "do" => "local.switchOds") )
						);
					}
					?>
				</div>
				<div class="small-8 columns">
					<div class="row">
						<h3 class="text-center">Operational Definitions for
							<span id="<?php echo ___strToSel(array($slide['name'], $taskName,"name"));?>">
								<?php echo $research_subject ? $params_scheme['research_subject']['data']['options'][$research_subject]['string']: "[research subject]";?>
							</span>
						</h3>
						<div class="small-12 columns olt-datasheet olt-panel">
								<?php
								$rsubOptions = $params_scheme['research_subject']['data']['options'];
								$rsubDatalistIds = array();
								foreach ($rsubOptions as $rsub) {
									if (!$research_subject) $research_subject = -1;
									$classArray = array("h4-sized", "expand", $research_subject == $rsub['value'] ? "active" : "hidden");
									$rsubDatalistIds[$rsub['value']] = ___strToSel(array($slide['name'], $taskName, 'option', $rsub['value']));
									?>
							<table id="<?php echo $rsubDatalistIds[$rsub['value']];?>" <?php echo ___cD($classArray);?>>
							<?php foreach($rsub['operational_definitions'] as $od) {?>
								<tr>
									<td class="small-4 columns descriptor"><h5><?php echo $od['label'];?></h5></td>
									<td class="small-8 columns value"> <?php echo $od['description'];?></td>
								</tr>
								<?php } ?>
							</table>
						<?php } ?>
						</div>
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


<?php
// create hidden param form
echo $this->Form->create( false, array( "id" => $form_id ) );
echo $this->Form->input( false, array( "type"           => "hidden",
                                       "id"             => $param_input_id,
                                       "name"           => AppController::cakeforms_name( array( "params",
                                                                                                 "research-subject" )
	                                       ),
                                       "class"          => array( "olt-param" ),
                                       "data-olt-param" => true,
                                       "data-required"  => true,
                                       "data-type"      => "input",
                                       "value"          => $research_subject )
);
echo $this->Form->end();

?>
<script>
	var local = {
		switchOds: function() {
			var e = arguments[0];
			var target = $(e.target).data().write[0].value;
			var stringVal = $(e.target).html();

			$("div.olt-datasheet table").each(function() {
				var id = $(this).attr('id');
				var targetCompare = id.split("_")[3].replace("-","_");

				if ( target == targetCompare) {
					$(this).removeClass("hidden").addClass('active').show("fade");
					$("#<?php echo ___strToSel(array($slide['name'], $taskName,"name"));?>").html(stringVal);
				} else {
					$(this).removeClass("active").addClass('hidden').hide("fade");
				}
			});

		}
	};
</script>