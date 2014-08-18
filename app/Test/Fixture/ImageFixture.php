<?php
/**
 * ImageFixture
 *
 */
class ImageFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'asset_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'format' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 8, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'height' => array('type' => 'integer', 'null' => false, 'default' => null),
		'width' => array('type' => 'integer', 'null' => false, 'default' => null),
		'license' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'data' => array('type' => 'binary', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'format' => array('column' => 'format', 'unique' => 0),
			'asset_id' => array('column' => 'asset_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'asset_id' => 1,
			'format' => 'Lorem ',
			'height' => 1,
			'width' => 1,
			'license' => 'Lorem ipsum dolor sit amet',
			'data' => 'Lorem ipsum dolor sit amet'
		),
	);

}
