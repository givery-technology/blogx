<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="box">
			<div class="box-header">
				<h2>
					<?php echo __(Inflector::singularize($this->params['controller']) .' ' .$this->params['action']) ?>
					<?php echo $this->Paginator->counter(array('format' => __('{:count}')));?>
				</h2>
			</div>
			<div class="box-content">
				<?php echo $this->Session->flash(); ?>
<!-- search	-->
				<div class="form-group tbl6">
					<?php echo $this -> Form -> create('Keyword', array('class' => 'form-search')); ?>
						<?php echo $this -> Form -> input('keyword', array('label' => False, 'class' => 'form-control', 'type' => 'text', 'div' => False, 'required' => False)); ?>
					<?php echo $this -> Form -> end(); ?>
				</div>
<!-- table -->
				<table class="table table-bordered table-striped table-condensed">
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('user_id'); ?></th>
						<th><?php echo $this->Paginator->sort('ip'); ?></th>
						<th><?php echo $this->Paginator->sort('memo'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
					</tr>
					<?php foreach ($logs as $log): ?>
					<tr>
						<td><?php echo h($log['Log']['id']); ?>&nbsp;</td>
						<td>
							<?php echo $this->Html->link($log['User']['email'], array('controller' => 'users', 'action' => 'view', $log['User']['id'])); ?>
						</td>
						<td><span class="badge bg-red"><?php echo h($log['Log']['ip']); ?></span>&nbsp;</td>
						<td><?php echo h($log['Log']['memo']); ?>&nbsp;</td>
						<td><?php echo h($log['Log']['created']); ?>&nbsp;</td>
					</tr>
					<?php endforeach; ?>
				</table>
<!-- paging -->
				<div class="row">
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
				</div>
			</div>
		</div>
	</div>
</div><!-- end row -->