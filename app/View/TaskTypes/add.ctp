<div class="taskTypes form">
<?php echo $this->Form->create('TaskType'); ?>
	<fieldset>
		<legend><?php echo __('Add Task Type'); ?></legend>
	<?php
		echo $this->Form->input('type');
		echo $this->Form->input('subtype');
		echo $this->Form->input('name');
		echo $this->Form->input('params');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Task Types'), array('action' => 'index')); ?></li>
	</ul>
</div>
