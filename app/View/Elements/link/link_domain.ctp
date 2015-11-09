<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="box">
			<div class="box-header">
				<h2>
					<?php echo __(ucfirst($this->params['controller']).' List'); ?>
					<?php echo !isset($search) ? $this->Paginator->counter(array('format' => __('{:count}'))) : count($links);?>
				</h2>
			</div>
			<div class="box-content">
				<?php echo $this->Session->flash(); ?>
<!-- table -->
				<table class="table table-striped table-bordered bootstrap-datatable datatable">
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('keyword'); ?></th>
						<th><?php echo $this->Paginator->sort('url'); ?></th>
						<th><?php echo $this->Paginator->sort('type'); ?></th>
						<th><?php echo $this->Paginator->sort('updated'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
					<?php foreach ($links as $link): ?>
					<tr>
						<td><?php echo h($link['Link']['id']); ?>&nbsp;</td>
						<td>
							<?php echo h($link['Link']['keyword']); ?><br />
						</td>
						<td>
							<i><?php echo $this->Html->link(h($this->Text->truncate(urldecode($link['Link']['url']), 50)),h($link['Link']['url']),array('target'=>'_blank')); ?></i>
						</td>
						<td>
							<?php echo $this->Url->linkType($link['Link']['type']); ?>&nbsp;
						</td>
						<td><?php echo date('Y-m-d H:i:s',strtotime($link['Link']['updated'])); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('', array('action' => 'edit', $link['Link']['id']), array('class' => 'btn btn-primary icon-edit')); ?>
							<?php echo $this->Html->link('', array('action' => 'get_content', $link['Link']['id']), array('class' => 'btn btn-success icon-refresh')); ?>
							<?php echo $this->Form->postLink('', array('action' => 'delete', $link['Link']['id']), array('class' => 'btn btn-danger icon-trash'), __('【%s】を削除しますか？', $link['Link']['id'])); ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
<!-- paging -->
				<div class="row">
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
				</div><!-- end row paging -->
			</div>
		</div>
	</div>
</div>