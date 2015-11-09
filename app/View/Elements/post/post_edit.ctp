<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header" data-original-title="">
<!-- Add Post -->
				<h2><i class="icon-edit"></i><span class="break"></span><?php  echo __(ucfirst($this->params['action']) .' ' .ucfirst(substr($this->params['controller'], 0, -1)));?></h2>
			</div>
			<div class="box-content">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Form->create(ucfirst(substr($this->params['controller'], 0, -1))); ?>
<!-- post form -->
				<?php #echo $this->element('post/post_form'); ?>
<!-- edit id -->
				<?php echo $this->Form->input('id'); ?>
<div class="tab-content">
		<div class="tab-pane active multi-post" id='multi-post'>
<!-- menu -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo __('メニュー'); ?></label>
						<span class="text-danger"><strong><?php echo __('※J・アメJ・X10') ?></strong></span>
						<div class="controls row">
							<div class="input-group col-sm-12">
								<?php echo $this->Form->input('menu', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
							</div>
						</div>
					</div>
<!-- title -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo $this->Html->tag('span', __('Title')); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-12">
						  <span class="input-group-addon"><i class="icon-th-large"></i>
						  </span>
						  <?php echo $this->Form->input('title', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					  </div>
					</div>
<!-- post genre -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo __('Post Genre'); ?></label>
						<span class="text-danger"><strong><?php #echo __('※必須') ?></strong></span>
						<div class="controls row">
							<div class="input-group col-sm-12">
							<?php 
								echo $this->Form->input('genre_id', array(
									'label'=> FALSE, 
									'type' => 'select', 
									'div'=> False, 
									'class' => 'form-control', 
									'data-rel'=>'chosen',
									'options' => $genres,
								));
							?>
							</div>
						</div>
					</div>
<!-- blog -->
					<div class="form-group link21">
					  <label class="control-label" for="date"><?php echo __('Blog'); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-12">
					 	 <?php echo $this->Form->input('blog_id', array('label'=> FALSE, 'type' => 'select', 'div'=> False, 'class' => 'form-control', 'data-rel'=>'chosen'));?>
					 	</div>
					  </div>
					</div>
<!-- pagename -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Pagename'); ?></label>
					  <span class="text-danger"><strong><?php echo __('※IP-200') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-12">
					 	 <?php echo $this->Form->input('pagename', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
					 	</div>
					  </div>
					</div>
<!-- content textarea-->
					<div class="form-group link22">
					  <label class="control-label" for="date"><?php echo $this->Html->tag('span', __('Content')); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-12">
						  <!-- <span class="input-group-addon"><i class="icon-th"></i> -->
						  </span>
						  <?php echo $this->Form->input('content', array('label' => FALSE, 'class' => 'form-control', 'type' => 'textarea')); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					  </div>
					</div>
<!-- public -->
					<div class="form-group">
						<div class="controls row">
							<div class="input-group col-sm-4">
								<!-- WARNING: different with add form -->
								<?php echo $this->Form->input('public', array('label'=> array('text' => __('Public'), 'class' => 'label label-important'), 'type' => 'checkbox', 'class' => 'form'));?>
								<?php #echo $this->Form->input('public', array('name'=>'data[Post][public][]', 'label'=> array('text' => __('Public'), 'class' => 'label label-important'), 'type' => 'checkbox', 'checked' => 'checked', 'class' => 'form', 'hiddenField'=>false));?>
							</div>
							<!-- <span class="help-block col-sm-8">ex. </span> -->
						</div>
					</div>
<!-- keyword -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Anchor Text'); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-12">
						  <!-- <span class="input-group-addon"><i class="icon-list"></i></span> -->
						  <?php echo $this->Form->input('Keyword.keyword', array('label'=> FALSE, 'class' => 'form-control', 'type'=>'textarea'));?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					  </div>
					</div>
<!-- keyword url -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Url'); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-12">
						  <!-- <span class="input-group-addon"><i class="icon-list"></i></span> -->
						  <?php echo $this->Form->input('Keyword.url', array('label'=> FALSE, 'class' => 'form-control', 'type'=>'textarea'));?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					  </div>
					</div>
<!-- submit button -->
					<?php echo $this->Form->button(__('Submit'), array('class' => 'btn btn-primary')); ?>
					<button class="btn btn-default"><?php echo $this -> Html -> link(__('キャンセル'), '/'.$this->params['controller'], array('class' => "")); ?></button>
					<?php echo $this->Element('common/button/back_referer'); ?>
	</div><!-- id multi-post -->
</div><!-- tab-content -->
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>

<?php
	echo $this->Fck->js();
	echo $this->Fck->load('Post.content');
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#KeywordKeyword').tagsInput({width:'auto',height:'50px',defaultText:'Add new keyword',});
		$('#KeywordUrl').tagsInput({width:'auto',height:'50px',defaultText:'Add new url',});
		$('.box-multipost').hide();
		$('.box-multicontent').hide();
	})
</script>	
				
<script type="text/javascript">
$(document).ready(function(){

	$('[data-rel="chosen"],[rel="chosen"]').chosen();

	var cat = $('#PostBlogId').val().split('-');
	if(cat[1]==2 || cat[1]==3 || cat[1]==6){
		$('#PostBlogId').parents('.multi-post').find('.form-group:first').show();
	}else{
		$('#PostBlogId').parents('.multi-post').find('.form-group:first').hide();
	}
	
	// pagename
	if(cat[1]==5){
		$(this).parents('.multi-post').find('input[name*="pagename"]').parents('.form-group').show();
	}else{
		$(this).parents('.multi-post').find('input[name*="pagename"]').parents('.form-group').hide();
	}
	
	$('select').change(function(){
		cat = $(this).val().split('-');
		if(cat[1]==2 || cat[1]==3 || cat[1]==6){
			$(this).parents('.multi-post').find('.form-group:first').show();
		}else{
			$(this).parents('.multi-post').find('.form-group:first').hide();
		}
		
		// pagename
		if(cat[1]==5){
			$(this).parents('.multi-post').find('input[name*="pagename"]').parents('.form-group').show();
		}else{
			$(this).parents('.multi-post').find('input[name*="pagename"]').parents('.form-group').hide();
		}
	})
})

function add_header_tab(){
	var nav_tab = '<li class=""><a href="#multi-post'+($('.tabbable .nav-tabs li').size()+1)+'" data-toggle="tab">Add post '+($('.tabbable .nav-tabs li').size()+1)+'</a></li>';
	$('.tabbable .nav-tabs').append(nav_tab);
}
</script>