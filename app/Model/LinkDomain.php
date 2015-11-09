<?php
App::uses('AppModel', 'Model');
/**
 * LinkDomain Model
 *
 * @property Link $Link
 */
class LinkDomain extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	// public $displayField = 'id';
	
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'domain' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Domain Unique'
			),
		),
	);


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Link' => array(
			'className' => 'Link',
			'foreignKey' => 'link_domain_id',
			'dependent' => false,
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
