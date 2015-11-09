<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="box">
			<div class="box-header">
				<h2>
					<?php echo __('Link Content List'); ?>
					<?php echo !isset($search) ? $this->Paginator->counter(array('model'=>'LinkContent','format' => __('{:count}'))) : count($linkContents);?>
				</h2>
			</div>
			<div class="box-content">
				<?php echo $this->Session->flash(); ?>
				<p class="align-right">
					<?php #echo $this->Html->link(__('Check Outlink All'), array('action' => 'check_outlink_all'), array('class' => "btn btn-info")); ?>
				</p>
<!-- search form -->
				<div class="form-group tbl6">
					<?php echo $this->Form->create('Search',array('class'=>'form-search')); ?>
					<?php echo $this->Form->input('keyword',array('label'=>False,'class'=>'form-control', 'type'=>'text','div'=>False, 'required' => False)); ?>
					<?php echo $this->Form->end(); ?>
				</div>
<!-- table -->
				<table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
					<thead>
						<tr role="row">
							<th class='tbl0'><?php echo $this->Paginator->sort('id'); ?></th>
							<th class='tbl2'><?php echo $this->Paginator->sort('Keyword'); ?></th>
							<th class='tbl2'><?php echo $this->Paginator->sort('Link'); ?></th>
							<th class='tbl0'><?php echo __('Type'); ?></th>
							<th class='tbl1'><?php echo __('Alive'); ?></th>
							<th class='tbl1'><?php echo $this->Paginator->sort('keyword_count', __('Frequency')); ?></th>
							<!-- <th class='tbl3'><?php #echo $this->Paginator->sort('title'); ?></th> -->
							<th class='tbl1'><?php echo $this->Paginator->sort('updated'); ?></th>
							<th class='tbl2'><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php foreach ($linkContents as $linkContent): ?>
						<tr>
<!-- id index -->
							<td class="center"><?php echo h($linkContent['LinkContent']['id']); ?>&nbsp;</td>
							<td><?php echo h($linkContent['Link']['keyword']); ?>&nbsp;</td>
<!-- link url -->
							<td>
								<?php echo $this->Html->link(h($this->Text->truncate(urldecode($linkContent['Link']['url']), configure::read('URL_LENGTH'))),h($linkContent['Link']['url']),array('target'=>'_blank')); ?>
							</td>
<!-- type -->
							<td><?php echo $this->Url->linkType($linkContent['Link']['type']); ?>&nbsp;</td>
<!-- link status death or alive -->
							<td class="">
								<?php
									$www_redirect = explode(' ', $linkContent['LinkContent']['www_redirect']);
									echo $this->Url->http_code($www_redirect);
								?>&nbsp;
							</td>
<!-- keyword count -->
							<td><?php echo h($linkContent['LinkContent']['keyword_count']); ?>&nbsp;</td>
<!-- title -->
							<!-- <td><?php #echo h($this->Text->truncate($linkContent['LinkContent']['title'], configure::read('LINK_TITLE_LENGTH'))); ?>&nbsp;</td> -->
<!-- updated -->
							<td><?php echo date('H:i:s',strtotime($linkContent['LinkContent']['updated'])); ?>&nbsp;</td>
<!-- action -->
							<td class="center">
								<a href="<?php echo Router::url(array('action'=>'view',$linkContent['LinkContent']['id'])) ?>" class="btn btn-primary"><i class="icon-eye-open"></i></a>
								<a href="<?php echo Router::url(array('controller' => 'links', 'action' => 'get_content', $linkContent['Link']['id'])) ?>" class="btn btn-success"><i class="icon-refresh"></i></a>
								<a href="<?php echo 'http://' .$_SERVER['SERVER_NAME'] .Router::url(array('action'=>'cache',$linkContent['LinkContent']['id'])) ?>" class="btn btn-warning" target="_blank"><i class="icon-exclamation-sign"></i></a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
			</table>
<!-- paging -->
				<div class="row">
					<div class="col-lg-12 center">
						<span class="label label-info">
							<?php
								echo $this->Paginator->counter(array(
									'model'=>'LinkContent',
									'format' => __('全{:pages}ページ')
								));
							?>
						</span>
						<div class="dataTables_paginate paging_bootstrap">
							<ul class="pagination">
								<li><?php echo $this->Paginator->prev('← ' . __('previous'), array('model'=>'LinkContent'), null, array('class' => 'prev disabled')); ?></li>
								<li><?php echo $this->Paginator->numbers(array('separator' => '','model'=>'LinkContent')); ?></li>
								<li><?php echo $this->Paginator->next(__('next') . ' →', array('model'=>'LinkContent'), null, array('class' => 'next disabled')); ?></li>
							</ul>
						</div>
					</div>
				</div><!-- paging end row -->
			</div>
		</div>
	</div>
</div>