<?php
App::uses('AppModel', 'Model');
/**
 * LinkContentOutlink Model
 *
 * @property Genre $Genre
 */
class LinkContentOutlink extends AppModel {

	public $belongsTo = array(
		'LinkContent' => array(
			'className' => 'LinkContent',
			'foreignKey' => 'link_content_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
}
?>