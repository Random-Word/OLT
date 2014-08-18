<div class="labSchemes index">
	<h2><?php echo __('Lab Schemes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('scheme'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($labSchemes as $labScheme): ?>
	<tr>
		<td><?php echo h($labScheme['LabScheme']['id']); ?>&nbsp;</td>
		<td><?php echo h($labScheme['LabScheme']['created']); ?>&nbsp;</td>
		<td><?php echo h($labScheme['LabScheme']['modified']); ?>&nbsp;</td>
		<td><?php echo h($labScheme['LabScheme']['scheme']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $labScheme['LabScheme']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $labScheme['LabScheme']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $labScheme['LabScheme']['id']), null, __('Are you sure you want to delete # %s?', $labScheme['LabScheme']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Lab Scheme'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Labs'), array('controller' => 'labs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lab'), array('controller' => 'labs', 'action' => 'add')); ?> </li>
	</ul>
</div>
