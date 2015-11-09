<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
		'Auth' => array(
			'authError' => 'Did you really think you are allowed to see that?'
		),
		'Session',
		'Cookie',
		'Email',
		'RequestHandler',
		'Paginator',
		'Upload',
		'FileManager',
		'Url',
		'Content',
		'Input',
		'Security',
	);
	
	// Load Helper
	public $helpers = array('Session','Form','Html','Js','Layout','Fck', 'SettingsForm');
	
	public $paginate = array('limit' => 50, 'order' => array('updated' => 'DESC'));
	
	public function beforeFilter() {
		$this->Paginator->settings = $this->paginate;
		parent::beforeFilter();
		$this->_setupAuth();
		$this->_setupLayout();
		
		// search input
		if(isset($this->request->data['Search']['keyword'])) {
			$this->request->data['Search']['keyword'] = $this->Input->ddnbCheck($this->request->data['Search']['keyword']);
		}
	}
	
	public function beforeRender() {
		parent::beforeRender();
		if(isset($this->request->data['User']['password'])){
			unset($this->request->data['User']['password']);
		}
	}
	
	public function _setupLayout(){
	}

	public function _setupAuth() {
		if(!$this->Auth->user()){
			$this->Auth->loginAction = array('admin'=>false,'controller' => 'users','action' => 'login');
			$this->Auth->authenticate = array(
				'Form' => array('userModel' => 'User', 'fields' => array('username' => 'email', 'password' => 'password'))
			);
			AuthComponent::$sessionKey = 'Auth.User.user';
		}else{
			$this->Auth->allow('*');
		}
	}

	// CSV download filename
	public function export($options = null) {
		$this->autoRender = false;
		$modelClass = $this->modelClass;
		$this->response->type('Content-Type: text/csv');
		if(isset($options['filename'])){
			$this->response->download(strtolower($options['filename']) . '.csv');
			unset($options['filename']);
		}else{
			$this->response->download(date('Y-m-d_H-i-s').'_'.strtolower(Inflector::pluralize($modelClass)) . '.csv');
		}
		$this->response->body($this->$modelClass->exportCSV($options));
	}
}
