<?php
App::uses('AppController', 'Controller');
/**
 * Outlinks Controller
 *
 * @property Outlink $Outlink
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class OutlinksController extends AppController {

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
		$this->Outlink->recursive = 0;
		$this->set('outlinks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Outlink->exists($id)) {
			throw new NotFoundException(__('Invalid outlink'));
		}
		$options = array('conditions' => array('Outlink.' . $this->Outlink->primaryKey => $id));
		$this->set('outlink', $this->Outlink->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Outlink->create();
			if ($this->Outlink->save($this->request->data)) {
				$this->Session->setFlash(__('The outlink has been saved.'), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The outlink could not be saved. Please, try again.'), 'default', array('class' => 'error'));
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
		if (!$this->Outlink->exists($id)) {
			throw new NotFoundException(__('Invalid outlink'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Outlink->save($this->request->data)) {
				$this->Session->setFlash(__('The outlink has been saved.'), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The outlink could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Outlink.' . $this->Outlink->primaryKey => $id));
			$this->request->data = $this->Outlink->find('first', $options);
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
		$this->Outlink->id = $id;
		if (!$this->Outlink->exists()) {
			throw new NotFoundException(__('Invalid outlink'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Outlink->delete()) {
			$this->Session->setFlash(__('The outlink has been deleted.'));
		} else {
			$this->Session->setFlash(__('The outlink could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
