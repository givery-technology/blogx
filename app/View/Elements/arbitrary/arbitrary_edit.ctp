<div class="row">	
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header" data-original-title="">
				<h2><i class="icon-edit"></i><span class="break"></span><?php  echo __('Edit Arbitraries');?></h2>
			</div>
			<div class="box-content">
				<?php echo $this->Form->create(ucfirst(substr($this->params['controller'],-3) == 'ies' ? substr($this->params['controller'], 0, -3).'y' : substr($this->params['controller'], 0, -1))); ?>
<!-- edit id -->
				<?php echo $this->Form->input('id'); ?>
<!-- prefix -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Prefix'); ?></label>
					  <!-- <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span> -->
					  <div class="controls row">
						<div class="input-group col-sm-4">
						  <span class="input-group-addon"><i class="icon-chevron-left"></i></span>
						  <?php echo $this->Form->input('prefix', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					  </div>
					</div>
<!-- suffix -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo $this->Html->tag('span', __('Suffix')); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-4">
						  <span class="input-group-addon"><i class="icon-chevron-right"></i>
						  </span>
						  <?php echo $this->Form->input('suffix', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					  </div>
					</div>					
					<?php echo $this->Form->button(__('Submit'), array('class' => 'btn btn-primary')); ?>
				<?php echo $this->Form->end(); ?>
			</div>            
		</div>
	</div>
</div>