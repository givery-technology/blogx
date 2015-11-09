<div class="row">	
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header" data-original-title="">
				<h2><i class="icon-edit"></i><span class="break"></span><?php  echo __(ucfirst($this->params['action']) .' ' .ucfirst(substr($this->params['controller'], 0, -1)));?></h2>
			</div>
			<div class="box-content">
				<?php echo $this->Form->create(ucfirst(substr($this->params['controller'],-3) == 'ies' ? substr($this->params['controller'], 0, -3).'y' : substr($this->params['controller'], 0, -1))); ?>
<!-- edit id -->
				<?php echo $this->Form->input('id');?>
<!-- name -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Name'); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-12">
						  <!-- <span class="input-group-addon"><i class="icon-tag"></i></span> -->
						  <?php echo $this->Form->input('name', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					  </div>
					</div>
<!-- params -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Params'); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-12">
						  <!-- <span class="input-group-addon"><i class="icon-tag"></i></span> -->
						  <?php echo $this->Form->input('params', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text', 'rows' => 1)); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					  </div>
					</div>					
<!-- js -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo $this->Html->tag('span', __('JS')); ?></label>
					  <!-- <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span> -->
					  <div class="controls row">
						<div class="input-group col-sm-12">
						  <!-- <span class="input-group-addon"><i class="icon-edit"></i> -->
						  </span>
						  <?php echo $this->Form->input('js', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text', 'rows' => 1)); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					  </div>
					</div>
<!-- css -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo $this->Html->tag('span', __('CSS')); ?></label>
					  <!-- <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span> -->
					  <div class="controls row">
						<div class="input-group col-sm-12">
						  <!-- <span class="input-group-addon"><i class="icon-edit"></i> -->
						  </span>
						  <?php echo $this->Form->input('css', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text', 'rows' => 1)); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					  </div>
					</div>
<!-- layout -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo $this->Html->tag('span', __('Layout')); ?></label>
					  <!-- <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span> -->
					  <div class="controls row">
						<div class="input-group col-sm-12">
						  <!-- <span class="input-group-addon"><i class="icon-edit"></i> -->
						  </span>
						  <?php echo $this->Form->input('layout', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text', 'rows' => 2)); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					  </div>
					</div>										
<!-- design -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo $this->Html->tag('span', __('Design')); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-12">
						  <!-- <span class="input-group-addon"><i class="icon-picture"></i> -->
						  </span>
						  <?php echo $this->Form->input('design', array('label' => FALSE, 'class' => 'form-control', 'type' => 'textarea')); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					  </div>
					</div>
					<?php echo $this->Form->button(__('Submit'), array('class' => 'btn btn-primary')); ?>
					<button class="btn btn-default"><?php echo $this->Html->link(__('キャンセル'), '/'.$this->params['controller'], array('class' => "")); ?></button>
				<?php echo $this->Form->end(); ?>
			</div>            
		</div>
	</div>
</div>

<?php
	echo $this->Fck->js();
	echo $this->Fck->load('Design.layout');
	echo $this->Fck->load('Design.design');
?>