<?php
App::uses('AppController', 'Controller');

/**
 * Setting Controller
 *
 * @package  Setting.Controller
 * @author   ddnb_admin <admin@ddnb.info>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.ddnb.info
 */
class SettingsController extends AppController {
/**
 * Controller name
 *
 * @var string
 * @access public
 */
	public $name = 'Settings';

/**
 * Admin index
 *
 * @return void
 * @access public
 */
	public function index() {
		$this->Setting->recursive = 0;		
		$this->set('settings', $this->Paginator->paginate());
		
		// search
		if($this->request->is('post') && !empty($this->request->data['Setting']['keyword'])){
			$conds = array();
			$search = 1;
			$conds['OR']['Setting.title LIKE'] = '%'.mb_strtolower(trim($this->request->data['Setting']['keyword']),'UTF-8').'%';

			$settings = $this->Setting->find('all', array('conditions' => $conds, 'order' => 'Post.id DESC'));
			$this->set(compact('settings', 'conds'));
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
		if (!$this->Setting->exists($id)) {
			throw new NotFoundException(__('Invalid setting'));
		}
		$options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
		$this->set('setting', $this->Setting->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Setting->create();
			if ($this->Setting->save($this->request->data)) {
				$this->Session->setFlash(__('The setting has been saved.'), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The setting could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
		$input_type = array(
			'text'=>'Text',
			'textarea'=>'Textarea',
			'checkbox'=>'Checkbox',
			'radio'=>'Radio',
			'select'=>'Select',
			'date'=>'Date',
			'datetime'=>'Date Time',
			'multiple'=>'Multiple Checkbox Or Multiple Radio'
		);
		$this->set("input_type", $input_type);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Setting->exists($id)) {
			throw new NotFoundException(__('Invalid setting'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Setting->save($this->request->data)) {
				$this->Session->setFlash(__('The setting has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The setting could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
			$this->request->data = $this->Setting->find('first', $options);
		}
		$input_type = array(
			'text'=>'Text',
			'textarea'=>'Textarea',
			'checkbox'=>'Checkbox',
			'radio'=>'Radio',
			'select'=>'Select',
			'date'=>'Date',
			'datetime'=>'Date Time',
			'multiple'=>'Multiple Checkbox Or Multiple Radio'
		);
		$this->set("input_type", $input_type);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Setting->id = $id;
		if (!$this->Setting->exists()) {
			throw new NotFoundException(__('Invalid setting'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Setting->delete()) {
			$this->Session->setFlash(__('The setting has been deleted.'));
		} else {
			$this->Session->setFlash(__('The setting could not be deleted. Please, try again.'));
		}
		$this->redirect($this->referer());
	}

/**
 * prefix
 *
 * @param string $prefix
 * @return void
 * @access public
 */
	public function prefix($prefix = null) {
		$this->Setting->Behaviors->attach('Params');
		if (!empty($this->request->data) && $this->Setting->saveAll($this->request->data['Setting'])) {
			$this->Session->setFlash(__("Settings updated successfully"), 'default', array('class' => 'success'));
			$this->redirect(array('action' => 'prefix', $prefix));
		}

		$settings = $this->Setting->find('all', array(
			'order' => 'Setting.weight ASC',
			'conditions' => array(
				'Setting.key LIKE' => $prefix . '.%',
				'Setting.editable' => 1,
			),
		));
		
		$this->set(compact('settings'));

		if (count($settings) == 0) {
			$this->Session->setFlash(__("Invalid Setting key"), 'default', array('class' => 'error'));
		}

		$this->set("prefix", $prefix);
	}

}
?>