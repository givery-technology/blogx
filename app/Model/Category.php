<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 * @property Blog $Blog
 */
class Category extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	
// #category
	public $actsAs = array('Tree');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
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
                'message' => 'このカテゴリ名は事前に登録しました。',
            ), 
		),
		'code' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
                'rule' => 'isUnique',
                'message' => 'このカテゴリコードは事前に登録しました。',
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
		'Blog' => array(
			'className' => 'Blog',
			'foreignKey' => 'category_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Children'=>array(
	       'className'=>'Category',
	       'foreignKey'=>'parent_id'
	    )
	);

/**
 * belongsTo associations
 *
 * @var array
 */	
	public $belongsTo = array(
		'Parent'=>array(
			'className'=>'Category',
			'foreignKey'=>'parent_id'
		)
	);	

}
