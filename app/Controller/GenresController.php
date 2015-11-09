<?php
App::uses('AppController', 'Controller');
/**
 * Genres Controller
 *
 * @property Genre $Genre
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class GenresController extends AppController {

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
		$this->Genre->recursive = 0;
		$this->set('genres', $this->Paginator->paginate());
	}
	
/**
 * download csv method
 *
 * @return void
 */	
	public function download_csv() {
		$this -> export(array(
			'fields' => array('Genre.id', 'Genre.genre', 'Genre.genre_jpn'), 
			'order' => array('Genre.id' => 'desc'), 
			'mapHeader' => 'HEADER_CSV_GENRE', 
			'filename' => date('Y-m-d-H-i-s') . '_BLOGX_GENRE'
		));
	}
	
	/**
	 * add csv method
	 *
	 * @return void
	 */
	public function add_csv() {
		if ($this -> request -> is('post')) {
			$csv = $this -> Upload -> uploadFile('uploads/csv/genres', $this -> request -> data['Genre']['csv']);
			if (!empty($csv['urls'])) {
				try {
					if ($this -> Genre -> importCSV($csv['urls'])) {
						$this -> Session -> setFlash(__('The csv data has been saved.'), 'default', array('class' => 'success'));
						return $this -> redirect(array('action' => 'index'));
					}
					$import_errors = $this -> Genre -> getImportErrors();
					$import_errors = Hash::extract($import_errors, "{n}.validation.url.{n}");
					$this -> set('import_errors', $import_errors);
				} catch (Exception $e) {
					$import_errors = $this -> Genre -> getImportErrors();
					$import_errors = Hash::extract($import_errors, "{n}.validation.url.{n}");
					$this -> set('import_errors', $import_errors);
					$this -> Session -> setFlash(__('Error Importing') . ' ' . $this -> request -> data['Genre']['csv']['name'] . ', ' . __('column name mismatch.'));
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
		if (!$this->Genre->exists($id)) {
			throw new NotFoundException(__('Invalid genre'));
		}
		$options = array('conditions' => array('Genre.' . $this->Genre->primaryKey => $id));
		$this->set('genre', $this->Genre->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Genre->create();
			if ($this->Genre->save($this->request->data)) {
				$this->Session->setFlash(__('The genre has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The genre could not be saved. Please, try again.'));
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
		if (!$this->Genre->exists($id)) {
			throw new NotFoundException(__('Invalid genre'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Genre->save($this->request->data)) {
				$this->Session->setFlash(__('The genre has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The genre could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Genre.' . $this->Genre->primaryKey => $id));
			$this->request->data = $this->Genre->find('first', $options);
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
		$this->Genre->id = $id;
		if (!$this->Genre->exists()) {
			throw new NotFoundException(__('Invalid genre'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Genre->delete()) {
			$this->Session->setFlash(__('The genre has been deleted.'));
		} else {
			$this->Session->setFlash(__('The genre could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
