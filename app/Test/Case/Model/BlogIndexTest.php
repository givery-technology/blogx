<?php
App::uses('BlogIndex', 'Model');

/**
 * BlogIndex Test Case
 *
 */
class BlogIndexTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.blog_index',
		'app.blog',
		'app.category',
		'app.design',
		'app.genre',
		'app.post',
		'app.outlink_log',
		'app.image_log',
		'app.keyword',
		'app.company',
		'app.menu'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BlogIndex = ClassRegistry::init('BlogIndex');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BlogIndex);

		parent::tearDown();
	}

}
