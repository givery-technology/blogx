<?php
App::uses('Keyword', 'Model');

/**
 * Keyword Test Case
 *
 */
class KeywordTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.keyword',
		'app.post',
		'app.blog',
		'app.category',
		'app.design',
		'app.company'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Keyword = ClassRegistry::init('Keyword');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Keyword);

		parent::tearDown();
	}

}
