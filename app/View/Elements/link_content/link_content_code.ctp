<script type="text/javascript">SyntaxHighlighter.all();</script>
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header" data-original-title="">
				<h2><i class="icon-user"></i><span class="break"></span><?php  echo __('View Content Link:').' '.$linkContent['Link']['url'];?></h2>
			</div>
			<div class="box-content">
				
				<div class="view_link_content">
					<iframe src="<?php echo $linkContent['Link']['url'] ?>" border="0" width="100%" height="500"></iframe>
				</div>
			
				<div class="view_content_html">
					<pre class="brush: xml;html-script: false" style="display:none" id="viewcode">
						<?php echo $linkContent['LinkContent']['html_content'] ?>
					</pre>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(window).load(function(){
		$('#viewcode').show();
	})
</script>