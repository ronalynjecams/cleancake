<?php
/* Topic Test cases generated on: 2016-09-13 16:10:32 : 1473775832*/
App::uses('Topic', 'Model');

/**
 * Topic Test Case
 *  
 */
class TopicTestCase extends CakeTestCase {
/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Topic = ClassRegistry::init('Topic');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Topic);

		parent::tearDown();
	}

}
