<!-- edit id -->
				<?php echo $this->Form->input('id'); ?>				
<!-- name -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Blog Name'); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon"><i class="icon-pencil"></i></span>
						  <?php echo $this->Form->input('name', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<span class="help-block col-sm-5">ex. サテライトサイト名</span>
					  </div>
					</div>
<!-- category -->
					<?php #if($this->request->params['action'] == 'add') : ?>
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Category'); ?></label>
					  <!-- <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span> -->
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <!-- <span class="input-group-addon"><i class="icon-briefcase"></i></span> -->
						  <?php echo $this->Form->input('category_id', array('label' => FALSE, 'class' => 'form-control', 'type' => 'select', 'data-rel'=>'chosen')); ?>
						</div>
						<span class="help-block col-sm-5">ex. カテゴリによりサイトの表示は異なります。</span>
					  </div>
					</div>
					<?php #endif; ?>
<!-- genre -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo __('Genre'); ?></label>
						<!-- <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span> -->
						<div class="controls row">
							<div class="input-group col-sm-5">
								<!-- <span class="input-group-addon"><i class="icon-picture"></i></span> -->
								<?php 
									echo $this->Form->input('genre_id', array(
										'label' => FALSE, 
										'class' => 'form-control', 
										'type' => 'select', 
										'data-rel'=>'chosen',
									)); 
								?>
							</div>
							<span class="help-block col-sm-5">ex. ブログのジェンル</span>
						</div>
					</div>
<!-- design -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo __('Design'); ?></label>
						<!-- <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span> -->
						<div class="controls row">
							<div class="input-group col-sm-5">
								<!-- <span class="input-group-addon"><i class="icon-picture"></i></span> -->
								<?php echo $this->Form->input('design_id', array('label' => FALSE, 'class' => 'form-control', 'type' => 'select', 'data-rel'=>'chosen')); ?>
							</div>
							<span class="help-block col-sm-5">ex. サイトのテンプレート</span>
						</div>
					</div>
<!-- sitename -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo $this->Html->tag('span', __('Site Name')); ?></label>
					  <span class="text-danger"><strong><?php #echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon"><i class="icon-th-large"></i></span>
						  <?php echo $this->Form->input('sitename', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
						<span class="help-block col-sm-5">me. 公開サイト名</span>
					  </div>
					</div>
<!-- title -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo $this->Html->tag('span', __('Title')); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon"><i class="icon-th-large"></i></span>
						  <?php echo $this->Form->input('title', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
						<span class="help-block col-sm-5">me. 最大69文字</span>
					  </div>
					</div>
<!-- description -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo $this->Html->tag('span', __('Description')); ?></label>
					  <span class="text-danger"><strong><?php #echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon"><i class="icon-th"></i></span>
						  <?php echo $this->Form->input('description', array('label' => FALSE, 'class' => 'form-control', 'type' => 'textarea')); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
						<span class="help-block col-sm-5">me. 最大156文字</span>
					  </div>
					</div>
<!-- ip	-->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo $this->Html->tag('span', __('IP')); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon"><i class="icon-globe"></i>
						  </span>
						  <?php echo $this->Form->input('ip', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<span class="help-block col-sm-5">ex. <?php echo $_SERVER['REMOTE_ADDR']; ?></span>
					  </div>
					</div>
<!-- domain	-->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo $this->Html->tag('span', __('Domain Name')); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon">URL</i>
						  </span>
						  <?php echo $this->Form->input('domain', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<!-- <span class="help-block">ex. <?php echo $_SERVER['REMOTE_ADDR']; ?></span> -->
					  </div>
					</div>						
<!-- api key -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo $this->Html->tag('span', __('API Key')); ?></label>
						<!-- <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span> -->
						<div class="controls row">
							<div class="input-group col-sm-5">
								<span class="input-group-addon"><i class="icon-certificate"></i></span>
								<?php echo $this->Form->input('key', array('label' => FALSE, 'class' => 'form-control', 'div' => false, 'value'=>String::uuid(), 'readonly'=>'readonly'));?>
							</div>
							<!-- <span class="help-block col-sm-8">ex. <?php echo $_SERVER['REMOTE_ADDR']; ?></span> -->
							<span class="help-block getKey"><?php echo $this->Html->image('refresh.png',array('width'=>15,'style'=>'cursor: pointer;')); ?></span>
						</div>
					</div>
<!-- memo -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo $this->Html->tag('span', __('Memo')); ?></label>
						<span class="text-danger"><strong><?php #echo __('※必須') ?></strong></span>
						<div class="controls row">
							<div class="input-group col-sm-5">
								<span class="input-group-addon"><i class="icon-pencil"></i></span>
								<?php echo $this->Form->input('memo', array('label' => FALSE, 'class' => 'form-control', 'type' => 'textarea')); ?>
							</div>
							<span class="help-block col-sm-8">ex. サテライトサイトの詳細情報</span>
						</div>
					</div>
					<?php echo $this->Form->button(__('Submit'), array('class' => 'btn btn-primary')); ?>
					<button class="btn btn-default"><?php echo $this->Html->link(__('キャンセル'), '/'.$this->params['controller'], array('class' => "")); ?></button>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		
		$('[data-rel="chosen"],[rel="chosen"]').chosen();
		
		$('.getKey').click(function(){
			$.ajax({
				url: '<?php echo $this->webroot ?>blogs/get_key',
				data:{},
				type:'post',
				async:true,
				success:function(data){
					$('#BlogKey').val(data);
				}
			});
		})
	})
</script>