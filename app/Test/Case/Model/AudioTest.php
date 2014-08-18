<?php
App::uses('Audio', 'Model');

/**
 * Audio Test Case
 *
 */
class AudioTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.audio',
		'app.asset',
		'app.owner',
		'app.image',
		'app.video'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Audio = ClassRegistry::init('Audio');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Audio);

		parent::tearDown();
	}

}
