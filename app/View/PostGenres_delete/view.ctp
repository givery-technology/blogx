<div class="postGenres view">
<h2><?php echo __('Post Genre'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($postGenre['PostGenre']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Genre'); ?></dt>
		<dd>
			<?php echo h($postGenre['PostGenre']['genre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Memo'); ?></dt>
		<dd>
			<?php echo h($postGenre['PostGenre']['memo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('History'); ?></dt>
		<dd>
			<?php echo h($postGenre['PostGenre']['history']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($postGenre['PostGenre']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Update'); ?></dt>
		<dd>
			<?php echo h($postGenre['PostGenre']['update']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Post Genre'), array('action' => 'edit', $postGenre['PostGenre']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Post Genre'), array('action' => 'delete', $postGenre['PostGenre']['id']), null, __('Are you sure you want to delete # %s?', $postGenre['PostGenre']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Post Genres'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post Genre'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Posts'); ?></h3>
	<?php if (!empty($postGenre['Post'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Blog Id'); ?></th>
		<th><?php echo __('Post Genre Id'); ?></th>
		<th><?php echo __('Pagename'); ?></th>
		<th><?php echo __('Menu'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Content'); ?></th>
		<th><?php echo __('Pageview'); ?></th>
		<th><?php echo __('Public'); ?></th>
		<th><?php echo __('Outlink'); ?></th>
		<th><?php echo __('Image'); ?></th>
		<th><?php echo __('G Index'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($postGenre['Post'] as $post): ?>
		<tr>
			<td><?php echo $post['id']; ?></td>
			<td><?php echo $post['blog_id']; ?></td>
			<td><?php echo $post['post_genre_id']; ?></td>
			<td><?php echo $post['pagename']; ?></td>
			<td><?php echo $post['menu']; ?></td>
			<td><?php echo $post['title']; ?></td>
			<td><?php echo $post['description']; ?></td>
			<td><?php echo $post['content']; ?></td>
			<td><?php echo $post['pageview']; ?></td>
			<td><?php echo $post['public']; ?></td>
			<td><?php echo $post['outlink']; ?></td>
			<td><?php echo $post['image']; ?></td>
			<td><?php echo $post['g_index']; ?></td>
			<td><?php echo $post['created']; ?></td>
			<td><?php echo $post['updated']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'posts', 'action' => 'view', $post['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'posts', 'action' => 'edit', $post['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'posts', 'action' => 'delete', $post['id']), null, __('Are you sure you want to delete # %s?', $post['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
