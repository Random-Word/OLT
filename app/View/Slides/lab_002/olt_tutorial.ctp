<?php
/**
 * J. Mulle, for app, 7/13/14 1:17 AM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 */
extract( $assets );
extract( $rset[ 'data' ][ 'params' ] );

echo $this->element( "layout/slide_title", array(  "header"    => $slide['title'],
		                                                  "subheader" =>$slide['subtitle'],
		                                                  "separator" => ":",
                                                          "infobar" => $infobar,
                                           )
		);?>
<?php echo $this->Element("layout/instructions", array("content" => $slide['text']['instructions']));?>
<?php foreach ( $sections as $sectionName => $include ):
	if ( $sectionName != "slide-instructions" && $sectionName != "slide-title"):?>
	<section id="<?php echo ___strToSel( array( $sectionName, "section" ) ); ?>" class="slide-section">
		<!-- TaskSection: Behavior Counting 1 -->
<?php switch ($sectionName):
		case "tutorial_content_section":
			echo $this->element( 'layout/section_title', array( "header"    => "Sections",
			                                                   "subheader" => "And what they mean",
			                                                   "separator" => ":",
			                                                   "sectionName" => $sectionName
			                                            )
			);?>

			<div class="row">
				<div class="small-12 columns">
					<p>Sections break down the content of a lab's pages for easier readability. There are basically four kinds of sections:</p>
					<ol>
						<li><strong>Title sections</strong>, which provide you with basic information about the page you're on, such as the number of tasks
							you'll perform (more on tasks later!), or how many points your activity on the page will be worth to your total score.</li>
						<li><strong>Instructions Sections</strong>, which will provide you with any instructions you may need to complete the current page.</li>
						<li><strong>Content Sections</strong>, which present you with content for which your own responsibility is taking it in. This could be video, text, images—anything! But content sections will never require you to do anything.</li>
						<li><strong>Task Sections</strong>, which are just about anything interactive. A "task" is a question, or an activity, or anything within a page for which you are expected to <em>do</em> something.
					</ol>
				</div>
			</div>
			<?php   break;
							case "footer":
								echo $this->element("layout/footer");
								break;
						endswitch;?>
						</section>
					<?php endif; //if:sectionName == slide-instructions
					endforeach; //section printing ?>

<div data-id="TUTORIAL_START" data-text="Next" data-register="center" class="tutorial-window">
	<div class="joyride-content-wrapper">
		<h3>Hi!</h3>
		<p>Welcome to the tutorial for using online lab. First, a little tour of the interface so you'll know what you're about!</p>
		<button class="tutorial-button">Next</button>
	</div>
</div>
<div data-id="lab" data-class="custom so-awesome" data-register="top" class="tutorial-window">
	<div class="tutorial-content-wrapper">
		<h3>Navigation: Part 1/4</h3>
		<p>Each lab is composed of <span class="warning">pages</span>, like you're probably used to on any old website. At the bottom-left of every page, you'll find this handy <span class="warning">navigation bar</span>. This bit in the center tells you which page of the lab you're on, and how many there are altogether.</p>
		<button class="tutorial-button">Next</button>
	</div>
</div>
<div data-id="forward-nav" data-button="Next" data-register="top-right"  class="tutorial-window">
	<div class="joyride-content-wrapper">
		<h3>Navigation: Part 2/4</h3>
		<p>When you've completed a page, you can advance your progress by pressing the <kbd>next</kbd> button.</p>
		<button class="tutorial-button">Next</button>
	</div>
</div>
<div data-id="backward-nav" data-button="Next" data-register="top-right" class="tutorial-window">
	<div class="joyride-content-wrapper">
		<h3>Navigation: Part 3/4</h3>
		<p>Currently, the <kbd>previous</kbd> button is in active,  since this is the first page of the lab and there's nothing prior to visit! Likewise, when you reach the end of a lab, the <kbd>Next</kbd> button won't be available.</p>
		<button class="tutorial-button">Next</button>
	</div>
</div>
<div data-id="slide-nav-content" data-button="Next" data-register="right" class="tutorial-window">
	<div class="joyride-content-wrapper">
		<h3>Navigation: Part 4/4</h3>
		<p>But most pages of a lab will <em>also</em> feature <span class="warning">sections</span>, which are just a way of making the content of a page a little more structured and a little less cramped.</p>
		<p>Make sure you've visited every section and completed any <span class="warning">tasks</span> they may hold before heading on to the next page. </p>
		<button class="tutorial-button">Next</button>
	</div>
</div>
<div data-id="user-panel" data-button="Next" data-register="bottom-left" class="tutorial-window">
	<div class="joyride-content-wrapper">
		<h3>Getting In and Out</h3>
		<p>If you find yourself in the wrong lab, or you've finished and it's time to close up shop, you can use this area to get back to the <span class="warning">User Homepage</span> or to <span class="warning">log out</span> completely.</p>
		<button class="tutorial-button">Next</button>
	</div>
</div>
<div data-id="TUTORIAL_END" data-register="center" class="tutorial-window">
	<div class="joyride-content-wrapper">
		<h3>Got it?</h3>
		<p>That's it for the tour. You can now finish the rest of this tutorial using the interface you've just been introduced to. If you think you missed anything just refresh the page to go again! Whee!</p>
		<button class="tutorial-button">OK!</button>
	</div>
</div>
