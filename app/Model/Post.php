<?php
App::uses('AppModel', 'Model');

/**
 * Post Model
 *
 * @property Blog $Blog
 * @property Keyword $Keyword
 */
class Post extends AppModel {
	
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'blog_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'ブログがありません',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			// 'numeric' => array(
				// 'rule' => array('numeric'),
				// 'message' => 'ブログがありません',
				// //'allowEmpty' => false,
				// //'required' => false,
				// //'last' => false, // Stop validation after this rule
				// //'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
		),
		'title' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'タイトルがありません',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			// 'unique' => array(
				// 'rule' => 'isUnique',
				// 'required' => 'create',
				// 'message' => 'Title is unique',
			// ),
		),
		'content' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'コンテンツがありません',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			// csv upload 2 times error
			// 'unique' => array(
				// 'rule' => 'isUnique',
				// 'message' => 'このコンテンツは重複です',
			// ),
		),
		// 'pagename' => array(
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
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'OutlinkLog' => array(
			'className' => 'OutlinkLog',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ImageLog' => array(
			'className' => 'ImageLog',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

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
		'Keyword' => array(
			'className' => 'Keyword',
			'foreignKey' => 'post_id',
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
			'foreignKey' => 'post_id',
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
 * csv download
 *
 * @var array
 */
	public $actsAs = array(
		'CsvImport' => array(
			// 'delimiter'  => ',',
			'hasHeader' => true, 
			'mapHeader' => 'POST_CSV_UPLOAD', 
			'max_execution_time' => 0, 
			'post_max_size' => '64M', 
			'uploadmax_filesize' => '64M'
		), 
		'CsvExport' => array(
			'delimiter' => ',', //The delimiter for the values, default is ;
			'enclosure' => '"', //The enclosure, defauslt is "
			'max_execution_time' => 360, //Increase for Models with lots of data, has no effect is php safemode is enabled.
			'encoding' => 'utf8' //Prefixes the return file with a BOM and attempts to utf_encode() data
		)
 	);
	
	public function header_csv_post($headers, $mapHeader){
 		$post_headers = Configure::read('Post.HEADER_CSV_VIEW_POSTLIST');
 		// $headers[] = $post_headers['Post.content_no_tag'];
 		return $headers;
 	}
	
	public function header_csv_post_template($headers, $mapHeader){
 		$post_headers = Configure::read('POST_CSV_UPLOAD');
 		return $headers;
 	}

 	public function row_csv_post($values){
 		$values['Post.content'] = trim(strip_tags($values['Post.content']));
 		// $values['Post.content_no_tag'] = trim(strip_tags($values['Post.content']));
 		return $values;
 	}

/**
 * before import
 *
 * @logic menu logic
 * blog_id
 * 
 * or
 * 
 * 1．genre_id (pagename & menu なし): -> アメーバ  category_id = 2 or IP100 category_id = 5
 * 2．genre_id + pagename: -> IP200 category_id = 6
 * 3．genre_id + menu: -> メニューリストから抽出
 * @created 2014-08
 * @updated 2014-09-18
 * 4.
 */
	public function beforeImport($data) {
		isset($data['Blog'])?$data[$this -> alias]['Blog'] = $data['Blog']:$data['Blog']=Null;
		$data[$this -> alias]['Keyword'] = $data['Keyword'];
		$data[$this -> alias]['Arbitrary'] = $data['Arbitrary'];

		// step 1: get all blog_id by genre_id
		$Blog = ClassRegistry::init('Blog');
		$Keyword = ClassRegistry::init('Keyword');
		$Menu = ClassRegistry::init('Menu');
		
		$conds = array();
		$fields = array('Blog.id', 'Blog.category_id', 'Blog.genre_id', 'Blog.name', 'Genre.id', 'Genre.genre'); // find Blog & Post
		
		// check logic find suitable blog_id for import post line 198
		if($data['Blog']['id'] != '') {
			$conds['Blog.id'] = $data['Blog']['id'];
		} else {
			$conds['Blog.genre_id'] = $data['Post']['genre_id'];
			if($data['Post']['pagename'] == '' && $data['Post']['menu'] == '') {
				$conds['Blog.category_id'] = array(2,5);
			}
	
			if($data['Post']['pagename'] != '' && $data['Post']['menu'] == '') {
				$conds['Blog.category_id'] = 6;
			}
			
			if($data['Post']['pagename'] == '' && $data['Post']['menu'] != '') {
				$menus = $Menu -> find('all', array('recursive' => -1, 'conditions' => array('Menu.name' => $data['Post']['menu'])));
				$blog_ids = Hash::combine($menus,'{n}.Menu.blog_id');
				$conds['Blog.id'] = array_keys($blog_ids);
			}
		}
		
		$blogs = $Blog->find('all',array('recursive' => 1, 'conditions'=> $conds, 'fields' => $fields));
		// debug($blogs);exit;
		
		// url exact, partial
		App::import('Component', 'Content');
		$ContentComponent = new ContentComponent(new ComponentCollection());
		$conds = array();
		$blog_count_url = array();
		// exact
		// $conds['Keyword.url'] = $data['Keyword']['url']; // exact
		// partial
		$remain_domain = $ContentComponent->remainDomain($data['Keyword']['url']);
		
		if(count($blogs) > 0) {
			if($data['Blog']['id'] != '') {
				foreach ($blogs as $blog) {
					// debug($blog);exit;
					$data['Post']['blog_id'] = (int)$blog['Blog']['id'];
					$data['Post']['genre_id'] = (int)$blog['Blog']['genre_id'];
					unset($data['Post']['Blog']);
				}
			} else {
				// step 2: count post that have Keword.url in blog
				foreach ($blogs as $blog) {
					if(count($blog['Post']) > 0) { // count blog that have post only
						foreach($blog['Post'] as $post) {
							$conds['Keyword.post_id'] = $post['id'];
							$blog_count_url[$blog['Blog']['id']][] = $Keyword->find('count', array('conditions' => $conds)); // count with conditions url -> result array
						}
					}
				}
				// debug($blog_count_url);
				foreach($blog_count_url as $key => $value) {
					$blog_count_url[$key] = array_sum($value);
				}
				// debug($blog_count_url);
				
				// step 3: check blog_id with minimum Keyword.url count
				if(count($blog_count_url) > 0) { 
					$min_url = array_keys($blog_count_url, min($blog_count_url));
					// debug($min_url);
					$data['Post']['blog_id'] = $min_url[0]; // get blog id with minimum post count
				} else { // no keyword & url
					$data['Post']['blog_id'] = $blogs[0]['Blog']['id'];
				}
			}
		}else {
			$data['Post']['blog_id'] = Null;
		}
		
		// debug($data);
		// exit;
		unset($data['Blog']);
		unset($data['Keyword']);
		unset($data['Arbitrary']);
		// debug($data);exit;
		
		if (empty($data[$this -> alias]['blog_id'])) {
			return null;
		} else {
			return $data;
		}
	}
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
// }

	public function afterImport($data) {
		if (isset($data[$this -> alias]['Keyword'])) {
			$data[$this -> alias]['Keyword']['post_id'] = $data[$this -> alias]['id'];
			$data_keyword['Keyword'] = $data[$this -> alias]['Keyword'];

			// arbitrary keyword
			if($data[$this -> alias]['Arbitrary']['keyword'] == 1) {
				// load model
				$Arbitrary = ClassRegistry::init('Arbitrary');
				$arbitrary = $Arbitrary->find('first',array('order'=>'rand()'));
				$data_keyword['Keyword']['keyword'] = $arbitrary['Arbitrary']['prefix'] .' ' .$data_keyword['Keyword']['keyword'].' ' .$arbitrary['Arbitrary']['suffix'];
			}

			// load model
			$Keyword = ClassRegistry::init('Keyword');
			$Keyword -> create();
			$Keyword -> save($data_keyword);
		}
		return $data;
	}

}
