<div class="row">
	<div class="col-lg-12 col-md-12">
	    <div class="box">
			<div class="box-header">
	            <h2><?php echo __(ucfirst($this->params['controller']).' List'); ?></h2>
		    </div>
		    <div class="box-content">
				<?php echo $this->Session->flash(); ?>
<!-- Search-->
				<!-- <?php echo $this->Form->create('Arbitrary',array('class'=>'form-search')); ?>
				<div class="input-append">
					<?php echo $this->Form->input('keyword',array('label'=>FALSE,'class'=>'span3 search-query', 'type'=>'text','div'=>FALSE)); ?>
					<?php echo $this->Form->button(__('Search'), array('class'=>'btn')); ?>
				</div>
				<?php echo $this->Form->end(); ?> -->
				<p>
					<?php echo $this->Html->link(__('Add ' .ucfirst(substr($this->params['controller'],-3) == 'ies' ? substr($this->params['controller'], 0, -3) .'y' : substr($this->params['controller'], 0, -1))), array('action' => 'add'), array('class' => "btn btn-warning")); ?>
				</p>
				<table class="table table-striped table-bordered bootstrap-datatable datatable">
		            <tr>
		                <th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('prefix'); ?></th>
						<th><?php echo $this->Paginator->sort('suffix'); ?></th>
						<!-- <th><?php echo $this->Paginator->sort('created'); ?></th> -->
						<!-- <th><?php echo $this->Paginator->sort('update'); ?></th> -->
						<th class="actions"><?php echo __('Actions'); ?></th>
		            </tr>
		            <?php foreach ($arbitraries as $arbitrary): ?>
					<tr>
						<td><?php echo h($arbitrary['Arbitrary']['id']); ?>&nbsp;</td>
						<td><?php echo h($arbitrary['Arbitrary']['prefix']); ?>&nbsp;</td>
						<td><?php echo h($arbitrary['Arbitrary']['suffix']); ?>&nbsp;</td>
						<!-- <td><?php echo h($arbitrary['Arbitrary']['created']); ?>&nbsp;</td> -->
						<!-- <td><?php echo h($arbitrary['Arbitrary']['update']); ?>&nbsp;</td> -->
						<td class="actions">
							<?php echo $this->Html->link('', array('action' => 'edit', $arbitrary['Arbitrary']['id']), array('class' => 'btn btn-info icon-edit')); ?>
							<?php echo $this->Form->postLink('', array('action' => 'delete', $arbitrary['Arbitrary']['id']), array('class' => 'btn btn-danger icon-trash'), __('【%s】を削除しますか？', $arbitrary['Arbitrary']['id'])); ?>
						</td>
					</tr>
					<?php endforeach; ?>
		        </table>
		    </div>
		</div>
	</div>
</div>