<?php
/**
 * ResponseFixture
 *
 */
class ResponseFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'tasktype_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'rset_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'lab_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'value' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 65000, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'lab_id' => array('column' => 'tasktype_id', 'unique' => 0),
			'rset_id' => array('column' => 'rset_id', 'unique' => 0),
			'lab_id_2' => array('column' => array('lab_id', 'user_id'), 'unique' => 0)
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
			'tasktype_id' => 1,
			'rset_id' => 1,
			'lab_id' => 1,
			'user_id' => 1,
			'value' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-03-19 15:41:18',
			'modified' => '2014-03-19 15:41:18'
		),
	);

}
