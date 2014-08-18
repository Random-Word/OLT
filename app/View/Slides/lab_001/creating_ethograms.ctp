<?php
extract( $assets );
extract( $rset[ 'data' ][ 'params' ] );

echo $this->element( "layout/slide_title", array( "header"    => $slide[ 'title' ],
                                                  "subheader" => $slide[ 'subtitle' ],
                                                  "separator" => ":",
                                                  "infobar" => $infobar
                                           )
);?>
<?php foreach ( $sections as $sectionName => $include ):
	if ( $sectionName != "slide-instructions" && $sectionName != "slide-title"):?>
	<section id="<?php echo ___strToSel( array( $sectionName, "section" ) ); ?>" class="slide-section">
		<!-- TaskSection: Behavior Counting 2 -->
<?php switch ($sectionName):
		case "creating_ethograms":
			echo $this->element( 'layout/section_title', array( "header"    => "Creating Ethograms",
			                                                   "subheader" => false,
			                                                   "separator" => ":",
			                                                   "sectionName" => $sectionName
			                                            )
			);?>
	<div class="row">
		<div class="small-12 columns">
			<p>For this part of the activity, you will be provided with operational definitions of specific behaviours
				and will use them to make a continuous count or tally of behaviours in a series of short videos.</p>

			<p>Each of these videos has been divided into fixed time interval (10 sec). In order to keep a tally of
				the described behaviours, you will click a button each time the behaviour occurs. Your tally will be
				kept in a table that you can review before advancing to the next video.</p>

			<p>In the section the behaviours that have been operationally defined are presented for you to review.</p>
		</div>
	</div>
<?php       break;
		case "your_research_subject":
			echo $this->element( 'layout/section_title', array( "header"    => "Your Research Subject",
						                                                   "subheader" => "",
						                                                   "separator" => ":",
						                                                   "sectionName" => $sectionName
						                                            )
			);?>

			<div class="row">
				<div class="small-12 columns">
			<h3>Operational Definitions for <span class='success emphatic label'><?php echo $params_scheme['research_subject']['data']['options'][$research_subject]['string'];?></span></h3>

			<p class="note">These are operational defnitions for behaviours for your chosen research subject. Your goal
				will be to watch for them and count them.</p>
			<div class="olt-datasheet">
				<dl class="h3-sized">
					<?php foreach ( $params_scheme[ 'research_subject' ][ 'data' ][ 'options' ][ $research_subject ][ 'operational_definitions' ] as $od ) { ?>
					<dt class="small-2 columns descriptor"><?php echo $od['label'];?></dt
					><dd class="small-10 columns value">
						<?php echo ucfirst( $od['description'] ); ?>
					</dd>
					<?php } ?>
				</dl>
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


