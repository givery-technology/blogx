<div class="row">
    <?php echo $this -> Session -> flash(); ?>
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
				<h2><i class="icon-edit"></i><span class="break"></span><?php  echo __(ucfirst($this -> params['action']) . ' ' . ucfirst(substr($this -> params['controller'], 0, -1))); ?></h2>
			</div>
			<div class="box-content">
				<?php echo $this -> Form -> create('Image', array('class' => 'form-horizontal', 'type' => 'file')); ?>
					<?php echo $this -> Form -> input('id'); ?>
					<fieldset class="col-sm-12">
<!-- image upload -->
						<div class="form-group">
							<label class="control-label" for="date"><?php echo $this -> Html -> tag('span', __('Image')); ?></label>
							<?php if($this->Form->value('Image.name')!=''){ ?>
								<div class="">
									<?php echo $this -> Html -> image('/uploads/image/' . $this -> Form -> value('Image.name'), array('class' => 'img-thumbnail')); ?>
								</div>
							<?php } ?>
							<div class="controls row">
								<div class="input-group col-sm-4">
									<span class="input-group-addon"><i class="icon-cloud-upload"></i></span>
									<?php echo $this -> Form -> input('name', array('type' => 'file', 'label' => FALSE, 'class' => 'form-control')); ?>
								</div>
								<span class="col-sm-8 text-warning">
									<strong><?php echo __('※画像の最大量は2MBになります') ?></strong>
								</span>
							</div>
						</div>
<!-- form button -->
						<div class="form-actions">
							<?php echo $this -> Form -> button(__('Submit'), array('class' => 'btn btn-primary')); ?>
							<button class="btn btn-default"><?php echo $this -> Html -> link(__('キャンセル'), '/' . $this -> params['controller'], array('class' => "")); ?></button>
						</div>
					</fieldset>
					<?php echo $this -> Form -> end(); ?>
			</div>
		</div>
	</div><!--/col-->
</div><!--/row-->