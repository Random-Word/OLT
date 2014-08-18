<?php
/**
 * J. Mulle, for app, 7/10/14 8:32 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 */
?>

<div id="slide-nav" class="page-frame" data-options="destination_threshold:65;throttle_delay:0;">
	<div class="row">
		<div class="small-12 columns">
		<ul id="slide-nav-list" class="small-block-grid-<?php echo count($sections);?>">
		<?php
			$i = 1;
			foreach ($sections as $s => $include) {
				if ($include) {
					$destination = ___strToSel(array($s,'section'));
					$classes = array("slide-nav-anchor", "pointer-cursor", "h4-sized");
					if ($s == "slide-title") $classes[] = "active";
					?>
					<li <?php echo ___cD($classes);?> data-scroll-to="#<?php echo $destination;?>">
						<?php echo $i.". ".___selToStr(str_replace("slide-", "", $s));?></a>
					</li>
		<?php
				$i++;
				}
			}
			?>
			</ul>
		</div>
	</div>
</div>
