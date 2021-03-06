<?php
App::uses('AppModel', 'Model');
/**
 * Genre Model
 *
 * @property Blog $Blog
 * @property Post $Post
 */
class Genre extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'genre_jpn';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		// 'genre' => array(
			// 'notEmpty' => array(
				// 'rule' => array('notEmpty'),
				// //'message' => 'Your custom message here',
				// //'allowEmpty' => false,
				// //'required' => false,
				// //'last' => false, // Stop validation after this rule
				// //'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
		// ),
		// 'genre_jpn' => array(
			// 'notEmpty' => array(
				// 'rule' => array('notEmpty'),
				// //'message' => 'Your custom message here',
				// //'allowEmpty' => false,
				// //'required' => false,
				// //'last' => false, // Stop validation after this rule
				// //'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
		// ),
		// 'memo' => array(
			// 'notEmpty' => array(
				// 'rule' => array('notEmpty'),
				// //'message' => 'Your custom message here',
				// //'allowEmpty' => false,
				// //'required' => false,
				// //'last' => false, // Stop validation after this rule
				// //'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
		// ),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Blog' => array(
			'className' => 'Blog',
			'foreignKey' => 'genre_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'genre_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
/**
 * CSV export
 *
 * @var array
 */
	public $actsAs = array(
		'CsvImport' => array(
			// 'delimiter'  => ',',
			'hasHeader' => true, 
			'mapHeader' => 'HEADER_CSV_GENRE', 
			'max_execution_time' => 0, 
			'post_max_size' => '64M',
			'uploadmax_filesize' => '64M'
		 ), 
		'CsvExport' => array(
			'delimiter' => ',', //The delimiter for the values, default is ;
			'enclosure' => '"', //The enclosure, default is "
			'max_execution_time' => 360, //Increase for Models with lots of data, has no effect is php safemode is enabled.
			'encoding' => 'utf8' //Prefixes the return file with a BOM and attempts to utf_encode() data
		)
	);
	
	public function afterImport($data) {
		$this -> deleteAll(array($this -> alias . '.Genre' => ''));
		return $data;
	}

}
