<!-- view include template -->
<!-- 
<?php $this->assign('title', __(ucfirst($this->params['action']) .' ' .ucfirst(substr($this->params['controller'], 0, -1)))) ;?>
<?php echo $this->element(substr($this->params['controller'], 0, -1) .'/' .substr($this->params['controller'], 0, -1) .'_' .$this->params['action']) ?> 
-->

<!-- check plural ies in controller  -->
<!--
<?php $this->assign('title', __(ucfirst($this->params['action']) .' ' .ucfirst(substr($this->params['controller'], 0, -1)))) ;?>
<?php echo $this->element(substr($this->params['controller'],-3) == 'ies' ? substr($this->params['controller'], 0, -3).'y' .'/'.substr($this->params['controller'], 0, -3).'y' .'_' .$this->params['action'] : substr($this->params['controller'], 0, -1) .'/' .substr($this->params['controller'], 0, -1) .'_' .$this->params['action']);?>
-->

<!-- index template -->
<div class="row">
	<div class="col-lg-12 col-md-12">
	    <div class="box">
			<div class="box-header">
	            <h2><?php echo __(ucfirst($this->params['controller']).' List'); ?></h2>
		    </div>
		    <div class="box-content">
				<?php echo $this->Session->flash(); ?>
<!-- search -->
				<?php echo $this->Form->create('',array('class'=>'form-search')); ?>
				<div class="input-append">
					<?php echo $this->Form->input('keyword',array('label'=>FALSE,'class'=>'span3 search-query', 'type'=>'text','div'=>FALSE)); ?>
					<?php echo $this->Form->button(__('Search'), array('class'=>'btn')); ?>
				</div>
				<?php echo $this->Form->end(); ?>
<!-- proccess button-->
				<h2><i class="fa fa-list"></i>Buttons</h2>
				<p>
					<button class="btn btn-large">Large button</button>
					<button class="btn btn-large btn-primary">Large button</button>
					<button class="btn btn-large btn-danger">Large button</button>
					<button class="btn btn-large btn-warning">Large button</button>
					<button class="btn btn-large btn-success">Large button</button>
					<button class="btn btn-large btn-info">Large button</button>
					<button class="btn btn-large btn-inverse">Large button</button>
				</p>
<!-- button with controller name no s -->				
				<p>
					<?php echo $this->Html->link(__('Add ' .ucfirst(substr($this->params['controller'], 0, -1))), array('action' => 'add'), array('class' => "btn btn-warning")); ?>
				</p>
<!-- table -->
				<!-- <table class="table"> -->
				<table class="table table-striped table-bordered bootstrap-datatable datatable">
		            <tr>
		                <th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('cat'); ?></th>
						<th><?php echo $this->Paginator->sort('name'); ?></th>
						<th><?php echo $this->Paginator->sort('design'); ?></th>
						<th><?php echo $this->Paginator->sort('params'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('updated'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
		            </tr>
<!-- foreach -->
		            <?php foreach ($blogs as $blog): ?>
					<tr>
						<td><?php echo h($blog['Blog']['id']); ?>&nbsp;</td>
						<td>
							<?php echo $this->Html->link($blog['Category']['name'], array('controller' => 'categories', 'action' => 'view', $blog['Category']['id'])); ?>
						</td>
						<td>
							<?php echo $this->Html->link($blog['Design']['name'], array('controller' => 'designs', 'action' => 'view', $blog['Design']['id'])); ?>
						</td>
						<td><?php echo h($blog['Blog']['name']); ?>&nbsp;</td>
						<td><?php echo h($blog['Blog']['title']); ?>&nbsp;</td>
						<td><?php echo h($blog['Blog']['description']); ?>&nbsp;</td>
						<td><?php echo h($blog['Blog']['ip']); ?>&nbsp;</td>
						<!-- <td><?php echo h($blog['Blog']['created']); ?>&nbsp;</td> -->
						<!-- <td><?php echo h($blog['Blog']['updated']); ?>&nbsp;</td> -->
<!-- actions -->
						<td class="actions">
							<!-- <?php echo $this->Html->link(__('View'), array('action' => 'view', $blog['Blog']['id'])); ?> -->
<!-- open domain for view blog -->
							<?php echo $this->Html->link(__(''), $blog['Blog']['domain'], array('class' => 'btn btn-success icon-eye-open', 'target'=>'_blank')); ?>
							<?php echo $this->Html->link('', array('action' => 'edit', $blog['Blog']['id']), array('class' => 'btn btn-info icon-edit')); ?>
							<?php echo $this->Form->postLink('', array('action' => 'delete', $blog['Blog']['id']), array('class' => 'btn btn-danger icon-trash'), __('【%s】を削除しますか？', $blog['Blog']['id'])); ?>
							
<!-- view edit delete with boostrap icon -->
							<!-- <?php echo $this->Html->link(__(''), array('action' => 'view', $blog['Blog']['id']), array('class' => 'btn btn-success icon-eye-open')); ?> -->
							<!-- <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $blog['Blog']['id'])); ?> -->
							<!-- <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $blog['Blog']['id']), null, __('Are you sure you want to delete # %s?', $blog['Blog']['id'])); ?> -->
							
						</td>
					</tr>
					<?php endforeach; ?>
		        </table>
		    </div>
		</div>
	</div>
</div>
<!-- Cake default pagination -->
	<!-- <p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>


<!-- blog add template -->
<div class="row">	
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header" data-original-title="">
				<h2><i class="icon-user"></i><span class="break"></span><?php  echo __(ucfirst($this->params['action']) .' ' .ucfirst(substr($this->params['controller'], 0, -1)));?></h2>
			</div>
			<div class="box-content">
				<?php echo $this->Form->create(ucfirst(substr($this->params['controller'], 0, -1))); ?>
<!-- blog name -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Blog Name'); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon"><i class="icon-pencil"></i></span>
						  <?php echo $this->Form->input('name', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					  </div>
					</div>				
<!-- blog category -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Category'); ?></label>
					  <!-- <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span> -->
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon"><i class="icon-briefcase"></i></span>
						  <?php echo $this->Form->input('category_id', array('label' => FALSE, 'class' => 'form-control', 'type' => 'select')); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					  </div>
					</div>
<!-- blog design -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo __('Design'); ?></label>
					  <!-- <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span> -->
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon"><i class="icon-picture"></i></span>
						  <?php echo $this->Form->input('design_id', array('label' => FALSE, 'class' => 'form-control', 'type' => 'select')); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
					  </div>
					</div>
<!-- blog title -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo $this->Html->tag('span', __('Title')); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon"><i class="icon-th-large"></i></span>
						  <?php echo $this->Form->input('title', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
						<span class="help-block">me. 最大69文字</span>
					  </div>
					</div>
<!-- description -->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo $this->Html->tag('span', __('Description')); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon"><i class="icon-th"></i></span>
						  <?php echo $this->Form->input('description', array('label' => FALSE, 'class' => 'form-control', 'type' => 'textarea')); ?>
						</div>
						<!-- <span class="help-block col-sm-8">ex. </span> -->
						<span class="help-block">me. 最大156文字</span>
					  </div>
					</div>
<!-- ip	-->
					<div class="form-group">
					  <label class="control-label" for="date"><?php echo $this->Html->tag('span', __('IP')); ?></label>
					  <span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
					  <div class="controls row">
						<div class="input-group col-sm-5">
						  <span class="input-group-addon"><i class="icon-globe"></i>
						  </span>
						  <?php echo $this->Form->input('ip', array('label' => FALSE, 'class' => 'form-control', 'type' => 'text')); ?>
						</div>
						<span class="help-block">ex. <?php echo $_SERVER['REMOTE_ADDR']; ?></span>
					  </div>
					</div>
<!-- api key -->
					<div class="form-group">
						<label class="control-label" for="date"><?php echo $this->Html->tag('span', __('API Key')); ?></label>
						<span class="text-danger"><strong><?php echo __('※必須') ?></strong></span>
						<div class="controls row">
							<div class="input-group col-sm-5">
								<span class="input-group-addon"><i class="icon-certificate"></i></span>
								<?php echo $this->Form->input('key', array('label' => FALSE, 'class' => 'form-control', 'div' => false, 'value'=>String::uuid(), 'readonly'=>'readonly'));?>
							</div>
							<!-- <span class="help-block col-sm-8">ex. <?php echo $_SERVER['REMOTE_ADDR']; ?></span> -->
							<span class="help-block getKey"><?php echo $this->Html->image('refresh.png',array('width'=>15,'style'=>'cursor: pointer;')); ?></span>
						</div>
					</div>
					<?php echo $this->Form->button(__('Submit'), array('class' => 'btn btn-primary')); ?>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>


<!-- Nav -->
<!-- start: Main Menu -->
<div id="sidebar-left" class="col-lg-2 col-sm-1">
	
	<input type="text" class="search hidden-sm" placeholder="..." />
	
	<div class="nav-collapse sidebar-nav collapse navbar-collapse bs-navbar-collapse">
		<ul class="nav nav-tabs nav-stacked main-menu">
			<li><a href="index.html"><i class="icon-bar-chart"></i><span class="hidden-sm"> Dashboard</span></a></li>	
			<li>
				<a class="dropmenu" href="table.html#"><i class="icon-eye-open"></i><span class="hidden-sm"> UI Features</span> <span class="label">3</span></a>
				<ul>
					<li><a class="submenu" href="ui-sliders-progress.html"><i class="icon-eye-open"></i><span class="hidden-sm"> Sliders & Progress</span></a></li>
					<li><a class="submenu" href="ui-nestable-list.html"><i class="icon-eye-open"></i><span class="hidden-sm"> Nestable Lists</span></a></li>
					<li><a class="submenu" href="ui-elements.html"><i class="icon-eye-open"></i><span class="hidden-sm"> Elements</span></a></li>
				</ul>
				</li>
			<li><a href="widgets.html"><i class="icon-dashboard"></i><span class="hidden-sm"> Widgets</span></a></li>
			<li>
				<a class="dropmenu" href="table.html#"><i class="icon-folder-close-alt"></i><span class="hidden-sm"> Example Pages</span> <span class="label">3</span></a>
				<ul>
					<li><a class="submenu" href="page-infrastructure.html"><i class="icon-hdd"></i><span class="hidden-sm"> Infrastructure</span></a></li>
					<li><a class="submenu" href="page-inbox.html"><i class="icon-envelope"></i><span class="hidden-sm"> Inbox</span></a></li>
					<li><a class="submenu" href="page-todo.html"><i class="icon-tasks"></i><span class="hidden-sm"> ToDo & Timeline</span></a></li>
					<!-- Profile Page - Cooming Soone
					<li><a class="submenu" href="page-profile.html"><i class="icon-male"></i><span class="hidden-sm"> User Profile</span></a></li>
					-->
				</ul>	
			</li>
			<li>
				<a class="dropmenu" href="table.html#"><i class="icon-edit"></i><span class="hidden-sm"> Forms</span> <span class="label">3</span></a>
				<ul>
					<li><a class="submenu" href="form-elements.html"><i class="icon-edit"></i><span class="hidden-sm"> Form elements</span></a></li>
					<li><a class="submenu" href="form-wizard.html"><i class="icon-edit"></i><span class="hidden-sm"> Wizard</span></a></li>
					<li><a class="submenu" href="form-dropzone.html"><i class="icon-edit"></i><span class="hidden-sm"> Dropzone Upload</span></a></li>
				</ul>
			</li>
			<li>
				<a class="dropmenu" href="table.html#"><i class="icon-list-alt"></i><span class="hidden-sm"> Charts</span> <span class="label">3</span></a>
				<ul>
					<li><a class="submenu" href="charts-flot.html"><i class="icon-list-alt"></i><span class="hidden-sm"> Flot Charts</span></a></li>
					<li><a class="submenu" href="charts-xcharts.html"><i class="icon-list-alt"></i><span class="hidden-sm"> xCharts</span></a></li>
					<li><a class="submenu" href="charts-others.html"><i class="icon-list-alt"></i><span class="hidden-sm"> Other</span></a></li>
				</ul>
			
			</li>
			<li><a href="typography.html"><i class="icon-font"></i><span class="hidden-sm"> Typography</span></a></li>
			<li><a href="gallery.html"><i class="icon-picture"></i><span class="hidden-sm"> Gallery</span></a></li>
			<li><a href="table.html"><i class="icon-align-justify"></i><span class="hidden-sm"> Tables</span></a></li>
			<li><a href="calendar.html"><i class="icon-calendar"></i><span class="hidden-sm"> Calendar</span></a></li>
			<li><a href="file-manager.html"><i class="icon-folder-open"></i><span class="hidden-sm"> File Manager</span></a></li>
			<li>
				<a class="dropmenu" href="table.html#"><i class="icon-star"></i><span class="hidden-sm"> Icons</span> <span class="label">3</span></a>
				<ul>
					<li><a class="submenu" href="icons-halflings.html"><i class="icon-star"></i><span class="hidden-sm"> Halflings</span></a></li>
					<li><a class="submenu" href="icons-glyphicons-pro.html"><i class="icon-star"></i><span class="hidden-sm"> Glyphicons PRO</span></a></li>
					<li><a class="submenu" href="icons-font-awesome.html"><i class="icon-star"></i><span class="hidden-sm"> Font Awesome</span></a></li>
				</ul>
			</li>
			<li><a href="login.html"><i class="icon-lock"></i><span class="hidden-sm"> Login Page</span></a></li>
		</ul>
	</div>
</div>
<!-- end: Main Menu -->
