<?php
App::uses('QuotationProduct', 'Model');

/**
 * QuotationProduct Test Case
 */
class QuotationProductTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.quotation_product',
		'app.quotation',
		'app.company',
		'app.user',
		'app.product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->QuotationProduct = ClassRegistry::init('QuotationProduct');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->QuotationProduct);

		parent::tearDown();
	}

}
