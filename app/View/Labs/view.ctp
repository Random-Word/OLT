<div class="labs view">
<h2><?php echo __('Lab'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($lab['Lab']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lab Scheme'); ?></dt>
		<dd>
			<?php echo $this->Html->link($lab['LabScheme']['id'], array('controller' => 'lab_schemes', 'action' => 'view', $lab['LabScheme']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($lab['Lab']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($lab['Lab']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Published'); ?></dt>
		<dd>
			<?php echo h($lab['Lab']['published']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($lab['Lab']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($lab['Lab']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Lab'), array('action' => 'edit', $lab['Lab']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Lab'), array('action' => 'delete', $lab['Lab']['id']), null, __('Are you sure you want to delete # %s?', $lab['Lab']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Labs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lab'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lab Schemes'), array('controller' => 'lab_schemes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lab Scheme'), array('controller' => 'lab_schemes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rsets'), array('controller' => 'rsets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rset'), array('controller' => 'rsets', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Rsets'); ?></h3>
	<?php if (!empty($lab['Rset'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Lab Id'); ?></th>
		<th><?php echo __('Completed'); ?></th>
		<th><?php echo __('Completed On'); ?></th>
		<th><?php echo __('Data'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($lab['Rset'] as $rset): ?>
		<tr>
			<td><?php echo $rset['id']; ?></td>
			<td><?php echo $rset['user_id']; ?></td>
			<td><?php echo $rset['lab_id']; ?></td>
			<td><?php echo $rset['completed']; ?></td>
			<td><?php echo $rset['completed_on']; ?></td>
			<td><?php echo $rset['data']; ?></td>
			<td><?php echo $rset['created']; ?></td>
			<td><?php echo $rset['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'rsets', 'action' => 'view', $rset['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'rsets', 'action' => 'edit', $rset['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'rsets', 'action' => 'delete', $rset['id']), null, __('Are you sure you want to delete # %s?', $rset['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Rset'), array('controller' => 'rsets', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
