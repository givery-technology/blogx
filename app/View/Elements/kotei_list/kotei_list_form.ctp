				<?php echo $this->Form->input('id'); ?>
<!-- keyword -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo __('Keyword'); ?></label>
						<!-- <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span> -->
						<div class="controls row">
							<div class="input-group col-sm-4">
								<span class="input-group-addon"><i class="icon-chevron-left"></i></span>
								<?php echo $this->Form->input('keyword', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
							</div>
							<!-- <span class="help-block col-sm-8">ex. </span> -->
						</div>
					</div>
<!-- url -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo $this->Html->tag('span', __('Url')); ?></label>
						<span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
						<div class="controls row">
							<div class="input-group col-sm-4">
								<span class="input-group-addon"><i class="icon-chevron-right"></i></span>
								<?php echo $this->Form->input('url', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
							</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
						</div>
					</div>
<!-- random group -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo $this->Html->tag('span', __('Random Group')); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-4">
						  <span class="input-group-addon"><i class="icon-flag"></i>
						  </span>
						  <?php echo $this->Form->input('random_group', array('label' => False, 'class' => 'form-control', 'type' => 'select', 'options' => Configure::read('RANDOM_GROUP'))); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					  </div>
					</div>
					<?php echo $this->Form->button(__('Submit'), array('class' => 'btn btn-primary')); ?>
					<button class="btn btn-default"><?php echo $this -> Html -> link(__('キャンセル'), '/'.$this->params['controller'], array('class' => "")); ?></button>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>