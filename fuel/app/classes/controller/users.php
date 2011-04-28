<?php

class Controller_Users extends Controller_Common {
	
	public function action_index()
	{
		$this->template->title = 'Welcome';
		$this->template->content = View::factory('users/index');
	}
	
	public function action_signup()
	{
		$val = Validation::factory('signup_user');
		$val->add('username', 'Username')->add_rule('required')->add_rule('min_length', 3)->add_rule('max_length', 20);
		$val->add('password', 'Password')->add_rule('required')->add_rule('min_length', 3)->add_rule('max_length', 20);
		$val->add('email', 'Email Address')->add_rule('required')->add_rule('valid_email');
		
		if ($val->run())
		{
			if (Auth::instance()->create_user($val->validated('username'), $val->validated('password'), $val->validated('email'), 1))
			{
				Session::set_flash('success', 'Thanks for registering!');
				
				Response::redirect('/');
			}
			else
			{
				throw new Exception('An unexpected error occurred. Please try again.');
			}
		}
		
		$this->template->title = 'Sign Up';
		$this->template->content = View::factory('users/signup')
			->set('val', Validation::instance('signup_user'), false);
	}
	
	public function action_login()
	{
		if (Auth::check())
		{
			Response::redirect('/');
		}
		
		$val = Validation::factory('login_user');
		$val->add('username', 'Username')->add_rule('required')->add_rule('min_length', 3)->add_rule('max_length', 20);
		$val->add('password', 'Password')->add_rule('required')->add_rule('min_length', 3)->add_rule('max_length', 20);
		
		if ($val->run())
		{
			if (Auth::instance()->login($val->validated('username'), $val->validated('password')))
			{
				Response::redirect('users');
			}
			else
			{
				Session::set_flash('error', 'Incorrect username or password.');
				
				Response::redirect('users/login');
			}
		}
		
		$this->template->title = 'Login';
		$this->template->content = View::factory('users/login')
			->set('val', Validation::instance('login_user'), false);
	}
	
	public function action_logout()
	{
		Auth::instance()->logout();
		
		Response::redirect('users');
	}
}

/* End of file users.php */