<div class="row">	
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header" data-original-title="">
				<h2><i class="icon-edit"></i><span class="break"></span><?php  echo __(ucfirst($this->params['action']) .' ' .ucfirst(substr($this->params['controller'], 0, -1)));?></h2>
			</div>
			<div class="box-content">
				<?php #echo $this->Form->create(ucfirst(substr($this->params['controller'],-3) == 'ies' ? substr($this->params['controller'], 0, -3).'y' : substr($this->params['controller'], 0, -1))); ?>
				<?php echo $this->Form->create('KoteiList'); ?>
<!-- kotei list form -->
<?php echo $this->Element('kotei_list/kotei_list_form'); ?>