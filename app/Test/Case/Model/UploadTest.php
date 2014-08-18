<?php
App::uses('Upload', 'Model');

/**
 * Upload Test Case
 *
 */
class UploadTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.upload',
		'app.user',
		'app.rset',
		'app.lab',
		'app.lab_scheme'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Upload = ClassRegistry::init('Upload');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Upload);

		parent::tearDown();
	}

}
