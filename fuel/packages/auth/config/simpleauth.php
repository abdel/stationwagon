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
            'users' => array(
                'index',
            ),
        ),
        'guest'      => array(
            'users'  => array(
                'index',
                'signup',
                'login',
            ),
        ),
        'user'       => array(
            'users'  => array( 
                'logout',
            ),
            'articles'   => array(
                'index',
                'add',
                'edit',
                'delete',
            ),
            'categories' => array(
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
