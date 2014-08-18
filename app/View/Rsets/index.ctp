<div class="rsets index">
	<h2><?php echo __('Rsets'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('lab_id'); ?></th>
			<th><?php echo $this->Paginator->sort('completed'); ?></th>
			<th><?php echo $this->Paginator->sort('completed_on'); ?></th>
			<th><?php echo $this->Paginator->sort('data'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($rsets as $rset): ?>
	<tr>
		<td><?php echo h($rset['Rset']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($rset['User']['id'], array('controller' => 'users', 'action' => 'view', $rset['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($rset['Lab']['name'], array('controller' => 'labs', 'action' => 'view', $rset['Lab']['id'])); ?>
		</td>
		<td><?php echo h($rset['Rset']['completed']); ?>&nbsp;</td>
		<td><?php echo h($rset['Rset']['completed_on']); ?>&nbsp;</td>
		<td><?php echo h($rset['Rset']['data']); ?>&nbsp;</td>
		<td><?php echo h($rset['Rset']['created']); ?>&nbsp;</td>
		<td><?php echo h($rset['Rset']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $rset['Rset']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $rset['Rset']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $rset['Rset']['id']), null, __('Are you sure you want to delete # %s?', $rset['Rset']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Rset'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Labs'), array('controller' => 'labs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lab'), array('controller' => 'labs', 'action' => 'add')); ?> </li>
	</ul>
</div>
