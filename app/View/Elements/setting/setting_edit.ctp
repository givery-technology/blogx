<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header" data-original-title="">
<!-- Add menu -->
				<h2><i class="icon-edit"></i><span class="break"></span><?php  echo __(ucfirst($this->params['action']) .' ' .ucfirst(substr($this->params['controller'], 0, -1)));?></h2>
			</div>
			<div class="box-content">
				<?php echo $this->Session->flash(); ?>				
				<?php echo $this->Form->create(ucfirst(substr($this->params['controller'], 0, -1))); ?>				
<!-- menu form -->
				<?php echo $this->element('setting/setting_form'); ?>