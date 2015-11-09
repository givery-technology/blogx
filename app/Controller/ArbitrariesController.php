<?php
App::uses('AppController', 'Controller');
/**
 * Arbitraries Controller
 *
 * @property Arbitrary $Arbitrary
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ArbitrariesController extends AppController {

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
		$this->Arbitrary->recursive = 0;
		$this->set('arbitraries', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Arbitrary->exists($id)) {
			throw new NotFoundException(__('Invalid arbitrary'));
		}
		$options = array('conditions' => array('Arbitrary.' . $this->Arbitrary->primaryKey => $id));
		$this->set('arbitrary', $this->Arbitrary->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Arbitrary->create();
			if ($this->Arbitrary->save($this->request->data)) {
				$this->Session->setFlash(__('The arbitrary has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The arbitrary could not be saved. Please, try again.'));
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
		if (!$this->Arbitrary->exists($id)) {
			throw new NotFoundException(__('Invalid arbitrary'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Arbitrary->save($this->request->data)) {
				$this->Session->setFlash(__('The arbitrary has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The arbitrary could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Arbitrary.' . $this->Arbitrary->primaryKey => $id));
			$this->request->data = $this->Arbitrary->find('first', $options);
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
		$this->Arbitrary->id = $id;
		if (!$this->Arbitrary->exists()) {
			throw new NotFoundException(__('Invalid arbitrary'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Arbitrary->delete()) {
			$this->Session->setFlash(__('The arbitrary has been deleted.'));
		} else {
			$this->Session->setFlash(__('The arbitrary could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
