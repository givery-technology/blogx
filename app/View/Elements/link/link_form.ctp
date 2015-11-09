<!-- edit id -->
				<?php echo $this -> Form -> input('id'); ?>
<!-- type -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo __('Type'); ?></label>
						<span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
						<div class="controls row">
							<div class="input-group col-sm-5">
								<span class="input-group-addon"><i class="icon-pencil"></i></span>
								<?php echo $this -> Form -> input('type', array('label' => FALSE, 'class' => 'form-control', 'type' => 'select', 'options' => Configure::read('Link.type'))); ?>
							</div>
							<span class="help-block col-sm-5"></span>
						</div>
					</div>
<!-- keyword -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo $this -> Html -> tag('span', __('Keyword')); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon"><i class="icon-th"></i></span>
						  <?php echo $this -> Form -> input('keyword', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<span class="help-block col-sm-5"></span>
					  </div>
					</div>
<!-- Url -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo $this -> Html -> tag('span', __('Url')); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon"><i class="icon-th-large"></i></span>
						  <?php echo $this -> Form -> input('url', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<span class="help-block col-sm-5">ex. <?php echo __('domain or link'); ?></span>
					  </div>
					</div>
<!-- memo	-->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo $this -> Html -> tag('span', __('Memo')); ?></label>
					  <span class="text-danger"><strong><?php #echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon"><i class="icon-globe"></i>
						  </span>
						  <?php echo $this -> Form -> input('memo', array('label' => FALSE, 'class' => 'form-control')); ?>
						</div>
						<!-- <span class="help-block col-sm-5">ex.</span> -->
					  </div>
					</div>
					<?php echo $this -> Form -> button(__('Submit'), array('class' => 'btn btn-primary')); ?>
					<button class="btn btn-default"><?php echo $this -> Html -> link(__('キャンセル'), '/'.$this->params['controller'], array('class' => "")); ?></button>
				<?php echo $this -> Form -> end(); ?>
			</div>
		</div>
	</div>
</div>