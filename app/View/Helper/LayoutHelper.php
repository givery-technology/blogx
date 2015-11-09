<?php

/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       layout.View.Helper
 */
class LayoutHelper extends Helper {

	public $helpers = array('Html');

	private function _getModel($model = null) {
		return ClassRegistry::init($model);
	}

	/*
	 * company method
	 */

	public function getCompany($field, $conds) {
		$Company = $this -> _getModel('Company');
		if (empty($field)) {
			$company = $Company -> find('first', array('conditions' => $conds));
			return $company;
		} else {
			$company = $Company -> find('first', array('fields' => array('Company.' . $field), 'conditions' => $conds));
			return $company['Company'][$field];
		}
	}

/*
 * get referer method
 * @param: $referer = $_SERVER['HTTP_REFERER']
 * @output: referer for back button
 * @logic: 
 * @created: 20140702
 * @updated:
*/
	public function get_referer($referer) {
		$back = $referer;
		$here = FULL_BASE_URL .$this->here;
		if($referer == Null || $referer == $here) {
			$back = '/'.$this->params['controller'] ;
		}
		
		return $back;
	}
	
/*
 * japanese datetime method
 * @param: $datetime
 * @output: Japanese Datetime
 * @logic: 
 * @created: 20140702
 * @updated:
*/
	public function jpn_datetime($datetime) {
		$datetime = date('Y年m月d日 H時i分',strtotime($datetime));
		return $datetime;
	}
	
/*
 * csv output method
 * @param: $data
 * @output: csv output template
 * @logic: 
 * @created: 20140707
 * @updated:
*/
	public function csv_output($data) {
		$output = fopen("php://output", "w");
		foreach ($data as $row) {
			fputcsv($output, $row); // change delimiter or enclosure
		}
		fclose($output);
	}

}
?>