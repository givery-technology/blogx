<div class="row">	
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
				<h2><?php echo __('Post Genres'); ?></h2>
				<div class="box-icon"></div>
			</div>
			<div class="box-content">
				<?php echo $this->Session->flash(); ?>
<!-- add post -->
				<p class="align-right">
					<?php echo $this->Html->link(__('Add ' .ucfirst(substr($this->params['controller'], 0, -1))), array('action' => 'add'), array('class' => "btn btn-warning")); ?>
				</p>
<!-- search form -->
				<!-- <div class="form-group tbl6">
					<?php echo $this -> Form -> create('', array('class' => 'form-search')); ?>
						<?php echo $this -> Form -> input('keyword', array('label' => False, 'class' => 'form-control', 'type' => 'text', 'div' => False, 'required' => False)); ?>
					<?php echo $this -> Form -> end(); ?>
				</div> -->
				<table class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('genre'); ?></th>
						<th><?php echo $this->Paginator->sort('genre_jpn'); ?></th>
						<th><?php echo $this->Paginator->sort('memo'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($postGenres as $postGenre): ?>
							<tr>
								<td><?php echo h($postGenre['PostGenre']['id']); ?>&nbsp;</td>
								<td><?php echo h($postGenre['PostGenre']['genre']); ?>&nbsp;</td>
								<td><?php echo h($postGenre['PostGenre']['genre_jpn']); ?>&nbsp;</td>
								<td><?php echo h($postGenre['PostGenre']['memo']); ?>&nbsp;</td>
								<td class="actions">
									<a href="<?php echo Router::url(array('action'=>'edit',$postGenre['PostGenre']['id'])) ?>" class="btn btn-primary"><i class="icon-edit"></i></a>
									<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $postGenre['PostGenre']['id']), array('class' => 'btn btn-danger icon-trash'), __('【%s】を削除しますか？', $postGenre['PostGenre']['id'])); ?>
									
									<?php #echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $postGenre['PostGenre']['id']), null, __('Are you sure you want to delete # %s?', $postGenre['PostGenre']['id'])); ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				 </table>  
<!-- paging -->
				<!-- <div class="row">
					<?php if(!isset($search)): ?>
					<div class="col-lg-12 center">
						<span class="label label-info">
							<?php
								echo $this->Paginator->counter(array(
									'format' => __('全{:pages}ページ')
								));
							?>
						</span>
						<div class="dataTables_paginate paging_bootstrap">
							<ul class="pagination">
								<li><?php echo $this->Paginator->prev('← ' . __('previous'), array(), null, array('class' => 'prev disabled')); ?></li>
								<li><?php echo $this->Paginator->numbers(array('separator' => '')); ?></li>
								<li><?php echo $this->Paginator->next(__('next') . ' →', array(), null, array('class' => 'next disabled')); ?></li>
							</ul>
						</div>
					</div>
					<?php endif ?> 
				</div> --><!-- end paging -->
			</div>
		</div>
	</div><!--/col-->
</div>