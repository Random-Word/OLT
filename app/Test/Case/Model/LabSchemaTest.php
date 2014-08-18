<?php
App::uses('LabSchema', 'Model');

/**
 * LabSchema Test Case
 *
 */
class LabSchemaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.lab_schema'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->LabSchema = ClassRegistry::init('LabSchema');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LabSchema);

		parent::tearDown();
	}

}
