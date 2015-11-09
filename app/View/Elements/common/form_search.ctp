<?php echo $this -> Form -> create('Keyword', array('class' => '')); ?>
<div class="controls tbl6">
	<div class="input-group">
		<?php echo $this -> Form -> input('keyword', array('label' => False, 'class' => 'form-control', 'type' => 'text', 'div' => False)); ?>
		<span class="input-group-btn"><button class="btn" type="submit"><i class="icon-search"></i>検索</button></span>
		<?php #echo $this -> Html -> link('', array('controller' => $this -> params['controller']), array('class' => 'btn icon-refresh')); ?>
	</div>
</div>
<?php echo $this -> Form -> end(); ?>