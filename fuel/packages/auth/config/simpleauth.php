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
	 * DB table name for the user table
	 */
	'table_name' => 'simpleusers',

	/**
	 * This will allow you to use the group & acl driver for non-logged in users
	 */
	'guest_login' => true,

	/**
	 * Groups as id => array(name => <string>, roles => <array>)
	 */
	'groups' => array(
		-1	=> array('name' => 'Banned', 'roles' => array('banned')),
		0	=> array('name' => 'Guests', 'roles' => array()),
		1	=> array('name' => 'Users', 'roles' => array('user')),
		50	=> array('name' => 'Moderators', 'roles' => array('user', 'moderator')),
		100	=> array('name' => 'Administrators', 'roles' => array('user', 'moderator', 'admin')),
	),

	/**
	 * Roles as name => array(location => rights)
	 */
	'roles' => array(
		'#'          => array('website' => array('read')), // default rights
		'banned'     => false,
		'user'       => array('comments' => array('create', 'read')),
		'moderator'  => array('comments' => array('update', 'delete')),
		'admin'      => array(
			'website'  => array('create', 'update', 'delete'),
			'admin'    => array('create', 'read', 'update', 'delete'),
		),
		'super'      => true,
	),

	/**
	 * Salt for the login hash
	 */
	'login_hash_salt' => 'put_some_salt_in_here',
);
