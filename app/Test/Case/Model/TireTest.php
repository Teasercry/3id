<?php
App::uses('Tire', 'Model');

/**
 * Tire Test Case
 */
class TireTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tire'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tire = ClassRegistry::init('Tire');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tire);

		parent::tearDown();
	}

}
