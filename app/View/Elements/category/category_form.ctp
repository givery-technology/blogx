<!-- edit id -->
				<?php echo $this->Form->input('id'); ?>
<!-- category code -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Category Code'); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-4">
						  <span class="input-group-addon"><i class="icon-tag"></i></span>
						  <?php echo $this->Form->input('code', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					  </div>
					</div>	
<!-- category name -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Category Name'); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-4">
						  <span class="input-group-addon"><i class="icon-tag"></i></span>
						  <?php echo $this->Form->input('name', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					  </div>
					</div>
<!-- show url -->
					<!-- <div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Show Url'); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-4">
						  <span class="input-group-addon"><i class="icon-cog"></i></span>
						  <?php 
							echo $this->Form->input('show_url',array(
								'label' => false,
								'div'=>false,
								'type' => 'select',
								'class'=> 'form-control',
								'options'=>array(
									0 => __('Default'),
									1 => __('Created'),
									2 => __('Page Name')
								)	
							)); 
						?>
						</div>
						<span class="help-block col-sm-8">ex. ブログURLの表示形式。例：日付、ディレクトリなど</span>
					  </div>
					</div> -->
<!-- category name -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Memo'); ?></label>
					  <!-- <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span> -->
					  <div class="controls row">
						<div class="input-group col-sm-4">
						  <span class="input-group-addon"><i class="icon-comment"></i></span>
						  <?php echo $this->Form->input('memo', array('label' => FALSE, 'class' => 'form-control', 'type' => 'textarea')); ?>
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