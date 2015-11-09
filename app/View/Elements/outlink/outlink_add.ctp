<div class="row">	
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header" data-original-title="">
				<h2><i class="icon-edit"></i><span class="break"></span><?php  echo __(ucfirst($this -> params['action']) . ' ' . ucfirst(substr($this -> params['controller'], 0, -1))); ?></h2>
			</div>
			<div class="box-content">
				<?php #echo $this->Form->create(ucfirst(substr($this->params['controller'],-3) == 'ies' ? substr($this->params['controller'], 0, -3).'y' : substr($this->params['controller'], 0, -1))); ?>
				<?php echo $this -> Form -> create('Outlink'); ?>
				<?php echo $this -> Form -> input('id'); ?>
<!-- site name -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo __('Site Name'); ?></label>
						<span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
						<div class="controls row">
							<div class="input-group col-sm-4">
								<span class="input-group-addon"><i class="icon-chevron-left"></i></span>
								<?php echo $this -> Form -> input('name', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
							</div>
							<span class="help-block col-sm-8">ex. ヤフージャパン</span>
						</div>
					</div>
<!-- url -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo $this -> Html -> tag('span', __('Url')); ?></label>
						<span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
						<div class="controls row">
							<div class="input-group col-sm-4">
								<span class="input-group-addon"><i class="icon-chevron-right"></i></span>
								<?php echo $this -> Form -> input('url', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
							</div>
							<span class="help-block col-sm-8">ex. http://www.yahoo.co.jp</span>
						</div>
					</div>
					<?php echo $this -> Form -> button(__('Submit'), array('class' => 'btn btn-primary')); ?>
					<button class="btn btn-default"><?php echo $this->Html->link(__('キャンセル'), '/'.$this->params['controller'], array('class' => "")); ?></button>
				<?php echo $this -> Form -> end(); ?>
			</div>
		</div>
	</div>
</div>