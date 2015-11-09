<?php 
	$out_links = $this->Url->outLink($linkContent['LinkContent']['a_tag'],$linkContent['Link']['url'],$linkContent['Link']['domain']);
	$onpage_links = $this->Url->onpageLink($linkContent['LinkContent']['a_tag'],$linkContent['Link']['url'],$linkContent['Link']['domain']);
	$all_links = $this->Url->allLink($linkContent['LinkContent']['a_tag'],$linkContent['Link']['url'],$linkContent['Link']['domain']);
	$count_out = count($out_links);
	$count_all = count($all_links);
?>

<div class="row">
	<div class="col-lg-6">
		<div class="box">
			<div class="box-header">
				<h2>
					<?php echo __(configure::read('LinkContent.view_link')); ?>
				</h2>
			</div>
			<div class="box-content">
				<?php echo $this -> Session -> flash(); ?>
<!-- table -->
				<table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
					<thead>
						<tr role="row">
							<th colspan="" class="tbl0"><?php echo __('No.'); ?></th>
							<th colspan="" class="tbl5">
								<?php echo $linkContent['Link']['keyword']; ?>
								<?php echo $this->Html->link($this->Text->truncate($linkContent['Link']['url'], configure::read('URL_LENGHT')), $linkContent['Link']['url'], array('target' => '_blank')); ?>
								<br />
								<?php echo __('Count All Link') .': ' .$count_all; ?>
								<?php echo __('Count In Page Link') .': ' .($count_all - $count_out); ?>
								<?php echo __('Count Outbounce Link') .': ' .$count_out; ?>
							</th>
							<!-- <th class="tbl1"><?php echo __('Status'); ?></th> -->
						</tr>
					</thead>
					<tbody>
<!-- data -->
					<?php $count = 0; foreach($all_links as $all_link): $count++;?>
						<tr>
							<td><?php echo $count; ?></td>
							<td class="">
								<?php echo strip_tags($all_link[3][0]);?>&nbsp;
								<br />
								<?php 
									if(strpos(' '.$all_link[1][0],'http') != False) {
										echo $this->Html->link($this->Text->truncate($all_link[1][0], configure::read('URL_LENGTH')), $all_link[1][0], array('target' => '_blank'));
									} else {
										echo $this->Html->link($this->Text->truncate($all_link[1][0], configure::read('URL_LENGTH')), 'http://'.$linkContent['Link']['domain'].'/'.$all_link[1][0], array('target' => '_blank'));
									}
								?>&nbsp;
							</td>
							<!-- <td class="http_response" data-url="<?php #echo (strpos(' '.$all_link[1][0],'http') != False)? $all_link[1][0] : 'http://'.$linkContent['Link']['domain'].'/'.$all_link[1][0] ?>" data-status="200" data-wait="<?php echo (strpos(' '.$all_link[1][0],'http') != False)? 3: 1 ?>">
								<?php 
									// load ajax
									//if(strpos(' '.$all_link[1][0],'http') != False) {
										//echo ( $this->Url->http_response($all_link[1][0], 200, 3) != 0) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15));
									//} else {
										#echo ( $this->Url->http_response('http://'.$linkContent['Link']['domain'].'/'.$all_link[1][0], 200, 1) != 0) ? $this->Html->image('tick.png',array('width'=>15)): $this->Html->image('cross.png',array('width'=>15));
									//}
								?>&nbsp;
							</td> -->
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div><!-- end box content -->
		</div>
	</div>
</div>

<script type="text/javascript">
	// $(document).ready(function(){
		// var count = $('.http_response').size()-1;
		// load_link(0,count);
	// })
// 	
	// function load_link(index, count){
		// if(index <= count){
			// var obj = $('.http_response:eq('+index+')')
			// var url = obj.attr('data-url');
			// var status = obj.attr('data-status');
			// var wait = obj.attr('data-wait');
			// $.ajax({
				// url:'<?php echo $this->webroot ?>link_contents/http_response',
				// data:{url:url,status:status,wait:wait},
				// type:'post',
				// success:function(data){
					// obj.html(data);
					// index++;
					// load_link(index, count);
				// }
			// });
		// }
	// }
</script>