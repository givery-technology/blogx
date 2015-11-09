<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="box">
			<div class="box-header">
				<h2>
					<?php echo __(ucfirst($this -> params['controller']) . ' List'); ?>
					<?php echo !isset($search) ? $this -> Paginator -> counter(array('format' => __('{:count}'))) : count($blogs); ?>
				</h2>
			</div>
			<div class="box-content">
				<?php echo $this -> Session -> flash(); ?>
				<p class="align-right">
					<?php #echo $this -> Html -> link(__('Add ' . ucfirst(substr($this -> params['controller'], 0, -1))), array('action' => 'add'), array('class' => "btn btn-warning")); ?>
					<a href="<?php echo Router::url(array('action'=>'add')) ?>" class="btn btn-warning"><i class="icon-plus-sign"></i></a>
					<a href="<?php echo Router::url(array('action'=>'download_csv')) ?>" class="btn btn-success"><i class="icon-download-alt"></i></a>
					<a href="<?php echo Router::url(array('action'=>'add_csv')) ?>" class="btn btn-danger"><i class="icon-upload"></i></a>
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
						<th class="tbl0"><?php echo $this -> Paginator -> sort('id'); ?></th>
						<th class="tbl5"><?php echo $this -> Paginator -> sort('name'); ?></th>
						<th class="tbl3"><?php echo $this -> Paginator -> sort('genre_id', 'Genre'); ?></th>
						<th class="tbl2"><?php echo $this -> Paginator -> sort('category_id'); ?></th>
						<!-- <th class="tbl4"><?php echo $this -> Paginator -> sort('design_id'); ?></th> -->
						<th class="tbl1"><?php echo $this -> Paginator -> sort('ip'); ?></th>
						<th class="tbl1"><?php echo $this -> Paginator -> sort('count_post'); ?></th>
						<!-- <th class="tbl3"><?php echo $this -> Paginator -> sort('domain'); ?></th> -->
						<th class="tbl2"><?php echo __('Actions'); ?></th>
					</tr>
					<?php foreach ($blogs as $blog): ?>
					<tr>
<!-- id -->
						<td><?php echo h($blog['Blog']['id']); ?>&nbsp;</td>
<!-- blog name -->
						<td><?php echo h($blog['Blog']['name']); ?>&nbsp;</td>
<!-- genre -->
						<td><?php echo  $blog['Genre']['genre_jpn']; ?></td>
<!-- category code -->
						<td><?php echo '[' . $blog['Category']['code'] . ']' . $blog['Category']['name']; ?></td>
<!-- design name -->
						<!-- <td><?php #echo $this -> Text -> truncate($blog['Design']['name'], configure::read('STRING_LENGTH_SHORT')); ?></td> -->
<!-- blog ip -->
						<td><?php echo h($blog['Blog']['ip']); ?>&nbsp;</td>
						<td><?php echo h($blog['Blog']['count_post']); ?>&nbsp;</td>
<!-- blog domain -->
						<!-- <td><?php echo $this -> Html -> link($this -> Text -> truncate($blog['Blog']['domain'], configure::read('STRING_LENGTH_SHORT')), $blog['Blog']['domain'], array('target' => '_blank')); ?>&nbsp;</td> -->
<!-- actions -->
						<td class="actions">
							<a href="<?php echo Router::url(array('action'=>'edit',$blog['Blog']['id'])) ?>" class="btn-primary"><i class="icon-edit"></i></a>
							<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $blog['Blog']['id']), array('class' => 'btn-danger icon-trash'), __('【%s】を削除しますか？', $blog['Blog']['id'])); ?>
							<a href="<?php echo $blog['Blog']['domain']; ?>" class="link_open_tab btn-success" target="_blank"><i class="icon-eye-open"></i></a>
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