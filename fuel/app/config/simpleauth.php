<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2011 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */

return array(

	/**
	 * DB connection, leave null to use default
	 */
	'db_connection' => null,

	/**
	 * DB table name for the user table
	 */
	'table_name' => 'users',

	/**
	 * Choose which columns are selected, must include: username, password, email, last_login,
	 * login_hash, group & profile_fields
	 */
	'table_columns' => array('*'),

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
            '\Controller_Users' => array(
                'index',
            ),
        ),
        'guest'      => array(
            '\Controller_Users'  => array(
                'index',
                'signup',
                'login',
            ),
        ),
        'user'       => array(
            '\Controller_Users'  => array(
                'logout',
            ),
            '\Controller_Articles'   => array(
                'index',
                'add',
                'edit',
                'delete',
            ),
            '\Controller_Categories' => array(
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

	/**
	 * $_POST key for login username
	 */
	'username_post_key' => 'username',

	/**
	 * $_POST key for login password
	 */
	'password_post_key' => 'password',
);

/* End of file simpleauth.php */
