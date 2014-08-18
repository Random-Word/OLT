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

<?php foreach ( $sections as $sectionName => $include ):
	if ( $sectionName != "slide-instructions" && $sectionName != "slide-title"):?>
	<section id="<?php echo ___strToSel( array( $sectionName, "section" ) ); ?>" class="slide-section">

<?php switch ($sectionName):
		case "definition_of_an_ethogram":
			echo $this->element( 'layout/section_title', array( "header"    => $slide[ 'title' ],
			                                                   "subheader" => $slide[ 'subtitle' ],
			                                                   "separator" => ":",
			                                                   "sectionName" => $sectionName
			                                            )
			);?>
	<div class="row">
		<div class="small-8 columns">
			<p>An ethogram is a systematic record of behaviour. Ethograms are particularly important in recording the behaviour of animals in the wild, though they can be useful to measure behaviour in a variety of situations. Although a simple technique, it is difficult to reliably execute.</p>
		</div>

		<div class="small-4 columns text-right">
			<?php echo $this->Html->image("deer_running.svg", array("alt" => "An image of a deer leeping; an example of behaviour that can be captured in an ethogram."));?>
		</div>
		<div class="small-12 columns text-center">
			<?php echo $this->Html->image("humans_running.svg", array("alt" => "An image of a man running; another example of behaviour that can be captured in an ethogram."));?>
		</div>
	</div>
	<?php   break;
		case "footer":
			echo $this->element("layout/footer");
			break;
	endswitch;?>
	</section>
<?php endif; //if:sectionName == slide-instructions
endforeach; //section printing

?>