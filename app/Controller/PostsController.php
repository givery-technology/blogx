<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 */
class PostsController extends AppController {

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
		set_time_limit(0);
		ini_set('memory_limit', '-1'); // no limit
		$this->Post->recursive = 2;
		$this->set('posts', $this->Paginator->paginate());
		
		// search
		$conds = array();
		if($this->request->is('post') && !empty($this->request->data['Search']['keyword'])){
			$search = 1;
			$conds['OR']['Post.title LIKE'] = '%'.mb_strtolower(trim($this->request->data['Search']['keyword']),'UTF-8').'%';
			// $conds['OR']['Post.domain LIKE'] = '%'.mb_strtolower(trim($this->request->data['Keyword']['keyword']),'UTF-8').'%';
			// blog name
			$this->Post->Blog->recursive = 0;
			$blogs = $this->Post->Blog->find('all',array(
				'fields'=>array('Blog.id','Blog.id'),
				'conditions'=>array(
					'OR' => array (
						'Blog.name LIKE'=>'%'.mb_strtolower(trim($this->request->data['Search']['keyword']),'UTF-8').'%',
						'Blog.domain LIKE'=>'%'.mb_strtolower(trim($this->request->data['Search']['keyword']),'UTF-8').'%'
					)
				)
			));
			if($blogs!=false){
				$blog_id = Hash::extract($blogs,'{n}.Blog.id');
				$conds['OR']['Blog.id'] = $blog_id;
			}
			
			$posts = $this->Post->find('all', array('conditions' => $conds, 'order' => 'Post.id DESC', 'limit' => Configure::read('Paginate.search')));
			$this->set(compact('posts', 'search'));
		}
	}

/**
 *  download csv post index
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function download_csv(){	
		Configure::write('Post.HEADER_CSV_VIEW_POSTLIST',Hash::flatten(Configure::read('Post.HEADER_CSV_VIEW_POSTLIST')));
		$this->export(array(
			'fields' => array('Post.id', 'Post.title', 'Post.content', 'Blog.domain'),
			'order' => array('Post.id' => 'desc'),
			'mapHeader' => 'Post.HEADER_CSV_VIEW_POSTLIST',
			'filename' => date('Y-m-d-H-i-s').'_BLOGX_POSTLIST',
			'callbackHeader'=>'header_csv_post',
			'callbackRow'=>'row_csv_post',
		));
	}

/**
 * index no keyword method
 *
 * @return void
 */
	public function no_keyword() {
		$this->Post->recursive = 2;
		$kw_post_id = $this->Post->Keyword->find('list',array('fields'=>array('Keyword.id','Keyword.post_id'),'group'=>'Keyword.post_id'));
		$this->Paginator->settings['Post'] = array('conditions'=>array('Post.id <>'=>$kw_post_id));
		$this->set('posts', $this->Paginator->paginate('Post'));	
		// search		
		if($this->request->is('post')){
			$search = 1;
			$conds_post_no_kw = array();
			$conds_post_no_kw['OR']['Post.title LIKE'] = '%'.mb_strtolower(trim($this->request->data['Keyword']['keyword']),'UTF-8').'%';
			// blog name
			$this->Post->Blog->recursive = 0;
			$blogs = $this->Post->Blog->find('all',array(
				'fields'=>array('Blog.id','Blog.id'),
				'conditions'=>array(
					'OR' => array (
						'Blog.name LIKE'=>'%'.mb_strtolower(trim($this->request->data['Keyword']['keyword']),'UTF-8').'%',
						'Blog.domain LIKE'=>'%'.mb_strtolower(trim($this->request->data['Keyword']['keyword']),'UTF-8').'%'
					)
				)
			));
			if($blogs!=false){
				$blog_id = Hash::extract($blogs,'{n}.Blog.id');
				$conds_post_no_kw['OR']['Blog.id'] = $blog_id;
			}
			$conds_post_no_kw['Post.id <>'] = $kw_post_id;
			$posts = $this->Post->find('all', array('conditions' => $conds_post_no_kw, 'order' => 'Post.id DESC'));
			$this->set(compact('posts', 'search'));
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
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
		$this->set('post', $this->Post->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->loadModel('Arbitrary');
		$arbitraries = $this->Arbitrary->find('all',array('fields'=>array('Arbitrary.prefix','Arbitrary.suffix')));
		$rand = rand(0,count($arbitraries)-1);
		if ($this->request->is('post')) {
			if(count($this->request->data['Post']['title'])>0){
// multi content
				if(count($this->request->data['Keyword']['keyword'])==1 && count($this->request->data['Post']['content'])>1){
					$post['Post']['menu'] = $this->request->data['Post']['menu'][0]; // common menu
					for($j=0;$j<count($this->request->data['Post']['content']);$j++){
						// form data: title, content, blog, pagename, public
						$post['Post']['title'] = $this->request->data['Post']['title'][$j];
						$post['Post']['content'] = $this->request->data['Post']['content'][$j];
						$post['Post']['pagename'] = $this->request->data['Post']['pagename'][$j];
						$post['Post']['blog_id'] = $this->request->data['Post']['blog_id'][$j];
						$post['Post']['public'] = isset($this->request->data['Post']['public'][$j])?$this->request->data['Post']['public'][$j]:0;
						$post['Post']['outlink'] = isset($this->request->data['Post']['outlink'][$j])?$this->request->data['Post']['outlink'][$j]:0;
						$post['Post']['image'] = isset($this->request->data['Post']['image'][$j])?$this->request->data['Post']['image'][$j]:0;
						$this->Post->create();
						if ($this->Post->save($post)) {
							// save keyword
							if(isset($this->request->data['Keyword']['keyword']) && count($this->request->data['Keyword']['keyword'])>0){
								// kotei list
								if(!empty($this->request->data['Post']['kotei_lists'][$j]) && $this->request->data['Post']['kotei_lists'][$j] != 0){
									$this->loadModel('KoteiList');
									// 
									$koteiLists = $this->KoteiList->find('first',array(
										'conditions'=>array(
											'KoteiList.random_group'=>$this->request->data['Post']['kotei_lists'][$j],
											'KoteiList.show' => 0
										),
										'order'=>'rand()'
									));
									$rand = rand(1, 3); // ???
									$this->KoteiList->id = $koteiLists['KoteiList']['id'];
									$this->KoteiList->saveField('show',1);
									
									$kw_lists = Hash::extract($koteiLists,'KoteiList.keyword');
									$url_lists = Hash::extract($koteiLists,'KoteiList.url');
									
									if(!empty($this->request->data['Keyword']['keyword'][$j])){
										$this->request->data['Keyword']['keyword'][$j] = $this->request->data['Keyword']['keyword'][$j].','.implode(',',$kw_lists);
										$this->request->data['Keyword']['url'][$j] = $this->request->data['Keyword']['url'][$j].','.implode(',',$url_lists);
									}else{
										$this->request->data['Keyword']['keyword'][$j] = implode(',',$kw_lists);
										$this->request->data['Keyword']['url'][$j] = implode(',',$url_lists);
									}
								}
								// keyword
								$request_kw = $this->request->data['Keyword']['keyword'][0];
								$data_keywords = array();
								$this->loadModel('Keyword');
								// many keywords
								if(strpos($request_kw,',')){
									$keywords = explode(',',$request_kw);
									$urls = explode(',',$this->request->data['Keyword']['url'][0]);
									$i = 0;
									foreach($keywords as $k=>$keyword){
										$data_keywords[$i]['Keyword']['post_id'] = $this->Post->id;
										// arbitrary
										if(count($arbitraries)>0 && (@$this->request->data['Post']['arbitrary'][$j] == 1)){
											$data_keywords[$i]['Keyword']['keyword'] = $arbitraries[rand(0,count($arbitraries)-1)]['Arbitrary']['prefix'] .' ' .$keyword .' ' .$arbitraries[rand(0,count($arbitraries)-1)]['Arbitrary']['suffix']; 
										} else {
											$data_keywords[$i]['Keyword']['keyword'] = $keyword;
										}
										$data_keywords[$i]['Keyword']['url'] = $urls[$k];
										$data_keywords[$i]['Keyword']['visible'] = 1;
										
										$i++;
									}
									$this->Keyword->saveAll($data_keywords);
								// one keyword
								}else{
									$data_keywords['Keyword']['post_id'] = $this->Post->id;
									// arbitrary
									if(count($arbitraries)>0 && (@$this->request->data['Post']['arbitrary'][$j] == 1)){
										$data_keywords['Keyword']['keyword'] = $arbitraries[rand(0,count($arbitraries)-1)]['Arbitrary']['prefix'] .' ' .$request_kw .' ' .$arbitraries[rand(0,count($arbitraries)-1)]['Arbitrary']['suffix'];
									} else {
										$data_keywords['Keyword']['keyword'] = $request_kw;
									}
									$data_keywords['Keyword']['url'] = $this->request->data['Keyword']['url'][0];
									$data_keywords['Keyword']['visible'] = 1;
									$this->Keyword->create();
									$this->Keyword->save($data_keywords);
								}
							}
							// save outlinklogs
							if(!empty($this->request->data['Post']['outlink'][$j])) {
								$this->loadModel('OutlinkLog');
								$this->loadModel('Outlink');
								$outlink = $this->Outlink->find('first',array('order'=>'rand()'));
								$data_outlinklogs = array();
								$data_outlinklogs['OutlinkLog']['post_id'] = $this->Post->id;
								$data_outlinklogs['OutlinkLog']['outlink_id'] = $outlink['Outlink']['id'];
								$this->OutlinkLog->create();
								$this->OutlinkLog->save($data_outlinklogs);
							}
						}
					}
// multi post or one post or one content
				}else{
					for($j=0;$j<count($this->request->data['Post']['title']);$j++){
						// form data: title, content, blog, pagename, public
						$post['Post']['title'] = $this->request->data['Post']['title'][$j];
						$post['Post']['content'] = $this->request->data['Post']['content'][$j];
						$post['Post']['pagename'] = $this->request->data['Post']['pagename'][$j];
						$post['Post']['menu'] = $this->request->data['Post']['menu'][$j];
						$post['Post']['blog_id'] = $this->request->data['Post']['blog_id'][$j];
						$post['Post']['public'] = isset($this->request->data['Post']['public'][$j])?$this->request->data['Post']['public'][$j]:0;
						$post['Post']['outlink'] = isset($this->request->data['Post']['outlink'][$j])?$this->request->data['Post']['outlink'][$j]:0;
						$post['Post']['image'] = isset($this->request->data['Post']['image'][$j])?$this->request->data['Post']['image'][$j]:0;
						$this->Post->create();
						if ($this->Post->save($post)) {
							// save keyword
							if(isset($this->request->data['Keyword']['keyword']) && count($this->request->data['Keyword']['keyword'])>0){
								// kotei list
								if(!empty($this->request->data['Post']['kotei_lists'][$j]) && $this->request->data['Post']['kotei_lists'][$j] != 0){
									$this->loadModel('KoteiList');
									// 
									$koteiLists = $this->KoteiList->find('first',array(
										'conditions'=>array(
											'KoteiList.random_group'=>$this->request->data['Post']['kotei_lists'][$j],
											'KoteiList.show' => 0
										),
										'order'=>'rand()'
									));
									
									if(count($koteiLists) > 0) {
										$rand = rand(1, 3); // ???
										$this->KoteiList->id = $koteiLists['KoteiList']['id'];
										$this->KoteiList->saveField('show',1);
										
										$kw_lists = Hash::extract($koteiLists,'KoteiList.keyword');
										$url_lists = Hash::extract($koteiLists,'KoteiList.url');
										
										if(!empty($this->request->data['Keyword']['keyword'][$j])){
											$this->request->data['Keyword']['keyword'][$j] = $this->request->data['Keyword']['keyword'][$j].','.implode(',',$kw_lists);
											$this->request->data['Keyword']['url'][$j] = $this->request->data['Keyword']['url'][$j].','.implode(',',$url_lists);
										}else{
											$this->request->data['Keyword']['keyword'][$j] = implode(',',$kw_lists);
											$this->request->data['Keyword']['url'][$j] = implode(',',$url_lists);
										}
									} else {
										 // kotei keyword: all show
										$this->Session->setFlash(__('Kotei Keyword all randomly showed. Please reset.'), 'default', array('class' => 'error'));
										// reset random show
									}
								}
								// keyword
								$request_kw = $this->request->data['Keyword']['keyword'][$j];
								$data_keywords = array();
								$this->loadModel('Keyword');
								// many keywords
								if(strpos($request_kw,',')){
									$keywords = explode(',',$request_kw);
									$urls = explode(',',$this->request->data['Keyword']['url'][$j]);
									$i = 0;
									foreach($keywords as $k=>$keyword){
										$data_keywords[$i]['Keyword']['post_id'] = $this->Post->id;
										// arbitrary
										if(count($arbitraries)>0 && (@$this->request->data['Post']['arbitrary'][$j] == 1)){
											$data_keywords[$i]['Keyword']['keyword'] = $arbitraries[rand(0,count($arbitraries)-1)]['Arbitrary']['prefix'] .' ' .$keyword .' ' .$arbitraries[rand(0,count($arbitraries)-1)]['Arbitrary']['suffix']; 
										} else {
											$data_keywords[$i]['Keyword']['keyword'] = $keyword;
										}
										
										$data_keywords[$i]['Keyword']['url'] = $urls[$k];
										$data_keywords[$i]['Keyword']['visible'] = 1;
										$i++;
									}
									$this->Keyword->saveAll($data_keywords);
								// one keyword
								}else{
									$data_keywords['Keyword']['post_id'] = $this->Post->id;
									// arbitrary
									if(count($arbitraries)>0 && (@$this->request->data['Post']['arbitrary'][$j] == 1)){
										$data_keywords['Keyword']['keyword'] = $arbitraries[rand(0,count($arbitraries)-1)]['Arbitrary']['prefix'] .' ' .$request_kw .' ' .$arbitraries[rand(0,count($arbitraries)-1)]['Arbitrary']['suffix'];
									} else {
										$data_keywords['Keyword']['keyword'] = $request_kw;
									}
									$data_keywords['Keyword']['url'] = $this->request->data['Keyword']['url'][$j];
									$data_keywords['Keyword']['visible'] = 1;
									$this->Keyword->create();
									$this->Keyword->save($data_keywords);
								}
							}
							// save outlinklogs
							if(!empty($this->request->data['Post']['outlink'][$j])) {
								$this->loadModel('OutlinkLog');
								$this->loadModel('Outlink');
								$outlink = $this->Outlink->find('first',array('order'=>'rand()'));
								$data_outlinklogs = array();
								$data_outlinklogs['OutlinkLog']['post_id'] = $this->Post->id;
								$data_outlinklogs['OutlinkLog']['outlink_id'] = $outlink['Outlink']['id'];
								$this->OutlinkLog->create();
								$this->OutlinkLog->save($data_outlinklogs);
							}
							// save imagelogs
							if(!empty($this->request->data['Post']['image'][$j])) {
								$this->loadModel('ImageLog');
								$this->loadModel('Image');
								$image = $this->Image->find('first',array('order'=>'rand()'));
								$data_imagelogs = array();
								$data_imagelogs['ImageLog']['post_id'] = $this->Post->id;
								$data_imagelogs['ImageLog']['image_id'] = $image['Image']['id'];
								$this->ImageLog->create();
								$this->ImageLog->save($data_imagelogs);
							}
						}
					}
				}
			}
			$this->Session->setFlash(__('The post has been saved.'), 'default', array('class' => 'success'));
			return $this->redirect(array('action' => 'index'));
		}
		
		$blogs = $this->Post->Blog->find('all');
		// $blogs = Hash::combine($blogs,'{n}.Blog.id',array('%s [%s]', '{n}.Blog.name', '{n}.Category.name'));
		$blogs = Hash::combine($blogs,array('%s-%s', '{n}.Blog.id', '{n}.Category.code'),array('%s [%s]', '{n}.Blog.name', '{n}.Category.name'));
		$select_default = array_keys(array_slice($blogs, 0, 1));
		$select_default = explode('-',$select_default[0]);
		$select_default = $select_default[1];
		$this->set(compact('blogs','select_default'));
	}

/**
 * add csv method
 *
 * @return void
 */
 // $errors[$i][] = implode(',', $import_errors[$i]['validation']['content'][0]);
	public function add_csv() {
		if ($this -> request -> is('post')) {
			// *Note: check csv file size here 
			$csv = $this -> Upload -> uploadFile(Configure::read('POST.csv_upload_path'), $this -> request -> data['Post']['csv']);
			if (!empty($csv['urls'])) {
				try {
					if ($this -> Post -> importCSV($csv['urls'])) {
						// $this -> Session -> setFlash(__('The posts list has been saved.'), 'default', array('class' => 'success'));
						// return $this -> redirect(array('action' => 'index'));
					}
					$import_errors = $this -> Post -> getImportErrors();
					debug($import_errors);
					$errors = array();
					
					if(count($import_errors) > 0) {
						for($i=0; $i<count($import_errors); $i++) {
							// one error content or title or special character on file csv
							if(count(@$import_errors[$i]['validation']) == 1) {
								if(isset($import_errors[$i]['validation']['content'])) {
									$errors[] = $import_errors[$i]['validation']['content'][0];
								} elseif(isset($import_errors[$i]['validation']['title'])) {
									$errors[] = $import_errors[$i]['validation']['title'][0];
								} elseif(isset($import_errors[$i]['validation']['blog_id'])) {
									$errors[] = $import_errors[$i]['validation']['blog_id'][0];
								} else {
									// $errors[$i] = __('Special characters within csv file');
								}
							} 
						}
					}
					// debug($errors);exit;
					$this -> set('import_errors', $errors);
					// error
					if(count($errors) > 0) {
						$output = implode('<br /> ', array_map(function ($v, $k) { return $k+1 . ':' . $v; }, $errors, array_keys($errors)));
						$this -> Session -> setFlash($output, 'default', array('class' => 'error'));
						// $this -> Session -> setFlash(__('Content is unique'), 'default', array('class' => 'error'));
					} else {
						$this -> Session -> setFlash(__('The posts list has been saved.'), 'default', array('class' => 'success'));
						return $this -> redirect(array('action' => 'index'));
					}
				} catch (Exception $e) {
					$import_errors = $this -> Post -> getImportErrors();
					debug($import_errors);
					$import_errors = Hash::extract($import_errors, "{n}.validation.url.{n}");
					$this -> set('import_errors', $import_errors);
					$this -> Session -> setFlash(implode("\n", $import_errors), 'default', array('class' => 'error'));
					$this -> Session -> setFlash(__('Error Importing') . ' ' . $this -> request -> data['Post']['csv']['name'] . ', ' . __('column name mismatch.'));
				}
			}
		}
	}

/**
 * post csv method
 *
 * @return void
 */
	public function post_csv() {
		$this->layout = 'csv_layout';
		$data = array();
		$data['Header'] = Configure::read('POST_CSV_UPLOAD');
		$this->set(compact('data'));
		
		// $this->export(array(
			// 'mapHeader' => 'POST_CSV_UPLOAD',
			// 'insertHeader' => 'Post.id,Post.title,Post.blog_id,Post.pagename,Post.menu,Post.content,Post.public,Keyword.id,Keyword.keyword,Keyword.url,Keyword.visible',
			// 'filename' => date('Y-m-d-H-i-s').'_BLOGX_POSTCSV',
			// 'conditions' => array('Post.id' => 1),
		// ));
	}
	
/**
 * template csv genre method
 * 
 * 
 * @return void
 */
	public function csv_template_genre() {
		$this->layout = 'csv/post_csv_template_genre';
		$data = array();
		$data['Header'] = Configure::read('POST_CSV_TEMPLATE_GENRE');
		$this->set(compact('data'));
	}	

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Post->save($this->request->data)) {
				if(isset($this->request->data['Keyword']['keyword']) && !empty($this->request->data['Keyword']['keyword'])){
					$data_keywords = array();
					$this->loadModel('Keyword');
					$this->Keyword->deleteAll(array('Keyword.post_id'=>$this->Post->id));
					if(strpos($this->request->data['Keyword']['keyword'],',')){
						$keywords = explode(',',$this->request->data['Keyword']['keyword']);
						$urls = explode(',',$this->request->data['Keyword']['url']);
						$i = 0;
						foreach($keywords as $k=>$keyword){
							$data_keywords[$i]['Keyword']['post_id'] = $this->Post->id;
							$data_keywords[$i]['Keyword']['keyword'] = $keyword;
							$data_keywords[$i]['Keyword']['url'] = $urls[$k];
							$data_keywords[$i]['Keyword']['visible'] = 1;
							$i++;
						}
						$this->Keyword->saveAll($data_keywords);
					}else{
						$data_keywords['Keyword']['post_id'] = $this->Post->id;
						$data_keywords['Keyword']['keyword'] = $this->request->data['Keyword']['keyword'];
						$data_keywords['Keyword']['url'] = $this->request->data['Keyword']['url'];
						$data_keywords['Keyword']['visible'] = 1;
						$this->Keyword->create();
						$this->Keyword->save($data_keywords);
					}
				} else {
					$this->loadModel('Keyword');
					$keywords = $this->Keyword->findByPostId($id);
					if(count($keywords) > 0) {
						$this->Keyword->deleteAll(array('Keyword.post_id' => $id), false);
					}
				}
				$this->Session->setFlash(__('The post has been saved.'), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
		
		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
		$this->request->data = $this->Post->find('first', $options);
		
		$category = $this->Post->Blog->Category->find('first',array(
			'fields'=>array('Category.code'),
			'conditions'=>array('Category.id'=>$this->request->data['Blog']['category_id']))
		);
		
		$this->request->data['Post']['blog_id'] = $this->request->data['Post']['blog_id'].'-'.$category['Category']['code'];
		// debug($this->request->data);exit;
		
		// load keyword
		$this->loadModel('Keyword');
		$keyword = $this->Keyword->find('list',array('fields'=>array('Keyword.keyword', 'Keyword.url'),'conditions'=>array('Keyword.post_id'=>$id)));
		$this->request->data['Keyword']['keyword'] = implode(',',array_keys($keyword));
		$this->request->data['Keyword']['url'] = implode(',',array_values($keyword));
		
		// load blog
		$blogs = $this->Post->Blog->find('all');
		$blogs = Hash::combine($blogs,array('%s-%s', '{n}.Blog.id', '{n}.Category.code'),array('%s [%s]', '{n}.Blog.name', '{n}.Category.name'));
		$select_default = array_keys(array_slice($blogs, 0, 1));
		$select_default = explode('-',$select_default[0]);
		$select_default = $select_default[1];
		
		// load post genre
		$this -> loadModel('Genre');
		$this -> Genre -> recursive = 0;
		$genres = $this -> Genre -> find('all');
		$genres = Hash::combine($genres , '{n}.Genre.id', '{n}.Genre.genre_jpn');
		
		$this->set(compact('blogs', 'select_default', 'genres'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Post->delete()) {
			$this->Session->setFlash(__('The post has been deleted.'), 'default', array('class' => 'success'));
		} else {
			$this->Session->setFlash(__('The post could not be deleted. Please, try again.'), 'default', array('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * public reset all method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function public_reset_all($all = null) {
		if(empty($all)) $all = 0;
		$this->Post->recursive = -1;
		$this->Post->updateAll(
			array('Post.public'=>$all)
		);
		$this->redirect($this->referer());
	}

/**
 * public delete all post method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */	
	// public function delete_all_post($company_id = NULL) {
		// if(!empty($company_id)){
			// $this->Webmaster->updateAll(
				// array('Webmaster.check'=>0),
				// array('Webmaster.company_id'=>$company_id)
			// );
		// }
		// $this->redirect($this->referer());
	// }

/**
 * public reset one status method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */	
	public function status() {
		Configure::write('debug', 0);
		$this->autoRender = false;	
		$this->Post->recursive = -1;
		$this->Post->id = $this->request->data['post_id'];
		$this->Post->saveField('public',$this->request->data['status']);
		
		$message = array();
		$message['status'] = $this->request->data['status'];
		$message['post_id'] = $this->request->data['post_id'];
		return json_encode($message);
	}	

}
