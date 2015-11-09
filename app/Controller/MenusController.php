<?php
App::uses('AppController', 'Controller');
/**
 * Menus Controller
 *
 * @property Menu $Menu
 * @property PaginatorComponent $Paginator
 */
class MenusController extends AppController {

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
		$this->Menu->recursive = 0;
		$this->set('menus', $this->Paginator->paginate());
		
		// search
		$conds = array();
		if($this->request->is('post') && !empty($this->request->data['Keyword']['keyword'])){
			$search = 1; // show paging on view
			$conds['OR']['Menu.name LIKE'] = '%'.mb_strtolower(trim($this->request->data['Keyword']['keyword']),'UTF-8').'%';
			
			$menus = $this->Menu->find('all', array('conditions' => $conds, 'order' => 'Menu.id DESC'));
			$this->set(compact('menus', 'search'));
		}
	}
	
/**
 * download csv method
 *
 * @return void
 */	
	public function download_csv() {
		$this -> export(array(
			'fields' => array('Menu.id', 'Menu.blog_id', 'Menu.name'), 
			'order' => array('Menu.id' => 'desc'), 
			'mapHeader' => 'HEADER_CSV_MENU', 
			'filename' => date('Y-m-d-H-i-s') . '_BLOGX_MENU'
		));
	}
	
/**
 * add csv method
 *
 * @return void
 */
	public function add_csv() {
		if ($this -> request -> is('post')) {
			$csv = $this -> Upload -> uploadFile('uploads/csv/menu', $this -> request -> data['Menu']['csv']);
			if (!empty($csv['urls'])) {
				try {
					if ($this -> Menu -> importCSV($csv['urls'])) {
						$this -> Session -> setFlash(__('The csv data has been saved.'), 'default', array('class' => 'success'));
						return $this -> redirect(array('action' => 'index'));
					}
					$import_errors = $this -> Menu -> getImportErrors();
					$import_errors = Hash::extract($import_errors, "{n}.validation.url.{n}");
					$this -> set('import_errors', $import_errors);
					$this -> Session -> setFlash(__('The csv data has been saved.'), 'default', array('class' => 'success'));
					return $this -> redirect(array('action' => 'index'));
				} catch (Exception $e) {
					$import_errors = $this -> Menu -> getImportErrors();
					$import_errors = Hash::extract($import_errors, "{n}.validation.url.{n}");
					$this -> set('import_errors', $import_errors);
					$this -> Session -> setFlash(__('Error Importing') . ' ' . $this -> request -> data['Menu']['csv']['name'] . ', ' . __('column name mismatch.'));
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
		if (!$this->Menu->exists($id)) {
			throw new NotFoundException(__('Invalid menu'));
		}
		$options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
		$this->set('menu', $this->Menu->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Menu->create();
			if ($this->Menu->save($this->request->data)) {
				$this->Session->setFlash(__('The menu has been saved.'), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
		$blogs = $this->Menu->Blog->find('list');
		$posts = $this->Menu->Post->find('list');
		$this->set(compact('blogs', 'posts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Menu->exists($id)) {
			throw new NotFoundException(__('Invalid menu'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Menu->save($this->request->data)) {
				$this->Session->setFlash(__('The menu has been saved.'), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
			$this->request->data = $this->Menu->find('first', $options);
		}
		$blogs = $this->Menu->Blog->find('list');
		$posts = $this->Menu->Post->find('list');
		$this->set(compact('blogs', 'posts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Menu->id = $id;
		if (!$this->Menu->exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Menu->delete()) {
			$this->Session->setFlash(__('The menu has been deleted.'), 'default', array('class' => 'success'));
		} else {
			$this->Session->setFlash(__('The menu could not be deleted. Please, try again.'), 'default', array('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
