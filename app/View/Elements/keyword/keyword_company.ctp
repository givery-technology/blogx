<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="box">
			<div class="box-header">
				<h2>
					<?php #echo $this->Html->link(__(''), array('action' => 'index'), array('class' => 'icon-link')); ?>
					<?php echo __('Company Url Post Count'); ?>
					<?php echo !isset($search) ? $this -> Paginator -> counter(array('format' => __('{:count}'))) : count($keywords); ?>
				</h2>
			</div>
			<div class="box-content">
				<?php echo $this -> Session -> flash(); ?>
<!-- open all post link -->
				<p class="align-right">
					<?php #echo $this->Html->link(__('Open All Client Url'), 'javascript:void(0)', array('class' => "open_all_client_url btn btn-warning")); ?>
					<?php #echo $this->Html->link(__('Open All Post Link'), 'javascript:void(0)', array('class' => "open_all_post_link btn btn-success")); ?>
				</p>
<!-- search -->
				<p>
					<?php echo $this -> Form -> create('Keyword', array('class' => 'form-search')); ?>
						<?php echo $this -> Form -> input('keyword', array('label' => FALSE, 'class' => 'span3 search-query', 'type' => 'text', 'div' => FALSE)); ?>
						<?php echo $this -> Form -> button(__(''), array('class' => 'btn btn-info icon-search')); ?>
						<?php echo $this -> Html -> link('', array('controller' => $this -> params['controller']), array('class' => 'btn icon-refresh')); ?>
					<?php echo $this -> Form -> end(); ?>
				</p>
<!-- table -->
				<table class="table table-striped table-bordered bootstrap-datatable datatable">
					<tr>
						<?php if(isset($search)): ?><th><?php echo $this -> Paginator -> sort('keyword', __('Anchor Keyword')); ?></th><?php endif; ?>
						<th><?php echo $this -> Paginator -> sort('client url'); ?></th>
						<th><?php echo __('Count Post'); ?></th>
						<th class="tbl2"><?php echo __('Actions'); ?></th>
					</tr>
					<?php foreach ($keywords as $keyword): ?>
					<tr>
						<?php if(isset($search)): ?><td><?php echo $this -> Text -> truncate($keyword['Keyword']['keyword'], 30); ?>&nbsp;</td><?php endif; ?>
<!-- url -->
						<td><?php echo($keyword['Keyword']['url'] != '') ? $this -> Html -> link($this -> Text -> truncate($keyword['Keyword']['url'], 50), $keyword['Keyword']['url'], array('target' => '_blank')) : '<span class="no-data">No Data</span>'; ?>&nbsp;</td>
						<td><?php echo $keyword['Keyword']['count_post'] ?>&nbsp;</td>
						<td class="">
							<!-- <a href="<?php echo Router::url(array('action'=>'detail',$keyword['Keyword']['id'])) ?>" class="btn-success"><i class="icon-eye-open"></i></a> -->
							<!-- <a href="<?php echo Router::url(array('action'=>'edit',$keyword['Keyword']['id'])) ?>" class="btn-primary"><i class="icon-edit"></i></a> -->
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
					</div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div><!-- end row -->
<script type="text/javascript">
	$(document).ready(function() {

		//
		$('.open_all_post_link').click(function() {
			var count = $('.link_open_tab').size();
			for (var i = 0; i < count; i++) {
				window.open($('.link_open_tab:eq(' + i + ')').attr('href'));
			}
		})
		//
		$('.open_all_client_url').click(function() {
			var count = $('.open_client_url').size();
			for (var i = 0; i < count; i++) {
				window.open($('.open_client_url:eq(' + i + ')').attr('href'));
			}
		})
	})
</script>


<!-- debug -->
<?php 
	#debug($keywords);
?>