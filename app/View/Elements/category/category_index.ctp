<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="box">
			<div class="box-header">
				<h2><?php echo __(ucfirst($this -> params['controller']) . ' List'); ?></h2>
			</div>
			<div class="box-content">
				<?php echo $this -> Session -> flash(); ?>
<!-- Search-->
				<p>
					<?php echo $this -> Html -> link(__('Add ' . ucfirst(substr($this -> params['controller'], -3) == 'ies' ? substr($this -> params['controller'], 0, -3) . 'y' : substr($this -> params['controller'], 0, -1))), array('action' => 'add'), array('class' => "btn btn-warning")); ?>
				</p>
				<table class="table table-striped table-bordered bootstrap-datatable datatable">
					<tr>
						<th><?php echo $this -> Paginator -> sort('id'); ?></th>
						<th><?php echo $this -> Paginator -> sort('code'); ?></th>
						<th><?php echo $this -> Paginator -> sort('name'); ?></th>
						<th><?php echo $this -> Paginator -> sort('memo'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
					<?php foreach ($categories as $category): ?>
					<tr>
						<td><?php echo h($category['Category']['id']); ?>&nbsp;</td>
						<td><?php echo h($category['Category']['code']); ?>&nbsp;</td>
						<td><?php echo h($category['Category']['name']); ?>&nbsp;</td>
						<td><?php echo h($this -> Text -> truncate($category['Category']['memo']), 50); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this -> Html -> link('', array('action' => 'edit', $category['Category']['id']), array('class' => 'btn btn-info icon-edit')); ?>
							<?php #echo $this->Form->postLink('', array('action' => 'delete', $category['Category']['id']), array('class' => 'btn btn-danger icon-trash'), __('【%s】を削除しますか？', $category['Category']['name'])); ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
</div>