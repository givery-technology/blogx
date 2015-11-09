<?php
/**
 * BlogIndexFixture
 *
 */
class BlogIndexFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'blog_index';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'blog_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'g_index' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'history' => array('type' => 'date', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'blog_id' => 1,
			'g_index' => 'Lorem ipsum dolor sit amet',
			'history' => '2014-09-16',
			'created' => '2014-09-16 17:55:05',
			'updated' => '2014-09-16 17:55:05'
		),
	);

}
