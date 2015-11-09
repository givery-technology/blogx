<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="box">
			<div class="box-header">
				<h2>
					<?php echo __(ucfirst($this->params['controller']).' List'); ?>
					<?php echo !isset($search) ? $this->Paginator->counter(array('format' => __('{:count}'))) : count($plogs);?>
				</h2>
			</div>
			<div class="box-content">
				<?php echo $this->Session->flash(); ?>
<!-- search form -->
				<p>
					<?php echo $this->Form->postLink('CSV Download', array('action' => 'download_csv_page'), array('class' => 'btn btn-success align-right','data'=>Hash::extract($plogs,'{n}.Plog.id')), __('Do you want download csv?')); ?>
					
					<?php echo $this->Form->create('Plog',array('class'=>'form-search')); ?>
						<?php echo $this->Form->input('keyword',array('label'=>FALSE,'class'=>'span3 search-query', 'type'=>'text','div'=>FALSE)); ?>
						<?php echo $this->Form->button(__(''), array('class'=>'btn btn-info icon-search')); ?>
						<?php echo $this->Html->link('', array('controller' => $this->params['controller'], isset($this->params['pass'][0])?$this->params['pass'][0]:''), array('class' => 'btn icon-refresh')); ?>
					<?php echo $this->Form->end(); ?>
				</p>
<!-- table -->
				<table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
					<tr>
						<th class="tbl0"><?php echo __('Id'); ?></th>
						<th class="tbl3"><?php echo __('Title'); ?></th>
						<th class="tbl5"><?php echo __('UserAgent'); ?></th>
						<th class="tbl2"><?php echo __('Referral'); ?></th>
						<th class="tbl1"><?php echo __('Ip'); ?></th>
						<th class="tbl2"><?php echo __('Created'); ?></th>
						<!-- <th class="actions"><?php #echo __('Actions'); ?></th> -->
					</tr>
					<?php foreach ($plogs as $plog): ?>
					<tr>
						<td><?php echo h($plog['Plog']['id']); ?>&nbsp;</td>
						<td><?php echo h($plog['Post']['title']); ?>&nbsp;</td>
						<td><?php echo h($plog['Plog']['useragent']); ?>&nbsp;</td>
						<td><?php echo $this->Html->link($this->Text->truncate($plog['Plog']['referral'], configure::read('PLOG_URL_LENGTH')), $plog['Plog']['referral'], array('target' => '_blank')); ?>&nbsp;</td>
						<td><?php echo h($plog['Plog']['ip']); ?>&nbsp;</td>
						<td><?php echo date('Y-m-d H:i:s',strtotime($plog['Plog']['created'])); ?>&nbsp;</td>
						<!-- td class="actions">
							<?php #echo $this->Form->postLink('', array('action' => 'delete', $plog['Plog']['id']), array('class' => 'btn btn-danger icon-trash'), __('【%s】を削除しますか？', $plog['Plog']['id'])); ?>
						</td> -->
					</tr>
					<?php endforeach; ?>
				</table>
<!-- paging -->
				<div class="row">
					<?php if(!isset($search)): ?>
						<div class="col-lg-12 center">
							<span class="label label-info">
								<?php
								echo $this->Paginator->counter(array(
									'format' => __('全{:pages}ページ')
								));
								?>
							</span>
							<div class="dataTables_paginate paging_bootstrap">
								<ul class="pagination">
									<li><?php echo $this->Paginator->prev('← ' . __('previous'), array(), null, array('class' => 'prev disabled')); ?></li>
									<li><?php echo $this->Paginator->numbers(array('separator' => '')); ?></li>
									<li><?php echo $this->Paginator->next(__('next') . ' →', array(), null, array('class' => 'next disabled')); ?></li>
								</ul>
							</div>
						</div>
					<?php endif ?> 
				</div><!-- end row paging -->
			</div>
		</div>
	</div>
</div>