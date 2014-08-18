<?php
App::uses('Asset', 'Model');

/**
 * Asset Test Case
 *
 */
class AssetTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.asset',
		'app.owner',
		'app.audio',
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
		$this->Asset = ClassRegistry::init('Asset');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Asset);

		parent::tearDown();
	}

}
