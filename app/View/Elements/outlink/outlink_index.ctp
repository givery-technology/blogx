<div class="row">
	<div class="col-lg-12 col-md-12">
	    <div class="box">
			<div class="box-header">
	            <h2>
	            	<?php echo __(ucfirst($this->params['controller']).' List'); ?>
	            	<?php echo !isset($search) ? $this->Paginator->counter(array('format' => __('{:count}'))) : count($outlinks);?>
	            </h2>
		    </div>
		    <div class="box-content">
		    	<?php echo $this->Session->flash(); ?>
<!-- Search-->
				<!-- <?php echo $this->Form->create('',array('class'=>'form-search')); ?>
				<div class="input-append">
					<?php echo $this->Form->input('keyword',array('label'=>FALSE,'class'=>'span3 search-query', 'type'=>'text','div'=>FALSE)); ?>
					<?php echo $this->Form->button(__('Search'), array('class'=>'btn')); ?>
				</div>
				<?php echo $this->Form->end(); ?> -->
<!-- csv -->
				<p class="align-right">
					<?php #echo $this->Html->link(__('Download Csv'), array('action' => 'download_csv'), array('class' => "btn btn-success")); ?>
					<?php #echo $this->Html->link(__('Upload Csv'), array('action' => 'add_csv'), array('class' => "btn btn-danger")); ?>
				</p>
<!-- add one -->
				<p>
					<?php echo $this->Html->link(__('Add ' .ucfirst(substr($this->params['controller'],-3) == 'ies' ? substr($this->params['controller'], 0, -3) .'y' : substr($this->params['controller'], 0, -1))), array('action' => 'add'), array('class' => "btn btn-warning")); ?>
				</p>
				<table class="table table-striped table-bordered bootstrap-datatable datatable">
		            <tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('name'); ?></th>
						<th><?php echo $this->Paginator->sort('url'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
		            </tr>
		            <?php foreach ($outlinks as $outlink): ?>
					<tr>
						<td><?php echo h($outlink['Outlink']['id']); ?>&nbsp;</td>
						<td><?php echo h($outlink['Outlink']['name']); ?>&nbsp;</td>
						<td><?php echo h($outlink['Outlink']['url']); ?>&nbsp;</td>
						<td><?php echo h($outlink['Outlink']['created']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link(__(''), array('action' => 'edit', $outlink['Outlink']['id']), array('class' => 'btn btn-info icon-edit')); ?>
							<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $outlink['Outlink']['id']), array('class' => 'btn btn-danger icon-trash'), __('Are you sure you want to delete # %s?', $outlink['Outlink']['id'])); ?>
							<?php #echo $this->Html->link(__(''), array('action' => 'view', $outlink['Outlink']['id']), array('class' => 'btn btn-success icon-eye-open')); ?>
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
                    <?php endif ?> 
                    </div>
                </div>			        
		    </div>
		</div>
	</div>
</div>