<?php
/**
 * J. Mulle, for app, 7/12/14 8:09 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 */

?>

<div id="login-container" class="row">
	<div id="home-logo" class="small-6 columns">
		<?php echo $this->Html->image("psyo_1031_logo.dark.png");?>
	</div>
	<div id="login-wrapper" class="small-6 columns">
		<h1>Log In</h1>
	<?php
	echo $this->Form->create('User', array(
	    'url' => array(
	        'controller' => 'users',
	        'action' => 'login'
	    )
	));
	echo $this->Form->input('User.username', array('label' => "Dalhousie E-mail Address"));
	echo $this->Form->input('User.password');
	echo $this->Form->end('Login');
	?>
		<div class="row">
			<div class="small-12 columns">
				<br />
				<h4>Not yet registered? No problem, <?php echo $this->Html->link( "Sign Up Here!", ___cakeUrl("users","signup"), array("class" => "transition"));?></h4>
			</div>
		</div>
	</div>
</div>