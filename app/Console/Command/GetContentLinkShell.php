<?php
App::uses('AppShell', 'Console/Command');
App::uses('ComponentCollection', 'Controller');
App::uses('ContentComponent','Controller/Component');

class GetContentLinkShell extends Shell {

	public $uses = array('Link', 'LinkContent','LinkDomain');

	public function main() {
		set_time_limit(0);
		date_default_timezone_set('Asia/Tokyo');
		//load component
		$component = new ComponentCollection();
		App::import('Component','Content');
		$this->Content = new ContentComponent($component);
		
		$this->Link->recursive = 0;
		$links = $this->Link->find('all');
		if(count($links)>0) {
			foreach($links as $link){
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
				if($link_content == False) {
					$this->Link->LinkContent->create();
				}else {
					$linkContent['LinkContent']['id'] = $link_content['LinkContent']['id'];
				}

				if($this->Link->LinkContent->save($linkContent)){
					// update link ip
					$link_update_ip['Link']['id'] = $link['Link']['id'];
					$link_update_ip['Link']['ip'] = $this->Content->get_remote_ip($this->Content->remainDomain($link['Link']['url']));
					$this->Link->save($link_update_ip);
					$this->out('Get content of link '.$link['Link']['url'].' has been updated.'."\n");
				}else{
					$this->out('Error get content of link '.$link['Link']['url']."\n");
				}
			
				sleep(1);
			}
			$this->out('Done all at: '.date('Y-m-d H:i:s'));
		}
	}
}

?>