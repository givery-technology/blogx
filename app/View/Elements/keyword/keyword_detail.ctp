<div class="row">
	<div class="col-lg-3 col-sm-6 col-xs-6 col-xxs-12">
		<div class="smallstat box">
			<div class="boxchart-overlay red">
				<div class="boxchart"><canvas width="64" height="30" style="display: inline-block; vertical-align: top; width: 64px; height: 30px;"></canvas></div>
			</div>	
			<span class="title"><?php echo __('Datetime'); ?></span>
			<span class="value">
				<?php
					if(count($this->params['data'])>0) {
						echo $this->params['data']['History']['date']['year'] .'-' .$this->params['data']['History']['date']['month'];
					} else {
						echo __('Total');
					}
				?>
			</span>
		</div>
	</div><!--/col-->
	
	<div class="col-lg-3 col-sm-6 col-xs-6 col-xxs-12">
		<div class="smallstat box">
			<div class="boxchart-overlay blue">
				<div class="boxchart"><canvas width="64" height="30" style="display: inline-block; vertical-align: top; width: 64px; height: 30px;"></canvas></div>
			</div>	
			<span class="title"><?php echo __('Anchor Keyword'); ?></span>
			<span class="value"><?php echo count($posts); ?></span>
		</div>
	</div><!--/col-->
	
	<!-- <div class="col-lg-3 col-sm-6 col-xs-6 col-xxs-12">
		<div class="smallstat box">
			<div class="boxchart-overlay grey">
				<div class="boxchart"><canvas width="64" height="30" style="display: inline-block; vertical-align: top; width: 64px; height: 30px;"></canvas></div>
			</div>
			<span class="title"><?php echo __('Last month'); ?></span>
			<span class="value">999</span>
		</div>
	</div> --><!--/col-->
	
	<div class="col-lg-3 col-sm-6 col-xs-6 col-xxs-12">
		<div class="smallstat box">
			<div class="boxchart-overlay yellow">
				<div class="boxchart"><canvas width="64" height="30" style="display: inline-block; vertical-align: top; width: 64px; height: 30px;"></canvas></div>
			</div>
			<span class="title"><?php echo __('Total'); ?></span>
			<span class="value"><?php echo count($total_posts); ?></span>
		</div>
	</div><!--/col-->

</div>
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="box">
			<div class="">
				<h2>
					<span class="domain_index not-offer label label-default white-link fontsize30"><?php echo __('対策URL'); ?></span>
					&nbsp;
					<span class="not-offer label label-info white-link fontsize30">
						<?php 
							if (count($posts)>0) {
								echo $this->Html->link($posts[0]['Keyword']['url'], $posts[0]['Keyword']['url'] ,array('target' => 'blank'));
							} else { 
								echo 'No-data';
							}
						?>
					</span>
					&nbsp;
				</h2>
			</div>
			<div class="box-header">
				<h2>
					<?php echo __('Backlink Report Detail'); ?>
				</h2>
			</div>
			<div class="box-content">
				<?php echo $this -> Session -> flash(); ?>
<!-- right icon menu -->
				<p class="align-right">
					<?php
						if(count($this->params['data'])>0) {
							$date = implode('-', $this->params['data']['History']['date']);
						}
						echo isset($date) ? 
							$this->Element('common/button/download_csv', array('id' => $posts[0]['Keyword']['id'], 'date' => $date)):
							$this->Element('common/button/download_csv', array('id' => $posts[0]['Keyword']['id'],'date' => Null ));
					?>
				</p>
<!-- search -->
				<p>
					<?php echo $this->Element('common/form_history'); ?>
				</p>
<!-- table -->
				<!-- <table class="table table-striped table-bordered bootstrap-datatable datatable"> -->
				<table class="table table-bordered table-striped table-condensed">
<!-- heading -->
					<tr>
						<th><?php echo __('Id'); ?></th>
						<th><?php echo __('Anchor Keyword'); ?></th>
						<th><?php echo __('Blog'); ?></th>
						<th><?php echo __('blog'); ?></th>
						<th><?php echo __('post'); ?></th>
						<th><?php echo __('created'); ?></th>
						<th class="tbl2"><?php echo __('Actions'); ?></th>
					</tr>
<!-- data -->
					<?php $count=0; foreach ($posts as $post): $count++; ?>
					<?php 
						if(count($post['Post']) > 0 && isset($post['Post']['Blog'])) {
							// category 1:ameba, 2:amej, 3:j, 4:ip100, 5:ip200
							$default_url = trim($post['Post']['Blog']['domain'] .$post['Post']['id']);
							if($categories[$post['Post']['Blog']['category_id']] == 3) {
								$default_url = trim($post['Post']['Blog']['domain']) .$post['Post']['id'] .'-' .Inflector::slug($post['Post']['created'],'-') .'-' .Inflector::slug(!empty($post['Post']['menu']) ? $post['Post']['menu']:Configure::read('J_URL'),'-');
							}
							if($categories[$post['Post']['Blog']['category_id']] == 4) {
								$default_url = trim($post['Post']['Blog']['domain']) .$post['Post']['id'] .Configure::read('IP100_URL');
							}
							if($categories[$post['Post']['Blog']['category_id']] == 5) {
								$default_url = trim($post['Post']['Blog']['domain']) .$post['Post']['id'] .'-' .Inflector::slug(!empty($post['Post']['pagename']) ? $post['Post']['pagename']:Configure::read('IP200_URL'),'-');
							}
							if($categories[$post['Post']['Blog']['category_id']] == 6) {
								$post_keyword = array();
								if(count($post['Post']['Keyword'])>0) {
									$i=0;
									foreach($post['Post']['Keyword'] as $kw) {
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
								$default_url = trim($post['Post']['Blog']['domain']) .$post['Post']['id'] .str_replace(' ', '', implode('', $post_keyword));
							} 
						}
					?>
					<tr>
<!-- id -->
						<td><?php echo $post['Keyword']['id']; ?>&nbsp;</td>
<!-- url -->
						<!-- <td><?php #echo($post['Keyword']['url'] != '') ? $this -> Html -> link($this -> Text -> truncate($post['Keyword']['url'], 50), $post['Keyword']['url'], array('target' => '_blank')) : '<span class="no-data"></span>'; ?>&nbsp;</td> -->
						<td><?php echo $this -> Text -> truncate($post['Keyword']['keyword'], 30); ?>&nbsp;</td>
						<!-- <td><?php echo $post['Post']['Blog']['domain']; ?>&nbsp;</td> -->
						<td><?php echo isset($default_url) ? $this->Html->link($default_url,$default_url,array('target' => 'blank')) : ''; ?>&nbsp;</td>
<!-- google index blog-->
						<td 
							style="cursor: pointer;" 
							class="blog_index" 
							blog_id="<?php echo $post['Post']['Blog']['id']; ?>" 
							blog_url="<?php echo $post['Post']['Blog']['domain']; ?>"
						>
							<?php echo $post['Post']['Blog']['index']==0?$this->Html->image('cross.png',array('width'=>15)):$post['Post']['Blog']['index']; ?>&nbsp;
						</td>
<!-- google index page-->
						<td 
							style="cursor: pointer;" 
							class="google_index" 
							google_index="<?php echo $post['Post']['index'] ?>" 
							post_id="<?php echo $post['Post']['id']; ?>" 
							default_url="<?php echo isset($default_url)?$default_url:''; ?>"
						>
							<?php echo $post['Post']['index']==1?$this->Html->image('tick.png',array('width'=>15)):$this->Html->image('cross.png',array('width'=>15)); ?>&nbsp;
						</td>
<!-- created -->
						<td><?php echo date('Y-m-d', strtotime($post['Keyword']['created'])); ?>&nbsp;</td>
						<td class="">
<!-- edit post -->
							<a href="<?php echo Router::url(array('controller' => 'posts', 'action'=>'edit',$post['Post']['id'])) ?>" class="btn-primary"><i class="icon-edit"></i></a>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
<!-- paging -->
			<?php #echo $this->Element('common/button/back_referer'); ?>
			<button class="btn btn-default"><?php echo $this -> Html -> link(__('Back to Report'), '/'.$this->params['controller'] .'/report', array('class' => "")); ?></button>
			</div>
		</div>
	</div>
</div><!-- end row -->

<script type="text/javascript">
	$(document).ready(function(){
		// page index
		$('.google_index').click(function(){
			var post_id = $(this).attr('post_id');
			var default_url = $(this).attr('default_url');
			$(this).find('img').attr('src','<?php echo $this->webroot ?>img/loading.gif');
			$.ajax({
				url:'<?php echo $this->webroot ?>keywords/google_index',
				data:{post_id:post_id,default_url:default_url},
				type:'post',
				dataType:'json',
				success:function(data){
					if(data.google_index==1){
						// $('td[class="google_index"][post_id="'+data.post_id+'"]').html(data.google_index);
						$('td[class="google_index"][post_id="'+data.post_id+'"]').find('img').attr('src','<?php echo $this->webroot ?>img/tick.png');
					}
					
					if(data.google_index==0){
						$('td[class="google_index"][post_id="'+data.post_id+'"]').find('img').attr('src','<?php echo $this->webroot ?>img/cross.png');
					}
				}
			});
		})
		
		// domain index
		$('.blog_index').click(function(){
			var blog_id = $(this).attr('blog_id');
			var blog_url = $(this).attr('blog_url');
			$(this).find('img').attr('src','<?php echo $this->webroot ?>img/loading.gif');
			$.ajax({
				url:'<?php echo $this->webroot ?>keywords/google_index_blog',
				data:{blog_id:blog_id,blog_url:blog_url},
				type:'post',
				dataType:'json',
				success:function(data){
					if(data.google_index!=0){
						$('td[class="blog_index"][blog_id="'+data.blog_id+'"]').html(data.google_index);
					}else{
						$('td[class="blog_index"][blog_id="'+data.blog_id+'"]').find('img').attr('src','<?php echo $this->webroot ?>img/cross.png');
					}
				}
			});
		})
	})
</script>

<!-- debug -->