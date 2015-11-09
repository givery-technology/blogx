<?php
App::uses('BlogNav', 'Model');

/**
 * BlogNav Test Case
 *
 */
class BlogNavTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.blog_nav',
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
		$this->BlogNav = ClassRegistry::init('BlogNav');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BlogNav);

		parent::tearDown();
	}

}
