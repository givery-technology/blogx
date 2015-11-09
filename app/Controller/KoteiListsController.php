<?php
App::uses('AppController', 'Controller');
/**
 * KoteiLists Controller
 *
 * @property KoteiList $KoteiList
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class KoteiListsController extends AppController {

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
		// $this->Paginator->settings = array('order' => array('id' => 'DESC'));
		$this -> Paginator -> settings = array('limit' => 1000, 'order' => array('updated' => 'DESC'));
		$this -> KoteiList -> recursive = 0;
		$this -> set('koteiLists', $this -> Paginator -> paginate());
	}

	/**
	 * reset method
	 *
	 * @return void
	 */
	public function reset_all_show() {
		$this -> KoteiList -> updateAll(array('KoteiList.show' => 0));
		return $this -> redirect(array('action' => 'index'));
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if (!$this -> KoteiList -> exists($id)) {
			throw new NotFoundException(__('Invalid kotei list'));
		}
		$options = array('conditions' => array('KoteiList.' . $this -> KoteiList -> primaryKey => $id));
		$this -> set('koteiList', $this -> KoteiList -> find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this -> request -> is('post')) {
			$this -> KoteiList -> create();
			if ($this -> KoteiList -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The kotei list has been saved.'), 'default', array('class' => 'success'));
				return $this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The kotei list could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add_csv() {
		if ($this -> request -> is('post')) {
			$csv = $this -> Upload -> uploadFile('uploads/csv/kotei_lists', $this -> request -> data['KoteiList']['csv']);
			if (!empty($csv['urls'])) {
				try {

					if ($this -> KoteiList -> importCSV($csv['urls'])) {
						$this -> Session -> setFlash(__('The kotei list has been saved.'), 'default', array('class' => 'success'));
						return $this -> redirect(array('action' => 'index'));
					}
					$import_errors = $this -> KoteiList -> getImportErrors();
					$import_errors = Hash::extract($import_errors, "{n}.validation.url.{n}");
					$this -> set('import_errors', $import_errors);
				} catch (Exception $e) {
					$import_errors = $this -> KoteiList -> getImportErrors();
					$import_errors = Hash::extract($import_errors, "{n}.validation.url.{n}");
					$this -> set('import_errors', $import_errors);
					$this -> Session -> setFlash(__('Error Importing') . ' ' . $this -> request -> data['KoteiList']['csv']['name'] . ', ' . __('column name mismatch.'));
				}
			}
		}
	}

	public function download_csv() {
		$this -> export(array('fields' => array('KoteiList.id', 'KoteiList.keyword', 'KoteiList.url'), 'order' => array('KoteiList.id' => 'desc'), 'mapHeader' => 'HEADER_CSV_VIEW_KOTEILIST', 'filename' => date('Y-m-d-H-i-s') . '_BLOGX_KOTEILIST'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if (!$this -> KoteiList -> exists($id)) {
			throw new NotFoundException(__('Invalid kotei list'));
		}
		if ($this -> request -> is(array('post', 'put'))) {
			if ($this -> KoteiList -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The kotei list has been saved.'), 'default', array('class' => 'success'));
				return $this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The kotei list could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('KoteiList.' . $this -> KoteiList -> primaryKey => $id));
			$this -> request -> data = $this -> KoteiList -> find('first', $options);
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
		$this -> KoteiList -> id = $id;
		if (!$this -> KoteiList -> exists()) {
			throw new NotFoundException(__('Invalid kotei list'));
		}
		$this -> request -> onlyAllow('post', 'delete');
		if ($this -> KoteiList -> delete()) {
			$this -> Session -> setFlash(__('The kotei list has been deleted.'), 'default', array('class' => 'success'));
		} else {
			$this -> Session -> setFlash(__('The kotei list could not be deleted. Please, try again.'), 'default', array('class' => 'success'));
		}
		return $this -> redirect(array('action' => 'index'));
	}

}
