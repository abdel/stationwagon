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

namespace Auth;


class SimpleUserUpdateException extends \Fuel_Exception {}

class SimpleUserWrongPassword extends \Fuel_Exception {}


class Auth_Login_SimpleAuth extends \Auth_Login_Driver {

	public static function _init()
	{
		\Config::load('simpleauth', true);
	}

	/**
	 * @var  Database_Result  when login succeeded
	 */
	protected $user = null;

	/**
	 * @var  array  value for guest login
	 */
	protected static $guest_login = array(
		'id' => 0,
		'username' => 'guest',
		'group' => '0',
		'login_hash' => false,
		'email' => false
	);

	/**
	 * @var  array  SimpleAuth class config
	 */
	protected $config = array(
		'drivers' => array('group' => array('SimpleGroup')),
		'additional_fields' => array('profile_fields'),
	);

	/**
	 * Check for login
	 *
	 * @return  bool
	 */
	public function perform_check()
	{
		$username    = \Session::get('username');
		$login_hash  = \Session::get('login_hash');

		if (is_null($this->user) or ($this->user['username'] != $username and $this->user != static::$guest_login))
		{
			$this->user = \DB::select()
				->where('username', '=', $username)
				->from(\Config::get('simpleauth.table_name'))
				->execute()->current();
		}

		if ($this->user and $this->user['login_hash'] === $login_hash)
		{
			return true;
		}

		$this->user = \Config::get('simpleauth.guest_login', true) ? static::$guest_login : false;
		\Session::delete('username');
		\Session::delete('login_hash');

		return false;
	}

	/**
	 * Login user
	 *
	 * @param	string
	 * @param	string
	 * @return	bool
	 */
	public function login($username = '', $password = '')
	{
		$username = trim($username) ?: trim(\Input::post('username'));
		$password = trim($password) ?: trim(\Input::post('password'));

		if (empty($username) or empty($password))
		{
			return false;
		}

		$password = $this->hash_password($password);
		$this->user = \DB::select()
			->where('username', '=', $username)
			->where('password', '=', $password)
			->from(\Config::get('simpleauth.table_name'))
			->execute()->current();

		if ($this->user == false)
		{
			$this->user = \Config::get('simpleauth.guest_login', true) ? static::$guest_login : false;
			\Session::delete('username');
			\Session::delete('login_hash');
			return false;
		}

		\Session::set('username', $username);
		\Session::set('login_hash', $this->create_login_hash());
		return true;
	}

	/**
	 * Logout user
	 *
	 * @return bool
	 */
	public function logout()
	{
		$this->user = \Config::get('simpleauth.guest_login', true) ? static::$guest_login : false;
		\Session::delete('username');
		\Session::delete('login_hash');
		return true;
	}

	/**
	 * Create new user
	 *
	 * @param	string
	 * @param	string
	 * @param	string	must contain valid email address
	 * @param	int		group id
	 * @param	array
	 * @return	bool
	 */
	public function create_user($username, $password, $email, $group = 1, Array $profile_fields = array())
	{
		$email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);

		if (empty($username) or empty($password) or empty($email))
		{
			return false;
		}

		$user = array(
			'username'        => (string) $username,
			'password'        => $this->hash_password((string) $password),
			'email'           => $email,
			'group'           => (int) $group,
			'profile_fields'  => serialize($profile_fields)
		);
		$result = \DB::insert(\Config::get('simpleauth.table_name'))
			->set($user)
			->execute();

		return ($result[1] > 0) ? $result[0] : false;
	}

	/**
	 * Update a user's properties
	 * Note: Username cannot be updated, to update password the old password must be passed as old_password
	 *
	 * @param	array	properties to be updated including profile fields
	 * @param	string
	 * @return	bool
	 */
	public function update_user($values, $username = null)
	{
		$username = $username ?: $this->user['username'];
		$current_values = \DB::select()
			->where('username', '=', $username)
			->from(\Config::get('simpleauth.table_name'))->execute();

		if (empty($current_values))
		{
			throw new \SimpleUserUpdateException('Username not found');
		}

		$update = array();
		if (array_key_exists('username', $values))
		{
			throw new \SimpleUserUpdateException('Username cannot be changed.');
		}
		if (array_key_exists('password', $values))
		{
			if ($current_values->get('password') != $this->hash_password(@$values['old_password']))
			{
				throw new \SimpleUserWrongPassword('Old password is invalid');
			}

			if ( ! empty($values['password']))
			{
				$update['password'] = $this->hash_password($values['password']);
			}
			unset($values['password']);
		}
		if (array_key_exists('old_password', $values))
		{
			unset($values['old_password']);
		}
		if (array_key_exists('email', $values))
		{
			$email = filter_var(trim($values['email']), FILTER_VALIDATE_EMAIL);
			if ( ! $email)
			{
				throw new \SimpleUserUpdateException('Email address is not valid');
			}
			$update['email'] = $email;
			unset($values['email']);
		}
		if (array_key_exists('group', $values))
		{
			if (is_numeric($values['group']))
			{
				$update['group'] = (int) $values['group'];
			}
			unset($values['group']);
		}
		if ( ! empty($values))
		{
			$profile_fields = @unserialize($current_values->get('profile_fields')) ?: array();
			foreach ($values as $key => $val)
			{
				if ($val === null)
				{
					unset($profile_fields[$key]);
				}
				else
				{
					$profile_fields[$key] = $val;
				}
			}
			$update['profile_fields'] = serialize($profile_fields);
		}

		$affected_rows = \DB::update(\Config::get('simpleauth.table_name'))
			->set($update)
			->where('username', '=', $username)
			->execute();

		// Refresh user
		if ($this->user['username'] == $username)
		{
			$this->user = \DB::select()
				->where('username', '=', $username)
				->from(\Config::get('simpleauth.table_name'))
				->execute()->current();
		}

		return $affected_rows > 0;
	}

	/**
	 * Change a user's password
	 *
	 * @param	string
	 * @param	string
	 * @param	string	username or null for current user
	 * @return	bool
	 */
	public function change_password($old_password, $new_password, $username = null)
	{
		try
		{
			return (bool) $this->update_user(array('old_password' => $old_password, 'password' => $new_password), $username);
		}
		// Only catch the wrong password exception
		catch (SimpleUserWrongPassword $e)
		{
			return false;
		}
	}

	/**
	 * Deletes a given user
	 *
	 * @param	string
	 * @return	bool
	 */
	public function delete_user($username)
	{
		if (empty($username))
		{
			throw new \SimpleUserUpdateException('Cannot delete user with empty username');
		}

		$affected_rows = \DB::delete(\Config::get('simpleauth.table_name'))
			->where('username', '=', $username)
			->execute();

		return $affected_rows > 0;
	}

	public function forgotten_password($username)
	{
		$username = $username;
		$user = \DB::select()
			->where('username', '=', $username)
			->from(\Config::get('simpleauth.table_name'))
			->execute()->current();
		if (empty($user))
		{
			throw new \SimpleUserUpdateException('User not found, cannot reset password');
		}

		// MUST GET CODE TO RESET THE PASSWORD TO SOMETHING RANDOM AND EMAIL IT
		// TO THE USER'S EMAILADDRESS
	}

	/**
	 * Creates a temporary hash that will validate the current login
	 *
	 * @return	string
	 */
	public function create_login_hash()
	{
		if (empty($this->user))
		{
			throw new \SimpleUserUpdateException('User not logged in, can\'t create login hash.');
		}

		$last_login = \Date::factory()->get_timestamp();
		$login_hash = sha1(\Config::get('simpleauth.login_hash_salt').$this->user['username'].$last_login);

		\DB::update(\Config::get('simpleauth.table_name'))
			->set(array('last_login' => $last_login, 'login_hash' => $login_hash))
			->where('username', '=', $this->user['username'])->execute();

		return $login_hash;
	}

	/**
	 * Get the user's ID
	 *
	 * @return	array	containing this driver's ID & the user's ID
	 */
	public function get_user_id()
	{
		if (empty($this->user))
		{
			return false;
		}

		return array($this->id, (int) $this->user['id']);
	}

	/**
	 * Get the user's groups
	 *
	 * @return array	containing the group driver ID & the user's group ID
	 */
	public function get_groups()
	{
		if (empty($this->user))
		{
			return false;
		}

		return array(array('SimpleGroup', $this->user['group']));
	}

	/**
	 * Get the user's emailaddress
	 *
	 * @return	string
	 */
	public function get_email()
	{
		if (empty($this->user))
		{
			return false;
		}

		return $this->user['email'];
	}

	/**
	 * Get the user's screen name
	 *
	 * @return	string
	 */
	public function get_screen_name()
	{
		if (empty($this->user))
		{
			return false;
		}

		return $this->user['username'];
	}

	/**
	 * Get the user's profile fields
	 *
	 * @return array
	 */
	public function get_profile_fields()
	{
		if (empty($this->user))
		{
			return false;
		}

		return @unserialize($this->user['profile_fields']) ?: array();
	}

	/**
	 * Extension of base driver method to default to user group instead of user id
	 */
	public function has_access($condition, $driver = null, $user = null)
	{
		if (is_null($user))
		{
			$groups = $this->get_groups();
			$user = reset($groups);
		}
		return parent::has_access($condition, $driver, $user);
	}

	/**
	 * Extension of base driver because this supports a guest login when switched on
	 */
	public function guest_login()
	{
		return \Config::get('simpleauth.guest_login', true);
	}
}

// end of file simpleauth.php
