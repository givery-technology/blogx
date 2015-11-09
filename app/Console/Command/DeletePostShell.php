<?php
App::uses('AppShell', 'Console/Command');
App::uses('ComponentCollection', 'Controller');
App::uses('ContentComponent','Controller/Component');

class DeletePostShell extends Shell {

	public $uses = array('Blog');

	public function main() {
		set_time_limit(0);
		date_default_timezone_set('Asia/Tokyo');
		
		$this->Blog->recursive = 2;
		$conds = array();
		$conds['Blog.category_id'] = 6;
		$blogs = $this->Blog->find('all', array('conditions' => $conds));
		
		$count = 0;
		foreach ($blogs as $blog) {
			foreach ($blog['Post'] as $post) {
				$this->Blog->Post->id = $post['id'];
				if ($this->Blog->Post->delete()) {
					$this->out('delete post:' .$post['title']);
				}
				sleep(1);
				$count++;
			}
		}
		
		
		$this->out('Total Blog:' .count($blogs));
		$this->out('Total Post delete:' .$count);
		
		$this->out('Done all at: '.date('Y-m-d H:i:s'));
	}
}

?>