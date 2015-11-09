<!-- edit id -->
<?php echo $this->Form->input('id'); ?>
<!-- keyword -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Keyword'); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-4">
						  <!-- <span class="input-group-addon"><i class="icon-chevron-left"></i></span> -->
						  <?php echo $this->Form->input('keyword', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					  </div>
					</div>
<!-- suffix -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo $this->Html->tag('span', __('Url')); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-4">
						  <!-- <span class="input-group-addon"><i class="icon-chevron-right"></i> -->
						  </span>
						  <?php echo $this->Form->input('url', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
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

<!-- <div class="keywords form">
<?php echo $this->Form->create('Keyword'); ?>
	<fieldset>
		<legend><?php echo __('Add Keyword'); ?></legend>
	<?php
		echo $this->Form->input('post_id');
		echo $this->Form->input('company_id');
		echo $this->Form->input('keyword');
		echo $this->Form->input('url');
		echo $this->Form->input('visible');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div> -->