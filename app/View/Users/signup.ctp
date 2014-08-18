<?php
/**
 * J. Mulle, for app, 7/12/14 9:11 PM
 * www.introspectacle.net
 * Email: this.impetus@gmail.com
 * Twitter: @thisimpetus
 * About.me: about.me/thisimpetus
 */

?>
<div class="users form">
<?php echo $this->Form->create('User', array("action" => "signup")); ?>
	<fieldset>
		<legend><?php echo __('Create an Account'); ?></legend>
	<?php
		echo $this->Form->input('username', array("label" => "Complete Dalhousie E-mail Address (ie. xxx@dal.ca)"));
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('password');
		echo $this->Form->input('student_number');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>