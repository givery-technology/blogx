<?php
App::uses('AppModel', 'Model');
/**
 * KoteiList Model
 *
 */
class KoteiList extends AppModel {
	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'id';

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	// public $validate = array(
	// 'keyword' => array(
	// 'notEmpty' => array(
	// 'rule' => array('notEmpty'),
	// //'message' => 'Your custom message here',
	// //'allowEmpty' => false,
	// //'required' => false,
	// //'last' => false, // Stop validation after this rule
	// //'on' => 'create', // Limit validation to 'create' or 'update' operations
	// ),
	// ),
	// 'url' => array(
	// 'notEmpty' => array(
	// 'rule' => array('notEmpty'),
	// //'message' => 'Your custom message here',
	// //'allowEmpty' => false,
	// //'required' => false,
	// //'last' => false, // Stop validation after this rule
	// //'on' => 'create', // Limit validation to 'create' or 'update' operations
	// ),
	// ),
	// );

	/**
	 * CSV export
	 *
	 * @var array
	 */
	public $actsAs = array(
	'CsvImport' => array(
		// 'delimiter'  => ',',
		'hasHeader' => true, 
		'mapHeader' => 'HEADER_CSV_ADD_KOTEILIST', 
		'max_execution_time' => 0, 
		'post_max_size' => '64M', 
		'uploadmax_filesize' => '64M'
	), 
	
	'CsvExport' => array(
		'delimiter' => ',', //The delimiter for the values, default is ;
		'enclosure' => '"', //The enclosure, default is "
		'max_execution_time' => 360, //Increase for Models with lots of data, has no effect is php safemode is enabled.
		'encoding' => 'utf8' //Prefixes the return file with a BOM and attempts to utf_encode() data
	));

	public function beforeImport($data) {
		if (!empty($data[$this -> alias]['keyword'])) {
			$data[$this -> alias]['keyword'] = trim($data[$this -> alias]['keyword'], ' ');
		}
		return $data;
	}

	public function afterImport($data) {
		$this -> deleteAll(array($this -> alias . '.Keyword' => ''));
		return $data;
	}

}
