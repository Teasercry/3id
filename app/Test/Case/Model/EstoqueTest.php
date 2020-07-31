<?php
App::uses('Estoque', 'Model');

/**
 * Estoque Test Case
 */
class EstoqueTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.estoque'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Estoque = ClassRegistry::init('Estoque');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Estoque);

		parent::tearDown();
	}

}
