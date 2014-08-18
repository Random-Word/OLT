<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Student Number'); ?></dt>
		<dd>
			<?php echo h($user['User']['student_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rsets'), array('controller' => 'rsets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rset'), array('controller' => 'rsets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Uploads'), array('controller' => 'uploads', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Upload'), array('controller' => 'uploads', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Rsets'); ?></h3>
	<?php if (!empty($user['Rset'])): ?>
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
	<?php foreach ($user['Rset'] as $rset): ?>
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
<div class="related">
	<h3><?php echo __('Related Uploads'); ?></h3>
	<?php if (!empty($user['Upload'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Format'); ?></th>
		<th><?php echo __('Data'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Upload'] as $upload): ?>
		<tr>
			<td><?php echo $upload['id']; ?></td>
			<td><?php echo $upload['user_id']; ?></td>
			<td><?php echo $upload['name']; ?></td>
			<td><?php echo $upload['format']; ?></td>
			<td><?php echo $upload['data']; ?></td>
			<td><?php echo $upload['created']; ?></td>
			<td><?php echo $upload['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'uploads', 'action' => 'view', $upload['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'uploads', 'action' => 'edit', $upload['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'uploads', 'action' => 'delete', $upload['id']), null, __('Are you sure you want to delete # %s?', $upload['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Upload'), array('controller' => 'uploads', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
