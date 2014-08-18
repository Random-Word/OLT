<?php $lab_title = "Ethogram"; ?>
<!DOCTYPE html>
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<?php echo $this->Html->charset(); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php   echo $this->Html->meta('icon');
			echo $this->Html->css(array('vendor/jsoneditor-min.css','vendor/foundation-icons','vendor/jquery.ui','//vjs.zencdn.net/4.4/video-js.css','app') );
			echo $this->Html->script('http://kleinlab.psychology.dal.ca/libraries/jon/js/handy.js');
			echo $this->Html->script(array('vendor/modernizr', 'vendor/jsoneditor/jsoneditor-min.js'));
			echo $this->Html->script(array('vendor/jquery','vendor/jquery.ui','vendor/jquery.cookie','vendor/placeholder','vendor/fastclick','//vjs.zencdn.net/4.4/video.js'), array('block' => 'jquery'));
			echo $this->Html->script(array('vendor/foundation.min'), array('block' => 'foundation'));
			echo $this->Html->script( array('app'), array( 'block' => 'app' ) );
			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
	?>
</head>

<body>

<div class="contain-to-grid fixed">
	<nav class="top-bar" data-topbar>
		<ul class="title-area">
			<li class="name">
				<h1><a href="#">OnlineLabTool: <?php echo $lab_title;?></a></h1>
			</li>
			<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
		</ul>

		<section class="top-bar-section">
			<!-- Right Nav Section, should be an Element, probably a complicated one -->
		</section>
	</nav>
</div>




<div id="templatefu" class="row show-for-medium-up">
	<div class="small-12 large-12 columns">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
	</div>
</div>
<?php
	echo $this->fetch("jquery");
	echo $this->fetch('jquery_plugins');?>
<script>
	// global definitions, available to any app.NAME.js file (as these are loaded below in the pages_js block
	const DS = "<?php echo DS;?>";
	const WWW = "<?php echo FULL_BASE_URL;?>";
	const APP = "<?php echo $this->base;?>".substring(1);
	const H   = "#";
</script>
<?php
	echo $this->fetch("foundation");
	echo $this->fetch('app');
	echo $this->fetch('views');
// echo $this->element('sql_dump');
?>
<script>
	$(document).ready(function(){matchWindowHeight("#slide-content")}).foundation();
	$(window).resize(function(){matchWindowHeight("#slide-content")});
</script>
</body>
</html>