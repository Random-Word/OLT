<div class="labSchemes form">
<?php echo $this->Form->create('LabScheme'); ?>
	<fieldset>
		<legend><?php echo __('Edit Lab Scheme'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('scheme');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('LabScheme.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('LabScheme.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Lab Schemes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Labs'), array('controller' => 'labs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lab'), array('controller' => 'labs', 'action' => 'add')); ?> </li>
	</ul>
</div>
