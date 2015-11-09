<?php 
	$onpage_links = $this->Url->onpageLink($linkContent['LinkContent']['a_tag'],$linkContent['Link']['url'],$linkContent['Link']['domain']);
?>

<div class="row" id="check_list">
	<div class="col-lg-6">
		<div class="box">
			<div class="box-header">
				<h2>
					<?php echo __(configure::read('LinkContent.view_link')); ?>
					<?php echo count($onpage_links); ?>
				</h2>
			</div>
			<div class="box-content">
				<?php echo $this -> Session -> flash(); ?>
				<p class="">
<!-- add link -->
					<?php echo $this->Html->link(__('Add All Link'), 'javascript:void(0)', array('class' => "btn btn-danger",'id'=>'add_check')); ?>
				</p>
<!-- form checkbox -->
				<?php echo $this->Form->create('Check',array('url'=>array('controller'=>'link_contents','action'=>'add_check'))); ?>
					<?php echo $this->Form->input('keyword',array('class'=>'','hidden'=> True,'value'=>$linkContent['Link']['keyword'],'div'=>false,'label'=>false)); ?>
<!-- table -->
					<table class="table table-striped table-bordered bootstrap-datatable datatable">
						<tr>
							<!-- <th>
								<?php echo $this->Form->input('all_id',array('type'=>'checkbox','hiddenField' => True,'value'=>0,'div' => False, 'label' => False)); ?>
							</th> -->
							<th><?php echo __('No.'); ?></th>
							<th>
								<?php echo $linkContent['Link']['keyword']; ?>
								<?php echo $this->Html->link($this->Text->truncate($linkContent['Link']['url'], configure::read('STRING_LENGTH_5')), $linkContent['Link']['url'], array('target' => '_blank')); ?>
							</th>
							<!-- <th class="tbl1"><?php echo __('Status'); ?></th> -->
						</tr>
<!-- data -->
					<?php $count = 0; foreach($onpage_links as $link): $count++;?>
						<?php echo $this->Form->input('Link.'.$count,array('class'=>'check_one','hidden'=> True,'value'=>$link,'div'=>false,'label'=>false)); ?>
						<tr>
							<!-- <td><?php #echo $this->Form->input('check_id_' .$count,array('type'=>'checkbox','class'=>'check_one','hiddenField'=> True,'value'=>$link,'div'=>false,'label'=>false)); ?></td> -->
							<td><?php echo $count; ?></td>
							<td class="">
								<?php echo $this->Html->link($link, $link, array('target' => '_blank'));?>&nbsp;
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
				<?php echo $this->Form->end(); ?>
			</div><!-- end box content -->
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		// 
		// $('#check_list #CheckAllId').click(function() {
			// if($(this).attr('checked')=='checked'){
				// $('#check_list .check_one').attr('checked',true);
			// }else{
				// $('#check_list .check_one').removeAttr('checked');
			// }
		// });

		$('#add_check').click(function() {
			$('#CheckViewLinkOnpageForm').submit();
		});
	})
</script>