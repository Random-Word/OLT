<div class="labs index">
	<h2><?php echo __('Labs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('lab_scheme_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('published'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($labs as $lab): ?>
	<tr>
		<td><?php echo h($lab['Lab']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($lab['LabScheme']['id'], array('controller' => 'lab_schemes', 'action' => 'view', $lab['LabScheme']['id'])); ?>
		</td>
		<td><?php echo h($lab['Lab']['name']); ?>&nbsp;</td>
		<td><?php echo h($lab['Lab']['description']); ?>&nbsp;</td>
		<td><?php echo h($lab['Lab']['published']); ?>&nbsp;</td>
		<td><?php echo h($lab['Lab']['created']); ?>&nbsp;</td>
		<td><?php echo h($lab['Lab']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $lab['Lab']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $lab['Lab']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $lab['Lab']['id']), null, __('Are you sure you want to delete # %s?', $lab['Lab']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Lab'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Lab Schemes'), array('controller' => 'lab_schemes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lab Scheme'), array('controller' => 'lab_schemes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rsets'), array('controller' => 'rsets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rset'), array('controller' => 'rsets', 'action' => 'add')); ?> </li>
	</ul>
</div>
