<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="box">
			<div class="box-header">
				<h2>
					<?php echo __(ucfirst($this->params['controller']).' List'); ?>
					<?php echo !isset($search) ? $this->Paginator->counter(array('format' => __('{:count}'))) : count($keywords);?>
				</h2>
			</div>
			<div class="box-content">
				<?php echo $this->Session->flash(); ?>
				<span class="align-right">
<!-- add post -->
					<a href="<?php echo Router::url(array('action'=>'add')) ?>" class="btn-sm btn-warning"><i class="icon-plus-sign"></i></a>
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
				<table class="table table-bordered table-striped table-condensed">
					<tr>
							<th class="tbl0"><?php echo __('Id'); ?></th>
							<th class="tbl3"><?php echo $this->Paginator->sort('keyword'); ?></th>
							<th class="tbl3"><?php echo $this->Paginator->sort('client url'); ?></th>
							<th class="tbl4"><?php echo $this->Paginator->sort('Post.Blog.name','Blog Name'); ?></th>
							<th class="tbl0"><?php echo $this->Paginator->sort('P'); ?></th>
							<th class="tbl2"><?php echo __('Actions'); ?></th>
					</tr>
					<?php foreach ($keywords as $keyword):  if(isset($keyword['Post']['Blog'])):?>
					<tr>
<!-- keyword id -->
						<td><?php echo h($keyword['Keyword']['id']); ?>&nbsp;</td>
<!-- keyword -->
						<td class="<?php echo $keyword['Keyword']['visible']==1?'duplicate':'' ?>" url="<?php echo $keyword['Keyword']['url'].'-'.$keyword['Post']['Blog']['id']; ?>"><?php echo $this->Text->truncate($keyword['Keyword']['keyword'], configure::read('KEYWORD_LENGTH')); ?>&nbsp;</td>
<!-- client url -->
						<td><?php echo $this->Html->link($this->Text->truncate($keyword['Keyword']['url'], configure::read('URL_LENGTH')), $keyword['Keyword']['url'], array('target'=>'_blank','class'=>'link')); ?>&nbsp;</td>
<!-- blog name -->
						<td><?php echo  isset($keyword['Post']['Blog']) ? $this->Text->truncate($keyword['Post']['Blog']['name'], configure::read('BLOG_LENGTH')) : ''; ?>&nbsp;</td>
<!-- post url -->
						<!-- <td> -->
							<?php
								if(count($keyword['Post']) > 0 && isset($keyword['Post']['Blog'])) {
									// category 1:ameba, 2:amej, 3:j, 4:ip100, 5:ip200
									$default_url = trim($keyword['Post']['Blog']['domain'] .$keyword['Post']['id']);
									if($categories[$keyword['Post']['Blog']['category_id']] == 3) {
										$default_url = trim($keyword['Post']['Blog']['domain']) .$keyword['Post']['id'] .'-' .Inflector::slug($keyword['Post']['created'],'-') .'-' .Inflector::slug(!empty($keyword['Post']['menu']) ? $keyword['Post']['menu']:Configure::read('J_URL'),'-');
									}
									if($categories[$keyword['Post']['Blog']['category_id']] == 4) {
										$default_url = trim($keyword['Post']['Blog']['domain']) .$keyword['Post']['id'] .Configure::read('IP100_URL');
									}
									if($categories[$keyword['Post']['Blog']['category_id']] == 5 || $categories[$keyword['Post']['Blog']['category_id']] == 9) {
										$default_url = trim($keyword['Post']['Blog']['domain']) .$keyword['Post']['id'] .(!empty($keyword['Post']['pagename']) ? '_'.Inflector::slug($keyword['Post']['pagename']):'');
									}
									if($categories[$keyword['Post']['Blog']['category_id']] == 6) {
										$post_keyword = array();
										if(count($keyword['Post']['Keyword'])>0) {
											$i=0;
											foreach($keyword['Post']['Keyword'] as $kw) {
												$i++;
												if($kw['visible'] == 1) {
													// all keyword
													$list_keyword[] = $kw['keyword'];
													$list_keyword_url[] = $this->Html->link($kw['keyword'],$kw['url']);
													// post keyword
													$post_keyword[] = $kw['keyword'];
													// first keyword
													if($i == 1):
														$first_keyword[] = $kw['keyword'];
														$first_keyword_url = $this->Html->link($kw['keyword'],$kw['url']);
													endif;
												}
											}
										}
										$default_url = trim($keyword['Post']['Blog']['domain']) .$keyword['Post']['id'] .str_replace(' ', '', implode('', $post_keyword));
									} 
									// echo $this->Html->link($this->Text->truncate($default_url, configure::read('URL_LENGTH')), $default_url, array('target'=>'_blank'));
								}
							?>&nbsp;
						<!-- </td> -->
<!-- visible -->
						<td style="cursor: pointer;" class="visible" visible="<?php echo $keyword['Keyword']['visible'] ?>" keyword_id="<?php echo h($keyword['Keyword']['id']); ?>">
							<?php echo $keyword['Keyword']['visible']==1?$this->Html->image('tick.png',array('width'=>15)):$this->Html->image('cross.png',array('width'=>15)); ?>&nbsp;
						</td>
<!-- actions -->
						<td class="actions">
							<a href="<?php echo Router::url(array('controller' => 'posts', 'action'=>'edit',$keyword['Keyword']['post_id'])) ?>" class="btn-sm btn-primary"><i class="icon-edit"></i></a>
							<?php echo $this->Form->postLink(__(''), array('action' => 'delete',  $keyword['Keyword']['id']), array('class' => 'btn-sm btn-danger icon-trash'), __('【%s】を削除しますか？', $keyword['Keyword']['id'])); ?>
							<a href="<?php echo isset($default_url) ? $default_url:''; ?>" class="link_open_tab btn-sm btn-success" target="_blank"><i class="icon-eye-open"></i></a>
						</td>
					</tr>
					<?php endif; endforeach; ?>
				</table>
<!-- paging -->
				<div class="row">
					<?php if(!isset($search)): ?>
						<div class="col-lg-12 center">
							<span class="label label-info">
								<?php echo $this->Paginator->counter(array('format' => __('全{:pages}ページ'))); ?>
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
		//
		$('.duplicate').each(function(){
			var url = $(this).attr('url');
			if($('td[class="duplicate"][url="'+url+'"]').size()>1){
				console.log($('td[class="duplicate"][url="'+url+'"]').size());
				$(this).parents('tr').css('color','red').find('a.link').css('color','red');
			}
		})
		
		//
		$('.visible').click(function(){
			var keyword_id = $(this).attr('keyword_id');
			var visible = $(this).attr('visible')==1?0:1;
			$(this).find('img').attr('src','<?php echo $this->webroot ?>img/loading.gif');
			$.ajax({
				url:'<?php echo $this->webroot ?>keywords/visible',
				data:{keyword_id:keyword_id,visible:visible},
				type:'post',
				dataType:'json',
				success:function(data){
					if(data.visible==1){
						$('td[class="visible"][keyword_id="'+data.keyword_id+'"]').find('img').attr('src','<?php echo $this->webroot ?>img/tick.png');
					}else{
						$('td[class="visible"][keyword_id="'+data.keyword_id+'"]').find('img').attr('src','<?php echo $this->webroot ?>img/cross.png');
					}
					$('td[class="visible"][keyword_id="'+data.keyword_id+'"]').attr('visible',data.visible);
				}
			});
		})
	})
</script>