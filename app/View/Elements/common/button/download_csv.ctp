<!-- download -->
<a 
	href="<?php echo Router::url(array('action' => 'download_csv',isset($id)?$id:'', isset($date)?$date:'')); ?>" 
	class="btn-sm btn-success">
	<!-- <i class="glyphicon glyphicon-download-alt"></i> -->
	<i class="icon-download-alt"></i>
</a>