<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header" data-original-title="">
<!-- Add Post -->
				<h2><i class="icon-edit"></i><span class="break"></span><?php  echo __(ucfirst($this->params['action']) .' ' .ucfirst(substr($this->params['controller'], 0, -1)));?></h2>
			</div>
			<div class="box-content">
				<?php echo $this->Session->flash(); ?>				
				<?php echo $this->Form->create(ucfirst(substr($this->params['controller'], 0, -1))); ?>
<!-- csv upload -->
				<p class="align-right">
					<?php #echo $this->Html->link(__('Upload Csv'), array('action' => 'add_csv'), array('class' => "btn btn-danger")); ?>
					<a href="<?php echo Router::url(array('action'=>'add_csv')) ?>" class="btn btn-danger"><i class="icon-upload"></i></a>
				</p>
<!-- Multi Add -->
				<p>
					<a href="javascript:void(0)" class="addpost btn btn-warning" style="padding-right: 10px;color:#fff"><?php echo __('Add More Post'); ?></a>
					<a href="javascript:void(0)" class="addpostcontent btn btn-success" style="padding-right: 10px;color:#fff"><?php echo __('Add More Content'); ?></a>
				</p>
<!-- post form -->
				<?php echo $this->element('post/post_form'); ?>