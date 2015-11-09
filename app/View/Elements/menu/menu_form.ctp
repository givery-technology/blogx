				<?php echo $this->Form->input('id'); ?>
<!-- blog id -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo __('Blog'); ?></label>
						<span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
						<div class="controls row">
							<div class="input-group col-sm-4">
								<!-- <span class="input-group-addon"><i class="icon-th"></i></span> -->
								<?php echo $this->Form->input('blog_id', array('label' => FALSE, 'class' => 'form-control', 'type' => 'select', 'data-rel'=>'chosen')); ?>
							</div>
							<!-- <span class="help-block col-sm-8">ex. </span> -->
						</div>
					</div>
<!-- name -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo __('Menu'); ?></label>
						<span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
						<div class="controls row">
							<div class="input-group col-sm-4">
								<span class="input-group-addon"><i class="icon-th"></i></span>
								<?php echo $this->Form->input('name', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
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

<script type="text/javascript">
	$(document).ready(function(){
		// list search
		$('[data-rel="chosen"],[rel="chosen"]').chosen();
		
	})
</script>