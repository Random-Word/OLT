<?php
App::uses('Response', 'Model');

/**
 * Response Test Case
 *
 */
class ResponseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.response',
		'app.tasktype',
		'app.respone',
		'app.rset',
		'app.user',
		'app.lab'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Response = ClassRegistry::init('Response');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Response);

		parent::tearDown();
	}

}
