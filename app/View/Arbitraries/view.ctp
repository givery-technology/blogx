<div class="arbitraries view">
<h2><?php echo __('Arbitrary'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($arbitrary['Arbitrary']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prefix'); ?></dt>
		<dd>
			<?php echo h($arbitrary['Arbitrary']['prefix']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Suffix'); ?></dt>
		<dd>
			<?php echo h($arbitrary['Arbitrary']['suffix']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($arbitrary['Arbitrary']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Update'); ?></dt>
		<dd>
			<?php echo h($arbitrary['Arbitrary']['update']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Arbitrary'), array('action' => 'edit', $arbitrary['Arbitrary']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Arbitrary'), array('action' => 'delete', $arbitrary['Arbitrary']['id']), null, __('Are you sure you want to delete # %s?', $arbitrary['Arbitrary']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Arbitraries'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Arbitrary'), array('action' => 'add')); ?> </li>
	</ul>
</div>
