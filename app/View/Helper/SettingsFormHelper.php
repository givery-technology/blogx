<?php
App::uses('AppHelper', 'View/Helper');

class SettingsFormHelper extends AppHelper {

	public $helpers = array(
		'Form'
	);

/**
 * _inputCheckbox
 *
 * @see SettingsFormHelper::input()
 */
	protected function _inputCheckbox($setting, $label, $i) {
		$tooltip = array(
			'data-trigger' => 'hover',
			'data-placement' => 'right',
			'data-title' => $setting['Setting']['description'],
		);
		if ($setting['Setting']['value'] == 1) {
			$output = $this->Form->input("Setting.$i.value", array(
				'type' => $setting['Setting']['input_type'],
				'checked' => 'checked',
				'tooltip' => $tooltip,
				//'label' => $label,
				'label' => FALSE,
			));
		} else {
			$output = $this->Form->input("Setting.$i.value", array(
				'type' => $setting['Setting']['input_type'],
				'tooltip' => $tooltip,
				'label' => $label
			));
		}
		return $output;
	}

/**
 * Renders input setting according to its type
 *
 * @param array $setting setting data
 * @param string $label Input label
 * @param integer $i index
 * @return string
 */
	public function input($setting, $label, $i) {
		$output = '';
		$inputType = ($setting['Setting']['input_type'] != null) ? $setting['Setting']['input_type'] : 'text';
		if ($setting['Setting']['input_type'] == 'multiple') {
			$multiple = true;
			if (isset($setting['Params']['multiple'])) {
				$multiple = $setting['Params']['multiple'];
			};
			$selected = json_decode($setting['Setting']['value']);
			$options = json_decode($setting['Params']['options'], true);
			$output = $this->Form->input("Setting.$i.values", array(
				//'label' => $setting['Setting']['title'],
				'label' => FALSE,
				'multiple' => $multiple,
				'options' => $options,
				'selected' => $selected,
			));
		} elseif ($setting['Setting']['input_type'] == 'checkbox') {
			$output = $this->_inputCheckbox($setting, $label, $i);
		} elseif ($setting['Setting']['input_type'] == 'radio') {
			$value = $setting['Setting']['value'];
			$options = json_decode($setting['Params']['options'], true);
			$output = $this->Form->input("Setting.$i.value", array(
				'legend' => $setting['Setting']['title'],
				'type' => 'radio',
				'options' => $options,
				'value' => $value,
			));
		} elseif ($setting['Setting']['input_type'] == 'select') {
			$selected = json_decode($setting['Setting']['value']);
			$options = json_decode($setting['Params']['options'], true);
			$output = $this->Form->input("Setting.$i.values", array(
				//'label' => $setting['Setting']['title'],
				'label' => FALSE,
				'options' => $options,
				'selected' => $selected,
				'class' => 'form-control',
				'data-rel'=>'chosen'
			));		
		}else {
			$output = $this->Form->input("Setting.$i.value", array(
				'type' => $inputType,
				'class' => 'form-control',
				'value' => $setting['Setting']['value'],
				'help' => $setting['Setting']['description'],
				//'label' => $label,
				'label' => FALSE,
			));
		}
		return $output;
	}

}
