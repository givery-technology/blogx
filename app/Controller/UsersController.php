<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	
/**
* login method
*
* @return void
*/	
	public function login() {
		$login_url = 'https://' .$_SERVER['SERVER_NAME'] .$this->here;
		if($_SERVER['SERVER_PORT'] == 80) {
			$this->redirect($login_url);
		}
		
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				// log
				$Log = ClassRegistry::init('Log');
				$data_log['user_id'] = $this->Session->read('Auth.User.user.id');
				$data_log['memo'] = 'login';
				$data_log['ip'] = $this->request->clientIp();
				$data_log['useragent'] = $this->request->header('User-Agent');
				$data_log['referer'] = $this->request->referer();
				$Log -> create();
				$Log -> save($data_log);
				
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Username or password is incorrect. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
	}
	
/**
* logout method
*
* @return void
*/		
	public function logout() {
	    $this->Session->destroy();
		$this->redirect($this->Auth->logout());
	}	

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
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
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			 # Hash user password with md5
            if($this->request->data['User']['password'] != '') {
            	// Configure::read('Security.salt')
                $this->request->data['User']['password'] = Security::hash($this->request->data['User']['password'], 'sha1', Configure::read('Security.salt')); 
            }else{
                $User = $this->User->read(null, $id);
                $this->request->data['User']['password'] = $User['User']['password'];
            }
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'), 'default', array('class' => 'success'));
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}

