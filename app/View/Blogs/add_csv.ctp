<?php $this->assign('title', __(ucfirst($this->params['action']) .' ' .ucfirst(substr($this->params['controller'], 0, -1)))) ;?>
<?php #echo $this->element(substr($this->params['controller'], 0, -1) .'/' .substr($this->params['controller'], 0, -1) .'_' .$this->params['action']) ?>
<?php echo $this->element('common/form_csv'); ?>