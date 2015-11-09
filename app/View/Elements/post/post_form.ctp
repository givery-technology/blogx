<!-- edit id -->
				<?php echo $this->Form->input('id'); ?>
<!--tab post-->				
<div style="margin-top: 20px" class="tabbable">
	<ul class="nav nav-responsive nav-tabs">
		<li class="active">
			<a href="#multi-post" data-toggle="tab">Add post 1</a>
		</li>		
	</ul>
<!-- tab content -->
	<div class="tab-content">
		<div class="tab-pane active multi-post" id='multi-post'>

<!-- start form content -->
			<div class="box-multipost"><i class="icon-file"></i><?php echo __('Add More Post'); ?></div>
			<div class="multi-content" id="multi-content">
<!-- show line multi-content-->
				<div class="box-multicontent"><i class="icon-file"></i><?php echo __('Add More Content'); ?></div>
<!-- menu -->
			<div class="form-group" style="display:none">
			  <label class="control-label" for="date"><?php echo __('メニュー'); ?></label>
			  <span class="text-danger"><strong><?php echo __('※J・アメJ・X10') ?></strong></span>
			  <div class="controls row">
				<div class="input-group col-sm-12">
				 <?php echo $this->Form->input('menu', array('name'=>'data[Post][menu][]', 'label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
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
				  <?php echo $this->Form->input('title', array('name'=>'data[Post][title][]', 'label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
				</div>
				<!-- <span class="help-block col-sm-8">ex. </span> -->
			  </div>
			</div>
<!-- blog -->
				<div class="form-group link21">
				  <label class="control-label" for="date"><?php echo __('Blog'); ?></label>
				  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
				  <div class="controls row">
					<div class="input-group col-sm-12">
					 <?php echo $this->Form->input('blog_id', array('name'=>'data[Post][blog_id][]', 'label'=> FALSE, 'type' => 'select', 'div'=>false, 'class' => 'form-control', 'data-rel'=>'chosen'));?>
					</div>
				  </div>
				</div>
<!-- pagename ip200 -->
				<div class="form-group" style="<?php echo $select_default!=5?'display:none':'' ?>">
				  <label class="control-label" for="date"><?php echo __('Pagename'); ?></label>
				  <span class="text-danger"><strong><?php echo __('※/All Domain/IP-200/') ?></strong></span>
				  <div class="controls row">
					<div class="input-group col-sm-12">
					 <?php echo $this->Form->input('pagename', array('name'=>'data[Post][pagename][]', 'label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
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
					  <?php #echo $this->Form->input('content', array('label' => FALSE, 'class' => 'form-control', 'type' => 'textarea')); ?>
					  <?php echo $this->Form->input('content', array('name'=>'data[Post][content][]', 'label' => FALSE, 'class' => 'form-control', 'type' => 'textarea')); ?>
					</div>
					<!-- <span class="help-block col-sm-8">ex. </span> -->
				  </div>
				</div>
<!-- public -->
				<div class="form-group">
					<div class="controls row">
						<div class="input-group col-sm-4">
							<!-- error multipublic-->
							<?php #echo $this->Form->input('public', array('name'=>'data[Post][public][]', 'label'=> __('Public'), 'type' => 'checkbox', 'checked' => 'checked', 'value' => 1, 'class' => 'form'));?>
							<!-- fixed error multipublic-->
							<?php echo $this->Form->input('public', array('name'=>'data[Post][public][]', 'label'=> array('text' => __('Public'), 'class' => 'label label-important'), 'type' => 'checkbox', 'checked' => 'checked', 'class' => 'form', 'hiddenField'=>false));?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					</div>
				</div>
			</div><!-- multi content -->
<!-- keyword -->
			<div class="form-group">
			  <label class="control-label" for="date"><?php echo __('Anchor Text'); ?></label>
			  <span class="text-danger"><strong><?php #echo __('※必須') ?></strong></span>
			  <div class="controls row">
				<div class="input-group col-sm-8">
				  <!-- <span class="input-group-addon"><i class="icon-list"></i></span> -->
				  <?php echo $this->Form->input('Keyword.keyword', array('name'=>'data[Keyword][keyword][]', 'label'=> FALSE, 'class' => 'form-control', 'type'=>'textarea'));?>
				</div>
				<!-- <span class="help-block col-sm-8">ex. </span> -->
				<div class="input-group col-sm-2"><?php echo $this->Form->input('arbitrary', array('name'=>'data[Post][arbitrary][]', 'label'=> array('text' => __('Arbitrary'), 'class' => 'label label-warning'), 'type' => 'checkbox', 'checked' => 'checked', 'class' => 'form', 'hiddenField'=>false));?></div>
			  </div>
			</div>

<!-- keyword url -->
			<div class="form-group">
			  <label class="control-label" for="date"><?php echo __('Url'); ?></label>
			  <span class="text-danger"><strong><?php #echo __('※必須') ?></strong></span>
			  <div class="controls row">
				<div class="input-group col-sm-12">
				  <!-- <span class="input-group-addon"><i class="icon-list"></i></span> -->
				  <?php #echo $this->Form->input('Keyword.url', array('label'=> FALSE, 'class' => 'form-control', 'type'=>'textarea'));?>
				  <?php echo $this->Form->input('Keyword.url', array('name'=>'data[Keyword][url][]', 'label'=> FALSE, 'class' => 'form-control', 'type'=>'textarea'));?>
				</div>
				<!-- <span class="help-block col-sm-8">ex. </span> -->
			  </div>
			</div>
<!-- kotei list -->
			<div class="form-group">
				<label class="control-label" for="date"><?php echo __('Kotei List Random'); ?></label>
				<span class="text-warning"><strong><?php echo __('※Option') ?></strong></span>
				<div class="controls row">
					<div class="input-group col-sm-4">
					 <?php 
						echo $this->Form->input('kotei_lists', array(
							'name'=>'data[Post][kotei_lists][0]', 
							// 'label'=>array('text'=>__('Kotei List Random'),'class' => 'label label-warning'),
							'label' => False,
							'legend'=>false,
							'separator' => '<br />',
							'type' => 'select', 
							'options' => configure::read('RANDOM_GROUP'),
							'default' => 0, 
							// 'style'=>'float: none;margin-left:0',
							'class'=>'form-control',
							'hiddenField'=>false
						));
					?>
					</div>
					<!-- <span class="help-block col-sm-8">ex. </span> -->
				</div>
			</div>
<!-- kotei list, outlink list, random image -->
			<div class="form-group">
				<div class="controls row">
				<!-- <div class="input-group col-sm-2">
					<?php #echo $this->Form->input('kotei_lists', array('div' => False, 'name'=>'data[Post][kotei_lists][]', 'label'=> array('text'=>__('Kotei List Random'),'class'=>'label label-warning'), 'type' => 'checkbox', 'checked' => 'checked', 'class' => 'form', 'hiddenField'=>false));?>
				</div> -->
				<div class="input-group col-sm-3">
					<?php echo $this->Form->input('outlink', array('div' => False, 'name'=>'data[Post][outlink][]', 'label'=> array('text'=>__('Outlink Random'),'class'=>'label label-default'), 'type' => 'checkbox', 'checked' => False, 'class' => 'form', 'hiddenField'=>false));?>
					<span class="text-warning"><strong><?php echo __('※X-Satelite') ?></strong></span>
				</div>
				<div class="input-group col-sm-2">
					<?php echo $this->Form->input('image', array('div' => False, 'name'=>'data[Post][image][]', 'label'=> array('text'=>__('Image'),'class'=>'label label-default'), 'type' => 'checkbox', 'checked' => False, 'class' => 'form', 'hiddenField'=>false));?>
					<span class="text-warning"><strong><?php echo __('※X-Satelite') ?></strong></span>
				</div>
				<!-- <span class="help-block col-sm-8">ex. </span> -->
				</div>
			</div>
<!-- end form content -->

		</div><!-- multi post -->
	</div><!-- tab content -->
</div><!-- tab post -->
<!-- submit button -->
					<?php echo $this->Form->button(__('Submit'), array('class' => 'btn btn-primary')); ?>
					<button class="btn btn-default"><?php echo $this -> Html -> link(__('キャンセル'), '/'.$this->params['controller'], array('class' => "")); ?></button>
				<?php echo $this->Form->end(); ?>
			</div><!-- .box-content -->
		</div><!-- .box -->
	</div><!-- .col-lg-12 -->
</div><!-- .row -->

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
	if(cat[1]==6 || cat[1]==3 || cat[1]==2){
		$('#PostBlogId').parents('.multi-post').find('.form-group:first').show();
	}else{
		$('#PostBlogId').parents('.multi-post').find('.form-group:first').hide();
	}
	
	$('select').change(function(){
		cat = $(this).val().split('-');
		
		// pagename
		if(cat[1]==5 || cat[1]==9){
			$(this).parents('.multi-post').find('input[name*="pagename"]').parents('.form-group').show();
		}else{
			$(this).parents('.multi-post').find('input[name*="pagename"]').parents('.form-group').hide();
		}
		
		// menu
		if(cat[1]==6 || cat[1]==3 || cat[1]==2){
			$(this).parents('.multi-post').find('.form-group:first').show();
		}else{
			$(this).parents('.multi-post').find('.form-group:first').hide();
		}
	})
	
	// multi post
	$('.addpost').click(function(){
		add_header_tab();
		$('.addpostcontent').hide();
		var multiPost = $('.multi-post:first').clone();
		// $('.multi-post:first').after(multiPost);
		$('.multi-post:last').after(multiPost);
		$('.multi-post:last').removeClass('active');
		var size_multiPost = $('.multi-post').size();
		$('.multi-post:last').attr('id','multi-post'+size_multiPost);
		$('.multi-post:last').find('.tagsinput').remove();
		$('.multi-post:last').find('#KeywordKeyword').attr('id','KeywordKeyword'+size_multiPost);
		$('.multi-post:last').find('#KeywordUrl').attr('id','KeywordUrl'+size_multiPost);
		$('#KeywordKeyword'+size_multiPost).tagsInput({width:'auto',height:'50px',defaultText:'Add new keyword'});
		$('#KeywordUrl'+size_multiPost).tagsInput({width:'auto',height:'50px',defaultText:'Add new keyword'});
		$('.multi-post:last').find('#cke_PostContent').remove();
		$('.multi-post:last').find('#PostContent').attr('id','PostContent'+size_multiPost);
		CKEDITOR.replace('PostContent'+size_multiPost);
		$('.multi-post:last').find('#PostPublic').attr('id','PostPublic'+size_multiPost);
		$('.multi-post:last').find('#PostPublic'+size_multiPost).parent().find('label').attr('for','PostPublic'+size_multiPost);
		
		// kotei list
		$('.multi-post:last').find('#PostKoteiLists').attr('id','PostKoteiLists'+size_multiPost);
		$('.multi-post:last').find('#PostKoteiLists'+size_multiPost).parent().find('label').attr('for','PostKoteiLists'+size_multiPost);
		for(var i=1;i<=3;i++){
			$('.multi-post:last').find('#PostKoteiLists'+i).attr('name','data[Post][kotei_lists]['+(size_multiPost-1)+']').attr('id','PostKoteiLists1-'+size_multiPost);		
			$('.multi-post:last').find('label[for="PostKoteiLists'+i+'"]').attr('for','PostKoteiLists1-'+size_multiPost);
		}
		
		// outlink checkbox
		$('.multi-post:last').find('#PostOutlink').attr('id','PostOutlink'+size_multiPost);
		$('.multi-post:last').find('#PostOutlink'+size_multiPost).parent().find('label').attr('for','PostOutlink'+size_multiPost);
		
		// image checkbox
		$('.multi-post:last').find('#PostImage').attr('id','PostImage'+size_multiPost);
		$('.multi-post:last').find('#PostImage'+size_multiPost).parent().find('label').attr('for','PostImage'+size_multiPost);
		
		// pagename ip200
		$('.multi-post:last').find('#PostBlogId').attr('id','PostBlogId'+size_multiPost);
		$('.multi-post:last').find('.chosen-container').remove();
		$('.multi-post:last select[id^="PostBlogId"]').val($('.multi-post:first select[id^="PostBlogId"]').val()); // keep blog id
		$('[data-rel="chosen"],[rel="chosen"]').chosen();
		$('.multi-post:last').find('#PostBlogId'+size_multiPost+'_chosen').css('width','100%');		
		$('select[id^="PostBlogId"]').on("change", function(e) {
			var val = this.value.split('-');
			// pagename
			if(val[1]==5){
				$(this).parents('.multi-post').find('input[name*="pagename"]').parents('.form-group').show();
			}else{
				$(this).parents('.multi-post').find('input[name*="pagename"]').parents('.form-group').hide();
			}
			
			// menu
			if(val[1]==2 || val[1]==3 || val[1]==6){
				$(this).parents('.multi-post').find('.form-group:first').show();
			}else{
				$(this).parents('.multi-post').find('.form-group:first').hide();
			}
		})
		
		// add line
		$('.box-multipost').show();
	})

	// multi content
	$('.addpostcontent').click(function(){
		add_header_tab();
		$('.addpost').hide();
		var multiContent = $('.multi-content:first').clone();
		// $('.multi-content:first').after(multiContent);
		$('.multi-post:last').after(multiContent);
		$('.multi-content:last').wrap('<div id="multi-post" class="tab-pane multi-post"></div>');
		//$('.multi-content:last').after(multiContent);
		$('.multi-post:last').removeClass('active');
		var size_multiContent = $('.multi-content').size();
		$('.multi-post:last').attr('id','multi-post'+size_multiContent);		
		$('.multi-content:last').attr('id','multi-content'+size_multiContent);
		$('.multi-content:last').find('#cke_PostContent').remove();
		$('.multi-content:last').find('#PostContent').attr('id','PostContent'+size_multiContent);
		CKEDITOR.replace('PostContent'+size_multiContent);
		// add line
		$('.box-multicontent').show();
		// pagename ip200
		$('.multi-post:last').find('#PostBlogId').attr('id','PostBlogId'+size_multiContent);
		$('.multi-post:last').find('.chosen-container').remove();
		$('.multi-post:last select[id^="PostBlogId"]').val($('.multi-post:first select[id^="PostBlogId"]').val()); // keep blog id
		$('[data-rel="chosen"],[rel="chosen"]').chosen();
		$('.multi-post:last').find('#PostBlogId'+size_multiContent+'_chosen').css('width','100%');		
		$('select[id^="PostBlogId"]').on("change", function(e) {
			var val = this.value.split('-');
			// pagename
			if(val[1]==5){
				$(this).parents('.multi-post').find('input[name*="pagename"]').parents('.form-group').show();
			}else{
				$(this).parents('.multi-post').find('input[name*="pagename"]').parents('.form-group').hide();
			}
			
			// menu
			if(val[1]==2 || val[1]==3 || val[1]==6){
				$(this).parents('.multi-post').find('.form-group:first').show();
			}else{
				$(this).parents('.multi-post').find('.form-group:first').hide();
			}
		})
	})
	
})

function add_header_tab(){
	var nav_tab = '<li class=""><a href="#multi-post'+($('.tabbable .nav-tabs li').size()+1)+'" data-toggle="tab">Add post '+($('.tabbable .nav-tabs li').size()+1)+'</a></li>';
	$('.tabbable .nav-tabs').append(nav_tab);
}
</script>