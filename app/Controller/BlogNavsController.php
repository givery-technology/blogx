<?php
App::uses('AppController', 'Controller');
/**
 * BlogNavs Controller
 *
 * @property BlogNav $BlogNav
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class BlogNavsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->BlogNav->recursive = 0;
		$this->set('blogNavs', $this->Paginator->paginate());
		
		// search
		$conds = array();
		if($this->request->is('post') && !empty($this->request->data['Keyword']['keyword'])){
			$search = 1;
			$conds['OR']['Blog.title LIKE'] = '%'.mb_strtolower(trim($this->request->data['Keyword']['keyword']),'UTF-8').'%';
			// $conds['OR']['Post.domain LIKE'] = '%'.mb_strtolower(trim($this->request->data['Keyword']['keyword']),'UTF-8').'%';
			// blog name
			$this->BlogNav->Blog->recursive = 0;
			$blogs = $this->BlogNav->Blog->find('all',array(
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
				$conds['OR']['Blog.id'] = $blog_id;
			}
			
			$blogNavs = $this->BlogNav->find('all', array('conditions' => $conds, 'order' => 'BlogNav.id DESC'));
			$this->set(compact('blogNavs', 'search'));
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
		if (!$this->BlogNav->exists($id)) {
			throw new NotFoundException(__('Invalid blog nav'));
		}
		$options = array('conditions' => array('BlogNav.' . $this->BlogNav->primaryKey => $id));
		$this->set('blogNav', $this->BlogNav->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BlogNav->create();
			if ($this->BlogNav->save($this->request->data)) {
				$this->Session->setFlash(__('The blog nav has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The blog nav could not be saved. Please, try again.'));
			}
		}
		$blogs = $this->BlogNav->Blog->find('list');
		$this->set(compact('blogs'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->BlogNav->exists($id)) {
			throw new NotFoundException(__('Invalid blog nav'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->BlogNav->save($this->request->data)) {
				$this->Session->setFlash(__('The blog nav has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The blog nav could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('BlogNav.' . $this->BlogNav->primaryKey => $id));
			$this->request->data = $this->BlogNav->find('first', $options);
		}
		$blogs = $this->BlogNav->Blog->find('list');
		$this->set(compact('blogs'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->BlogNav->id = $id;
		if (!$this->BlogNav->exists()) {
			throw new NotFoundException(__('Invalid blog nav'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->BlogNav->delete()) {
			$this->Session->setFlash(__('The blog nav has been deleted.'));
		} else {
			$this->Session->setFlash(__('The blog nav could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
