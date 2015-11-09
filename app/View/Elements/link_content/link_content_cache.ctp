<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<base href="<?php echo $linkContent['Link']['url']; ?>">
<script>
	function close_window() {close();}
</script>
<div style="background:#aaa;border:1px solid #999;margin:-1px -1px 0;padding:0;">
	<div style="
		background:#eee;
		border:1px solid #999;
		color:#000;
		font:16px tahoma;
		font-weight:normal;
		margin:10px;
		padding:20px;
		text-align:left
	">
		<div style="color:#000;font-size: 20px;font-style: strong">
			<?php echo __('BlogX Cache'); ?>
			<button><?php echo $this -> Html -> link(__('Close'), '#', array('class' => '', 'style' => 'color:#000', "onclick"=>"close_window();return false;")); ?></button>
		</div> 
		<?php echo __('Keyword') .': '.$linkContent['Link']['keyword']; ?>
		<br />
		<?php echo __('Url') .': '.$this->Html->link($linkContent['Link']['url'],$linkContent['Link']['url'], array('target' => '_blank', 'style' => 'text-decoration:underline;color:#00c;font-size:16px;')); ?>
		<br />
		<?php echo __('Crawled Datetime') .': ' .$this->Layout->jpn_datetime($linkContent['LinkContent']['updated']); ?>
		<br />
		<?php echo __('*The HTML page sometime can not be showed'); ?>
	</div>
</div>
<div style="position:relative">
<?php 
	$html_contents = explode("\r\n\r\n", $linkContent['LinkContent']['html_content']);
	$start = 0;
	foreach($html_contents as $html_content) :
		if($start > 0) {
		echo $html_content;
		}
		$start++;
	endforeach;
?>