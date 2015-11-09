<?php
App::uses('AppController', 'Controller');
/**
 * Plogs Controller
 *
 * @property Plog $Plog
 * @property PaginatorComponent $Paginator
 */
class PlogsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	

    public $paginate = array(
        'order' => array(
            'Plog.created' => 'desc'
        )
    );	

/**
 * index method
 *
 * @return void
 */
	public function index($post_id = null) {
		$conds = array();
		if(!empty($post_id)){
			$conds['Plog.post_id'] = $post_id;
		}
		
		$this->Plog->recursive = 0;
		$this->set('plogs', $this->Paginator->paginate($conds));
		
		// search
		if($this->request->is('post') && !empty($this->request->data['Plog']['keyword'])){
			$search = 1;
			$conds['OR']['Post.title LIKE'] = '%'.mb_strtolower(trim($this->request->data['Plog']['keyword']),'UTF-8').'%';
			$conds['OR']['Plog.useragent LIKE'] = '%'.mb_strtolower(trim($this->request->data['Plog']['keyword']),'UTF-8').'%';
			$conds['OR']['Plog.referral LIKE'] = '%'.mb_strtolower(trim($this->request->data['Plog']['keyword']),'UTF-8').'%';		
			$conds['OR']['Plog.ip LIKE'] = '%'.mb_strtolower(trim($this->request->data['Plog']['keyword']),'UTF-8').'%';		
			$conds['OR']['DATE_FORMAT(Plog.created,"%Y%m%d")'] = date('Ymd',strtotime(trim($this->request->data['Plog']['keyword'])));			
		}
		
		$plogs = $this->Plog->find('all', array('conditions' => $conds, 'order' => 'Plog.id DESC'));
		$this->set(compact('plogs', 'search'));
	}

/**
 * download csv page method
 *
 * @return void
 */
	public function download_csv_page(){
		if($this->request->is('post')){
			$this->export(array(
				'fields' => array('Post.title', 'Plog.useragent', 'Plog.referral', 'Plog.ip', 'Plog.created'),
				'conditions'=>array('Plog.id'=>$this->request->data),
				'order' => array('Plog.created' => 'desc'),
				//'page' => $page,
				'mapHeader' => 'HEADER_CSV_VIEW_PLOG',
				//'filename' => date('Y-m-d-H-i-s').'_Plog'
			));			
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
		if (!$this->Plog->exists($id)) {
			throw new NotFoundException(__('Invalid plog'));
		}
		$options = array('conditions' => array('Plog.' . $this->Plog->primaryKey => $id));
		$this->set('plog', $this->Plog->find('first', $options));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Plog->id = $id;
		if (!$this->Plog->exists()) {
			throw new NotFoundException(__('Invalid plog'));
		}
		$this->request->onlyAllow('plog', 'delete');
		if ($this->Plog->delete()) {
			$this->Session->setFlash(__('The plog has been deleted.'));
		} else {
			$this->Session->setFlash(__('The plog could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}	
}
	
?>