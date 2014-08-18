<?php
/**
 * J. Mulle, for app, 7/9/14 7:37 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 */

$slidePointString = $value['slide']." / ".$value['total'];
?>
<div class="row">
	<div id="information-bar" class="small-12 columns">
		<div id="task-count" class="round info label infobox"><strong>Tasks to Perform:</strong> <?php echo $tasks;?></div>
		<div id="slide-points" class="round info label infobox"><strong>Available Points On This Page:</strong> <?php echo $slidePointString;?></div>
	</div>
</div>