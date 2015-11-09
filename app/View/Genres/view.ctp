<div class="genres view">
<h2><?php echo __('Genre'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($genre['Genre']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Genre'); ?></dt>
		<dd>
			<?php echo h($genre['Genre']['genre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Genre Jpn'); ?></dt>
		<dd>
			<?php echo h($genre['Genre']['genre_jpn']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Memo'); ?></dt>
		<dd>
			<?php echo h($genre['Genre']['memo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($genre['Genre']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($genre['Genre']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Genre'), array('action' => 'edit', $genre['Genre']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Genre'), array('action' => 'delete', $genre['Genre']['id']), null, __('Are you sure you want to delete # %s?', $genre['Genre']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Genres'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Genre'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Blogs'), array('controller' => 'blogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog'), array('controller' => 'blogs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Blogs'); ?></h3>
	<?php if (!empty($genre['Blog'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Design Id'); ?></th>
		<th><?php echo __('Genre Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Sitename'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Keyword'); ?></th>
		<th><?php echo __('Ip'); ?></th>
		<th><?php echo __('Domain'); ?></th>
		<th><?php echo __('Key'); ?></th>
		<th><?php echo __('Memo'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($genre['Blog'] as $blog): ?>
		<tr>
			<td><?php echo $blog['id']; ?></td>
			<td><?php echo $blog['category_id']; ?></td>
			<td><?php echo $blog['design_id']; ?></td>
			<td><?php echo $blog['genre_id']; ?></td>
			<td><?php echo $blog['name']; ?></td>
			<td><?php echo $blog['sitename']; ?></td>
			<td><?php echo $blog['title']; ?></td>
			<td><?php echo $blog['description']; ?></td>
			<td><?php echo $blog['keyword']; ?></td>
			<td><?php echo $blog['ip']; ?></td>
			<td><?php echo $blog['domain']; ?></td>
			<td><?php echo $blog['key']; ?></td>
			<td><?php echo $blog['memo']; ?></td>
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
<div class="related">
	<h3><?php echo __('Related Posts'); ?></h3>
	<?php if (!empty($genre['Post'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Blog Id'); ?></th>
		<th><?php echo __('Genre Id'); ?></th>
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
	<?php foreach ($genre['Post'] as $post): ?>
		<tr>
			<td><?php echo $post['id']; ?></td>
			<td><?php echo $post['blog_id']; ?></td>
			<td><?php echo $post['genre_id']; ?></td>
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
