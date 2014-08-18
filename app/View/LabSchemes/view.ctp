<div class="labSchemes view">
<h2><?php echo __('Lab Scheme'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($labScheme['LabScheme']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($labScheme['LabScheme']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($labScheme['LabScheme']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Scheme'); ?></dt>
		<dd>
			<?php echo h($labScheme['LabScheme']['scheme']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Lab Scheme'), array('action' => 'edit', $labScheme['LabScheme']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Lab Scheme'), array('action' => 'delete', $labScheme['LabScheme']['id']), null, __('Are you sure you want to delete # %s?', $labScheme['LabScheme']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Lab Schemes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lab Scheme'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Labs'), array('controller' => 'labs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lab'), array('controller' => 'labs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Labs'); ?></h3>
	<?php if (!empty($labScheme['Lab'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Lab Scheme Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Published'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($labScheme['Lab'] as $lab): ?>
		<tr>
			<td><?php echo $lab['id']; ?></td>
			<td><?php echo $lab['lab_scheme_id']; ?></td>
			<td><?php echo $lab['name']; ?></td>
			<td><?php echo $lab['description']; ?></td>
			<td><?php echo $lab['published']; ?></td>
			<td><?php echo $lab['created']; ?></td>
			<td><?php echo $lab['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'labs', 'action' => 'view', $lab['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'labs', 'action' => 'edit', $lab['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'labs', 'action' => 'delete', $lab['id']), null, __('Are you sure you want to delete # %s?', $lab['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Lab'), array('controller' => 'labs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
