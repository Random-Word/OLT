<?php
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

<div class="lab-nav">
	<div class="small-8 small-centered columns show-for-large-up">
		<div class="small-4 large-4 columns text-left top-nav-section">
			<?php if ($previous) {?>
			<h3 id="backward-nav" data-request="previous" data-target="null" class="pagenav">
				<a href="#" class="olt-triangle left-facing inherited-transition"></a> Previous

	        </h3>
			<?php } else { ?>
				<div id="backward-nav-placeholder" class="slidenav-placeholder">&nbsp;</div>
			<?php }?>
		</div>
		<div class="small-4 large-4 columns text-center top-nav-section">
			<div id="slides-completed">
				<span id="current-slide"><?php echo $current_slide + 1;?></span>
				&nbsp;&nbsp;of&nbsp;&nbsp;
				<span id="total-slides"><?php echo $slide_count; ?> </span>
			</div>
		</div>
		<div class="small-4 large-4 columns text-right top-nav-section">
			<?php if ($next && !$last_slide) {?>
			<h3 id="forward-nav" data-request="next" data-target="null" class="pagenav">
				Next <a href="#" class="olt-triangle right-facing inherited-transition"></a>
	        </h3>
			<?php } else { ?>
				<div id="forward-nav-placeholder" class="slidenav-placeholder">&nbsp;</div>
			<?php }?>
		</div>
		<div id="slide-nav-form" class="hide">
			<?php echo $this->Form->create("Lab", array("id" => "LabNavForm"));
				  echo $this->Form->input("nav_current", array("type" => "hidden", "value" => $current_slide));
				  echo $this->Form->input("nav_request", array("type" => "hidden"));
				  echo $this->Form->input("nav_target", array("type" => "hidden"));
				  echo $this->Form->end();
			?>
		</div>
		<?php echo $this->element( "slide_nav", array( "sections" => $sections ) ); ?>
	</div>

</div>