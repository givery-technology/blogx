<?php
App::uses('AppController', 'Controller');
/**
 * Blogs Controller
 *
 * @property Blog $Blog
 * @property PaginatorComponent $Paginator
 */
class BlogsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	
/**
 * dashboard method
 *
 * @return void
 */
	public function dashboard() {
		
		$this->loadModel('Keyword');
		$this->loadModel('Post');
		$this->loadModel('Blog');
		
		// pie chart
		$piechart = array();
		$piechart[] = "['Type','Current Month']";
		
		$key_cons = array();
		$key_cons['MONTH(Keyword.created)'] = date('n'); // this month data only
		$keywords = $this->Keyword->find('count', array('conditions' => $key_cons));
		$piechart[] = "['Keyword',".$keywords."]";
		
		$post_cons = array();
		$post_cons['MONTH(Post.created)'] = date('n');
		$posts = $this->Post->find('count', array('conditions' => $post_cons));
		$piechart[] = "['Post',".$posts."]";
		
		$blog_cons = array();
		$blog_cons['MONTH(Blog.created)'] = date('n');
		$blogs = $this->Blog->find('count', array('conditions' => $blog_cons));
		$piechart[] = "['Blog',".$blogs."]";
		
		
		// line chart
		$linechart = array();
		$linechart[] = "['Week', 'Keyword', 'Post', 'Blog']";
		
		// keyword
		// week 1
		$kw_week1_cons = array();
		$kw_week1_cons['Keyword.created BETWEEN ? AND ?'] = array(date('Y-m-01'), date('Y-m-07'));
		$keyword_week1 = $this->Keyword->find('count', array('conditions' => $kw_week1_cons));
		// week 2
		$kw_week2_cons = array();
		$kw_week2_cons['Keyword.created BETWEEN ? AND ?'] = array(date('Y-m-07'), date('Y-m-14'));
		$keyword_week2 = $this->Keyword->find('count', array('conditions' => $kw_week2_cons));
		// week 3
		$kw_week3_cons = array();
		$kw_week3_cons['Keyword.created BETWEEN ? AND ?'] = array(date('Y-m-14'), date('Y-m-22'));
		$keyword_week3 = $this->Keyword->find('count', array('conditions' => $kw_week3_cons));
		// week 4
		$kw_week4_cons = array();
		$kw_week4_cons['Keyword.created BETWEEN ? AND ?'] = array(date('Y-m-22'), date('Y-m-31'));
		$keyword_week4 = $this->Keyword->find('count', array('conditions' => $kw_week4_cons));
		
		// post
		// week 1
		$post_week1_cons = array();
		$post_week1_cons['Post.created BETWEEN ? AND ?'] = array(date('Y-m-01'), date('Y-m-07'));
		$post_week1 = $this->Post->find('count', array('conditions' => $post_week1_cons));
		// week 2
		$post_week2_cons = array();
		$post_week2_cons['Post.created BETWEEN ? AND ?'] = array(date('Y-m-07'), date('Y-m-14'));
		$post_week2 = $this->Post->find('count', array('conditions' => $post_week2_cons));
		// week 3
		$post_week3_cons = array();
		$post_week3_cons['Post.created BETWEEN ? AND ?'] = array(date('Y-m-14'), date('Y-m-21'));
		$post_week3 = $this->Post->find('count', array('conditions' => $post_week3_cons));
		// week 4
		$post_week4_cons = array();
		$post_week4_cons['Post.created BETWEEN ? AND ?'] = array(date('Y-m-21'), date('Y-m-31'));
		$post_week4 = $this->Post->find('count', array('conditions' => $post_week4_cons));
		
		// blogs
		// week 1
		$blog_week1_cons = array();
		$blog_week1_cons['Blog.created BETWEEN ? AND ?'] = array(date('Y-m-01'), date('Y-m-07'));
		$blog_week1 = $this->Blog->find('count', array('conditions' => $blog_week1_cons));
		// week 2
		$blog_week2_cons = array();
		$blog_week2_cons['Blog.created BETWEEN ? AND ?'] = array(date('Y-m-07'), date('Y-m-14'));
		$blog_week2 = $this->Blog->find('count', array('conditions' => $blog_week2_cons));
		// week 3
		$blog_week3_cons = array();
		$blog_week3_cons['Blog.created BETWEEN ? AND ?'] = array(date('Y-m-14'), date('Y-m-21'));
		$blog_week3 = $this->Blog->find('count', array('conditions' => $blog_week3_cons));
		// week 4
		$blog_week4_cons = array();
		$blog_week4_cons['Blog.created BETWEEN ? AND ?'] = array(date('Y-m-21'), date('Y-m-31'));
		$blog_week4 = $this->Blog->find('count', array('conditions' => $blog_week4_cons));
		
		$linechart[] = "['Week1', ".$keyword_week1.", ".$post_week1.", ".$blog_week1."]";
		$linechart[] = "['Week2', ".$keyword_week2.", ".$post_week2.", ".$blog_week2."]";
		$linechart[] = "['Week3', ".$keyword_week3.", ".$post_week3.", ".$blog_week3."]";
		$linechart[] = "['Week4', ".$keyword_week4.", ".$post_week4.", ".$blog_week4."]";
		
		
		// year graph
		$graph = array();
		$graph[] = "['Month', 'Keyword', 'Post', 'Blog']";
		$current_year = date('Y');
		for($i=0;$i<12;$i++) {
			$current_month = $i+1;
			$current_date = date('Y-m',strtotime($current_year.'-'.$current_month));
			$count_graph = array();			
			// keyword
			$count_graph[] = $this->Keyword->find('count', array('conditions' => array('DATE_FORMAT(Keyword.created,"%Y-%m")' => $current_date)));
			
			// post
			$count_graph[] = $this->Post->find('count', array('conditions' => array('DATE_FORMAT(Post.created,"%Y-%m")' => $current_date)));
			
			// blog
			$count_graph[] = $this->Blog->find('count', array('conditions' => array('DATE_FORMAT(Blog.created,"%Y-%m")' => $current_date)));
			
			$graph[] = "['".$current_month."',".implode(',',$count_graph)."]";
		}
		
		// days of month graph
		$days_of_month_graph = array();
		$days_of_month_graph[] = "['Day', 'Keyword', 'Post', 'Blog']";
		$current_month = date('m');
		$current_year = date('Y');
		$num_of_month = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);
		for($i=0;$i<$num_of_month;$i++) {
			$current_day = $i+1;
			$current_date = date('Y-m-d',strtotime($current_year.'-'.$current_month.'-'.$current_day));
			$count_graph = array();
			// keyword
			$count_graph[] = $this->Keyword->find('count', array('conditions' => array('DATE_FORMAT(Keyword.created,"%Y-%m-%d")' => $current_date)));
			// post
			$count_graph[] = $this->Post->find('count', array('conditions' => array('DATE_FORMAT(Post.created,"%Y-%m-%d")' => $current_date)));			
			// blog
			$count_graph[] = $this->Blog->find('count', array('conditions' => array('DATE_FORMAT(Blog.created,"%Y-%m-%d")' => $current_date)));
			$days_of_month_graph[] = "['".$current_day."',".implode(',',$count_graph)."]";
		}				
		
		$this->set(compact('piechart', 'linechart', 'graph','days_of_month_graph'));
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Blog->recursive = 0;
		$this->Blog->Post->recursive = -1;
		$this -> Paginator -> settings = array('order' => 'Blog.updated DESC', 'limit' => 50);
		$blogs = $this -> Paginator -> paginate();
		
		foreach($blogs as $key=>$blog) {
			$blogs[$key]['Blog']['count_post'] = $this->Blog->Post->find('count',array('conditions' => array('Post.blog_id' => $blog['Blog']['id'])));
		}
		$this->set('blogs', $blogs);
		
		// search
		$conds = array();
		if($this->request->is('post') && !empty($this->request->data['Keyword']['keyword'])){
			$search = 1; // show paging on view
			$conds['OR']['Blog.name LIKE'] = '%'.mb_strtolower(trim($this->request->data['Keyword']['keyword']),'UTF-8').'%';
			
			// category
			$this->Blog->Category->recursive = 0;
			$categories = $this->Blog->Category->find('all',array(
				'fields'=>array('Category.id','Category.id'),
				'conditions'=>array(
					'Category.name LIKE'=>'%'.mb_strtolower(trim($this->request->data['Keyword']['keyword']),'UTF-8').'%')
				)
			);
			if($categories!=false){
				$category_id = Hash::extract($categories,'{n}.Category.id');
				$conds['OR']['Category.id'] = $category_id;
			}
			
			// design
			// $this->Blog->Design->recursive = 0;
			// $designs = $this->Blog->Design->find('all',array(
				// 'fields'=>array('Design.id','Design.id'),
				// 'conditions'=>array(
					// 'Design.name LIKE'=>'%'.mb_strtolower(trim($this->request->data['Keyword']['keyword']),'UTF-8').'%')
				// )
			// );
			// if($designs!=false){
				// $category_id = Hash::extract($designs,'{n}.Design.id');
				// $conds['OR']['Design.id'] = $category_id;
			// }
			
			// genre
			$this->Blog->Genre->recursive = 0;
			$genres = $this->Blog->Genre->find('all',array(
				'fields'=>array('Genre.id','Genre.id'),
				'conditions'=>array(
					'Genre.genre_jpn LIKE'=>'%'.mb_strtolower(trim($this->request->data['Keyword']['keyword']),'UTF-8').'%')
				)
			);
			if($genres != False){
				$category_id = Hash::extract($genres,'{n}.Genre.id');
				$conds['OR']['Genre.id'] = $category_id;
			}
			
			$blogs = $this->Blog->find('all', array('conditions' => $conds, 'order' => 'Blog.id DESC', 'limit' => Configure::read('Paginate.search')));
			foreach($blogs as $key=>$blog) {
				$blogs[$key]['Blog']['count_post'] = $this->Blog->Post->find('count',array('conditions' => array('Post.blog_id' => $blog['Blog']['id'])));
			}
			$this->set(compact('blogs', 'search'));
		}
	}

/**
 * download csv method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 * @created 2014-07-03
 */
	public function download_csv(){		
		// $this->Blog->unbindModel(array('hasMany'=>array('Post')));
		
		// $this->export(array(
			// 'recursive'=>1,
			// // 'fields' => array('Blog.id', 'Blog.name','Category.name' , 'Blog.genre_id', 'Design.name','Blog.ip','Blog.domain'),
			// 'fields' => array('Blog.id', 'Blog.category_id', 'Blog.design_id', 'Blog.genre_id', 'Blog.name'),
			// 'order' => array('Blog.id' => 'desc'),
			// 'mapHeader' => 'BLOG_CSV_UPLOAD',
			// // 'insertHeader' => array(Configure::read('SYSTEM_NAME')),
			// // 'insertFooter' => array(Configure::read('COMPANY_NAME_INC')),
			// 'filename' => date('Y-m-d_H-i-s').'_BLOGX_BlogList',
			// // 'callbackHeader'=>'header_csv_blog',
			// //'callbackRow'=>'row_csv_post'
		// ));
		
		$this -> export(array(
			// 'fields' => array('Blog.id', 'Blog.genre_id', 'Blog.name', 'Blog.ip','Blog.domain', 'Category.name', 'Design.name'),
			'fields' => Configure::read('BLOG_CSV_DOWNLOAD_FIELD'),
			'order' => array('Blog.id' => 'desc'),
			'mapHeader' => 'BLOG_CSV_UPLOAD',
			'filename' => date('Y-m-d_H-i-s').'_BLOGX_BLOG_LIST',
		));
	}
	
/**
 * add csvs method
 *
 * @return void
 */
	public function add_csv() {
		if ($this -> request -> is('post')) {
			// debug($this->request->data);exit;
			$csv = $this -> Upload -> uploadFile('uploads/csv/blogs', $this -> request -> data['Blog']['csv']);
			if (!empty($csv['urls'])) {
				try {
					if ($this -> Blog -> importCSV($csv['urls'])) {
						$this -> Session -> setFlash(__('The csv data has been saved.'), 'default', array('class' => 'success'));
						return $this -> redirect(array('action' => 'index'));
					}
					$import_errors = $this -> Blog -> getImportErrors();
					// debug($import_errors);exit;
					$import_errors = Hash::extract($import_errors, "{n}.validation.url.{n}");
					$this -> set('import_errors', $import_errors);
				} catch (Exception $e) {
					$import_errors = $this -> Blog -> getImportErrors();
					$import_errors = Hash::extract($import_errors, "{n}.validation.url.{n}");
					$this -> set('import_errors', $import_errors);
					// $this -> Session -> setFlash(__('Error Importing') . ' ' . $this -> request -> data['Blog']['csv']['name'] . ', ' . __('column name mismatch.'), 'default', array('class' => 'error'));
					$this -> Session -> setFlash(__('The csv data has been saved.'), 'default', array('class' => 'success'));
					return $this -> redirect(array('action' => 'index'));
				}
			}
		}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Blog->exists($id)) {
			throw new NotFoundException(__('Invalid blog'));
		}
		$options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
		$this->set('blog', $this->Blog->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Blog->create();
			if ($this->Blog->save($this->request->data)) {
				$this->Session->setFlash(__('The blog has been saved.'), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The blog could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
		$categories = $this->Blog->Category->find('list');
		$designs = $this->Blog->Design->find('list');
		
		// load post genre
		$genres = $this->Blog->Genre->find('list');
		
		$this->set(compact('categories', 'designs', 'genres'));
	}
	
/**
* get key method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
	public function get_key() {
		$this->autoRender = false;
		Configure::write('debug', 0);
		App::uses('String', 'Utility');
		return String::uuid();
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Blog->exists($id)) {
			throw new NotFoundException(__('Invalid blog'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Blog->save($this->request->data)) {
				$this->Session->setFlash(__('The blog has been saved.'), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The blog could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
			$this->request->data = $this->Blog->find('first', $options);
		}
		$categories = $this->Blog->Category->find('list');
		$designs = $this->Blog->Design->find('list');
		$genres = $this->Blog->Genre->find('list');
		
		$this->set(compact('categories', 'designs', 'genres'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Blog->id = $id;
		if (!$this->Blog->exists()) {
			throw new NotFoundException(__('Invalid blog'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Blog->delete()) {
			$this->Session->setFlash(__('The blog has been deleted.'), 'default', array('class' => 'success'));
		} else {
			$this->Session->setFlash(__('The blog could not be deleted. Please, try again.'), 'default', array('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * count keyword method
 *
 * @return void
 */
	public function count_keyword() {
		$this->loadModel('Keyword');
		Configure::write('debug', 0);
		$this->Keyword->recursive = -1;
        $this->autoRender = false;
        $conds = array();
        $conds['MONTH(Keyword.Created)'] = date('n');
        $count = $this->Keyword->find('count',array('conditions' => $conds));
        $message = array();
        $message['count'] = $count;
        return json_encode($message);
	}
	
/**
 * count keyword method
 *
 * @return void
 */
	public function count_post() {
		$this->loadModel('Post');
		Configure::write('debug', 0);
		$this->Post->recursive = -1;
        $this->autoRender = false;
        $conds = array();
        $conds['MONTH(Post.Created)'] = date('n');
        $count = $this->Post->find('count',array('conditions' => $conds));
        $message = array();
        $message['count'] = $count;
        return json_encode($message);
	}	

/**
 * count blog method
 *
 * @return void
 */
	public function count_blog() {
		Configure::write('debug', 0);
		$this->Blog->recursive = -1;
        $this->autoRender = false;
        $conds = array();
        $conds['MONTH(Blog.Created)'] = date('n');
        $count = $this->Blog->find('count',array('conditions' => $conds));
        $message = array();
        $message['count'] = $count;
        return json_encode($message);
	}

/**
 * count category method
 *
 * @return void
 */
	public function count_category() {
		$this->loadModel('Category');
		Configure::write('debug', 0);
		$this->Category->recursive = -1;
        $this->autoRender = false;
        $conds = array();
        $conds['MONTH(Category.Created)'] = date('n');
        $count = $this->Category->find('count',array('conditions' => $conds));
        $message = array();
        $message['count'] = $count;
        return json_encode($message);
	}
	
/**
 * count design method
 *
 * @return void
 */
	public function count_design() {
		$this->loadModel('Design');
		Configure::write('debug', 0);
		$this->Design->recursive = -1;
        $this->autoRender = false;
        $conds = array();
        $conds['MONTH(Design.Created)'] = date('n');
        $count = $this->Design->find('count',array('conditions' => $conds));
        $message = array();
        $message['count'] = $count;
        return json_encode($message);
	}
	
/**
 * count arbitrary method
 *
 * @return void
 */
	public function count_arbitrary() {
		$this->loadModel('Arbitrary');
		Configure::write('debug', 0);
		$this->Arbitrary->recursive = -1;
        $this->autoRender = false;
        $conds = array();
        $conds['MONTH(Arbitrary.Created)'] = date('n');
        $count = $this->Arbitrary->find('count',array('conditions' => $conds));
        $message = array();
        $message['count'] = $count;
        return json_encode($message);
	}

/**
 * template method
 *
 * @return void
 */
	public function template() {
		$this->Blog->recursive = 0;
		$this->set('blogs', $this->Paginator->paginate());
	}

/**
 * test method
 *
 * @return void
 */
	public function test() {
		// $this->Blog->recursive = 0;
		// $this->set('blogs', $this->Paginator->paginate());
	}	

}
