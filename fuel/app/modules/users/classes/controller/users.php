<?php

namespace Users;

class Controller_Users extends \Controller_User {

    public function before()
    {
        parent::before();
    }

    public function action_index()
    {
        $this->template->title = 'Welcome';
        $this->template->content = \View::factory('index');
    }

    public function action_login()
	{
		if ( \Auth::check())
        {
            \Output::redirect('/');
        }
		
		$val = \Validation::factory('users');
        $val->add_field('username', 'Your username', 'required|min_length[3]|max_length[20]');
        $val->add_field('password', 'Your password', 'required|min_length[3]|max_length[20]');
		
        if ($val->run())
        {
            $auth = \Auth::instance();

            if($auth->login($val->validated('username'), $val->validated('password')))
            {
                \Session::set_flash('notice', 'FLASH: logged in');
                \Output::redirect('users');
            }
            else
            {
                $data['username']    = $val->validated('username');
                $data['login_error'] = 'Wrong username/password combo. Try again';
            }
        }
        else
        {
            if($_POST)
            {
                $data['username']    = $val->validated('username');
                $data['login_error'] = 'Wrong username/password combo. Try again';
            }
            else
            {
                $data['login_error'] = false;
            }
        }

        $this->template->title = 'Login';
		$this->template->login_error = @$data['login_error'];
		$this->template->content = \View::factory('login', $data);
	}

	public function action_logout()
	{
		\Auth::instance()->logout();

        \Session::set_flash('notice', 'FLASH: logged out');
        \Output::redirect('users');
	}

	public function action_signup()
	{
        if ( \Auth::check())
        {
            \Output::redirect('/');
        }
		
        $val = \Validation::factory('users2');
        $val->add_field('username', 'Your username', 'required|min_length[3]|max_length[20]');
        $val->add_field('password', 'Your password', 'required|min_length[3]|max_length[20]');
        $val->add_field('email', 'Email', 'required|valid_email');
		
        if ($val->run())
        {
            if(\Auth::instance()->create_user($val->validated('username'), $val->validated('password'), $val->validated('email'), '100'))
            {
                \Session::set_flash('notice', 'FLASH: User created.');
                \Output::redirect('users');
            }
            else
            {
                throw new Exception('Smth went wrong while registering');
            }
        }
        else
        {
            if($_POST)
            {
                $data['username']    = $val->validated('username');
                $data['login_error'] = 'All fields are required.';
            }
            else
            {
                $data['login_error'] = false;
            }
        }


		$this->template->title = 'Sign Up';
        $this->template->login_error = @$data['login_error'];
		$this->template->content = \View::factory('signup');
	}

	public function action_activate()
	{
		$this->template->title = 'Activate Your Account';
		$this->template->content = View::factory('users/activate');
	}

}

/* End of file users.php */