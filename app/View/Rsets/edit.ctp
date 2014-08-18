<div class="rsets form">
<?php echo $this->Form->create('Rset'); ?>
	<fieldset>
		<legend><?php echo __('Edit Rset'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('lab_id');
		echo $this->Form->input('completed');
		echo $this->Form->input('completed_on');
		echo $this->Form->input('data');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Rset.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Rset.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Rsets'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Labs'), array('controller' => 'labs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lab'), array('controller' => 'labs', 'action' => 'add')); ?> </li>
	</ul>
</div>
