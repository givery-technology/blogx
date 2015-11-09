				<?php echo $this->Form->input('id'); ?>
<!-- genre -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo __('Post Genre'); ?></label>
						<span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
						<div class="controls row">
							<div class="input-group col-sm-4">
								<span class="input-group-addon"><i class="icon-th"></i></span>
								<?php echo $this->Form->input('genre', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
							</div>
							<!-- <span class="help-block col-sm-8">ex. </span> -->
						</div>
					</div>
<!-- genre jpn -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo __('Post Genre Japanese'); ?></label>
						<span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
						<div class="controls row">
							<div class="input-group col-sm-4">
								<span class="input-group-addon"><i class="icon-th"></i></span>
								<?php echo $this->Form->input('genre_jpn', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
							</div>
							<!-- <span class="help-block col-sm-8">ex. </span> -->
						</div>
					</div>
<!-- genre jpn -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo __('Memo'); ?></label>
						<!-- <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span> -->
						<div class="controls row">
							<div class="input-group col-sm-4">
								<span class="input-group-addon"><i class="icon-th"></i></span>
								<?php echo $this->Form->input('memo', array('label' => FALSE, 'class' => 'form-control', 'type' => 'textarea')); ?>
							</div>
							<!-- <span class="help-block col-sm-8">ex. </span> -->
						</div>
					</div>
<!-- form end -->
					<?php echo $this->Form->button(__('Submit'), array('class' => 'btn btn-primary')); ?>
					<button class="btn btn-default"><?php echo $this -> Html -> link(__('キャンセル'), '/'.$this->params['controller'], array('class' => "")); ?></button>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>