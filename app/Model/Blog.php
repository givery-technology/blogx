<?php
App::uses('AppModel', 'Model');
/**
 * Blog Model
 *
 * @property Category $Category
 * @property Design $Design
 * @property Post $Post
 */
class Blog extends AppModel {

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
		// 'category_id' => array(
			// 'numeric' => array(
				// 'rule' => array('numeric'),
				// //'message' => 'Your custom message here',
				// //'allowEmpty' => false,
				// //'required' => false,
				// //'last' => false, // Stop validation after this rule
				// //'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
		// ),
		// 'design_id' => array(
			// 'numeric' => array(
				// 'rule' => array('numeric'),
				// //'message' => 'Your custom message here',
				// //'allowEmpty' => false,
				// //'required' => false,
				// //'last' => false, // Stop validation after this rule
				// //'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
		// ),
		// 'name' => array(
			// 'notEmpty' => array(
				// 'rule' => array('notEmpty'),
				// //'message' => 'Your custom message here',
				// //'allowEmpty' => false,
				// //'required' => false,
				// //'last' => false, // Stop validation after this rule
				// //'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
		// ),
		// 'title' => array(
			// 'notEmpty' => array(
				// 'rule' => array('notEmpty'),
				// //'message' => 'Your custom message here',
				// //'allowEmpty' => false,
				// //'required' => false,
				// //'last' => false, // Stop validation after this rule
				// //'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
		// ),
		// 'description' => array(
			// 'notEmpty' => array(
				// 'rule' => array('notEmpty'),
				// //'message' => 'Your custom message here',
				// //'allowEmpty' => false,
				// //'required' => false,
				// //'last' => false, // Stop validation after this rule
				// //'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
		// ),
		// 'ip' => array(
			// 'notEmpty' => array(
				// 'rule' => array('notEmpty'),
				// //'message' => 'Your custom message here',
				// //'allowEmpty' => false,
				// //'required' => false,
				// //'last' => false, // Stop validation after this rule
				// //'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
		// ),
		// 'domain' => array(
			// 'notEmpty' => array(
				// 'rule' => array('notEmpty'),
				// //'message' => 'Your custom message here',
				// //'allowEmpty' => false,
				// //'required' => false,
				// //'last' => false, // Stop validation after this rule
				// //'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
			// 'unique' => array(
				// 'rule' => 'isUnique',
				// 'message' => 'このドメインは事前に登録しました。',
			// ), 
		// ),
		// 'key' => array(
			// 'notEmpty' => array(
				// 'rule' => array('notEmpty'),
				// //'message' => 'Your custom message here',
				// //'allowEmpty' => false,
				// //'required' => false,
				// //'last' => false, // Stop validation after this rule
				// //'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
			// 'unique' => array(
				// 'rule' => 'isUnique',
				// 'message' => '新いAPIキ‐を作成してください。',
			// ), 
		// ),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Design' => array(
			'className' => 'Design',
			'foreignKey' => 'design_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Genre' => array(
			'className' => 'Genre',
			'foreignKey' => 'genre_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'blog_id',
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
		'Menu' => array(
			'className' => 'Menu',
			'foreignKey' => 'blog_id',
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
	);

/**
 * csv behavior
 *
 * @var array
 */
	public $actsAs = array(
		'CsvImport' => array(
			// 'delimiter'  => ',',
			'hasHeader' => true, 
			'mapHeader' => 'BLOG_CSV_UPLOAD', 
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
	
	public function beforeImport($data) {
		// $data[$this -> alias]['Category'] = $data['Category'];
		// $data[$this -> alias]['Design'] = $data['Design'];
		unset($data['Category']);
		unset($data['Design']);
		// kotei list random
		// if ($data['KoteiList']['random'] > 0 ) {
			// $this->loadModel('KoteiList');
			// // 
			// $koteiLists = $this->KoteiList->find('first',array(
				// 'conditions'=>array(
					// 'KoteiList.random_group'=> $data['KoteiList']['random'],
					// 'KoteiList.show' => 0
				// ),
				// 'order'=>'rand()'
			// ));
			// debug($koteiLists);exit;
		// }
		// if (empty($data[$this -> alias]['title'])) {
			// return null;
		// }
		return $data;
	}

	public function afterImport($data) {
		// $this -> deleteAll(array($this -> alias . '.Blog' => ''));
		return $data;
	}

}
