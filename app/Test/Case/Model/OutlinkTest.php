<?php
App::uses('Outlink', 'Model');

/**
 * Outlink Test Case
 *
 */
class OutlinkTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.outlink',
		'app.post',
		'app.blog',
		'app.category',
		'app.design',
		'app.keyword',
		'app.company'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Outlink = ClassRegistry::init('Outlink');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Outlink);

		parent::tearDown();
	}

}
