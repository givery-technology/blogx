<?php 
	// debug
	// $test_content = "メンズ事バッグ、メッセンジャーバッグ|SEAL"; // aptana comment error fixed
	// $test_keyword = "メンズ バッグ"; // aptana comment error fixed
	// $check_keyword = $this->Keyword->checkKeyword($test_content, $test_keyword);
?>
<div class="row">
	<div class="col-lg-10">
		<div class="box">
			<div class="box-header">
				<h2>
					<?php echo __(configure::read('LinkContent.view')); ?>
				</h2>
			</div>
			<div class="box-content">
				<?php echo $this -> Session -> flash(); ?>
				<p>
					<?php echo $this->Html->link(__('View All Domain'), array('controller'=>'links','action' => 'link_domain',$linkContent['Link']['link_domain_id']), array('class' => "btn btn-info")); ?>
					<?php echo $this->Html->link(__('View All Result'), array('controller'=>'link_contents','action' => 'domain_result',$linkContent['Link']['link_domain_id']), array('class' => "btn btn-warning")); ?>
				</p>
<!-- table -->
				<table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
					<thead>
						<tr role="row">
							<th class="tbl0"><?php echo __('Id'); ?></th>
							<th class="tbl3"><?php echo __('Checklist'); ?></th>
							<th class="tbl8"><?php echo __('Content'); ?></th>
							<th class="tbl1"><?php echo __('Result'); ?></th>
							<!-- <th class="tbl5"><?php #echo __('Comment'); ?></th> -->
						</tr>
					</thead>
					<tbody>
<!-- keyword -->
						<tr>
							<td class=""><?php echo __('1'); ?></td>
							<td class=""><?php echo __('Keyword') .'/' .__('Url'); ?></td>
							<td class="">
								(<?php echo $this->Keyword->countLength($linkContent['Link']['keyword']); ?>)&nbsp;
								<?php echo h($linkContent['Link']['keyword']); ?>&nbsp;
								<?php echo $this->Html->link(h($this->Text->truncate($linkContent['Link']['url']), configure::read('URL_LENGTH')),h($linkContent['Link']['url']),array('target'=>'_blank')); ?>
							</td>
							<td class="">
								<?php 
									$check_keyword = $this->Keyword->checkKeyword($linkContent['Link']['url'], $this->Keyword->noSpace($linkContent['Link']['keyword']));
									echo ($check_keyword != 0) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); 
								?>&nbsp;
							</td>
							<!-- <td class=""><?php  ?>&nbsp;</td> -->
						</tr>
<!-- title -->
						<tr class="<?php echo ($this->Keyword->countLength($linkContent['LinkContent']['title']) > configure::read('SEO_TITLE_JPN')) ? 'alert-danger': ''; ?>">
							<td class=""><?php echo __('2'); ?></td>
							<td class=""><?php echo __('Title'); ?></td>
							<td class="">
								(<?php echo $this->Keyword->countLength($linkContent['LinkContent']['title']) .'/' .configure::read('SEO_TITLE_JPN'); ?>)&nbsp;
								<?php echo h($linkContent['LinkContent']['title']); ?>&nbsp;
							</td>
							<td class="">
								<?php 
									$check_keyword = $this->Keyword->checkKeyword($linkContent['LinkContent']['title'], $linkContent['Link']['keyword']);
									echo ($check_keyword == 1) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); 
								?>&nbsp;
							</td>
							<!-- <td class=""><?php  ?>&nbsp;</td> -->
						</tr>
<!-- meta keyword -->
						<tr>
							<td class=""><?php echo __('3'); ?></td>
							<td class=""><?php echo __('Meta Keyword'); ?></td>
							<td class=""><?php echo h($linkContent['LinkContent']['meta_keyword']); ?>&nbsp;</td>
							<td class="">
								<?php 
									$check_keyword = $this->Keyword->checkKeyword($linkContent['LinkContent']['meta_keyword'], $linkContent['Link']['keyword']);
									echo ($check_keyword == 1) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); 
								?>&nbsp;
							</td>
							<!-- <td class=""><?php  ?>&nbsp;</td> -->
						</tr>
<!-- meta description -->
						<tr class="<?php echo ($this->Keyword->countLength($linkContent['LinkContent']['meta_description']) > configure::read('SEO_DESCRIPTION_JPN')) ? 'alert-danger': ''; ?>">
							<td class=""><?php echo __('4'); ?></td>
							<td class=""><?php echo __('Meta Description'); ?></td>
							<td class="">
								(<?php echo $this->Keyword->countLength($linkContent['LinkContent']['meta_description']) .'/' .configure::read('SEO_DESCRIPTION_JPN'); ?>)&nbsp;
								<?php echo h($linkContent['LinkContent']['meta_description']); ?>&nbsp;
							</td>
							<td class="">
								<?php 
									$check_keyword = $this->Keyword->checkKeyword($linkContent['LinkContent']['meta_description'], $linkContent['Link']['keyword']);
									echo ($check_keyword == 1) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); 
								?>&nbsp;
							</td>
							<!-- <td class=""><?php  ?>&nbsp;</td> -->
						</tr>
<!-- h1 tag -->
						<tr>
							<td class=""><?php echo __('5'); ?></td>
							<td class=""><?php echo __('H1 Tag'); ?></td>
							<td class=""><?php echo ($linkContent['LinkContent']['h1_tag'] != '') ? $linkContent['LinkContent']['h1_tag'] : __('No Data'); ?>&nbsp;</td>
							<td class="">
								<?php 
									$check_keyword = $this->Keyword->checkKeyword($linkContent['LinkContent']['h1_tag'], $linkContent['Link']['keyword']);
									echo ($check_keyword == 1) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); 
								?>&nbsp;
							</td>
							<!-- <td class=""><?php  ?>&nbsp;</td> -->
						</tr>
<!-- keyword count keyword density -->
						<tr>
							<td class=""><?php echo __('6'); ?></td>
							<td class=""><?php echo __('Keyword Density'); ?></td>
							<td class="">
								<!-- keyword count -->
								<?php echo __('All in Source'); ?>
								(<?php echo $linkContent['LinkContent']['keyword_count']; ?>)
								<?php echo $linkContent['LinkContent']['keyword_count']*$this->Keyword->countLength($linkContent['Link']['keyword']) .'/' .mb_strlen($this->Keyword->jpnContent($linkContent['LinkContent']['no_html_content'])); ?>&nbsp;
								/
								<!-- keyword count body -->
								<?php echo __('All in Content'); ?>
								(<?php echo $linkContent['LinkContent']['keyword_count_body']; ?>)
								<?php echo $linkContent['LinkContent']['keyword_count_body']*$this->Keyword->countLength($linkContent['Link']['keyword']) .'/' .mb_strlen($this->Keyword->jpnContent($linkContent['LinkContent']['no_html_content'])); ?>&nbsp;
							</td>
							<td class="">
								<?php echo ($linkContent['LinkContent']['keyword_count'] != 0) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); ?>&nbsp;</td>
							</td>
							<!-- <td class=""><?php  ?>&nbsp;</td> -->
						</tr>
<!-- keyword frequency -->
						<tr>
							<td class=""><?php echo __('7'); ?></td>
							<td class=""><?php echo __('Keyword Frequency'); ?></td>
							<td class="">
								<?php echo __('All in Source'); ?>
								<?php 
									$frequency_keyword = $linkContent['LinkContent']['keyword_count']*$this->Keyword->countLength($linkContent['Link']['keyword']) / mb_strlen($this->Keyword->jpnContent($linkContent['LinkContent']['no_html_content']));
									echo ($linkContent['LinkContent']['keyword_count'] != 0) ? round($frequency_keyword*100,4).'%' : 0; 
								?>
								/
								<?php echo __('All in Content'); ?>
								<?php 
									$frequency_keyword_body = $linkContent['LinkContent']['keyword_count_body']*$this->Keyword->countLength($linkContent['Link']['keyword']) / mb_strlen($this->Keyword->jpnContent($linkContent['LinkContent']['no_html_content']));
									echo ($linkContent['LinkContent']['keyword_count_body'] != 0) ? round($frequency_keyword_body*100,4).'%' : 0; 
								?>
							</td>
							<td class="">
								<?php echo ($linkContent['LinkContent']['keyword_count'] != 0) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); ?>&nbsp;</td>
							</td>
							<!-- <td class=""><?php  ?>&nbsp;</td> -->
						</tr>
<!-- link a tag count -->
						<tr>
							<td class=""><?php echo __('8'); ?></td>
							<td class=""><?php echo __('Link Set'); ?></td>
							<td class="">
								<?php echo h($linkContent['LinkContent']['a_tag_count']); ?>&nbsp;
								<?php echo $this->Html->link(__('Link Onpage'), array('action' => 'view_link_onpage', $linkContent['LinkContent']['id']) , array('class' => 'label label-warning', 'target'=>'_blank')); ?>&nbsp;
								<?php echo $this->Html->link(__('Link Details'), array('action' => 'view_link', $linkContent['LinkContent']['id']) , array('class' => 'label label-important', 'target'=>'_blank')); ?>&nbsp;
							</td>
							<td class=""><?php echo ($linkContent['LinkContent']['a_tag_count'] > 0) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); ?>&nbsp;</td>
							<!-- <td class=""><?php  ?>&nbsp;</td> -->
						</tr>
<!-- sitemap -->
<!-- www redirect -->
						<tr>
							<td class=""><?php echo __('9'); ?></td>
							<td class=""><?php echo __('Redirect'); ?></td>
							<td class="">
								<?php echo h($linkContent['LinkContent']['www_redirect']); ?>&nbsp;
								<!-- http header -->
								<?php echo $this->Html->link(__('HTTP Header'), array('action' => 'view_header', $linkContent['LinkContent']['id']) , array('class' => 'label label-primary', 'target'=>'_blank')); ?>
							</td>
							<td class="">
								<?php
									$www_redirect = explode(' ', $linkContent['LinkContent']['www_redirect']);
									echo ($www_redirect[1] == 301) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15));
								?>&nbsp;
							</td>
							<!-- <td class=""><?php  ?>&nbsp;</td> -->
						</tr>
<!-- canonical -->
						<tr>
							<td class=""><?php echo __('10'); ?></td>
							<td class=""><?php echo __('Canonical'); ?></td>
							<td class=""><i><?php echo ($linkContent['LinkContent']['canonical'] != 0) ? __('Canonical Page'): __('No Canonical Page') ?></i>&nbsp;</td>
							<td class=""><?php echo ($linkContent['LinkContent']['canonical'] != 0) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); ?>&nbsp;</td>
							<!-- <td class=""><?php  ?>&nbsp;</td> -->
						</tr>
<!-- unique title -->
						<tr>
							<td class=""><?php echo __('11'); ?></td>
							<td class=""><?php echo __('Unique Title'); ?></td>
							<!-- <td class=""><?php #echo h($linkContent['LinkContent']['unique_title']); ?>&nbsp;</td> -->
							<td class=""><?php echo configure::read('INDEX_DATA'); ?>&nbsp;</td>
							<td class=""><?php echo ($linkContent['LinkContent']['unique_title'] == 1) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); ?>&nbsp;</td>
							<!-- <td class=""><?php  ?>&nbsp;</td> -->
						</tr>
<!-- unique meta keyword -->
						<tr>
							<td class=""><?php echo __('12'); ?></td>
							<td class=""><?php echo __('Unique Meta Keyword'); ?></td>
							<!-- <td class=""><?php #echo h($linkContent['LinkContent']['unique_meta_keyword']); ?>&nbsp;</td> -->
							<td class=""><?php echo configure::read('INDEX_DATA'); ?>&nbsp;</td>
							<td class=""><?php echo ($linkContent['LinkContent']['unique_meta_keyword'] == 1) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); ?>&nbsp;</td>
							<!-- <td class=""><?php  ?>&nbsp;</td> -->
						</tr>
<!-- unique meta description -->
						<tr>
							<td class=""><?php echo __('13'); ?></td>
							<td class=""><?php echo __('Unique Meta Description'); ?></td>
							<!-- <td class=""><?php #echo h($linkContent['LinkContent']['unique_meta_description']); ?>&nbsp;</td> -->
							<td class=""><?php echo configure::read('INDEX_DATA'); ?>&nbsp;</td>
							<td class=""><?php echo ($linkContent['LinkContent']['unique_meta_description'] == 1) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15)); ?>&nbsp;</td>
							<!-- <td class=""><?php  ?>&nbsp;</td> -->
						</tr>
					</tbody>
				</table>
<!-- back button -->
				<button class="btn btn-default"><?php echo $this -> Html -> link(__('Back'), $this->Layout->get_referer(@$_SERVER['HTTP_REFERER']), array('class' => "")); ?></button>
			</div><!-- end dbox content -->
		</div>
	</div>
</div>