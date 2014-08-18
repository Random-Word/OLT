<div class="labSchemes form">
<?php echo $this->Form->create('LabScheme'); ?>
	<fieldset>
		<legend><?php echo __('Add Lab Scheme'); ?></legend>
	<?php
		echo $this->Form->input('scheme');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Lab Schemes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Labs'), array('controller' => 'labs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lab'), array('controller' => 'labs', 'action' => 'add')); ?> </li>
	</ul>
</div>
