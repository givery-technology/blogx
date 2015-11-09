<?php
App::uses('AppModel', 'Model');
/**
 * BlogIndex Model
 *
 * @property Blog $Blog
 */
class BlogIndex extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'blog_index';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Blog' => array(
			'className' => 'Blog',
			'foreignKey' => 'blog_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
