<div class="row">
	<div class="col-lg-3 col-sm-6 col-xs-6 col-xxs-12">
		<div class="smallstat box">
			<div class="boxchart-overlay red">
				<div class="boxchart"><canvas width="64" height="30" style="display: inline-block; vertical-align: top; width: 64px; height: 30px;"></canvas></div>
			</div>	
			<span class="title"><?php echo __('Datetime'); ?></span>
			<span class="value">
				<?php
					if(count($this->params['data'])>0) {
						echo $this->params['data']['History']['date']['year'] .'-' .$this->params['data']['History']['date']['month'];
					} else {
						echo __('Total');
					}
				?>
			</span>
		</div>
	</div><!--/col-->
	
	<div class="col-lg-3 col-sm-6 col-xs-6 col-xxs-12">
		<div class="smallstat box">
			<div class="boxchart-overlay blue">
				<div class="boxchart"><canvas width="64" height="30" style="display: inline-block; vertical-align: top; width: 64px; height: 30px;"></canvas></div>
			</div>	
			<span class="title"><?php echo __('Anchor Keyword'); ?></span>
			<span class="value"><?php echo array_sum($count_posts) ?></span>
		</div>
	</div><!--/col-->
	
	<div class="col-lg-3 col-sm-6 col-xs-6 col-xxs-12">
		<div class="smallstat box">
			<div class="boxchart-overlay grey">
				<div class="boxchart"><canvas width="64" height="30" style="display: inline-block; vertical-align: top; width: 64px; height: 30px;"></canvas></div>
			</div>
			<span class="title"><?php echo __('Client Link'); ?></span>
			<span class="value"><?php echo count($keywords); ?></span>
		</div>
	</div><!--/col-->
	
	<div class="col-lg-3 col-sm-6 col-xs-6 col-xxs-12">
		<div class="smallstat box">
			<div class="boxchart-overlay yellow">
				<div class="boxchart"><canvas width="64" height="30" style="display: inline-block; vertical-align: top; width: 64px; height: 30px;"></canvas></div>
			</div>
			<span class="title"><?php echo __('Total'); ?></span>
			<span class="value"><?php echo $total_posts; ?></span>
		</div>
	</div><!--/col-->
	
</div>
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="box">
			<div class="box-header">
				<h2>
					<?php echo __('Backlink Report'); ?>
				</h2>
			</div>
			<div class="box-content">
				<?php echo $this -> Session -> flash(); ?>
<!-- row right menu --><!-- download csv -->
				<p class="align-right">
				</p>
<!-- row left menu -->
				<span class=""><?php echo $this->Element('common/form_history'); ?></span>
<!-- table -->
				<!-- <table class="table table-striped table-bordered bootstrap-datatable datatable"> -->
				<table class="table table-bordered table-striped table-condensed">
<!-- heading -->
					<tr>
						<th><?php echo __('Id'); ?></th>
						<th><?php echo $this -> Paginator -> sort('client url'); ?></th>
						<th><?php echo $this -> Paginator -> sort('keyword', __('Anchor Keyword')); ?></th>
						<?php if(isset($search)): ?>
							
						<?php else: ?>
							<th><?php echo __('Count Post'); ?></th>
						<?php endif; ?>
						<th><?php echo $this -> Paginator -> sort('created'); ?></th>
						<th class="tbl2"><?php echo __('Actions'); ?></th>
					</tr>
<!-- data -->
					<?php $count=0; foreach ($keywords as $keyword): $count++?>
					<tr>
						<!-- id -->
						<td><?php echo $count; ?></td>
						<!-- url -->
						<td><?php echo($keyword['Keyword']['url'] != '') ? $this -> Html -> link($this -> Text -> truncate($keyword['Keyword']['url'], 50), $keyword['Keyword']['url'], array('target' => '_blank')) : '<span class="no-data"></span>'; ?>&nbsp;</td>
						<td><?php echo $this -> Text -> truncate($keyword['Keyword']['keyword'], 30); ?>&nbsp;</td>
						<?php if(isset($search)): ?>
							
						<?php else: ?>
							<td><?php echo $keyword['Keyword']['count_post'] ?>&nbsp;</td>
						<?php endif; ?>
<!-- created -->
						<td><?php echo date('Y-m-d', strtotime($keyword['Keyword']['created'])); ?>&nbsp;</td>
						<td class="">
							<a href="<?php echo Router::url(array('action'=>'detail', $keyword['Keyword']['id'])) ?>" class="btn-success"><i class="icon-eye-open"></i></a>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
<!-- paging -->
				<!-- <?php #echo $this->Element('common/paging_search'); ?> -->
			</div>
		</div>
	</div>
</div><!-- end row -->

<script type="text/javascript">
	$(document).ready(function() {
		//
		// $('.open_all_post_link').click(function() {
			// var count = $('.link_open_tab').size();
			// for (var i = 0; i < count; i++) {
				// window.open($('.link_open_tab:eq(' + i + ')').attr('href'));
			// }
		// })
		//
		// $('.open_all_client_url').click(function() {
			// var count = $('.open_client_url').size();
			// for (var i = 0; i < count; i++) {
				// window.open($('.open_client_url:eq(' + i + ')').attr('href'));
			// }
		// })
	})
</script>

<!-- debug -->
<?php 
	// echo $this->Element('debug/ddnb');
?>