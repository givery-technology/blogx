<?php
App::uses('AppController', 'Controller');
/**
 * Keywords Controller
 *
 * @property Keyword $Keyword
 * @property PaginatorComponent $Paginator
 */
class KeywordsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$conds = array();
		$this->Keyword->recursive = 2;
		$this->Paginator->settings  = array('conditions' => $conds, 'order' => 'Keyword.updated DESC', 'limit' => Configure::read('PAGINATION_MEDIUM'));
		$this->set('keywords', $this->Paginator->paginate());
		
		// search
		$conds = array();
		if($this->request->is('post') && !empty($this->request->data['Search']['keyword'])){
			$search = 1; // show paging on view
			$conds['OR']['Keyword.keyword LIKE'] = '%'.mb_strtolower(trim($this->request->data['Search']['keyword']),'UTF-8').'%';
			$conds['OR']['Keyword.url LIKE'] = '%'.mb_strtolower(trim($this->request->data['Search']['keyword']),'UTF-8').'%';
			
			// blog name
			$this->Keyword->Post->Blog->recursive = 1;
			$blogs = $this->Keyword->Post->Blog->find('all',array(
				'fields'=>array('Blog.id','Blog.name','Blog.domain'),
				'conditions'=>array(
					'OR' => array (
						'Blog.name LIKE'=>'%'.mb_strtolower(trim($this->request->data['Search']['keyword']),'UTF-8').'%',
						'Blog.domain LIKE'=>'%'.mb_strtolower(trim($this->request->data['Search']['keyword']),'UTF-8').'%'
					)
				),
			));
			
			if($blogs!=false){
				$posts = Hash::extract($blogs,'{n}.Post.{n}.id');
				$conds['OR']['Post.id'] = $posts;
			}
			
			$keywords = $this->Keyword->find('all', array('conditions' => $conds, 'order' => 'Keyword.id DESC', 'limit' => Configure::read('Paginate.search')));
			$this->set(compact('keywords', 'search'));
		}
		
		# category code
		$this->loadModel('Category');
		$this->Category->recursive = -1;
		$categories = $this->Category->find('list', array('fields' => array('Category.id', 'Category.code')));
		$this->set(compact('categories'));
	}

/**
 * company method
 * debug: pr($this->Paginator->paginate());
 * @return void
 */
	public function company() {
		ini_set('memory_limit', '512M');
		$this->Keyword->recursive = -1;
		$this->Paginator->settings = array('group'=>'Keyword.url', 'limit' => 1000);
		$keywords = $this->Paginator->paginate();
		
		// search
		$conds = array();
		if($this->request->is('post') && !empty($this->request->data['Keyword']['keyword'])){
			$search = 1; // show paging on view
			$conds['OR']['Keyword.keyword LIKE'] = '%'.mb_strtolower(trim($this->request->data['Keyword']['keyword']),'UTF-8').'%';
			$conds['OR']['Keyword.url LIKE'] = '%'.mb_strtolower(trim($this->request->data['Keyword']['keyword']),'UTF-8').'%';
			$keywords = $this->Keyword->find('all', array('conditions' => $conds, 'order' => 'Keyword.id DESC'));
			$this->set( 'search', $search);
		}
		
		foreach($keywords as $key=>$keyword){
			$keywords[$key]['Keyword']['count_post'] = $this->Keyword->find('count',array('conditions'=>array('Keyword.url'=>$keyword['Keyword']['url'])));
		}
		
		$this->set('keywords', $keywords);
	}

/**
 * report method
 *
 * @return void
 * @inherit company
 */
	public function report() {
		ini_set('memory_limit', '512M');
		$conds = array();
		// $conds['DATE_FORMAT(Keyword.created,"%Y-%m")'] = date('Y-m');
		$this->Keyword->recursive = 1;
		$this->Paginator->settings = array('group'=>'Keyword.url', 'conditions' => $conds, 'limit' => 1000, 'order' => 'Keyword.created DESC');
		$keywords = $this->Paginator->paginate();
		
		// history data
		if($this->request->is('post') && !empty($this->request->data['History']['date'])){
			$conds['DATE_FORMAT(Keyword.created,"%Y-%m")'] = date('Y-m',strtotime($this->request->data['History']['date']['year'].'-'.$this->request->data['History']['date']['month']));
			$keywords = $this->Keyword->find('all', array('group'=>'Keyword.url', 'conditions' => $conds, 'order' => 'Keyword.created DESC'));
		}
		
		// search
		if($this->request->is('post') && !empty($this->request->data['Keyword']['keyword'])){
			$this->request->data['Keyword']['keyword'] = $this-> Input -> ddnbCheck($this->request->data['Keyword']['keyword']);
			$search = 1; // show paging on view
			$conds['OR']['Keyword.keyword LIKE'] = '%'.mb_strtolower(trim($this->request->data['Keyword']['keyword']),'UTF-8').'%';
			$conds['OR']['Keyword.url LIKE'] = '%'.mb_strtolower(trim($this->request->data['Keyword']['keyword']),'UTF-8').'%';
			$keywords = $this->Keyword->find('all', array('conditions' => $conds, 'order' => 'Keyword.created DESC'));
			$this->set( 'search', $search);
		}
		
		foreach($keywords as $key=>$keyword){
			$keywords[$key]['Keyword']['count_post'] = $this->Keyword->find('count',array(
				'conditions'=>array(
					'Keyword.url' => $keyword['Keyword']['url'],
					// 'DATE_FORMAT(Keyword.created,"%Y-%m")' => $conds['DATE_FORMAT(Keyword.created,"%Y-%m")'],
				),
			));
			
		}
		
		// total post
		$this->loadModel('Post');
		$total_posts = $this->Post->find('count');
		
		// post by month
		$count_posts = Hash::extract($keywords, '{n}.Keyword.count_post');
		
		$this->set(compact('keywords', 'count_posts', 'total_posts'));
	}

/**
 * csv report method
 *
 * @input
 * @output
 * @return void
 * @inherit company
 */
	public function download_csv($id, $date = Null) {
		$conds = array();
		if($date !=Null) {
			$conds['DATE_FORMAT(Keyword.created,"%Y-%m")'] = $date;
		} else {
			// $conds['DATE_FORMAT(Keyword.created,"%Y-%m")'] = date('Y-m');
		}

		$keyword = $this->Keyword->findById($id);
		$conds['Keyword.url'] = $keyword['Keyword']['url'];
		
		$this -> export(array(
			'conditions' => $conds,
			'mapHeader' => 'CSV_KEYWORD',
			'fields' => array('Keyword.id', 'Keyword.keyword', 'Keyword.url', 'Keyword.created', 'Post.id'),
			'filename' => date('Y-m-d-H-i-s') . '_'.  strtoupper($this->modelClass).'_LIST',
			//'callbackHeader' => 'header_csv_post'
			'callbackRow'=>'call_back_row',
			
		));
	}

/**
 * detail method
 * check link detail
 * @input keyword $id
 * @logic list all domain by the same url
 * @return void
 * @created 2014-08
 */
	public function detail($id) {
		ini_set('memory_limit', '512M');
		$conds = array();
		// $conds['DATE_FORMAT(Keyword.created,"%Y-%m")'] = date('Y-m');
		$this->Keyword->recursive = 2;
		
		// history data
		if($this->request->is('post') && !empty($this->request->data['History']['date'])){
			$conds['DATE_FORMAT(Keyword.created,"%Y-%m")'] = date('Y-m',strtotime($this->request->data['History']['date']['year'].'-'.$this->request->data['History']['date']['month']));
		}
		
		// find all post_id by same url limit by month
		$keyword = $this->Keyword->findById($id);
		$conds['Keyword.url'] = $keyword['Keyword']['url'];
		$fields = array();
		$posts = $this -> Keyword -> find('all', array('conditions' => $conds, 'fields' => $fields, 'order' => 'Keyword.id DESC'));
		
		// total post by same url
		$conds_total = array();
		$conds_total['Keyword.url'] = $keyword['Keyword']['url'];
		$total_posts = $this -> Keyword -> find('list', array('conditions' => $conds_total, 'fields' => $fields));
		
		// default url
		// category code
		$this->loadModel('Category');
		$this->Category->recursive = -1;
		$categories = $this->Category->find('list', array('fields' => array('Category.id', 'Category.code')));
		
		$this->set(compact('posts', 'total_posts', 'categories'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Keyword->exists($id)) {
			throw new NotFoundException(__('Invalid keyword'));
		}
		$options = array('conditions' => array('Keyword.' . $this->Keyword->primaryKey => $id));
		$this->set('keyword', $this->Keyword->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Keyword->create();
			if ($this->Keyword->save($this->request->data)) {
				$this->Session->setFlash(__('The keyword has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The keyword could not be saved. Please, try again.'));
			}
		}
		$posts = $this->Keyword->Post->find('list');
		$companies = $this->Keyword->Company->find('list');
		$this->set(compact('posts', 'companies'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Keyword->exists($id)) {
			throw new NotFoundException(__('Invalid keyword'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Keyword->save($this->request->data)) {
				$this->Session->setFlash(__('The keyword has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The keyword could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Keyword.' . $this->Keyword->primaryKey => $id));
			$this->request->data = $this->Keyword->find('first', $options);
		}
		$posts = $this->Keyword->Post->find('list');
		$companies = $this->Keyword->Company->find('list');
		$this->set(compact('posts', 'companies'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Keyword->id = $id;
		if (!$this->Keyword->exists()) {
			throw new NotFoundException(__('Invalid keyword'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Keyword->delete()) {
			$this->Session->setFlash(__('The keyword has been deleted.'), 'default', array('class' => 'success'));
		} else {
			$this->Session->setFlash(__('The keyword could not be deleted. Please, try again.'), 'default', array('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function visible_all($all = null) {
		if(empty($all)) $all = 0;
		$this->Keyword->recursive = -1;
		$this->Keyword->updateAll(
			array('Keyword.visible'=>$all)
		);
		return $this->redirect(array('action' => 'index'));
	}	
	
/**
 * visible method
 *
 * @logic reset one status
 */	
	public function visible() {
		Configure::write('debug', 0);
		$this->autoRender = false;	
		$this->Keyword->recursive = -1;
		$this->Keyword->id = $this->request->data['keyword_id'];
		$this->Keyword->saveField('visible',$this->request->data['visible']);
		
		$message = array();
		$message['visible'] = $this->request->data['visible'];
		$message['keyword_id'] = $this->request->data['keyword_id'];
		return json_encode($message);
	}
	
/**
 * google index method
 *
 * @logic reset one status
 */	
	public function google_index() {
		Configure::write('debug', 0);
		$this->autoRender = False;
		
		$this->loadModel('Post');
		$this->Post->recursive = -1;
		
		$post_id = $this->request->data['post_id'];
		$this->Post->id = $post_id;
		$defautl_url = $this->request->data['default_url'];
		$encode_url = urlencode($defautl_url);
		
		$message = array();
		$message['post_id'] = $post_id;
		$message['google_index'] = 0;
		
		if ($encode_url != Null) {
			$url = 'http://www.google.co.jp/search?hl=ja&q=site:_QUERY_';
			$search_url = str_replace('_QUERY_', $encode_url, $url);
			$html = $this->Content -> getWebContent($search_url);
			$html = $this->Content -> check_html_no_space($html);
			
			$regex = '/id="resultStats">(.*?)<\/div>/';
			preg_match_all($regex, $html, $matches);
			
			if(count($matches[1] > 0) && isset($matches[1][0])) {
				$index = explode(' ', $matches[1][0]);
				if(count($index) == 3){ // domain or dir
					$message['google_index'] =  $index[1];
				} elseif(count($index) == 2) { // page
					$message['google_index'] = $index[0]; 
				} else { // no index
					$message['google_index'] = 0;
				}
			}
		} 
		
		$this->Post->saveField('index',$message['google_index']);
		
		return json_encode($message);
	}

/**
 * google index method
 *
 * @logic reset one status
 */	
	public function google_index_blog() {
		Configure::write('debug', 0);
		$this->autoRender = False;	
		
		$this->loadModel('Blog');
		$this->Blog->recursive = -1;
		
		$blog_id = $this->request->data['blog_id'];
		$this->Blog->id = $blog_id;
		$blog_url = $this->request->data['blog_url'];
		$encode_url = urlencode($blog_url);
		
		$message = array();
		$message['blog_id'] = $blog_id;
		
		if ($encode_url != Null) {
			$url = 'http://www.google.co.jp/search?hl=ja&q=site:_QUERY_';
			$search_url = str_replace('_QUERY_', $encode_url, $url);
			$html = $this->Content -> getWebContent($search_url);
			$html = $this->Content -> check_html_no_space($html);
			
			$regex = '/id="resultStats">(.*?)<\/div>/';
			preg_match_all($regex, $html, $matches);
			
			if(count($matches[1] > 0)) {
				$index = explode(' ', $matches[1][0]);
				if(count($index) == 3){ // domain or dir
					$message['google_index'] =  $index[1];
				} elseif(count($index) == 2) { // page
					$message['google_index'] = $index[0]; 
				} else { // no index
					$message['google_index'] = 0;
				}
			}
		} else {
			$message['google_index'] = 0;
		}
		
		$this->Blog->saveField('index',$message['google_index']);
		
		return json_encode($message);
	}

}
?>