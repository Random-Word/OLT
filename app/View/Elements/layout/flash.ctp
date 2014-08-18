<?php
/**
 * J. Mulle, for app, 7/13/14 12:25 AM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 */
?>
<div id="flash-content-container" <?php if (empty($message) ) echo ___cD(array("hide"));?>>

	<div id="flash-content" class="">
		<?php echo $message; ?>
	</div>
	<div class="text-right" style="width:100%">
		<a href="#" id="dismiss-flash" data-on="click" data-do='{"action":"fn.layout.hide","args":{"target_id":"#flash-content-container", "method":"fade"}}' class="actionable tiny button secondary">OK</a>
	</div>
</div>