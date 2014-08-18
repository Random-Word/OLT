<div class="audios view">
<h2><?php echo __('Audio'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($audio['Audio']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Asset'); ?></dt>
		<dd>
			<?php echo $this->Html->link($audio['Asset']['id'], array('controller' => 'assets', 'action' => 'view', $audio['Asset']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Format'); ?></dt>
		<dd>
			<?php echo h($audio['Audio']['format']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Length'); ?></dt>
		<dd>
			<?php echo h($audio['Audio']['length']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('License'); ?></dt>
		<dd>
			<?php echo h($audio['Audio']['license']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data'); ?></dt>
		<dd>
			<?php echo h($audio['Audio']['data']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Audio'), array('action' => 'edit', $audio['Audio']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Audio'), array('action' => 'delete', $audio['Audio']['id']), null, __('Are you sure you want to delete # %s?', $audio['Audio']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Audios'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Audio'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assets'), array('controller' => 'assets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset'), array('controller' => 'assets', 'action' => 'add')); ?> </li>
	</ul>
</div>
