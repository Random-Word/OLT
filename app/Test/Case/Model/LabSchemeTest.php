<?php
App::uses('LabScheme', 'Model');

/**
 * LabScheme Test Case
 *
 */
class LabSchemeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.lab_scheme',
		'app.lab',
		'app.response',
		'app.tasktype',
		'app.respone',
		'app.rset',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->LabScheme = ClassRegistry::init('LabScheme');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LabScheme);

		parent::tearDown();
	}

}
