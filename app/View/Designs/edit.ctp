<?php $this->assign('title', __(ucfirst($this->params['action']) .' ' .ucfirst(substr($this->params['controller'], 0, -1)))) ;?>
<?php echo $this->element(substr($this->params['controller'],-3) == 'ies' ? substr($this->params['controller'], 0, -3).'y' .'/'.substr($this->params['controller'], 0, -3).'y' .'_' .$this->params['action'] : substr($this->params['controller'], 0, -1) .'/' .substr($this->params['controller'], 0, -1) .'_' .$this->params['action']);?>