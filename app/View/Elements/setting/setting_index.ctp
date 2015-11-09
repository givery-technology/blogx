<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="box">
			<div class="box-header">
				<h2>
					<?php echo __(ucfirst($this->params['controller']).' List'); ?> 
					<?php echo !isset($search) ? $this->Paginator->counter(array('format' => __('{:count}'))) : count($settings);?>
				</h2>
			</div>
			<div class="box-content">
				<?php echo $this->Session->flash(); ?>
<!-- search	-->
<!-- add setting -->
				<p>
					<?php echo $this->Html->link(__('Add ' .ucfirst(substr($this->params['controller'], 0, -1))), array('action' => 'add'), array('class' => "btn btn-warning")); ?>
				</p>
<!-- search form -->
				<?php echo $this->Form->create('Setting',array('class'=>'form-search')); ?>  
					<div class="input-append">
						<?php echo $this->Form->input('keyword',array('label'=>FALSE,'class'=>'span3 search-query', 'type'=>'text','div'=>FALSE)); ?>
						<?php echo $this->Form->button(__('Search'), array('class'=>'btn')); ?>
					</div>
				<?php echo $this->Form->end(); ?>
<!-- table -->
				<table class="table table-striped table-bordered bootstrap-datatable datatable">
					<tr>
						<th class="tbl0"><?php echo $this->Paginator->sort('id'); ?></th>
						<th class="tbl3"><?php echo $this->Paginator->sort('key'); ?></th>
						<th class="tbl5"><?php echo $this->Paginator->sort('value'); ?></th>
						<th class="tbl3"><?php echo $this->Paginator->sort('title'); ?></th>
						<!-- <th class="tbl3"><?php #echo $this->Paginator->sort('description'); ?></th> -->
						<th class="tbl1"><?php echo $this->Paginator->sort('input'); ?></th>
						<th class="tbl0"><?php echo $this->Paginator->sort('edittable'); ?></th>
						<th class="tbl2"><?php echo __('Actions'); ?></th>
					</tr>
					<?php foreach ($settings as $setting): ?>
					<tr>
<!-- id -->
						<td><?php echo h($setting['Setting']['id']); ?>&nbsp;</td>
<!-- key -->
						<td><?php echo $this->Text->truncate($setting['Setting']['key'], configure::read('SYSTEM_KEY_LENGTH')); ?>&nbsp;</td>
<!-- value -->
						<td><?php echo $setting['Setting']['value']; ?>&nbsp;</td>
<!-- title -->
						<td><?php echo $setting['Setting']['title']; ?>&nbsp;</td>
<!-- description -->
						<!-- <td><?php #echo $setting['Setting']['description']; ?>&nbsp;</td> -->
<!-- input_type -->
						<td><?php echo $setting['Setting']['input_type']; ?>&nbsp;</td>
<!-- edittable -->
						<td><?php echo $setting['Setting']['editable']; ?></td>
<!-- actions -->
						<td>
							<?php echo $this->Html->link(__(''), array('action' => 'edit', $setting['Setting']['id']), array('class' => 'btn btn-info icon-edit')); ?>
							<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $setting['Setting']['id']), array('class' => 'btn btn-danger icon-trash'), __('ã€%sã€‘ã‚’å‰Šé™¤ã—ã¾ã™ã‹ï¼Ÿ', $setting['Setting']['id'])); ?>
						</td>
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
</div><!-- end row -->