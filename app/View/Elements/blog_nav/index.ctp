<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="box">
			<div class="box-header">
				<h2>
					<?php echo __(ucfirst($this -> params['controller']) . ' List'); ?>
					<?php echo !isset($search) ? $this -> Paginator -> counter(array('format' => __('{:count}'))) : count($blogNavs); ?>
				</h2>
			</div>
			<div class="box-content">
				<?php echo $this -> Session -> flash(); ?>
				<p class="align-right">
					<a href="<?php echo Router::url(array('action'=>'add')) ?>" class="btn btn-warning"><i class="icon-plus-sign"></i></a>
				</p>
<!-- search form -->
				<div class="form-group tbl6">
					<?php echo $this -> Form -> create('Keyword', array('class' => 'form-search')); ?>
						<?php echo $this -> Form -> input('keyword', array('label' => False, 'class' => 'form-control', 'type' => 'text', 'div' => False, 'required' => False)); ?>
					<?php echo $this -> Form -> end(); ?>
				</div>
<!-- table -->
				<table class="table table-bordered table-striped table-condensed">
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('blog_id', __('Blog Name')); ?></th>
						<th><?php echo __('Domain'); ?></th>
						<th><?php echo $this->Paginator->sort('nav_name'); ?></th>
						<th><?php echo $this->Paginator->sort('nav_name_jpn'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
					<?php foreach ($blogNavs as $blogNav): ?>
					<tr>
						<td><?php echo h($blogNav['BlogNav']['id']); ?>&nbsp;</td>
						<td>
							<?php echo $this->Html->link($blogNav['Blog']['name'], array('controller' => 'blogs', 'action' => 'edit', $blogNav['Blog']['id'])); ?>
						</td>
						<td>
							<?php echo $this->Html->link($blogNav['Blog']['domain'], $blogNav['Blog']['domain'], array('target' => '_blank')); ?>
						</td>
						<td><?php echo h($blogNav['BlogNav']['nav_name']); ?>&nbsp;</td>
						<td><?php echo h($blogNav['BlogNav']['nav_name_jpn']); ?>&nbsp;</td>
						<td><?php echo h($blogNav['BlogNav']['created']); ?>&nbsp;</td>
						<td class="actions">
							<a href="<?php echo Router::url(array('action'=>'edit',$blogNav['BlogNav']['id'])) ?>" class="btn-primary"><i class="icon-edit"></i></a>
							<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $blogNav['BlogNav']['id']), array('class' => 'btn-danger icon-trash'), __('【%s】を削除しますか？', $blogNav['BlogNav']['id'])); ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
<!-- paging -->
				<div class="row">
					<?php if(!isset($search)): ?>
					<div class="col-lg-12 center">
						<span class="label label-info">
							<?php echo $this -> Paginator -> counter(array('format' => __('全{:pages}ページ'))); ?>
						</span>
						<div class="dataTables_paginate paging_bootstrap">
							<ul class="pagination">
								<li><?php echo $this -> Paginator -> prev('← ' . __('previous'), array(), null, array('class' => 'prev disabled')); ?></li>
								<li><?php echo $this -> Paginator -> numbers(array('separator' => '')); ?></li>
								<li><?php echo $this -> Paginator -> next(__('next') . ' →', array(), null, array('class' => 'next disabled')); ?></li>
							</ul>
						</div>
					<?php endif ?> 
					</div>
				</div><!-- paging row -->
			</div>
		</div>
	</div>
</div><!-- end row -->
