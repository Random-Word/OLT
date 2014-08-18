<?php
/**
 * J. Mulle, for app, 5/14/14 5:16 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 */

?>

<?php
extract( $assets );
extract( $rset[ "data" ][ "params" ] );
$opDefs = $params_scheme[ 'research_subject' ][ 'data' ][ 'options' ][ $research_subject ][ 'operational_definitions' ];
$interval_value = $config[ 'interval_value']; // todo:there needs to be a strategy for automating access to these

$controls_array = array( "buttons" => array( array( "action"  => "refresh",
                                                    "string"  => "Reload",
                                                    "options" => array() ),
                                             array( "action"  => "pause",
                                                    "string"  => "Pause",
                                                    "options" => array() ),
                                             array( "action"  => "playFor",
                                                    "string"  => "Play Next %interval%s",
                                                    "options" => array(
	                                                    "interval" => $interval_value ) ),
                                             array( "action"  => "jumpList",
                                                    "string"  => "List",
                                                    "options" => array(
	                                                    "autoplay" => 10,
	                                                    "implicit" => true,
	                                                    "toc"      => array(),
	                                                    "interval" => $interval_value, // time to updateCounter over
	                                                    "start"    => 0, // time to start incrementing
	                                                    "stop"     => $video_2['properties']['duration'], // time to stop incrementing
	                                                    "label"    => null )
	                                             // a regex string to apply to the labelled output; a pipedream for the moment
                                             ) ),
                         "style"   => array( "button_size" => "small" ),
                         "wrap"    => true
);

$video_2['properties']['intervalize'] = $interval_value; // todo: this kind of thing should probably be done in the controller, eventually, by inferring the need from the schema
$video_2['properties']['on'] = 'e.intervalChange';
$video_2['properties']['do'] = 'local.loadInterval';

// build selectors for response ui
$counterId = ___strToSel( array( $slide[ 'name' ], $rFields[0]['name'], "counter" ));
$tallyId = ___strToSel( array( $slide[ 'name' ], $rFields[0]['name'], "tally" ));
$videoId = ___strToSel(array($slide[ "name" ], $rFields[0]['name'], "video"));
$finalizerId = ___strToSel( array( $slide[ 'name' ], $rFields[0]['name'], "finalizer" ));
$dataFixtureId = ___strToSel( array( $slide[ 'name' ], $rFields[0]['name'], "data fixture" ));
$intervalFixtureId = ___strToSel(array($slide['name'], $rFields[0]['name'], "interval-label", "fixture"));
$formId = ___strToSel(array($slide['name'], $rFields[0]['name'], "Form"));
// build interval strings
$intervalStrings = array();

for ($i=0; $i<ceil($video_2['properties']['duration'] / 10); $i++) {
	$interval =  "t".str_pad($i*$interval_value, 3, 0, STR_PAD_LEFT);
	$intervalStrings[] = $interval;
}

$print_interval_times = true; // this was made up for debugging; if you find this and don't understand it, remove all references & del;
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

		case "behaviour_counting_2":
			$taskName = $sectionName;
			echo $this->element( 'layout/section_title', array( "header"    => $slide[ 'title' ],
			                                                   "subheader" => $slide[ 'subtitle' ],
			                                                   "separator" => ":",
			                                                   "sectionName" => $sectionName
			                                            )
			);?>
		<div class="row">
			<div class="small-6 columns">
				<div class="off-canvas-wrap enclose" data-offcanvas data-twin=1>
					<div class="inner-wrap">
						<div class="row">
							<div class="small-12 columns">
								<ul class="olt-heading menu">
									<li class="heading togggler>">
										<a class="left-off-canvas-toggle" href="#" ><span class="small note-text">&lsaquo;&lsaquo;&nbsp;View Your Ethogram</span></a>
									</li>
									<li class="heading toggler right">
										<a class="right-off-canvas-toggle" href="#" ><span class="small note-text">Select Operational Definition&nbsp;&rsaquo;&rsaquo;</span></a>
									</li>
								</ul>
							</div>
						</div>
						<aside class="right-off-canvas-menu">
							<div class="row">
								<ul class="pagevar menu" data-for-pagevar="operational_definition">
							<?php foreach($opDefs as $i => $od) {
								$dataAttr = array("pagevar-opt" => ___asParam($od['label']),
								                  "opt-properties" => array("description" => $od['description']),
								                  "active" => $active = $i == 0);
								$classArray = array("text-center");
								if ($i == 0) array_push($classArray, "active");

								?>
									<li <?php echo ___cD($classArray);?> <?php echo ___dA($dataAttr);?>>
										<h4 ><a href="#_"> <?php echo $od['label'];?></a></h4>
									</li>
							<?php }?>
								</ul>
							</div>
						</aside>
						<aside class="left-off-canvas-menu">
							<div class="row">
								<div class="small-12 columns">
									<div class="olt-datasheet dark compact read-only olt-response">
										<h4 class="text-center" data-pagevar="operational_definition" data-pagevar-update="html.forhumans"><?php echo $od['label'];?></h4>
										<dl id="<?php echo $dataFixtureId;?>" class="h5-sized">
											<?php foreach ($intervalStrings as $i => $interval_str) {?>
											<dt class="small-6 columns olt-rfield descriptor">
												#<?php echo $i;?>
												<?php if ($print_interval_times) {?>
												<span class="diminished subheader">(<?php echo $i*$interval_value;?>s - <?php echo ($i+1)*$interval_value;?>s)</span>
												<?php } ?>
											</dt><dd class="small-6 columns value text-center">
												<span id="<?php echo ___strToSel(array($slide['name'], $rFields[0]['name']."-tally", $interval_str,"fixture"));?>"
												      class="value">0</span>
												<?php } ?>
											</dd>
										</dl>
									</div>
								</div>
							</div>
						</aside>
						<div class="row">
							<div class="small-12 columns">
								<div class="olt-datasheet">
									<dl class="h3-sized">
										<dt class="small-4 columns descriptor">Behavior</dt
										><dd class="small-8 columns value text-center">
											<span data-pagevar="operational_definition" data-pagevar-update="html.forhumans"><?php echo ucfirst( $opDefs[0]['label'] ); ?></span>
										</dd
										><dt class="small-4 columns descriptor">Description</dt
										><dd class="small-8 columns value">
											<span class="diminished" data-pagevar="operational_definition.description" data-pagevar-update="html.raw"><?php echo $opDefs[0]['description']; ?></span>
										</dd
										><dt class="small-4 columns descriptor">Interval #</dt
										><dd id="<?php echo $intervalFixtureId?>" class="small-8 columns value text-center"></dd>
										<dt class="small-4 columns tuple descriptor"> Count </dt
										><dd class="small-8 columns tuple value">
										<?php echo $this->Element("lab_ui".DS."counter", array(
												"slide_name" => $slide[ 'name'],
												"param_or_response_name" => $rFields[0]['name'],
												"incrementer" => true,
												"decrementer" => true,
												"triangles" => true,
												"arrangement" => "horizontal",
												"data" => array("active" => false,
												                "activate" => '{"target":"'.$videoId.'", "event":"play"}',
												                "deactivate" => '{"target":"'.$videoId.'", "event":"pause"}',
																"target" => false,
												                "require_target" => true,
												                "allow_negative" => false,
												                "ceiling" => false,
												                "floor"=> false,
												                "start" => 0),
										        "options" => array("font_size_class" => "h3-sized")
										                                                 ));?>
										</dd>
									</dl>
								</div>
							</div>
						</div>
						<a class="exit-off-canvas"></a>
					</div>
				</div>
			</div>
			<div class="small-6 columns" data-twin=1>
					<?php echo $this->element( "lab_ui/html5v", array( "id_parts" => array( $slide[ "name" ], $rFields[0]['name']),
					                                                   "path"     => $video_2['path'],
					                                                   "data"     => $video_2['properties'],
					                                                   "controls" => $controls_array )
					); ?>
			</div>
		</div>
		<div class="row">
			<div class="small-12 columns">
				<?php

				echo $this->Element("lab_ui/save_button", array("text" => "Save",
				                                                      "class" => array(),
				                                                      "write" => array(),
				                                                      "data"=> array(),
				                                                      "target"=> $formId));?>
			</div>
		</div>
		<div id="rset-data">
		<?php
		echo $this->Form->create('', array("id"=>$formId));
		foreach($opDefs as $od) {
			foreach ($intervalStrings as $iStr) {
				echo $this->Form->input($i, array("type" => "hidden",
				                                "id" => ___strToSel(array($slide['name'], $rFields[0]['name']."-tally", $od['label'],
				                                                                             $iStr,"value")),
				                                "class" => "hidden",
				                                "label" => false,
				                                "div" => false,
				                                "value" => 0,
				                                "name" =>"data[Response][".$slide['name']."][$taskName][".$od['label']."][$iStr]",
				                                "data-initialized" => 1
				                                ));
				echo "\n";
			}
		}

		echo $this->Form->end();
		?>
		</div>
			<?php   break;
				case "footer":
					echo $this->element("layout/footer");
					break;
			endswitch;?>
			</section>
		<?php endif; //if:sectionName == slide-instructions
		endforeach; //section printing ?>
<script>
var local = {
		counterId:"<?php echo $counterId;?>",
		tallyId: "<?php echo $tallyId;?>",
		intervalFixtureId: "<?php echo $intervalFixtureId;?>",
		intervalFormatStr: "<span>{0} <span class=\"diminished subheader\">({1}s&#8211; {2}s)</span></span>",
		fetchList:{
			player:"manifest.html5v.<?php echo ___strToSel(array($slide['name'], $rFields[0]['name'],"video"));?>",
			refresh:"fn.av.refresh"
		},
		init: function() {
			$(document).on("pagevarUpdate", local.loadBehavior);
		},

		generateSelector: function(intervalStr, operationalDefinition, fixture) {
			var debug = false;
			if (debug) pr([intervalStr, operationalDefinition, fixture], "generateSelector()");
			// note: the fixtures don\'t use the oper.def. part b/c they are always matched to the current interval, not the op.def
			var base = "<?php echo ___strToSel(array($slide['name'], $rFields[0]['name']."-tally"));?>";
			var od = OLT.fn.util.getPagevar("operational_definition").replace("_","-");
			if ( typeof(operationalDefinition) == "string" ) od = operationalDefinition;
			var type = fixture ? "fixture" : "value";
			var parts = operationalDefinition ? [base, od, intervalStr, type] : [base, intervalStr, type];
			return parts.join("_")
		},
		storeCurrentTally: function(previousInterval) {
			var debug = false;
			if (debug) pr(previousInterval,"storeCurrentTally()");
			var intervalString = local.intervalStr(previousInterval.time.toString());
			var currentTally = $(asId(local.tallyId)).data("tally");
			var rField = asId(local.generateSelector(intervalString, true, false));
			var intervalFixture = asId(local.generateSelector(intervalString, false, true));
			if (debug) pr(intervalFixture, "intervalFixture?");
			$(rField).val(currentTally);
			$(intervalFixture).html(currentTally);

			return true;
		},
		loadNewData: function(currentInterval) {
			var debug = false;
			if (debug) pr(currentInterval,"loadNewData()");
			var intervalString = local.intervalStr(currentInterval.time.toString());
			var rField = asId(local.generateSelector(intervalString, true, false));
			var storedValue = $(rField).val();
			$(asId(local.tallyId)).data("tally", storedValue)
			$(asId(local.tallyId)).html(storedValue);


			return true;
		},
		intervalStr: function(intervalTime) {
			var debug = false;
			if (debug) pr(intervalTime, "intervalStr()");

			return "t{0}".format(strpad(intervalTime, 3, 0, 1));
		},
		updateIntervalLabel: function(currentInterval, intervalList) {
			var debug = false;
			if (debug) pr([currentInterval, intervalList], "updateIntervalLabel()");

			var totalIntervals = obLen(intervalList) ;
			var nextIntervalTime = null;
			if (currentInterval.index+1 < totalIntervals) {
				nextIntervalTime = intervalList[currentInterval.index + 1];
			}

			var newIntervalFixtureLabel = local.intervalFormatStr.format(currentInterval.index, currentInterval.time, nextIntervalTime);
			$( asId(local.intervalFixtureId)).html(newIntervalFixtureLabel);

			return true;
		},
		loadInterval: function(e, data) {
			var debug = false;
			if (debug) pr([e, data], "loadInterval()");

			// first, store the data from the previous / outgoing interval if need be
			if (data.previousInterval != false) local.storeCurrentTally(data.previousInterval);

			// then load data for current interval
			local.loadNewData(data.currentInterval);

			// update fixtures, labels & ui elements
			local.updateIntervalLabel(data.currentInterval, data.player.interval.list);

			return true;
		},
		loadBehavior: function(e, data) {
			var player = local.player;
			for (var i in player.interval.list) {
				var intervalStr = local.intervalStr(player.interval.list[i]);
				var intervalFixture = local.generateSelector(intervalStr, false, true);
				var behaviourField = local.generateSelector(intervalStr, true, false);
				var storedValue = $(asId(behaviourField)).val();
				$(asId(intervalFixture) ).html(storedValue);
			}

			local.refresh(player.id);
		}

	};
</script>
