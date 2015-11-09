<div class="keywords view">
<h2><?php echo __('Keyword'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($keyword['Keyword']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Post'); ?></dt>
		<dd>
			<?php echo $this->Html->link($keyword['Post']['title'], array('controller' => 'posts', 'action' => 'view', $keyword['Post']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company'); ?></dt>
		<dd>
			<?php echo $this->Html->link($keyword['Company']['name'], array('controller' => 'companies', 'action' => 'view', $keyword['Company']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Keyword'); ?></dt>
		<dd>
			<?php echo h($keyword['Keyword']['keyword']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($keyword['Keyword']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Visible'); ?></dt>
		<dd>
			<?php echo h($keyword['Keyword']['visible']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($keyword['Keyword']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($keyword['Keyword']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Keyword'), array('action' => 'edit', $keyword['Keyword']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Keyword'), array('action' => 'delete', $keyword['Keyword']['id']), null, __('Are you sure you want to delete # %s?', $keyword['Keyword']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Keywords'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Keyword'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies'), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('controller' => 'companies', 'action' => 'add')); ?> </li>
	</ul>
</div>
