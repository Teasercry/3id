<?php
App::uses('RelatedTire', 'Model');

/**
 * RelatedTire Test Case
 */
class RelatedTireTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.related_tire',
		'app.vehicle',
		'app.tire'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RelatedTire = ClassRegistry::init('RelatedTire');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->RelatedTire);

		parent::tearDown();
	}

}
