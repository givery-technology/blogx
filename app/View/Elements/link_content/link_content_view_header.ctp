<?php 
	$headers = explode(',', $linkContent['LinkContent']['header']);
?>
<div class="row">
	<div class="col-lg-6">
		<div class="box">
			<div class="box-header">
				<h2>
					<?php echo __(configure::read('LinkContent.view_header')); ?>
				</h2>
			</div>
			<div class="box-content">
				<?php echo $this -> Session -> flash(); ?>
<!-- table -->
				<table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
					<thead>
						<tr role="row">
							<th colspan="" class="tbl10">
								<?php echo $linkContent['Link']['keyword']; ?>
								<?php echo $linkContent['Link']['url']; ?>
							</th>
						</tr>
					</thead>
					<tbody>
<!-- data -->
					<?php foreach($headers as $key => $header ): ?>
						<tr>
							<td class=""><?php echo h($header); ?>&nbsp;</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div><!-- end box content -->
		</div>
	</div>
</div>

<?php #debug($linkContent) ?>
<?php #debug(explode(',', $linkContent['LinkContent']['a_tag'])) ?>
<?php #debug(explode(',', $linkContent['LinkContent']['header'])) ?>