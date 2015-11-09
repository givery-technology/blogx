<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="box">
			<div class="box-header">
				<h2>
					<?php echo __('Link Result List'); ?>
					<?php echo !isset($search) ? $this -> Paginator -> counter(array('model' => 'LinkContent', 'format' => __('{:count}'))) : count($linkContents); ?>
				</h2>
			</div>
			<div class="box-content">
				<?php echo $this -> Session -> flash(); ?>
<!-- history input -->
<!-- csv -->
				<p class="align-right">
					<!-- <div class="input-group tbl6">
						<?php echo $this->Form->create('LinkContent',array('class'=>'')); ?>
						<div class="input-group">
							<?php echo $this->Form->input('keyword',array('label'=>False,'class'=>'form-control', 'type'=>'text', 'required' => False, 'div' => False)); ?>
						</div>
						<?php echo $this->Form->end(); ?>
					</div> -->
					<?php echo $this -> Html -> link(__('Download Csv'), array('action' => 'download_csv_domain', $this -> params['pass'][0]), array('class' => "btn btn-success")); ?>
				</p>
<!-- search form -->
				<!-- <div class="form-group tbl6">
					<?php #echo $this->Form->create('Search',array('class'=>'form-search')); ?>
						<?php #echo $this->Form->input('keyword',array('label'=>False,'class'=>'form-control', 'type'=>'text','div'=>False, 'required' => False)); ?>
					<?php #echo $this->Form->end(); ?>
				</div> -->
<!-- table -->
				<table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
					<?php echo $this->Element('table/checklist'); ?>
					<tbody role="alert" aria-live="polite" aria-relevant="all">
						<?php foreach ($linkContents as $linkContent): ?>
						<tr>
							<td class="center"><?php echo h($linkContent['LinkContent']['id']); ?>&nbsp;</td>
<!-- keyword -->
							<td><?php echo h($linkContent['Link']['keyword']); ?>&nbsp;</td>
<!-- url -->
							<td>
								<?php echo $this -> Html -> link(h($this -> Text -> truncate(urldecode($linkContent['Link']['url']), configure::read('STRING_LENGTH_SHORT'))), h($linkContent['Link']['url']), array('target' => '_blank')); ?>
							</td>
<!-- type -->
							<td><?php echo $this -> Url -> linkType($linkContent['Link']['type']); ?>&nbsp;</td>
<!-- 1 url keyword -->
							<td>
								<?php 
									$check_keyword = $this->Keyword->checkKeyword($linkContent['Link']['url'], $this->Keyword->noSpace($linkContent['Link']['keyword']));
									echo ($check_keyword != 0) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); 
								?>&nbsp;
							</td>
<!-- 2 title keyword -->
							<td>
								<?php 
									$check_keyword = $this->Keyword->checkKeyword($linkContent['LinkContent']['title'], $linkContent['Link']['keyword']);
									echo ($check_keyword == 1) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); 
								?>&nbsp;
							</td>
<!-- 3 meta_keyword -->
							<td>
								<?php 
									$check_keyword = $this->Keyword->checkKeyword($linkContent['LinkContent']['meta_keyword'], $linkContent['Link']['keyword']);
									echo ($check_keyword == 1) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); 
								?>&nbsp;
							</td>
<!-- 4 meta_description -->
							<td>
								<?php 
									$check_keyword = $this->Keyword->checkKeyword($linkContent['LinkContent']['meta_description'], $linkContent['Link']['keyword']);
									echo ($check_keyword == 1) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); 
								?>&nbsp;
							</td>
<!-- 5 h1_tag -->
							<td>
								<?php 
									$check_keyword = $this->Keyword->checkKeyword($linkContent['LinkContent']['h1_tag'], $linkContent['Link']['keyword']);
									echo ($check_keyword == 1) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); 
								?>&nbsp;
							</td>
<!-- 6 keyword_count -->
							<td><?php echo h($linkContent['LinkContent']['keyword_count']); ?>&nbsp;</td>
<!-- 7 frequency -->
							<td>
								<?php 
									@$frequency_keyword = $linkContent['LinkContent']['keyword_count']*$this->Keyword->countLength($linkContent['Link']['keyword']) / mb_strlen($this->Keyword->jpnContent($linkContent['LinkContent']['no_html_content']));
									echo ($linkContent['LinkContent']['keyword_count'] != 0) ? round($frequency_keyword*100,4).'%' : 0; 
								?>
							</td>
<!-- 8 a_tag_count on-site link -->
							<td><?php echo h($linkContent['LinkContent']['a_tag_count']); ?>&nbsp;</td>
<!-- 9 redirect -->
							<td>
								<?php
									@$www_redirect = explode(' ', $linkContent['LinkContent']['www_redirect']);
									echo (@$www_redirect[1] == 301) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15));
								?>&nbsp;
							</td>
<!-- 10 canonical -->
							<td class=""><?php echo ($linkContent['LinkContent']['canonical'] != 0) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); ?>&nbsp;</td>
<!-- 11 unique title -->
							<td class=""><?php echo ($linkContent['LinkContent']['unique_title'] == 1) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); ?>&nbsp;</td>
<!-- 12 unique meta keyword -->
							<td class=""><?php echo ($linkContent['LinkContent']['unique_meta_keyword'] == 1) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); ?>&nbsp;</td>
<!-- 13 unique meta description -->
							<td class=""><?php echo ($linkContent['LinkContent']['unique_meta_description'] == 1) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); ?>&nbsp;</td>
<!-- action -->
							<td class="center">
								<a href="<?php echo Router::url(array('action'=>'view',$linkContent['LinkContent']['id'])) ?>" class="btn btn-primary"><i class="icon-eye-open"></i></a>
								<!-- <a href="<?php #echo Router::url(array('controller' => 'links', 'action' => 'get_content', $linkContent['Link']['id'])) ?>" class="btn btn-success"><i class="icon-refresh"></i></a> -->
								<!-- <a href="<?php #echo 'http://' .$_SERVER['SERVER_NAME'] .Router::url(array('action'=>'cache',$linkContent['LinkContent']['id'])) ?>" class="btn btn-warning" target="_blank"><i class="icon-exclamation-sign"></i></a> -->
								<!-- <a href="<?php #echo Router::url(array('action'=>'cache',$linkContent['LinkContent']['id'])) ?>" class="btn btn-warning" target="_blank"><i class="icon-exclamation-sign"></i></a> -->
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
			</table>
			<?php if(!isset($search)){ ?>
<!-- paging -->
				<!-- <div class="row">
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
								<li><?php #echo $this->Paginator->prev('← ' . __('previous'), array('model'=>'LinkContent'), null, array('class' => 'prev disabled')); ?></li>
								<li><?php #echo $this->Paginator->numbers(array('separator' => '','model'=>'LinkContent')); ?></li>
								<li><?php #echo $this->Paginator->next(__('next') . ' →', array('model'=>'LinkContent'), null, array('class' => 'next disabled')); ?></li>
							</ul>
						</div>
					</div>
				</div> --><!-- paging end row -->
				<?php } ?>
			</div>
		</div>
	</div>
</div>