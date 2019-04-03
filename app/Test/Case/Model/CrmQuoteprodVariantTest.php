<?php
App::uses('CrmQuoteprodVariant', 'Model');

/**
 * CrmQuoteprodVariant Test Case
 */
class CrmQuoteprodVariantTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.crm_quoteprod_variant',
		'app.product_variant',
		'app.product',
		'app.sub_category',
		'app.category',
		'app.inquiry_detail',
		'app.crm_quotation_product',
		'app.crm_quotation',
		'app.crm_company',
		'app.admin',
		'app.crm_employee_detail',
		'app.crm_delivery_receipt',
		'app.inquiry',
		'app.crm_job_order',
		'app.crm_collection',
		'app.crm_bank'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CrmQuoteprodVariant = ClassRegistry::init('CrmQuoteprodVariant');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CrmQuoteprodVariant);

		parent::tearDown();
	}

}
