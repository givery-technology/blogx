<div class="row">	
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
				<h2>
					<?php echo __(ucfirst(substr($this->params['controller'], 0, -1))); ?>
					<?php echo !isset($search) ? $this -> Paginator -> counter(array('format' => __('{:count}'))) : count(${$this->params['controller']}); ?>
				</h2>
				<div class="box-icon"></div>
			</div>
			<div class="box-content">
				<?php echo $this->Session->flash(); ?>
<!-- csv -->
				<p class="align-right">
					<a href="<?php echo Router::url(array('action'=>'add')) ?>" class="btn btn-warning"><i class="icon-plus"></i></a>
					<a href="<?php echo Router::url(array('action'=>'download_csv')) ?>" class="btn btn-success"><i class="icon-download-alt"></i></a>
<!-- modal -->
					 <?php #echo $this->Html->link(__('CSV'), '#CsvFileUpload', array('data-toggle'=>'modal','role'=>'button','class' => "btn btn-danger")); ?>
					<a href="<?php echo Router::url(array('action'=>'add_csv')) ?>" class="btn btn-danger"><i class="icon-upload"></i></a>
				</p>
<!-- add post -->
				<p></p>
<!-- search form -->
				<div class="form-group tbl6">
					<?php echo $this -> Form -> create('Keyword', array('class' => 'form-search')); ?>
						<?php echo $this -> Form -> input('keyword', array('label' => False, 'class' => 'form-control', 'type' => 'text', 'div' => False, 'required' => False)); ?>
					<?php echo $this -> Form -> end(); ?>
				</div>
				<table class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th><?php echo $this->Paginator->sort('id'); ?></th>
							<th><?php echo $this->Paginator->sort('name', __('Menu')); ?></th>
							<th><?php echo $this->Paginator->sort('blog_id', __('Blog')); ?></th>
							<th><?php echo $this->Paginator->sort('blog_id', __('Domain')); ?></th>
							<!-- <th><?php #echo $this->Paginator->sort('post_id'); ?></th> -->
							<th class="actions"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($menus as $menu): ?>
							<tr>
								<td><?php echo h($menu['Menu']['id']); ?>&nbsp;</td>
								<td><?php echo h($menu['Menu']['name']); ?>&nbsp;</td>
								<td><?php echo h($menu['Blog']['name']); ?>&nbsp;</td>
								<td>
									<?php echo $this->Html->link($menu['Blog']['domain'], array('controller' => 'blogs', 'action' => 'edit', $menu['Blog']['id'])); ?>
								</td>
								<!-- <td>
									<?php #echo $this->Html->link($menu['Post']['title'], array('controller' => 'posts', 'action' => 'view', $menu['Post']['id'])); ?>
								</td> -->
								<td class="actions">
									<a href="<?php echo Router::url(array('action'=>'edit',$menu['Menu']['id'])) ?>" class="btn-primary"><i class="icon-edit"></i></a>
									<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $menu['Menu']['id']), array('class' => 'btn-danger icon-trash'), __('【%s】を削除しますか？', $menu['Menu']['id'])); ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
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
				</div><!-- end paging -->
			</div>
		</div>
	</div><!--/col-->
</div>

<!-- modal -->
<?php #echo $this->element('modal/csv_file_upload', array()); ?>

<!-- debug -->
<?php
	// debug($this->params['controller']);
	// debug($menus);
?>