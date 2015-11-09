<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="box">
			<div class="box-header">
				<h2>
					<?php echo __(ucfirst($this->params['controller']).' List'); ?> 
					<?php echo !isset($search) ? $this->Paginator->counter(array('format' => __('{:count}'))) : count($posts);?>
				</h2>
			</div>
			<div class="box-content">
				<?php echo $this->Session->flash(); ?>
				<span class="align-right">
<!-- add post -->
					<a href="<?php echo Router::url(array('action'=>'add')) ?>" class="btn-sm btn-warning"><i class="icon-plus-sign"></i></a>
<!-- csv -->
					<a href="<?php echo Router::url(array('action'=>'download_csv')) ?>" class="btn-sm btn-info"><i class="icon-download-alt"></i></a>
					<a href="<?php echo Router::url(array('action'=>'add_csv')) ?>" class="btn-sm btn-warning"><i class="icon-upload"></i></a>
<!-- enable all -->
					<?php echo $this->Form->postLink(__(''), array('action'=>'public_reset_all',1), array('class' => 'btn-sm btn-success icon-ok-sign'), __('Do you want to set public all posts?')); ?>
<!-- disable all -->
					<?php echo $this->Form->postLink(__(''), array('action'=>'public_reset_all'), array('class' => 'btn-sm btn-danger icon-remove-sign'), __('Do you want to reset public all posts?')); ?>
				</span>
<!-- search form -->
				<div class="form-group tbl6">
					<?php echo $this -> Form -> create('Search', array('class' => 'form-search')); ?>
						<?php echo $this -> Form -> input('keyword', array('label' => False, 'class' => 'form-control', 'type' => 'text', 'div' => False, 'required' => False)); ?>
					<?php echo $this -> Form -> end(); ?>
				</div>
<!-- table -->
				<!-- <table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"> -->
				<table class="table table-bordered table-striped table-condensed">
					<thead>
					<tr role="row">
						<th class="tbl0"><?php echo $this->Paginator->sort('id'); ?></th>
						<th class="tbl3"><?php echo $this->Paginator->sort('title'); ?></th>
						<th class="tbl3"><?php echo $this->Paginator->sort('genre_id','Genre'); ?></th>
						<th class="tbl3"><?php echo $this->Paginator->sort('blog_id'); ?></th>
						<th class="tbl0"><?php echo __('PV'); ?></th>
						<th class="tbl0"><?php echo $this->Paginator->sort('P'); ?></th>
						<th class="tbl2"><?php echo $this->Paginator->sort('created'); ?></th>
						<th class="tbl2"><?php echo __('Actions'); ?></th>
					</tr>
					</thead>
					<tbody role="alert" aria-live="polite" aria-relevant="all">
					<?php foreach ($posts as $post): ?>
					<tr>
<!-- id -->
						<td><?php echo h($post['Post']['id']); ?>&nbsp;</td>
<!-- title -->
						<td><?php echo $this->Text->truncate($post['Post']['title'], Configure::read('TITLE_LENGTH')); ?>&nbsp;</td>
<!-- genre -->
						<td><?php echo h($post['Genre']['genre_jpn']); ?>&nbsp;</td>
<!-- blog -->
						<td>
							<?php echo $this->Text->truncate($post['Blog']['name'], Configure::read('BLOG_LENGTH')); ?>
						</td>
<!-- url -->
						<!-- <td>
							<?php
								// category 1:ameba, 2:amej, 3:j, 4:ip100, 5:ip200, 6:x10 9:alldomain
								$default_url = trim($post['Blog']['domain']) .$post['Post']['id'];
								$created_url = trim($post['Blog']['domain']) .$post['Post']['id'] ."/" .date('Y-m-d-H-i-s',strtotime($post['Post']['created']));
								$pagename_url = trim($post['Blog']['domain']) .$post['Post']['id'] ."/" .$post['Post']['pagename'];
								
								if($post['Blog']['Category']['code'] == 1) {
									$default_url = trim($post['Blog']['domain']) .$post['Post']['id'] .'_'  .Inflector::slug($post['Post']['created']);
								}
								
								if($post['Blog']['Category']['code'] == 3) {
									$default_url = trim($post['Blog']['domain']) .$post['Post']['id'] .'-'  .Inflector::slug($post['Post']['created'],'-') .'-' .Inflector::slug(!empty($post['Post']['menu']) ? $post['Post']['menu']:Configure::read('J_URL'),'-');
								}
								
								if($post['Blog']['Category']['code'] == 4) {
									$default_url = trim($post['Blog']['domain']) .$post['Post']['id'] .Configure::read('IP100_URL');
								}
								
								if($post['Blog']['Category']['code'] == 5 || $post['Blog']['Category']['code'] == 9) {
									$default_url = trim($post['Blog']['domain']) .$post['Post']['id'] .(!empty($post['Post']['pagename']) ? '_'.Inflector::slug($post['Post']['pagename']):'');
								}
								
								if($post['Blog']['Category']['code'] == 6) {
									$post_keyword = array();
									if(count($post['Keyword'])>0){
										$i=0;
										foreach($post['Keyword'] as $keyword) {
											$i++;
											if($keyword['visible'] == 1) {
												// all keyword
												$list_keyword[] = $keyword['keyword'];
												$list_keyword_url[] = $this->Html->link($keyword['keyword'],$keyword['url']);
												// post keyword
												$post_keyword[] = $keyword['keyword'];
												// first keyword
												if($i == 1):
													$first_keyword[] = $keyword['keyword'];
													$first_keyword_url = $this->Html->link($keyword['keyword'],$keyword['url']);
												endif;
											}
										}
									}
									$default_url = trim($post['Blog']['domain']) .$post['Post']['id'] .str_replace(' ', '', implode('', $post_keyword));
								} 
								echo $this->Html->link($this->Text->truncate($default_url, configure::read('URL_LENGTH')), $default_url, array('target'=>'_blank'));
							?>&nbsp;
						</td> -->
<!-- pv pageview -->
						<td><?php echo $this->Html->link($post['Post']['pageview'],array('controller' => 'plogs' , 'action' => 'index',$post['Post']['id'])); ?></td>
<!-- public	-->
						<td class="status" post_id="<?php echo $post['Post']['id'] ?>" public="<?php echo $post['Post']['public'] ?>"><?php echo $post['Post']['public']==1?$this->Html->image('tick.png',array('width'=>15)):$this->Html->image('cross.png',array('width'=>15)); ?></td>
<!-- created -->
						<td><?php echo h(date('Y-m-d',strtotime($post['Post']['created']))); ?>&nbsp;</td>
<!-- actions -->
						<td class="">
							<a href="<?php echo Router::url(array('action'=>'edit',$post['Post']['id'])) ?>" class="btn-sm btn-primary"><i class="icon-edit"></i></a>
							<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $post['Post']['id']), array('class' => 'btn-sm btn-danger icon-trash'), __('【%s】を削除しますか？', $post['Post']['id'])); ?>
							<a href="<?php echo $default_url; ?>" class="link_open_tab btn-sm btn-success" target="_blank"><i class="icon-eye-open"></i></a>
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
				</div>
			</div>
		</div>
	</div>
</div><!-- end row -->

<script type="text/javascript">
	$(document).ready(function(){
		// $('.status').click(function(){
			// var post_id = $(this).attr('post_id');
			// var status = $(this).attr('public')==1?0:1;
			// $(this).find('img').attr('src','<?php echo $this->webroot ?>img/loading.gif');
			// $.ajax({
				// url:'<?php echo $this->webroot ?>posts/status',
				// data:{post_id:post_id,status:status},
				// type:'post',
				// dataType:'json',
				// success:function(data){
					// if(data.status==1){
						// $('td[class="status"][post_id="'+data.post_id+'"]').find('img').attr('src','<?php echo $this->webroot ?>img/tick.png');
					// }else{
						// $('td[class="status"][post_id="'+data.post_id+'"]').find('img').attr('src','<?php echo $this->webroot ?>img/cross.png');
					// }
					// $('td[class="status"][post_id="'+data.post_id+'"]').attr('public',data.status);
				// }
			// });
		// })
		$('.status').click(function(){
			var obj = $(this);
			var post_id = obj.attr('post_id');
			var status = obj.attr('public')==1?0:1;
			obj.find('img').attr('src','<?php echo $this->webroot ?>img/loading.gif');
			$.ajax({
				url:'<?php echo $this->webroot ?>posts/status',
				data:{post_id:post_id,status:status},
				type:'post',
				dataType:'json',
				success:function(data){
					if(data.status==1){
						obj.find('img').attr('src','<?php echo $this->webroot ?>img/tick.png');
					}else{
						obj.find('img').attr('src','<?php echo $this->webroot ?>img/cross.png');
					}
					obj.attr('public',data.status);
				}
			});
		})
		
		//
		$('.open_all_post_link').click(function(){
			var count = $('.link_open_tab').size();
			for (var i=0;i<count;i++){
				window.open($('.link_open_tab:eq('+i+')').attr('href'));
			}
		})
	})
</script>