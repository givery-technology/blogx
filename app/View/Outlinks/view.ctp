<div class="outlinks view">
<h2><?php echo __('Outlink'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($outlink['Outlink']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Post'); ?></dt>
		<dd>
			<?php echo $this->Html->link($outlink['Post']['title'], array('controller' => 'posts', 'action' => 'view', $outlink['Post']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($outlink['Outlink']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($outlink['Outlink']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pagerank'); ?></dt>
		<dd>
			<?php echo h($outlink['Outlink']['pagerank']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($outlink['Outlink']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($outlink['Outlink']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Outlink'), array('action' => 'edit', $outlink['Outlink']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Outlink'), array('action' => 'delete', $outlink['Outlink']['id']), null, __('Are you sure you want to delete # %s?', $outlink['Outlink']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Outlinks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outlink'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
