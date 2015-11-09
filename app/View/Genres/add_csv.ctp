<div class="row">	
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header" data-original-title="">
				<h2><i class="icon-edit"></i><span class="break"></span><?php  echo __(ucfirst($this -> params['action']) . ' ' . ucfirst(substr($this -> params['controller'], 0, -1))); ?></h2>
			</div>
			<div class="box-content">
				<?php #echo $this->Form->create(ucfirst(substr($this->params['controller'],-3) == 'ies' ? substr($this->params['controller'], 0, -3).'y' : substr($this->params['controller'], 0, -1))); ?>
				<?php echo $this -> Form -> create('Genre', array('type' => 'file')); ?>
<!-- csv -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo __('Csv'); ?></label>
						<!-- <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span> -->
						<div class="row">
							<div class=" col-sm-4">
								<?php echo $this -> Form -> input('csv', array('label' => FALSE, 'class' => 'form-control', 'type' => 'file')); ?>
							</div>
							<!-- <span class="help-block col-sm-8">ex. </span> -->
						</div>
					</div>
					
					<?php echo $this -> Form -> button(__('Submit'), array('class' => 'btn btn-primary')); ?>
					<button class="btn btn-default"><?php echo $this -> Html -> link(__('Back'), $this->Layout->get_referer(@$_SERVER['HTTP_REFERER']), array('class' => "")); ?></button>
				<?php echo $this -> Form -> end(); ?>
			</div>
		</div>
	</div>
</div>