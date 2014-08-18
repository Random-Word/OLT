<div class="labs form">
<?php echo $this->Form->create('Lab'); ?>
	<fieldset>
		<legend><?php echo __('Add Lab'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Labs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Lab Schemes'), array('controller' => 'lab_schemes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lab Scheme'), array('controller' => 'lab_schemes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rsets'), array('controller' => 'rsets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rset'), array('controller' => 'rsets', 'action' => 'add')); ?> </li>
	</ul>
</div>
