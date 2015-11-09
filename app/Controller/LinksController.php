<?php

App::uses('AppController', 'Controller');

/**
 * Links Controller
 *
 * @property Link $Link
 * @property PaginatorComponent $Paginator
 */
class LinksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	public $paginate = array(
		'order' => array(
			'Link.created' => 'desc'
		)
	);

/**
* index method
*
* @return void
*/
	public function index() {
		$conds = array();
		$this->Link->recursive = 0;
		$this->Paginator->settings  = array('conditions' => $conds, 'order' => 'Link.updated DESC', 'limit' => '100');
		$this->set('links', $this->Paginator->paginate());
		
		// search
		$conds = array();
		if($this->request->is('post') && !empty($this->request->data['Search']['keyword'])){
			$search = 1;
			if(!empty($this->request->data['Search']['keyword'])){
				$conds['OR']['Link.keyword LIKE'] = '%'.mb_strtolower(trim($this->request->data['Search']['keyword']),'UTF-8').'%';
				$conds['OR']['Link.url LIKE'] = '%'.mb_strtolower(trim($this->request->data['Search']['keyword']),'UTF-8').'%';
			}
			
			$links = $this->Link->find('all', array('conditions' => $conds, 'order' => 'Link.updated DESC'));
			$this->set(compact('links', 'search'));
		}
	}

/**
* link domain method
*
* @return void
*/
	public function link_domain($link_domain_id = null) {
		$conds = array();
		$this->Link->recursive = 0;
		if(!empty($link_domain_id)){
			$conds['Link.link_domain_id'] = $link_domain_id;
		}		
		$this->Paginator->settings  = array('conditions' => $conds, 'order' => 'Link.id DESC', 'limit' => Configure::read('PAGINATION_HUGE'));
		$this->set('links', $this->Paginator->paginate());
		
		$this->loadModel('LinkDomain');
		$link_domain = $this->LinkDomain->find('first',array('conditions'=>array('LinkDomain.id'=>$link_domain_id)));
		$this->set('link_domain', $link_domain);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			if(!empty($this->request->data)){
				$this->request->data['Link']['url'] = urldecode(trim($this->request->data['Link']['url']));
				$this->request->data['Link']['keyword'] = $this->Content->hankakuSpace($this->request->data['Link']['keyword']);
				// domain strip http://wwww & url strip http://
				$domain = $this->Url->remainDomain($this->request->data['Link']['url']);
				$url = $this->Url->remainUrl($this->request->data['Link']['url']);
				// get domain ip
				$this->request->data['Link']['ip'] = $this->Content->get_remote_ip($domain);
				// check domain or subdomain
				$domains = explode('.',$domain);
				if(count($domains)>2){
					if(trim($domains[0])!='www'){
						$this->request->data['Link']['subdomain'] = trim($domains[0]);
						$this->request->data['Link']['domain'] = str_replace($this->request->data['Link']['subdomain'].'.','',$domain);
					}else{
						$domain = str_replace('www.','',$domain);
					}
				}else{
					$this->request->data['Link']['domain'] = $domain;
				}
				// url path or sub directory
				$this->request->data['Link']['path'] = str_replace('http://'.$url,'',$this->request->data['Link']['url']);
				// link domain
				$this->loadModel('LinkDomain');
				$conds = array();
				$conds['LinkDomain.domain'] = $domain;
				$link_domain = $this->LinkDomain->find('first', array('conditions' => $conds));
				// domain exit -> get id else save new 
				if(count($link_domain)>1) {
					$this->LinkDomain->id = $link_domain['LinkDomain']['id'];
				} else {
					$this->request->data['LinkDomain']['domain'] = $domain;
					// save to link domain
					$this->LinkDomain->create();
					$this->LinkDomain->save($this->request->data);
				}
			}
			// save to Link
			$this->Link->create();
			$this->request->data['Link']['link_domain_id'] = $this->LinkDomain->id;
			if ($this->Link->save($this->request->data)) {
				$this->Session->setFlash(__('The link has been saved.'), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The link could not be saved. Please, try again.'), 'default', array('class' => 'error'));
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
		if (!$this->Link->exists($id)) {
			throw new NotFoundException(__('Invalid link'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Link->save($this->request->data)) {
				$this->Session->setFlash(__('The link has been saved.'), 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The link could not be saved. Please, try again.'), 'default', array('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Link.' . $this->Link->primaryKey => $id));
			$this->request->data = $this->Link->find('first', $options);
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
		if (!$this->Link->exists($id)) {
			throw new NotFoundException(__('Invalid link'));
		}
		$options = array('conditions' => array('Link.' . $this->Link->primaryKey => $id));
		$this->set('link', $this->Link->find('first', $options));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Link->id = $id;
		if (!$this->Link->exists()) {
			throw new NotFoundException(__('Invalid link'));
		}
	
		if ($this->Link->delete()) {
			$this->Session->setFlash(__('The link has been deleted.'), 'default', array('class' => 'success'));
		} else {
			$this->Session->setFlash(__('The link could not be deleted. Please, try again.'), 'default', array('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * get all contents method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function get_all_content() {
		$this->Link->recursive = 0;
		$links = $this->Link->find('all', array('fields' => array('Link.id')));
		foreach($links as $link){
			$this->get_content($link['Link']['id'], False);
		}
		$this->Session->setFlash(__('Get content all has been updated.'), 'default', array('class' => 'success'));
		return $this->redirect(array('action' => 'index'));
	}	

/**
 * get content method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function get_content($id = null, $redirect = true) {
		set_time_limit(0);
		$this->Link->recursive = 0;
		$link = $this->Link->findById($id);
		
		// get link content
		$content = $this->Content->getContentLink($link['Link']['url'], $link['Link']['keyword']);
		$linkContent['LinkContent']['link_id'] = $link['Link']['id'];
		$linkContent['LinkContent']['header'] = $content['header'];
		$linkContent['LinkContent']['www_redirect'] = $content['www_redirect'];
		$linkContent['LinkContent']['title'] = $content['title'];
		$linkContent['LinkContent']['meta_keyword'] = $content['keywords'];
		$linkContent['LinkContent']['meta_description'] = $content['description'];
		$linkContent['LinkContent']['h1_tag'] = strip_tags($content['h1_tag']);
		$linkContent['LinkContent']['a_tag'] = $content['a_tag'];
		$linkContent['LinkContent']['a_tag_count'] = $content['a_tag_count'];
		$linkContent['LinkContent']['canonical'] = $content['canonical'];
		$linkContent['LinkContent']['keyword_count'] = $content['keyword_count'];
		$linkContent['LinkContent']['keyword_count_body'] = $content['keyword_count_body'];
		$linkContent['LinkContent']['html_content'] = $content['html_content'];
		$linkContent['LinkContent']['no_html_content'] = $content['no_html_content'];
		$linkContent['LinkContent']['history'] = date('Ymd');
		
		// unique check
		$link_domains = $this->Link->find('all',array('conditions'=>array('Link.id <>'=>$link['Link']['id'],'Link.link_domain_id'=>$link['Link']['link_domain_id'])));
		if($link_domains==false){
			$linkContent['LinkContent']['unique_title'] = 1;
			$linkContent['LinkContent']['unique_meta_keyword'] = 1;
			$linkContent['LinkContent']['unique_meta_description'] = 1;
		}else{
			$link_ids = Hash::extract($link_domains,'{n}.Link.id');
			$link_contents = $this->Link->LinkContent->find('all',array(
				'fields'=>array('LinkContent.id','LinkContent.title','LinkContent.meta_keyword','LinkContent.meta_description',),
				'conditions'=>array(
					'LinkContent.link_id'=>$link_ids
				)
			));
			if($link_contents==false){
				$linkContent['LinkContent']['unique_title'] = 1;
				$linkContent['LinkContent']['unique_meta_keyword'] = 1;
				$linkContent['LinkContent']['unique_meta_description'] = 1;
			}else{
				$check_title = 1;
				$check_keyword = 1;
				$check_description = 1;
				foreach($link_contents as $link_content){
					if($content['title']==$link_content['LinkContent']['title']){
						$check_title = 0;
					}
					
					if($content['keywords']==$link_content['LinkContent']['meta_keyword']){
						$check_keyword = 0;
					}

					if($content['description']==$link_content['LinkContent']['meta_description']){
						$check_description = 0;
					}
				}
				$linkContent['LinkContent']['unique_title'] = $check_title;
				$linkContent['LinkContent']['unique_meta_keyword'] = $check_keyword;
				$linkContent['LinkContent']['unique_meta_description'] = $check_description;
			}
		}

		$conds = array();
		$conds['LinkContent.link_id'] = $link['Link']['id'];
		$conds['LinkContent.history'] = date('Ymd');
		$link_content = $this->Link->LinkContent->find('first',array('conditions' => $conds));

		// create or update to link_content
		if($link_content == False){
			$this->Link->LinkContent->create();
		}else{
			$linkContent['LinkContent']['id'] = $link_content['LinkContent']['id'];
		}

		if($this->Link->LinkContent->save($linkContent)){
			// update link ip
			$link_update_ip['Link']['id'] = $link['Link']['id'];
			$link_update_ip['Link']['ip'] = $this->Content->get_remote_ip($this->Url->remainDomain($link['Link']['url']));
			$this->Link->save($link_update_ip);
			$this->Session->setFlash(__('Get content of link '.$link['Link']['url'].' has been updated.'), 'default', array('class' => 'success'));
		}else{
			$this->Session->setFlash(__('Error get content of link '.$link['Link']['url']), 'default', array('class' => 'error'));
		}
		if($redirect==true){
			return $this->redirect($this->referer());
		}
	}

/**
* link_content method
*
* @return void
*/
	public function link_content() {
		$conds = array();
		$this->Link->LinkContent->recursive = 0;
			$this->Paginator->settings['LinkContent']  = array('conditions' => $conds, 'order' => 'LinkContent.id DESC');
		$this->set('linkContents', $this->Paginator->paginate('LinkContent'));
	}

/**
* view_content_link method
*
* @return void
*/
	public function view_content_link($link_content_id = null) {
		$this->Link->LinkContent->recursive = 0;
		$linkContent = $this->Link->LinkContent->findById($link_content_id);
		$linkContent['LinkContent']['html_content'] = mb_convert_encoding(trim($linkContent['LinkContent']['html_content']),"UTF-8", "EUC-JP, UTF-8, ASCII, JIS, eucjp-win, sjis-win");
		$this->set(compact('linkContent'));
	}
}

?>