<?php
App::uses('AppModel', 'Model');
/**
 * Plog Model
 *
 * @property Genre $Genre
 */
class Plog extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'useragent';	
	
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
/**
 * CSV export
 *
 * @var array
 */    
    public $actsAs = array(
	    'CsvExport' => array(
	        'delimiter' => ',', //The delimiter for the values, default is ;
	        'enclosure' => '"', //The enclosure, default is "
	        'max_execution_time' => 360, //Increase for Models with lots of data, has no effect is php safemode is enabled.
	        'encoding' => 'utf8' //Prefixes the return file with a BOM and attempts to utf_encode() data
	    )		
	);
	
}
?>