<?php
/**
 * J. Mulle, for app, 7/10/14 8:49 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 */ ?>


<div class="row">
	<div class="small-12 columns">
		<h1 class="section-title">
	<?php
			echo $separator && $subheader ? $header.$separator : $header;
			if ($subheader) {?>
				<span class="subheader"><?php echo $subheader;?></span>
	<?php   };?>
		</h1>
	</div>
</div>
