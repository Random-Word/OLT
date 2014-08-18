<div class="audios form">
<?php echo $this->Form->create('Audio'); ?>
	<fieldset>
		<legend><?php echo __('Add Audio'); ?></legend>
	<?php
		echo $this->Form->input('asset_id');
		echo $this->Form->input('format');
		echo $this->Form->input('length');
		echo $this->Form->input('license');
		echo $this->Form->input('data');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Audios'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Assets'), array('controller' => 'assets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset'), array('controller' => 'assets', 'action' => 'add')); ?> </li>
	</ul>
</div>
