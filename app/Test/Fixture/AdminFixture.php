<?php
/**
 * Admin Fixture
 */
class AdminFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'first_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'last_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 150, 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'username' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 150, 'key' => 'unique', 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'job_title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'password' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'active' => array('type' => 'boolean', 'null' => true, 'default' => '1', 'key' => 'index'),
		'remember_token' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'created_at' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'updated_at' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'admins_username_unique' => array('column' => 'username', 'unique' => 1),
			'active_index' => array('column' => 'active', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'first_name' => 'Lorem ipsum dolor sit amet',
			'last_name' => 'Lorem ipsum dolor sit amet',
			'name' => 'Lorem ipsum dolor sit amet',
			'username' => 'Lorem ipsum dolor sit amet',
			'job_title' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'active' => 1,
			'remember_token' => 'Lorem ipsum dolor sit amet',
			'created_at' => 1531328945,
			'updated_at' => 1531328945
		),
	);

}
