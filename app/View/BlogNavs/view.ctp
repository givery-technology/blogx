<div class="blogNavs view">
<h2><?php echo __('Blog Nav'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($blogNav['BlogNav']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Blog'); ?></dt>
		<dd>
			<?php echo $this->Html->link($blogNav['Blog']['name'], array('controller' => 'blogs', 'action' => 'view', $blogNav['Blog']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nav Name'); ?></dt>
		<dd>
			<?php echo h($blogNav['BlogNav']['nav_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Default'); ?></dt>
		<dd>
			<?php echo h($blogNav['BlogNav']['default']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($blogNav['BlogNav']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($blogNav['BlogNav']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Blog Nav'), array('action' => 'edit', $blogNav['BlogNav']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Blog Nav'), array('action' => 'delete', $blogNav['BlogNav']['id']), null, __('Are you sure you want to delete # %s?', $blogNav['BlogNav']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Blog Navs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog Nav'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Blogs'), array('controller' => 'blogs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog'), array('controller' => 'blogs', 'action' => 'add')); ?> </li>
	</ul>
</div>
