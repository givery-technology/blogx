<?php
App::uses('Blog', 'Model');

/**
 * Blog Test Case
 *
 */
class BlogTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.blog',
		'app.category',
		'app.design',
		'app.post'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Blog = ClassRegistry::init('Blog');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Blog);

		parent::tearDown();
	}

}