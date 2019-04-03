<?php
App::uses('AppModel', 'Model');
/**
 * CrmQuoteprodVariant Model
 *
 * @property ProductVariant $ProductVariant
 * @property CrmQuotationProduct $CrmQuotationProduct
 */
class CrmQuoteprodVariant extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'product_variant_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'crm_quotation_product_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		// 'ProductVariant' => array(
		// 	'className' => 'ProductVariant',
		// 	'foreignKey' => 'product_variant_id',
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => ''
		// ),
		'CrmQuotationProduct' => array(
			'className' => 'CrmQuotationProduct',
			'foreignKey' => 'crm_quotation_product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $hasMany = array(
		'ProductVariant' => array(
			'className' => 'ProductVariant',
			'foreignKey' => false,
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => 'Select ProductVariant.* FROM crm_quoteprod_variants, product_variants as ProductVariant WHERE crm_quoteprod_variants.id = {$__cakeID__$} AND crm_quoteprod_variants.product_variant_id = ProductVariant.product_id',
			'counterQuery' => ''
		)
	);
}
