<?php
App::uses('AppController', 'Controller');
/**
 * LinkContents Controller
 *
 * @property LinkContent $LinkContent
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class LinkContentsController extends AppController {

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
		$this->LinkContent->recursive = 0;
		$conds = array();
		$conds['LinkContent.history'] = date('Ymd');

		// first load
		$this->Paginator->settings['LinkContent'] = array('conditions'=> $conds, 'order' => array('updated' => 'DESC'), 'limit' => 100);
		$this->set('linkContents', $this->Paginator->paginate('LinkContent'));

		// search
		if($this->request->is('post') && !empty($this->request->data['Search']['keyword'])){
			$search = 1;
			if(!empty($this->request->data['Search']['keyword'])){
				$conds['OR']['Link.keyword LIKE'] = '%'.mb_strtolower(trim($this->request->data['Search']['keyword']),'UTF-8').'%';
				$conds['OR']['Link.url LIKE'] = '%'.mb_strtolower(trim($this->request->data['Search']['keyword']),'UTF-8').'%';
			}

			$linkContents = $this->LinkContent->find('all', array('conditions' => $conds, 'order' => 'LinkContent.updated DESC'));
			$this->set(compact('linkContents', 'search'));
		}
	}
	
/**
 * result method
 *
 * @return void
 */
	public function result() {
		$this->LinkContent->recursive = 0;
		$conds = array();
		$conds['LinkContent.history'] = date('Ymd');

		// first load
		$this->Paginator->settings['LinkContent'] = array('conditions'=> $conds, 'order' => array('updated' => 'DESC'), 'limit' => 100);
		$this->set('linkContents', $this->Paginator->paginate('LinkContent'));

		// search
		if($this->request->is('post') && !empty($this->request->data['Search']['keyword'])){
			$search = 1;
			if(!empty($this->request->data['Search']['keyword'])){
				$conds['OR']['Link.keyword LIKE'] = '%'.mb_strtolower(trim($this->request->data['Search']['keyword']),'UTF-8').'%';
				$conds['OR']['Link.url LIKE'] = '%'.mb_strtolower(trim($this->request->data['Search']['keyword']),'UTF-8').'%';
			}

			$linkContents = $this->LinkContent->find('all', array('conditions' => $conds, 'order' => 'LinkContent.updated DESC'));
			$this->set(compact('linkContents', 'search'));
		}
	}

/**
 * result method
 *
 * @return void
 */
	public function domain_result($link_domain_id = null) {
		$this->LinkContent->recursive = 0;
		$conds = array();
		$conds['LinkContent.history'] = date('Ymd');
		if(!empty($link_domain_id)){
			$conds['Link.link_domain_id'] = $link_domain_id;
		}		
		$this->Paginator->settings  = array('conditions' => $conds, 'order' => 'LinkContent.id DESC', 'limit' => Configure::read('PAGINATION_HUGE'));
		$this->set('linkContents', $this->Paginator->paginate());
		
		$this->loadModel('LinkDomain');
		$link_domain = $this->LinkDomain->find('first',array('conditions'=>array('LinkDomain.id'=>$link_domain_id)));
		$this->set('link_domain', $link_domain);
	}

	public function download_csv_domain($link_domain_id = null) {
		$this->LinkContent->recursive = 0;
		$conds = array();
		$conds['LinkContent.history'] = date('Ymd');
		if(!empty($link_domain_id)){
			$conds['Link.link_domain_id'] = $link_domain_id;
		}

		$fields = array(
			'LinkContent.id', 'LinkContent.title', 'LinkContent.meta_keyword', 'LinkContent.meta_description', 
			'LinkContent.h1_tag', 'LinkContent.keyword_count', 'LinkContent.no_html_content', 'LinkContent.a_tag_count', 
			'LinkContent.www_redirect', 'LinkContent.canonical', 'LinkContent.unique_title', 'LinkContent.unique_meta_keyword',
			'LinkContent.unique_meta_description', 'LinkContent.history',
			'Link.keyword', 'Link.url', 'Link.type', 'Link.link_domain_id'
		);
		
		$this->export(array(
			'fields' => $fields,
			'conditions' => $conds,
			'mapHeader' => 'LINKCONTENT_DOMAIN',
			'filename' => date('Y-m-d-H-i-s') . '_BLOGX_DOMAIN_RESULT',
			'callbackHeader' => 'header_csv_link_content',
			'callbackRow' => 'row_csv_link_content'
		));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->LinkContent->exists($id)) {
			throw new NotFoundException(__('Invalid link content'));
		}
		$options = array('conditions' => array('LinkContent.' . $this->LinkContent->primaryKey => $id));
		$this->set('linkContent', $this->LinkContent->find('first', $options));
		
	}

/**
 * view header method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view_header($id = null) {
		if (!$this->LinkContent->exists($id)) {
			throw new NotFoundException(__('Invalid link content'));
		}
		$options = array('conditions' => array('LinkContent.' . $this->LinkContent->primaryKey => $id));
		$this->set('linkContent', $this->LinkContent->find('first', $options));
		
	}

/**
 * view link method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view_link($id = null) {
		if (!$this->LinkContent->exists($id)) {
			throw new NotFoundException(__('Invalid link content'));
		}
		$options = array('conditions' => array('LinkContent.' . $this->LinkContent->primaryKey => $id));
		$this->set('linkContent', $this->LinkContent->find('first', $options));
		
	}
	
/**
 * view link onpage method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view_link_onpage($id = null) {
		if (!$this->LinkContent->exists($id)) {
			throw new NotFoundException(__('Invalid link content'));
		}
		$options = array('conditions' => array('LinkContent.' . $this->LinkContent->primaryKey => $id));
		$this->set('linkContent', $this->LinkContent->find('first', $options));
		
	}

/**
 * code method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function code($id = null) {
		if (!$this->LinkContent->exists($id)) {
			throw new NotFoundException(__('Invalid link content'));
		}
		$options = array('conditions' => array('LinkContent.' . $this->LinkContent->primaryKey => $id));
		$this->set('linkContent', $this->LinkContent->find('first', $options));
	}

/**
 * cache method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function cache($id = null) {
		if (!$this->LinkContent->exists($id)) {
			throw new NotFoundException(__('Invalid link content'));
		}
		$options = array('conditions' => array('LinkContent.' . $this->LinkContent->primaryKey => $id));
		$this->set('linkContent', $this->LinkContent->find('first', $options));
		$this->layout = 'no_layout';
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->LinkContent->create();
			if ($this->LinkContent->save($this->request->data)) {
				$this->Session->setFlash(__('The link content has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The link content could not be saved. Please, try again.'));
			}
		}
		$links = $this->LinkContent->Link->find('list');
		$this->set(compact('links'));
	}
	
/**
 * add check method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function add_check() {
		if ($this -> request -> is('post')) {
			$check_ids = array();
			if (isset($this -> request -> data['Link'])) {
				$link_data = array();
				foreach ($this -> request -> data['Link'] as $key => $link) {
					$link_data['Link']['url'] = urldecode(trim($link));
					$link_data['Link']['keyword'] = $this->Content->hankakuSpace($this->request->data['Check']['keyword']);
					// domain strip http://wwww & url strip http://
					$domain = $this->Url->remainDomain($link);
					$url = $this->Url->remainUrl($link);
					// get domain ip
					$link_data['Link']['ip'] = $this->Content->get_remote_ip($domain);
					// check domain or subdomain
					$domains = explode('.',$domain);
					if(count($domains)>2){
						if(trim($domains[0])!='www'){
							$link_data['Link']['subdomain'] = trim($domains[0]);
							$link_data['Link']['domain'] = str_replace($link_data['Link']['subdomain'].'.','',$domain);
						}else{
							$domain = str_replace('www.','',$domain);
						}
					}else{
						$link_data['Link']['domain'] = $domain;
					}
					// url path or sub directory
					$link_data['Link']['path'] = str_replace('http://'.$url,'', $link_data['Link']['url']);
					// link domain
					$this->loadModel('LinkDomain');
					$linkDomain_data = array();
					$conds = array();
					$conds['LinkDomain.domain'] = $domain;
					$link_domain = $this->LinkDomain->find('first', array('conditions' => $conds));
					// domain exit -> get id else save new 
					if(count($link_domain)>1) {
						$link_data['Link']['link_domain_id'] = $link_domain['LinkDomain']['id'];
					} else {
						$linkDomain_data['LinkDomain']['domain'] = $domain;
						// save to link domain
						$this->LinkDomain->create();
						$this->LinkDomain->save($linkDomain_data);
					}
					
					// save to Link
					$this->loadModel('Link');
					$this->Link->create();
					$this->request->data['Link']['link_domain_id'] = $this->LinkDomain->id;
					if ($this->Link->save($link_data)) {
						// $this->Session->setFlash($key .__('The link has been saved.'), 'default', array('class' => 'success'));
						$flash_success[] = $key .' ' .__('Saved');
						// return $this->redirect(array('action' => 'index'));
					} else {
						// $this->Session->setFlash($key .__('The link could not be saved. Please, try again.'), 'default', array('class' => 'error'));
						$flash_error[] = $key .' ' .__('Duplicated');
					}
				}
				
			} else {
				$this -> Session -> setFlash(__('Error.Please, try again.'), 'default', array('class' => 'error'));
			}
			
			if (count($flash_error) > 0) {
				$this->Session->setFlash(implode('<br />',$flash_error), 'default', array('class' => 'error'));
			} else {
				$this->Session->setFlash(implode('<br />',$flash_success), 'default', array('class' => 'success'));
			}
			
			$this -> redirect($this -> referer());
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
		if (!$this->LinkContent->exists($id)) {
			throw new NotFoundException(__('Invalid link content'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->LinkContent->save($this->request->data)) {
				$this->Session->setFlash(__('The link content has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The link content could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('LinkContent.' . $this->LinkContent->primaryKey => $id));
			$this->request->data = $this->LinkContent->find('first', $options);
		}
		$links = $this->LinkContent->Link->find('list');
		$this->set(compact('links'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->LinkContent->id = $id;
		if (!$this->LinkContent->exists()) {
			throw new NotFoundException(__('Invalid link content'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->LinkContent->delete()) {
			$this->Session->setFlash(__('The link content has been deleted.'));
		} else {
			$this->Session->setFlash(__('The link content could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function http_response(){
		Configure::write('debug', 0);
		$this->autoRender = false;
		
		$url = $this->request->data['url'];
		$status = $this->request->data['status'];
		$wait = $this->request->data['wait'];
		
		$view = new View($this);
		$this->Html = $view->loadHelper('Html');
		
		if($this->Url->http_response($url, $status, $wait)!=0){
			return $this->Html->image('tick.png',array('width'=>15));
		}else{
			return $this->Html->image('cross.png',array('width'=>15));
		}
	}

	public function check_outlink($id, $redirect = true){
		if ($this->LinkContent->exists($id)) {
			$options = array('conditions' => array('LinkContent.' . $this->LinkContent->primaryKey => $id));
			$linkContent = $this->LinkContent->find('first', $options);			
			$all_links = $this->Url->allLink($linkContent['LinkContent']['a_tag'],$linkContent['Link']['url'],$linkContent['Link']['domain']);
			$link_content_outlink = array();
			$i = 0;
			foreach($all_links as $all_link):
				$link_content_outlink[$i]['LinkContentOutlink']['link_content_id'] = $id;
				$link_content_outlink[$i]['LinkContentOutlink']['keyword'] = strip_tags($all_link[3][0]);

				if(strpos(' '.$all_link[1][0],'http') != False) {
					$link_content_outlink[$i]['LinkContentOutlink']['url'] = $all_link[1][0];
				} else {
					$link_content_outlink[$i]['LinkContentOutlink']['url'] = 'http://'.$linkContent['Link']['domain'].'/'.$all_link[1][0];
				}

				$url = (strpos(' '.$all_link[1][0],'http') != False)? $all_link[1][0] : 'http://'.$linkContent['Link']['domain'].'/'.$all_link[1][0];
				$status = 200;
				$wait = (strpos(' '.$all_link[1][0],'http') != False)? 3: 1;
				if($this->Url->http_response($url, $status, $wait)!=0){
					$link_content_outlink[$i]['LinkContentOutlink']['status'] = 1;
				}else{
					$link_content_outlink[$i]['LinkContentOutlink']['status'] = 0;
				}

				//check link content outlink exists
				$check_link = $this->LinkContent->LinkContentOutlink->find('first',array(
					'conditions'=>array(
						'LinkContentOutlink.link_content_id' => $id,
						'LinkContentOutlink.keyword' => strip_tags($all_link[3][0]),
						'LinkContentOutlink.url' => $link_content_outlink[$i]['LinkContentOutlink']['url']
					)
				));
				if($check_link!=false){
					$link_content_outlink[$i]['LinkContentOutlink']['id'] = $check_link['LinkContentOutlink']['id'];
				}
				$i++;
			endforeach;
			//save to db
			if(count($link_content_outlink)>0){
				if ($this->LinkContent->LinkContentOutlink->saveAll($link_content_outlink)) {
					$this->Session->setFlash(__('The link content outlink has been updated.'));
				} else {
					$this->Session->setFlash(__('The link content outlink could not be saved. Please, try again.'));
				}
			}
		}
		if($redirect)
			return $this->redirect($this->referer());
	}
	
	public function check_outlink_all(){
		$linkContents = $this->LinkContent->find('all',array('fields'=>array('LinkContent.id')));
		foreach($linkContents as $linkContent){
			$this->check_outlink($linkContent['LinkContent']['id'],false);
		}
		$this->redirect($this->referer());
	}
}
