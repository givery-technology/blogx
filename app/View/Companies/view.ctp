<div class="companies view">
<h2><?php echo __('Company'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($company['Company']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($company['Company']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($company['Company']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($company['Company']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($company['Company']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Company'), array('action' => 'edit', $company['Company']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Company'), array('action' => 'delete', $company['Company']['id']), null, __('Are you sure you want to delete # %s?', $company['Company']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Keywords'), array('controller' => 'keywords', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Keyword'), array('controller' => 'keywords', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Keywords'); ?></h3>
	<?php if (!empty($company['Keyword'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Post Id'); ?></th>
		<th><?php echo __('Company Id'); ?></th>
		<th><?php echo __('Keyword'); ?></th>
		<th><?php echo __('Url'); ?></th>
		<th><?php echo __('Visible'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($company['Keyword'] as $keyword): ?>
		<tr>
			<td><?php echo $keyword['id']; ?></td>
			<td><?php echo $keyword['post_id']; ?></td>
			<td><?php echo $keyword['company_id']; ?></td>
			<td><?php echo $keyword['keyword']; ?></td>
			<td><?php echo $keyword['url']; ?></td>
			<td><?php echo $keyword['visible']; ?></td>
			<td><?php echo $keyword['created']; ?></td>
			<td><?php echo $keyword['updated']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'keywords', 'action' => 'view', $keyword['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'keywords', 'action' => 'edit', $keyword['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'keywords', 'action' => 'delete', $keyword['id']), null, __('Are you sure you want to delete # %s?', $keyword['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Keyword'), array('controller' => 'keywords', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
