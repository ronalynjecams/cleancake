<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * Admin Model
 *
 * @property CrmCompany $CrmCompany
 * @property CrmDeliveryReceipt $CrmDeliveryReceipt
 * @property CrmEmployeeDetail $CrmEmployeeDetail
 * @property CrmQuotationProduct $CrmQuotationProduct
 * @property CrmQuotation $CrmQuotation
 */
class Admin extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
 
	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $passwordHasher = new BlowfishPasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash(
	            $this->data[$this->alias]['password']
	        );
	    }
	    
	    $date = date('Y-m-d H:i:s');
	    if (isset($this->data[$this->alias]['id'])) {
	    	$QUERY = $this->query('SELECT created_at FROM '. Inflector::underscore(Inflector::pluralize($this->alias)) .' WHERE id = '. $this->data[$this->alias]['id']);
	        $this->data[$this->alias]['created_at'] = $QUERY[0][Inflector::underscore(Inflector::pluralize($this->alias))]['created_at'];
	        $this->data[$this->alias]['updated_at'] = $date; 
	       
	    } else{	
	    	$this->data[$this->alias]['created_at'] = $date; 
	    	$this->data[$this->alias]['updated_at'] = $date; 
	    }
	    return true;
	}
	 
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'username' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'job_title' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'CrmCompany' => array(
			'className' => 'CrmCompany',
			'foreignKey' => 'admin_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CrmDeliveryReceipt' => array(
			'className' => 'CrmDeliveryReceipt',
			'foreignKey' => 'admin_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CrmEmployeeDetail' => array(
			'className' => 'CrmEmployeeDetail',
			'foreignKey' => 'admin_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CrmQuotationProduct' => array(
			'className' => 'CrmQuotationProduct',
			'foreignKey' => 'admin_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CrmQuotation' => array(
			'className' => 'CrmQuotation',
			'foreignKey' => 'admin_id',
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
	
	public $hasOne = array(
		'CrmEmployeeDetail'
		);

}
