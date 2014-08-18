<?php
App::uses('Rset', 'Model');

/**
 * Rset Test Case
 *
 */
class RsetTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.rset',
		'app.user',
		'app.respone',
		'app.lab',
		'app.tasktype'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Rset = ClassRegistry::init('Rset');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Rset);

		parent::tearDown();
	}

}
