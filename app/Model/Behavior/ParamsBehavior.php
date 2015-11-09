<?php
App::uses('ModelBehavior', 'Model');

class ParamsBehavior extends ModelBehavior {

	/**
	 * Setup
	 *
	 * @param Model $model
	 * @param array $config
	 * @return void
	 */
	public function setup(Model $model, $config = array()) {
		if (is_string($config)) {
			$config = array($config);
		}

		$this -> settings[$model -> alias] = $config;
	}

	/**
	 * afterFind callback
	 *
	 * @param Model $model
	 * @param array $created
	 * @param boolean $primary
	 * @return array
	 */
	public function afterFind(Model $model, $results, $primary = false) {
		if ($primary && isset($results[0][$model -> alias])) {
			foreach ($results as $i => $result) {
				$params = array();
				if (isset($result[$model -> alias]['params']) && strlen($result[$model -> alias]['params']) > 0) {
					$params = $this -> paramsToArray($model, $result[$model -> alias]['params']);
				}
				$results[$i]['Params'] = $params;
			}
		} elseif (isset($results[$model -> alias])) {
			$params = array();
			if (isset($results[$model -> alias]['params']) && strlen($results[$model -> alias]['params']) > 0) {
				$params = $this -> paramsToArray($model, $results[$model -> alias]['params']);
			}
			$results['Params'] = $params;
		}

		return $results;
	}

	/**
	 * Converts a string of params to an array of formatted key/value pairs
	 *
	 * String is supposed to have one parameter per line in the format:
	 * my_param_key=value_here
	 * another_param=another_value
	 *
	 * @param Model $model
	 * @param string $params
	 * @return array
	 */
	public function paramsToArray(Model $model, $params) {
		$output = array();
		$params = preg_split('/[\r\n]+/', $params);
		foreach ($params as $param) {
			if (strlen($param) == 0) {
				continue;
			}

			$paramE = explode('=', $param);
			if (count($paramE) == 2) {
				$key = $paramE['0'];
				$value = $paramE['1'];
				$output[$key] = trim($value);
			}
		}
		return $output;
	}

	/**
	 * return blog id
	 *
	 * @param Model $model
	 * @param string $params
	 * @return array
	 */
	public function returnBlogId(Model $model, $params) {

	}

	/**
	 * return domain id
	 *
	 * @param Model $model
	 * @param string $params
	 * @return array
	 */

	public function returnDomain(Model $model, $params) {

	}

}
