<div class="designs view">
<h2><?php echo __('Design'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($design['Design']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($design['Design']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Design'); ?></dt>
		<dd>
			<?php echo h($design['Design']['design']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Params'); ?></dt>
		<dd>
			<?php echo h($design['Design']['params']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($design['Design']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($design['Design']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Design'), array('action' => 'edit', $design['Design']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Design'), array('action' => 'delete', $design['Design']['id']), null, __('Are you sure you want to delete # %s?', $design['Design']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Designs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Design'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Blogs'), array('controller' => 'blogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog'), array('controller' => 'blogs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Blogs'); ?></h3>
	<?php if (!empty($design['Blog'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Design Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Ip'); ?></th>
		<th><?php echo __('Key'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($design['Blog'] as $blog): ?>
		<tr>
			<td><?php echo $blog['id']; ?></td>
			<td><?php echo $blog['category_id']; ?></td>
			<td><?php echo $blog['design_id']; ?></td>
			<td><?php echo $blog['name']; ?></td>
			<td><?php echo $blog['title']; ?></td>
			<td><?php echo $blog['description']; ?></td>
			<td><?php echo $blog['ip']; ?></td>
			<td><?php echo $blog['key']; ?></td>
			<td><?php echo $blog['created']; ?></td>
			<td><?php echo $blog['updated']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'blogs', 'action' => 'view', $blog['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'blogs', 'action' => 'edit', $blog['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'blogs', 'action' => 'delete', $blog['id']), null, __('Are you sure you want to delete # %s?', $blog['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Blog'), array('controller' => 'blogs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
