<?php
/**
 * J. Mulle, for app, 7/12/14 9:46 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 */
?>
<section id="student-portal">
<h1>Welcome <?php echo $this->Session->read("Auth.User.first_name");?></h1>

<div class="row">
	<div class="small-6 columns">
		<p>This is your 'homebase'. Here you can see which labs are available for you to run, and which you have already completed.</p>

		<p>Jen & Leanne: The demo lab is something I threw together in about 2 minutes. Tomorrow, if you don't need too much changed or updated, I can flush this out and add in some animations that direct students to the within-page and within-lab navigation, etc.. It's just an idea! </p>
	</div>
	<div class="small-6 columns">
		<div class="row">
			<div class="small-6 columns">
				<h3>Labs</h3>
			</div>
			<div class="small-6 columns text-center">
				<h3>Action</h3>
			</div>
		</div>
		<div class="row">
			<div id="lab-progress">
				<ul>
				<?php foreach($rsets as $rset) {?>
					<li class="small-12 columns descriptor">
						<h3 class="small-6 columns"><?php echo $rset['Lab']['name'];?></h3>
						<div class="small-2 columns text-center">&nbsp;</div>
						<?php
						if ($rset['Rset']['completed'])  {
							echo "<h5>Completed ".substr($rset['Rset']['modified'], 0,10)."</h5>";
						} else {
							echo $this->Html->link("Continue", ___cakeUrl("labs","run", $rset['Rset']['id']), array("class" => array("small-4 columns")));
						}
						?>

					</li>
				<?php }
					foreach($labs as $id => $lab) {?>
					<li class="small-12 columns descriptor">
						<h3 class="small-6 columns"><?php echo $lab;?></h3>
						<?php echo $this->Html->link("Launch", ___cakeUrl("labs","launch", $id),  array("class" => array("small-4 columns")));?>
					</li>
				<?php }?>
				</ul>
			</div>
		</div>
	</div>
</div>
</section>
<?php echo $this->Element('layout/footer');?>