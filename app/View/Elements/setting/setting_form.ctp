<!-- edit id -->
				<?php echo $this->Form->input('id'); ?>				
<!-- Setting Key -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Setting Key'); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon"><i class="icon-pencil"></i></span>
						  <?php echo $this->Form->input('key', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<span class="help-block col-sm-5">ex. </span>
					  </div>
					</div>
<!-- setting value -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Setting value'); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon"><i class="icon-pencil"></i></span>
						  <?php echo $this->Form->input('value', array('label' => FALSE, 'class' => 'form-control', 'type' => 'textarea')); ?>
						</div>
						<span class="help-block col-sm-5">ex. </span>
					  </div>
					</div>					
<!-- Setting Title -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Title'); ?></label>
					  <!-- <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span> -->
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon"><i class="icon-briefcase"></i></span>
						  <?php echo $this->Form->input('title', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<span class="help-block col-sm-5">ex. </span>
					  </div>
					</div>
<!-- Setting Description -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Description'); ?></label>
					  <!-- <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span> -->
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon"><i class="icon-briefcase"></i></span>
						  <?php echo $this->Form->input('description', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<span class="help-block col-sm-5">ex. </span>
					  </div>
					</div>
<!-- Setting Input type -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Input Type'); ?></label>
					  <!-- <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span> -->
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <!--<span class="input-group-addon"><i class="icon-briefcase"></i></span>-->
						  <?php echo $this->Form->input('input_type', array('label' => FALSE, 'class' => 'form-control', 'type' => 'select','options'=>$input_type, 'data-rel'=>'chosen')); ?>
						</div>
						<span class="help-block col-sm-5">
							Ex: <br />
							<strong>Select multiple</strong> <br />
							<strong>Set params:</strong> <br />
							multiple=checkbox <br />
							options={"key1": "value1", "key2": "value2"}
						</span>
					  </div>
					</div>
<!-- Setting Editable -->
					<div class="form-group">
					  <label class="control-label" for="date">
						<?php echo __('Editable'); ?> <?php echo $this->Form->input('editable', array('label' => FALSE, 'type' => 'checkbox')); ?>
					</label>
					</div>
<!-- Setting Params -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Params'); ?></label>
					  <!-- <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span> -->
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon"><i class="icon-briefcase"></i></span>
						  <?php echo $this->Form->input('params', array('label' => FALSE, 'class' => 'form-control', 'type' => 'textarea')); ?>
						</div>
						<span class="help-block col-sm-5">ex. </span>
					  </div>
					</div>					
					<?php echo $this->Form->button(__('Submit'), array('class' => 'btn btn-primary')); ?>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('[data-rel="chosen"],[rel="chosen"]').chosen();
	})
</script>	