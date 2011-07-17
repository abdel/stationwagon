<?php

class Controller_Users extends Controller_Common {
	
	public function action_index()
	{
		$this->template->title = 'Welcome';
		$this->template->content = View::factory('users/index');
	}
	
	public function action_signup()
    {
        // Setup Validation
        $val = Validation::factory('signup_user');

        // Set validation rules
        $val->add('username', 'Username')
            ->add_rule('required')
            ->add_rule('min_length', 3)
            ->add_rule('max_length', 20);

        $val->add('password', 'Password')
            ->add_rule('required')
            ->add_rule('min_length', 3)
            ->add_rule('max_length', 20);

        $val->add('email', 'Email Address')
            ->add_rule('required')
            ->add_rule('valid_email');

        // Validate
		if ($val->run())
        {
            // Create user
            if (Auth::instance()->create_user($val->validated('username'), 
                $val->validated('password'), $val->validated('email'), 1))
			{
				Session::set_flash('success', 'Thanks for registering!');
				
				Response::redirect('/');
			}
			else
			{
                throw new Exception('An unexpected error occurred.'.
                    ' Please try again.');
			}
		}
		
		$this->template->title = 'Sign Up';
		$this->template->content = View::factory('users/signup')
			->set('val', $val, false);
	}
	
	public function action_login()
	{
        // Setup Validation
        $val = Validation::factory('login_user');

        // Set validation rules
        $val->add('username', 'Username')
            ->add_rule('required')
            ->add_rule('min_length', 3)
            ->add_rule('max_length', 20);

        $val->add('password', 'Password')
            ->add_rule('required')
            ->add_rule('min_length', 3)
            ->add_rule('max_length', 20);

        // Validate
		if ($val->run())
        {
            // Authenticate user
            if (Auth::instance()->login($val->validated('username'), 
                $val->validated('password')))
			{
				Response::redirect('users');
			}
			else
			{
                Session::set_flash('error', 'Incorrect username or password.'.
                    ' Please try again.');
				
				Response::redirect('users/login');
			}
		}
		
		$this->template->title = 'Login';
		$this->template->content = View::factory('users/login')
			->set('val', $val, false);
	}
	
	public function action_logout()
	{
		Auth::instance()->logout();
		
		Response::redirect('users');
	}
}

/* End of file users.php */
