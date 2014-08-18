<?php
/**
 * J. Mulle, for app, 5/14/14 4:17 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 *
 * @name slide title
 * @param (string) header
 * @param (string) subheader
 */
$joyride = false;
//<ol class="joyride-list" data-joyride>
//  <li data-id="firstStop" data-text="Next" data-options="tip_location: top">
//    <p>Hello and welcome to the Joyride documentation page.</p>
//  </li>
//  <li data-id="numero1" data-class="custom so-awesome" data-text="Next">
//    <h4>Stop #1</h4>
//    <p>You can control all the details for you tour stop. Any valid HTML will work inside of Joyride.</p>
//  </li>
//  <li data-id="numero2" data-button="Next" data-options="tip_location:top;tip_animation:fade">
//    <h4>Stop #2</h4>
//    <p>Get the details right by styling Joyride with a custom stylesheet!</p>
//  </li>
//  <li data-button="End">
//    <h4>Stop #3</h4>
//    <p>It works as a modal too!</p>
//  </li>
//</ol>
if ($header == "olt_tutorial") $joyride = true;
$destination = ___strToSel(array("slide-title", "section"));
?>
<section id="<?php echo $destination;?>" class="slide-section colored-bg">
	<div class="row">
		<div class="small-12 columns">
			<h1 id="slide-title-header" class="slide-title expand text-center">
		<?php
				echo $header;
				if ($subheader) {?>
					<br /><span class="subheader slide-title"><?php echo $subheader;?></span>
		<?php   };?>
			</h1>
			<?php
				if ($infobar) {
					echo $this->Element("layout/infobar", $infobar);
				}
			?>
		</div>
	</div>
</section>