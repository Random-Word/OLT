<?php $lab_title = "Ethogram"; ?>
<!DOCTYPE html>
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<?php echo $this->Html->charset(); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title><?php echo $title_for_layout; ?></title>
	<?php   echo $this->Html->meta('icon');
			echo $this->Html->css(array("http://fonts.googleapis.com/css?family=Oswald:400,700,300", "http://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800",'http://fonts.googleapis.com/css?family=Droid+Sans+Mono','vendor/foundation-icons','vendor/jquery.ui','app') );
			echo $this->Html->script(array('http://kleinlab.psychology.dal.ca/libraries/jon/js/handy.js', "vendor/md5.js"));
			echo $this->Html->script('vendor/modernizr');
			echo $this->Html->script(array('vendor/jquery','vendor/jquery.ui','vendor/jquery.cookie','vendor/snap.svg.min','vendor/placeholder','vendor/fastclick'), array('block' => 'jquery'));
			echo $this->Html->script(array('vendor/foundation.min'), array('block' => 'foundation'));
			echo $this->Html->script( array("utilities",
			                                "olt".DS."Rset",
			                                "olt".DS."Ticket",
			                                "olt".DS."OLT",'app'), array( 'block' => 'app' ) );
			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
	if (!(isset($page)) ) {
		$here = explode("/",$this->request->here);
		$page = $here[count($here) -1];
	}
	?>
</head>

<body data-layout="default">

<div class="masthead show-for-xlarge-up">
		<h1 class="masthead xlg">OnlineLabTool</h1> <h4 class="subheader"><?php echo $page;?></h4>
</div>

<div id="page-heading" class="olt-heading text-center">
	<div id="topnav" class="page-frame">
		<?php //echo $this->Element("lab_nav", array("options" => $nav)); ?>
	</div>
	<?php echo $this->element("layout/user_panel");?>
</div>

<?php echo $this->Element('mobile');?>

<div class="row show-for-medium-up">
	<div id="slide-content" class="small-12 large-12 columns">
		<?php echo $this->Element("layout/flash", array("message" => $this->Session->flash()));?>
		<?php echo $this->fetch('content'); ?>
	</div>
</div>


<div id="ajax-load-spinner"></div>
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
</script>
</body>
</html>