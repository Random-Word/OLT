<div class="rsets view">
<h2><?php echo __('Rset'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($rset['Rset']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($rset['User']['id'], array('controller' => 'users', 'action' => 'view', $rset['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lab'); ?></dt>
		<dd>
			<?php echo $this->Html->link($rset['Lab']['name'], array('controller' => 'labs', 'action' => 'view', $rset['Lab']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Completed'); ?></dt>
		<dd>
			<?php echo h($rset['Rset']['completed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Completed On'); ?></dt>
		<dd>
			<?php echo h($rset['Rset']['completed_on']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data'); ?></dt>
		<dd>
			<?php echo h($rset['Rset']['data']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($rset['Rset']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($rset['Rset']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rset'), array('action' => 'edit', $rset['Rset']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Rset'), array('action' => 'delete', $rset['Rset']['id']), null, __('Are you sure you want to delete # %s?', $rset['Rset']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rsets'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rset'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Labs'), array('controller' => 'labs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lab'), array('controller' => 'labs', 'action' => 'add')); ?> </li>
	</ul>
</div>
