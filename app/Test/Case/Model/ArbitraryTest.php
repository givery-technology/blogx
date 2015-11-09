<?php
App::uses('Arbitrary', 'Model');

/**
 * Arbitrary Test Case
 *
 */
class ArbitraryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.arbitrary'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Arbitrary = ClassRegistry::init('Arbitrary');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Arbitrary);

		parent::tearDown();
	}

}
