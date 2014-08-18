<div class="images view">
<h2><?php echo __('Image'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($image['Image']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Asset'); ?></dt>
		<dd>
			<?php echo $this->Html->link($image['Asset']['id'], array('controller' => 'assets', 'action' => 'view', $image['Asset']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Format'); ?></dt>
		<dd>
			<?php echo h($image['Image']['format']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Height'); ?></dt>
		<dd>
			<?php echo h($image['Image']['height']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Width'); ?></dt>
		<dd>
			<?php echo h($image['Image']['width']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('License'); ?></dt>
		<dd>
			<?php echo h($image['Image']['license']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data'); ?></dt>
		<dd>
			<?php echo h($image['Image']['data']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Image'), array('action' => 'edit', $image['Image']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Image'), array('action' => 'delete', $image['Image']['id']), null, __('Are you sure you want to delete # %s?', $image['Image']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Images'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assets'), array('controller' => 'assets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset'), array('controller' => 'assets', 'action' => 'add')); ?> </li>
	</ul>
</div>
