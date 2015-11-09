<div class="row">
	<div class="col-lg-12 col-md-12">
	    <div class="box">
			<div class="box-header">
	            <h2>
	            	<?php echo __(ucfirst($this -> params['controller']) . ' List'); ?>
	            	<?php echo !isset($search) ? $this -> Paginator -> counter(array('format' => __('{:count}'))) : count($designs); ?>
	            </h2>
		    </div>
		    <div class="box-content">
				<?php echo $this -> Session -> flash(); ?>
				<p class="align-right">
					<?php #echo $this -> Html -> link(__('Add ' . ucfirst(substr($this -> params['controller'], -3) == 'ies' ? substr($this -> params['controller'], 0, -3) . 'y' : substr($this -> params['controller'], 0, -1))), array('action' => 'add'), array('class' => "btn btn-warning")); ?>
					<a href="<?php echo Router::url(array('action'=>'add')) ?>" class="btn btn-warning"><i class="icon-plus-sign"></i></a>
				</p>
<!-- search form -->
				<p>
					<!-- <?php #echo $this -> Form -> create('Keyword', array('class' => 'form-search')); ?>
						<?php #echo $this -> Form -> input('keyword', array('label' => FALSE, 'class' => 'span3 search-query', 'type' => 'text', 'div' => FALSE)); ?>
						<?php #echo $this -> Form -> button(__(''), array('class' => 'btn btn-info icon-search')); ?>
						<?php #echo $this -> Html -> link('', array('controller' => $this -> params['controller']), array('class' => 'btn icon-refresh')); ?>
					<?php #echo $this -> Form -> end(); ?> -->
					<div class="form-group tbl6">
						<?php echo $this -> Form -> create('Keyword', array('class' => 'form-search')); ?>
							<?php echo $this -> Form -> input('keyword', array('label' => False, 'class' => 'form-control', 'type' => 'text', 'div' => False, 'required' => False)); ?>
						<?php echo $this -> Form -> end(); ?>
					</div>
				</p>
<!-- table -->				
				<table class="table table-striped table-bordered bootstrap-datatable datatable">
		            <tr>
		                <th><?php echo $this -> Paginator -> sort('id'); ?></th>
						<th><?php echo $this -> Paginator -> sort('name'); ?></th>
						<!-- <th><?php echo $this->Paginator->sort('design'); ?></th> -->
						<th><?php echo $this -> Paginator -> sort('params'); ?></th>
						<!-- <th><?php echo $this->Paginator->sort('created'); ?></th> -->
						<!-- <th><?php echo $this->Paginator->sort('updated'); ?></th> -->
						<th class="actions"><?php echo __('Actions'); ?></th>
		            </tr>
		            <?php foreach ($designs as $design): ?>
					<tr>
						<td><?php echo h($design['Design']['id']); ?>&nbsp;</td>
						<td><?php echo h($design['Design']['name']); ?>&nbsp;</td>
						<!-- <td><?php echo h($design['Design']['design']); ?>&nbsp;</td> -->
						<td><?php echo h($design['Design']['params']); ?>&nbsp;</td>
						<!-- <td><?php echo h($design['Design']['created']); ?>&nbsp;</td> -->
						<!-- <td><?php echo h($design['Design']['updated']); ?>&nbsp;</td> -->
						<td class="actions">
							<?php #echo $this->Html->link(__('View'), array('action' => 'view', $design['Design']['id'])); ?>
							<?php echo $this -> Html -> link('', array('action' => 'edit', $design['Design']['id']), array('class' => 'btn btn-info icon-edit')); ?>
							<!-- <?php echo $this->Form->postLink('', array('action' => 'delete', $design['Design']['id']), array('class' => 'btn btn-danger icon-trash'), __('【%s】を削除しますか？', $design['Design']['id'])); ?> -->
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
							echo $this -> Paginator -> counter(array('format' => __('全{:pages}ページ')));
                            ?>
                        </span>
                        <div class="dataTables_paginate paging_bootstrap">
                            <ul class="pagination">
                                <li><?php echo $this -> Paginator -> prev('← ' . __('previous'), array(), null, array('class' => 'prev disabled')); ?></li>
                                <li><?php echo $this -> Paginator -> numbers(array('separator' => '')); ?></li>
                                <li><?php echo $this -> Paginator -> next(__('next') . ' →', array(), null, array('class' => 'next disabled')); ?></li>
                            </ul>
                        </div>
                    <?php endif ?> 
                    </div>
                </div><!-- paging row -->		        
		    </div>
		</div>
	</div>
</div><!-- end row -->