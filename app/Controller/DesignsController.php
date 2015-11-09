<?php
App::uses('AppController', 'Controller');
/**
 * Designs Controller
 *
 * @property Design $Design
 * @property PaginatorComponent $Paginator
 */
class DesignsController extends AppController {

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
		$this->Design->recursive = 0;
		$this->set('designs', $this->Paginator->paginate());
		
		$conds = array();
		if($this->request->is('post') && !empty($this->request->data['Keyword']['keyword'])){
			$search = 1;
			$conds['OR']['Design.name LIKE'] = '%'.mb_strtolower(trim($this->request->data['Keyword']['keyword']),'UTF-8').'%';
			
			$designs = $this->Design->find('all', array('conditions' => $conds, 'order' => 'Design.id DESC'));
			$this->set(compact('designs', 'search'));
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
		if (!$this->Design->exists($id)) {
			throw new NotFoundException(__('Invalid design'));
		}
		$options = array('conditions' => array('Design.' . $this->Design->primaryKey => $id));
		$this->set('design', $this->Design->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Design->create();
			if ($this->Design->save($this->request->data)) {
				$this->Session->setFlash(__('The design has been saved.'), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The design could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Design->exists($id)) {
			throw new NotFoundException(__('Invalid design'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Design->save($this->request->data)) {
				$this->Session->setFlash(__('The design has been saved.'), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The design could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Design.' . $this->Design->primaryKey => $id));
			$this->request->data = $this->Design->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Design->id = $id;
		if (!$this->Design->exists()) {
			throw new NotFoundException(__('Invalid design'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Design->delete()) {
			$this->Session->setFlash(__('The design has been deleted.'));
		} else {
			$this->Session->setFlash(__('The design could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
