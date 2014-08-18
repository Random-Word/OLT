<div class="labs form">
<?php echo $this->Form->create('Lab'); ?>
	<fieldset>
		<legend><?php echo __('Edit Lab'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('lab_scheme_id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('published');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Lab.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Lab.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Labs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Lab Schemes'), array('controller' => 'lab_schemes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lab Scheme'), array('controller' => 'lab_schemes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rsets'), array('controller' => 'rsets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rset'), array('controller' => 'rsets', 'action' => 'add')); ?> </li>
	</ul>
</div>
