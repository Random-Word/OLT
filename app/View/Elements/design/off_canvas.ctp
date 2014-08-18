<?php
/**
 * J. Mulle, for app, 7/3/14 6:36 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 *
 *
 * off_canvas element
 * @arg (array) expander
 * @arg (array) offCanvas
 * @arg (array) onCanvas
 *
 */

?>

<div class="off-canvas-wrap enclose" data-offcanvas>
	<div class="inner-wrap">
		<div class="row">
			<div class="small-12 columns">
				<ul class="olt-heading menu">
					<?php if ($expander) {?>
					<li class="<?php echo ___strToSel($expander['classes']);?>">
						<a class="left-off-canvas-toggle h3-sized" href="#" ><?php echo ___i("list-thumbnails", 0);?></a>
						<span class="small note-text"><?php echo $expander['reveals'];?></span>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<aside class="left-off-canvas-menu">
			<?php echo $offCanvas['content'];?>
	    </aside>
			<?php echo $onCanvas['content'];?>
		<a class="exit-off-canvas"></a> <!-- required to close -->
	</div>
</div>
