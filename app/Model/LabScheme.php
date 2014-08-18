<?php
App::uses('AppModel', 'Model');
/**
 * LabScheme Model
 *
 * @property Lab $Lab
 */
class LabScheme extends AppModel {

	private $lab_params = array();

	public $virtualFields = array();

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'scheme' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Lab' => array(
			'className' => 'Lab',
			'foreignKey' => 'lab_scheme_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
