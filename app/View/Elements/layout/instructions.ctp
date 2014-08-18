<?php
/**
 * J. Mulle, for app, 7/9/14 5:52 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 */?>
<?php if ($content) {?>
<section id="<?php echo ___strToSel(array("slide-instructions","section"));?>" class="slide-section colored-bg">
	<div class="row">
		<div class="small-12 columns">
	<?php if ($content) { ?>
			<a name="slide-instructions-section"></a>
			<h1 class="instructions">Instructions </h1>
			<div class="instructions-inner-content">
				<?php echo $content;?>
			</div>
	<?php }?>
		</div>
	</div>
</section>
<?php } ?>
