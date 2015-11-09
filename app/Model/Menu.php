<?php
App::uses('AppModel', 'Model');
/**
 * Menu Model
 *
 * @property Blog $Blog
 * @property Post $Post
 */
class Menu extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'menu';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		// 'blog_id' => array(
			// 'numeric' => array(
				// 'rule' => array('numeric'),
				// //'message' => 'Your custom message here',
				// //'allowEmpty' => false,
				// //'required' => false,
				// //'last' => false, // Stop validation after this rule
				// //'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
		// ),
		// 'post_id' => array(
			// 'numeric' => array(
				// 'rule' => array('numeric'),
				// //'message' => 'Your custom message here',
				// //'allowEmpty' => false,
				// //'required' => false,
				// //'last' => false, // Stop validation after this rule
				// //'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
		// ),
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Blog' => array(
			'className' => 'Blog',
			'foreignKey' => 'blog_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
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
			'mapHeader' => 'HEADER_CSV_MENU', 
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
		// $this -> deleteAll(array($this -> alias . '.name' => ''));
		return $data;
	}

}
