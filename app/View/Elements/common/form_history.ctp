<!-- history data -->
<?php echo $this->Form->create('History',array('class'=>'form-search','id'=>'RankhistoryViewForm_list')); ?>
	<div class="form-group">
		<!-- <label class="control-label" for="HistoryDateMonth"><span class="label label-default"><?php echo __('History data'); ?></span></label> -->
		<div class="controls row">
			<div class="input-group col-sm-4">
				<?php 
					echo $this->Form->input('date', array(
						'div' => False,
						'label' => False,
						'class'=>'input-sm',
						'type'=>'date',
						'dateFormat' => 'YM',
						'monthNames'=>Configure::read('monthNames'),
						'maxYear'=> date('Y'),
						'minYear'=> date('Y')-1
					));
					echo '&nbsp';
					echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-success icon-refresh', 'div' => False));
				?>
				<span class="input-sm "><?php echo $this -> Html -> link('', '', array('class' => 'btn icon-refresh')); ?></spans>
			</div>
		</div>
	</div>
<?php echo $this->Form->end() ?>

<!-- debug -->
<?php 
	#debug($this->params);
?>