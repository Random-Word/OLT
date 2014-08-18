<div class="images form">
<?php echo $this->Form->create('Image'); ?>
	<fieldset>
		<legend><?php echo __('Edit Image'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('asset_id');
		echo $this->Form->input('format');
		echo $this->Form->input('height');
		echo $this->Form->input('width');
		echo $this->Form->input('license');
		echo $this->Form->input('data');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Image.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Image.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Images'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Assets'), array('controller' => 'assets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset'), array('controller' => 'assets', 'action' => 'add')); ?> </li>
	</ul>
</div>
