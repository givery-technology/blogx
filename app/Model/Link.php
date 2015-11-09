<?php
App::uses('AppModel', 'Model');
/**
 * Link Model
 *
 * @property Genre $Genre
 */
class Link extends AppModel {
	
	public $validate = array(
		'keyword' => array(
			'unique' => array(
				'rule' => array('checkUnique', array('keyword', 'url'), False), 
				'message' => 'Keyword and url are unique.',
				// 'on' => 'create'
			)
		),
		'url' => array(
			'unique' => array(
				'rule' => array('checkUnique', array('keyword', 'url'), False), 
				'message' => 'Keyword and url are unique.',
				// 'on' => 'create'
			)
		)
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'LinkDomain' => array(
			'className' => 'LinkDomain',
			'foreignKey' => 'link_domain_id',
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
		'LinkContent' => array(
			'className' => 'LinkContent',
			'foreignKey' => 'link_id',
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
	
}
?>