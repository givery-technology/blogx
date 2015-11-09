<?php

/*---------------------------------------------------------------------------------------------------------
 * Url Helper
 *
 * @package  Ddnb.View.Helper
 * @author   ddnb_admin <admin@ddnb.info>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.ddnb.info
 ---------------------------------------------------------------------------------------------------------*/
App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       layout.View.Helper
 */
class DdnbViewHelper extends Helper {

	public $helpers = array('Html');

	private function _getModel($model = null) {
		return ClassRegistry::init($model);
	}

	/*
	 * get referer method
	 * 
	 * @input: params & check = ""
	 * @output: data or 0
	 * @logic:
	 * @created: 2014-09-10
	 * @updated:
	 * @status: developing
	 */
	public function params_check($params, $check) {
		if(count($params[$check]) > 0) {
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
		$here = FULL_BASE_URL . $this -> here;
		if ($referer == Null || $referer == $here) {
			$back = '/' . $this -> params['controller'];
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
		$datetime = date('Y年m月d日 H時i分', strtotime($datetime));
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
			fputcsv($output, $row);
			// change delimiter or enclosure
		}
		fclose($output);
	}

	/*
	 * get model name by controller method
	 * @param: $controller
	 * @output: Model Name Capitalize
	 * @logic: check plural & singular on Controller name define by default
	 * @created: 20140826
	 * @updated:
	 * @problem: check vowels: a e u e o. Example: rsses genres categories testcodes
	 */
	public function model_by_controller($controller) {
		if (substr($controller, -3) == 'ies') {
			$model = substr($controller, 0, -3) . 'y';
		} elseif (substr($controller, -2) == 'es') {
			$model = substr($controller, 0, -2);
		} else {
			$model = substr($controller, 0, -1);
		}

		return $model;
	}

}
?>