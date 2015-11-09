<?php
App::uses('AppModel', 'Model');
/**
 * Keyword Model
 *
 * @property Post $Post
 * @property Company $Company
 */
class Keyword extends AppModel {

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
	public $validate = array(
		'post_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			// 'notEmpty' => array(
				// 'rule' => array('notEmpty'),
				// // 'message' => 'Your custom message here',
				// // 'allowEmpty' => false,
				// // 'required' => false,
				// // 'last' => false, // Stop validation after this rule
				// // 'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
		),
		// 'company_id' => array(
			// 'numeric' => array(
				// 'rule' => array('numeric'),
				// //'message' => 'Your custom message here',
				// //'allowEmpty' => false,
				// //'required' => false,
				// //'last' => false, // Stop validation after this rule
				// //'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
		// ),
		// 'keyword' => array(
			// 'notEmpty' => array(
				// 'rule' => array('notEmpty'),
				// // 'message' => 'Your custom message here',
				// // 'allowEmpty' => false,
				// // 'required' => false,
				// // 'last' => false, // Stop validation after this rule
				// // 'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
			// 'hankaku' => array(
				// 'rule'=> array('hanKaku'),
				// 'message' => '英文また数字は全て半角です。'
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
		// 'visible' => array(
			// 'boolean' => array(
				// 'rule' => array('boolean'),
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Company' => array(
			'className' => 'Company',
			'foreignKey' => 'company_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $actsAs = array(
		// 'CsvImport' => array(
			// // 'delimiter'  => ',',
			// 'hasHeader' => true,
			// // 'mapHeader' => '',
			// 'max_execution_time' => 0,
			// 'post_max_size' => '64M',
			// 'uploadmax_filesize' => '64M'
		// ),
		'CsvExport' => array('delimiter' => ',', //The delimiter for the values, default is ;
			'enclosure' => '"', //The enclosure, default is "
			'max_execution_time' => 360, //Increase for Models with lots of data, has no effect is php safemode is enabled.
			'encoding' => 'utf8' //Prefixes the return file with a BOM and attempts to utf_encode() data
		)
	);
	
	public function call_back_row($values) {
		$conds = array();
		$Post = ClassRegistry::init('Post');
		$post = $Post->findById($values['Post.id']);
		
		$Category = ClassRegistry::init('Category');
		$Category->recursive = -1;
		$categories = $Category->find('list', array('fields' => array('Category.id', 'Category.code')));
		
		//
		$default_url = '';
		if(count($post)>0) {
			// category 1:ameba, 2:amej, 3:j, 4:ip100, 5:ip200, 6:x-sate
			$default_url = trim($post['Blog']['domain'] .$post['Post']['id']);
			if($categories[$post['Blog']['category_id']] == 3) {
				$default_url = trim($post['Blog']['domain']) .$post['Post']['id'] .'-' .Inflector::slug($post['Post']['created'],'-') .'-' .Inflector::slug(!empty($post['Post']['menu']) ? $post['Post']['menu']:Configure::read('J_URL'),'-');
			}
			if($categories[$post['Blog']['category_id']] == 4) {
				$default_url = trim($post['Blog']['domain']) .$post['Post']['id'] .Configure::read('IP100_URL');
			}
			if($categories[$post['Blog']['category_id']] == 5) {
				$default_url = trim($post['Blog']['domain']) .$post['Post']['id'] .'-' .Inflector::slug(!empty($post['Post']['pagename']) ? $post['Post']['pagename']:Configure::read('IP200_URL'),'-');
			}
			if($categories[$post['Blog']['category_id']] == 6) {
				$post_keyword = array();
				if(count($post['Keyword'])>0) {
					$i=0;
					foreach($post['Keyword'] as $kw) {
						$i++;
						if($kw['visible'] == 1) {
							// all keyword
							$list_keyword[] = $kw['keyword'];
							// post keyword
							$post_keyword[] = $kw['keyword'];
							// first keyword
							if($i == 1):
								$first_keyword[] = $kw['keyword'];
							endif;
						}
					}
				}
				$default_url = trim($post['Blog']['domain']) .$post['Post']['id'] .str_replace(' ', '', implode('', $post_keyword));
			} 
		}
 		
		
		$values['Keyword.created'] = date('Y-m-d', strtotime($values['Keyword.created']));
		$values['Post.url'] = $default_url;
		unset($values['Post.id']);
 		
 		return $values;
 	}

	public function beforeImport($data) {
		return $data;
	}

	public function afterImport($data) {
		// $this->deleteAll(array($this->alias . '.catetory' => ''));
		// $this->deleteAll(array($this->alias . '.category_jpn' => ''));
		return $data;
	}
	
}
