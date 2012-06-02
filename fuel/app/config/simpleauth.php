<?php

return array(

	/**
	 * DB table name for the user table
	 */
	'table_name' => 'users',

	/**
	 * This will allow you to use the group & acl driver for non-logged in users
	 */
	'guest_login' => true,

	/**
	 * Groups as id => array(name => <string>, roles => <array>)
	 */
	'groups' => array(
		-1	=> array('name' => 'Banned', 'roles' => array('banned')),
		0	=> array('name' => 'Guests', 'roles' => array('guest')),
		1	=> array('name' => 'Users', 'roles' => array('user')),
	),

	/**
	 * Roles as name => array(location => rights)
	 */
	'roles' => array(
		'#'          => array(
			'Controller_Users' => array(
				'index',
			),
		),
		'guest'      => array(
			'Controller_Users'  => array(
				'index',
				'signup',
				'login',
			),
		),
		'user'       => array(
			'Controller_Users'  => array(
				'logout',
			),
			'Controller_Articles'   => array(
				'index',
				'add',
				'edit',
				'publish',
				'delete',
			),
			'Controller_Categories' => array(
				'index',
				'add',
				'edit',
				'delete',
			),
		),
		'banned'     => false,
		'super'      => true,
	),

	/**
	 * Salt for the login hash
	 */
	'login_hash_salt' => 'put_some_salt_in_here',
);

/* End of file simpleauth.php */
