<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header" data-original-title="">
<!-- Add menu -->
				<h2><i class="icon-edit"></i><span class="break"></span><?php  echo __(ucfirst(substr($this->params['controller'], 0, -1))).' '.$prefix;?></h2>
			</div>
			<div class="box-content">
				<?php echo $this->Session->flash(); ?>				
				<?php echo $this->Form->create(ucfirst(substr($this->params['controller'], 0, -1))); ?>				
<!-- menu form -->
			<?php
				$i = 0;
				foreach ($settings as $setting) :
					$keyE = explode('.', $setting['Setting']['key']);
					$keyTitle = Inflector::humanize($keyE['1']);

					$label = ($setting['Setting']['title'] != null) ? $setting['Setting']['title'] : $keyTitle;
					$icon = (isset($setting['Params']['icon'])) ? $setting['Params']['icon'] : 'random';

					$i = $setting['Setting']['id'];
					
					echo '<div class="form-group">';
					echo $this->Form->label('Setting.$i.id', $label);	
					echo '<div class="controls row"><div class="input-group col-sm-5">';
					if($setting['Setting']['input_type']=='text' || $setting['Setting']['input_type']=='textarea'){
						echo '<span class="input-group-addon"><i class="icon-'.$icon.'"></i></span>';
					}
					echo
						$this->Form->input("Setting.$i.id", array(
							'value' => $setting['Setting']['id'],
						)) .
						$this->Form->input("Setting.$i.key", array(
							'type' => 'hidden', 'value' => $setting['Setting']['key']
						)) .
						$this->SettingsForm->input($setting, $label, $i);
					echo '</div><span class="help-block col-sm-5">'.$setting['Setting']['description'].'</span></div>';
					echo '</div>';
					$i++;
				endforeach;
			?>					
					<?php echo $this->Form->button(__('Submit'), array('class' => 'btn btn-primary')); ?>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('[data-rel="chosen"],[rel="chosen"]').chosen();
	})
</script>	