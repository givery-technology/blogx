<div class="row">
	<?php if(!isset($search)): ?>
	<div class="col-lg-12 center">
		<span class="label label-info">
			<?php echo $this -> Paginator -> counter(array('format' => __('全{:pages}ページ'))); ?>
		</span>
		<div class="dataTables_paginate paging_bootstrap">
			<ul class="pagination">
				<li><?php echo $this -> Paginator -> prev('← ' . __('previous'), array(), null, array('class' => 'prev disabled')); ?></li>
				<li><?php echo $this -> Paginator -> numbers(array('separator' => '')); ?></li>
				<li><?php echo $this -> Paginator -> next(__('next') . ' →', array(), null, array('class' => 'next disabled')); ?></li>
			</ul>
		</div>
	</div>
	<?php endif ?>
</div>