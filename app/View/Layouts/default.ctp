<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja">
<head>
	<?php echo $this->Html->charset(); ?>
	<link href='http://fonts.googleapis.com/css?family=Cinzel+Decorative:700' rel='stylesheet' type='text/css'>
	<title><?php echo $this->fetch('title') .' | ' .Configure::read('SYSTEM_NAME'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo $this->Html->meta('icon'); ?>
	<?php echo $this->fetch('meta'); ?>
	
	<script type="text/javascript">var base_url = '<?php echo $this->webroot ?>';</script>
<!--css -->
	<?php echo $this->Html->css(array('bootstrap', 'style','font-awesome.min','font-awesome-ie7.min','chosen')); ?>
<!--js -->
	<?php 
		echo $this->Html->script(array(
			'jquery-1.10.2.min','bootstrap',
			// mouse over
			'jquery-ui-1.10.3.custom.min','bootstrap-tooltip','bootstrap-popover'
		)); 
	?>
<!--include lib -->
	<!-- jQuery-Tags-Input -->
	<?php echo $this->Html->script(array('jquery.tagsinput')); ?>
	<?php echo $this->Html->css(array('jquery.tagsinput')); ?>
	<!-- flot -->
	<?php echo $this->Html->script(array('flot.min','flot.resize')); ?>
	<!-- option change -->
	<?php echo $this->Html->script(array('jquery.chosen.min')); ?>
	<?php
		#echo $this->Html->css(array('viewsource/shCoreDefault'));
		#echo $this->Html->script(array('viewsource/shCore','viewsource/shBrushXml'));
	?>
<!-- fetch css & js from view -->
	<?php echo $this->fetch('css'); ?>
	<?php echo $this->fetch('script'); ?>
	
</head>
<body class="" id="">
<!--header -->
	<?php echo ($this->Session->read('Auth.User.user') && $this->here!=$this->webroot.'users/login') ? $this->element('header'):''; ?>
	<div class="container">
		<div class="row">
<!--nav -->
			<?php
				if($this->Session->read('Auth.User.user') && $this->here!=$this->webroot.'users/login') {
					echo $this->element('navigation');
				}
			?>
<!--content -->
			<?php echo ($this->here!=$this->webroot.'users/login') ? '<div id="content" class="col-lg-10 col-sm-11">':''; ?>
				<?php echo $this->fetch('content'); ?>
			<?php echo ($this->here!=$this->webroot.'users/login') ? '</div>':''; ?>
		</div>
	</div>
<!--footer-->
	<?php echo ($this->here!=$this->webroot.'users/login') ? $this->element('footer'):''; ?>
<!-- script -->
<?php echo $this->Html->script(array('script')); ?>
</body>
<span class="debug"><?php echo $this->element('sql_dump'); ?></span> 
</html>