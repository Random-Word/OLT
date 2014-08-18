<div class="videos index">
	<h2><?php echo __('Videos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('asset_id'); ?></th>
			<th><?php echo $this->Paginator->sort('format'); ?></th>
			<th><?php echo $this->Paginator->sort('height'); ?></th>
			<th><?php echo $this->Paginator->sort('width'); ?></th>
			<th><?php echo $this->Paginator->sort('duration'); ?></th>
			<th><?php echo $this->Paginator->sort('license'); ?></th>
			<th><?php echo $this->Paginator->sort('data'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($videos as $video): ?>
	<tr>
		<td><?php echo h($video['Video']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($video['Asset']['id'], array('controller' => 'assets', 'action' => 'view', $video['Asset']['id'])); ?>
		</td>
		<td><?php echo h($video['Video']['format']); ?>&nbsp;</td>
		<td><?php echo h($video['Video']['height']); ?>&nbsp;</td>
		<td><?php echo h($video['Video']['width']); ?>&nbsp;</td>
		<td><?php echo h($video['Video']['duration']); ?>&nbsp;</td>
		<td><?php echo h($video['Video']['license']); ?>&nbsp;</td>
		<td><?php echo h($video['Video']['data']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $video['Video']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $video['Video']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $video['Video']['id']), null, __('Are you sure you want to delete # %s?', $video['Video']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Video'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Assets'), array('controller' => 'assets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset'), array('controller' => 'assets', 'action' => 'add')); ?> </li>
	</ul>
</div>
