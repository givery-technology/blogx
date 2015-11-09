<div class="row">	
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header" data-original-title="">
				<h2><i class="icon-user"></i><span class="break"></span><?php  echo __(ucfirst($this->params['action']) .' ' .ucfirst(substr($this->params['controller'], 0, -1)));?></h2>
			</div>
			<div class="box-content">
				<?php echo $this->Form->create(Inflector::camelize(Inflector::singularize($this->params['controller']))); ?>
<!-- edit id -->
				<?php echo $this->Form->input('id'); ?>
<!-- blog -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo __('Blog'); ?></label>
						<div class="controls row">
							<div class="input-group col-sm-5">
								<?php echo $this->Form->input('blog_id', array('label' => FALSE, 'class' => 'form-control', 'type' => 'select', 'data-rel'=>'chosen')); ?>
							</div>
						</div>
					</div>
					<?php #endif; ?>
<!-- nave name -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo $this->Html->tag('span', __('Navigation Name')); ?></label>
						<span class="text-danger"><strong><?php #echo __('※必須') ?></strong></span>
						<div class="controls row">
							<div class="input-group col-sm-5">
								<span class="input-group-addon"><i class="icon-th-large"></i></span>
								<?php echo $this->Form->input('nav_name', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
							</div>
						</div>
					</div>
<!-- nav name jpn -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo $this->Html->tag('span', __('Navigation Name JPN')); ?></label>
						<span class="text-danger"><strong><?php #echo __('※必須') ?></strong></span>
						<div class="controls row">
							<div class="input-group col-sm-5">
								<span class="input-group-addon"><i class="icon-th-large"></i></span>
								<?php echo $this->Form->input('nav_name_jpn', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
							</div>
						</div>
					</div>
<!-- submit -->
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