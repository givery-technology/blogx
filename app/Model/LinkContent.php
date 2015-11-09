<?php
App::uses('AppModel', 'Model');
App::uses('KeywordHelper', 'View/Helper');
/**
 * LinkContent Model
 *
 * @property Genre $Genre
 */
class LinkContent extends AppModel {

	public $belongsTo = array(
		'Link' => array(
			'className' => 'Link',
			'foreignKey' => 'link_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'LinkContentOutlink' => array(
			'className' => 'LinkContentOutlink',
			'foreignKey' => 'link_content_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	public $actsAs = array(
		'CsvExport' => array(
			'delimiter' => ',', //The delimiter for the values, default is ;
			'enclosure' => '"', //The enclosure, default is "
			'max_execution_time' => 360, //Increase for Models with lots of data, has no effect is php safemode is enabled.
			'encoding' => 'utf8' //Prefixes the return file with a BOM and attempts to utf_encode() data
		)
	);

	public function header_csv_link_content($headers, $mapHeader) {
		for ($i = 1; $i <= 13; $i++) {
			$mapHeader[$i] = $i;
		}
		return $mapHeader;
	}

	public function row_csv_link_content($values) {
		//$view = new View($this);
		$this->Keyword = new KeywordHelper(new View());
		
		$values['Link.type'] = configure::read('Link.type.'.$values['Link.type']);
		
		$check_keyword = $this->Keyword->checkKeyword($values['Link.url'], $this->Keyword->noSpace($values['Link.keyword']));
		$values[1] = ($check_keyword != 0) ? 1 : 0;
		
		$check_keyword = $this->Keyword->checkKeyword($values['LinkContent.title'], $values['Link.keyword']);
		$values[2] = ($check_keyword == 1) ? 1 : 0;
		
		$check_keyword = $this->Keyword->checkKeyword($values['LinkContent.meta_keyword'], $values['Link.keyword']);
		$values[3] = ($check_keyword == 1) ? 1 : 0;
		
		$check_keyword = $this->Keyword->checkKeyword($values['LinkContent.meta_description'], $values['Link.keyword']);        
		$values[4] = ($check_keyword == 1)?1:0;
		
		$check_keyword = $this->Keyword->checkKeyword($values['LinkContent.h1_tag'], $values['Link.keyword']);
		$values[5] = ($check_keyword == 1)?1:0;
		
		$values[6] = $values['LinkContent.keyword_count'];
		
		@$frequency_keyword = $values['LinkContent.keyword_count'] * $this->Keyword->countLength($values['Link.keyword']) / mb_strlen($this->Keyword->jpnContent($values['LinkContent.no_html_content']));
		$values[7] = ($values['LinkContent.keyword_count'] != 0) ? round($frequency_keyword * 100, 4) . '%' : 0;
		
		$values[8] = $values['LinkContent.a_tag_count'];
		
		@$www_redirect = explode(' ', $values['LinkContent.www_redirect']);
		$values[9] = (@$www_redirect[1] == 301) ? 1 : 0;
		
		$values[10] = ($values['LinkContent.canonical'] != 0)?1:0;
		
		$values[11] = ($values['LinkContent.unique_title'] != 0)?1:0;
		$values[12] = ($values['LinkContent.unique_meta_keyword'] != 0)?1:0;
		$values[13] = ($values['LinkContent.unique_meta_description'] != 0)?1:0;
		
		unset($values['LinkContent.title']);
		unset($values['LinkContent.meta_keyword']);
		unset($values['LinkContent.meta_description']);
		unset($values['LinkContent.h1_tag']);
		unset($values['LinkContent.keyword_count']);
		unset($values['LinkContent.no_html_content']);
		unset($values['LinkContent.a_tag_count']);
		unset($values['LinkContent.www_redirect']);
		unset($values['LinkContent.canonical']);
		unset($values['LinkContent.unique_title']);
		unset($values['LinkContent.unique_meta_keyword']);
		unset($values['LinkContent.unique_meta_description']);
		unset($values['LinkContent.history']);
		unset($values['Link.link_domain_id']);

		return $values;
	}
	
}
?>