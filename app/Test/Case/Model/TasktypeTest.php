<?php
App::uses('TaskType', 'Model');

/**
 * TaskType Test Case
 *
 */
class TaskTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.task_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TaskType = ClassRegistry::init('TaskType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TaskType);

		parent::tearDown();
	}

}
