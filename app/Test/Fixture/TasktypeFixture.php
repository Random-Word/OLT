<?php
/**
 * TaskTypeFixture
 *
 */
class TaskTypeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 63, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'subtype' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => 'human-readable', 'charset' => 'latin1'),
		'params' => array('type' => 'string', 'null' => false, 'default' => 'null', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'type' => 'Lorem ipsum dolor sit amet',
			'subtype' => 'Lorem ipsum dolor sit amet',
			'name' => 'Lorem ipsum dolor sit amet',
			'params' => 'Lorem ipsum dolor sit amet'
		),
	);

}
