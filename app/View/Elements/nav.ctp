<?php
/**
 * J. Mulle, for olt, 8/19/14 7:22 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 */
// LAB NAV PREP
$_options = array("next" => null,
                  "previous" => null,
                  "jump" => true,
                  "branch" => false,
				  "toc" => null,
                  "slide_count" => null,
                  "current_slide" => null,
                  "last_slide" => false);

//todo: add logic for toc & jump, and eventually branch
extract(array_merge($_options, $options));
?>

<aside id="nav">
	<div id="reveal-slide-nav">
		<button>
			<div></div><div></div>
		</button>
	</div>
	<nav id="slide">
		<h4><?php echo $slide['title']; ?></h4>
		<ul id="slide-nav-content" data-options="destination_threshold:65;throttle_delay:0;" data-state="open">
	<?php   $i=1;
			foreach ($sections as $s => $include) {
				if ($include) {
					$destination = ___strToSel(array($s,'section'));
					$classes = array("slide-nav-anchor","pointer-cursor", "h4-sized");
					if ($s == "slide-title") $classes[] = "active";
					?>
					<li <?php echo ___cD($classes);?> data-scroll-to="#<?php echo $destination;?>">
						<div><?php echo $i;?>.&nbsp;</div>
						<div><?php echo "&nbsp;".___selToStr(str_replace("slide-", "", $s));?></div>
					</li>
	<?php       $i++;}}?>
		</ul>
	</nav>

	<nav id="lab">
		<h4><?php echo $lab_title;?> Lab</h4>
		<ul id="lab-nav-content">
			<li id="backward-nav" data-request="previous" data-target="null" <?php echo ___cD(["pagenav", !empty($previous) ? "enabled" : "disabled"]);?>>
				<a href="#"></a>&nbsp;<span>Prev</span>
		    </li
		    ><li id="slides-completed">
				<span id="current-slide"><?php echo $current_slide + 1;?></span>
				&nbsp;of&nbsp;
				<span id="total-slides"><?php echo $slide_count; ?> </span>
			</li
			><li id="forward-nav" data-request="next" data-target="null" <?php echo ___cD(["pagenav", $next && !$last_slide ? "enabled" : "disabled"]);?>>
				<span>Next</span>&nbsp;<a href="#"></a>
		    </li>
			<li id="slide-nav-form" class="hide">
				<?php echo $this->Form->create("Lab", array("id" => "LabNavForm"));
					  echo $this->Form->input("nav_current", array("type" => "hidden", "value" => $current_slide));
					  echo $this->Form->input("nav_request", array("type" => "hidden"));
					  echo $this->Form->input("nav_target", array("type" => "hidden"));
					  echo $this->Form->end();
				?>
			</li>
		</ul>
	</nav>
</aside>