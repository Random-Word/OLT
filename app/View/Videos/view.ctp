<div class="videos view">
<h2><?php echo __('Video'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($video['Video']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Asset'); ?></dt>
		<dd>
			<?php echo $this->Html->link($video['Asset']['id'], array('controller' => 'assets', 'action' => 'view', $video['Asset']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Format'); ?></dt>
		<dd>
			<?php echo h($video['Video']['format']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Height'); ?></dt>
		<dd>
			<?php echo h($video['Video']['height']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Width'); ?></dt>
		<dd>
			<?php echo h($video['Video']['width']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Duration'); ?></dt>
		<dd>
			<?php echo h($video['Video']['duration']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('License'); ?></dt>
		<dd>
			<?php echo h($video['Video']['license']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data'); ?></dt>
		<dd>
			<?php echo h($video['Video']['data']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Video'), array('action' => 'edit', $video['Video']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Video'), array('action' => 'delete', $video['Video']['id']), null, __('Are you sure you want to delete # %s?', $video['Video']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Videos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assets'), array('controller' => 'assets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset'), array('controller' => 'assets', 'action' => 'add')); ?> </li>
	</ul>
</div>
