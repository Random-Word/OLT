<?php
/**
 * J. Mulle, for app, 7/3/14 4:12 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 *
 *
 * @name arrow_label element
 * @desc
 * @arg (str) content
 * @arg  (str) direction
 * @arg (int) hsize Eg: h1, h2, etc.
 *
 *
 */
?>
<div class="arrow-label">
<?php if ($direction == "left") {?>  <a href="#" class="olt-triangle left-facing"></a><?php }?>
	<h<?php echo $hsize;?> class="expand"><?php echo $content;?></h<?php echo $hsize;?>>
<?php if ($direction == "right") {?>  <a href="#" class="olt-triangle right-facing"></a><?php }?>
</div>