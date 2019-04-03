<?php
/**
 * CrmQuoteprodVariant Fixture
 */
class CrmQuoteprodVariantFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'product_variant_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'crm_quotation_product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created_at' => array('type' => 'timestamp', 'null' => false, 'default' => null),
		'updated_at' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
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
			'product_variant_id' => 1,
			'crm_quotation_product_id' => 1,
			'created_at' => 1540536350,
			'updated_at' => 1540536350
		),
	);

}
