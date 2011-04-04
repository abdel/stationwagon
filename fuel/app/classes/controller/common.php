<?php

class Controller_Common extends Controller_Template {

    public function before()
    {
        parent::before();

        if (Auth::check())
        {
            $user = Auth::instance()->get_user_id();

            $this->user_id = $user[1];
        }
        
        if (Uri::segment(1) === 'articles' or Uri::segment(1) === 'categories')
        {
            if (!Auth::check())
            {
                Response::redirect('/users/login');    
            }
        }
    }

    public function action_404()
	{
		$messages = array('Aw, crap!', 'Bloody Hell!', 'Uh Oh!', 'Nope, not here.', 'Huh?');
		$data['title'] = $messages[array_rand($messages)];

		// Set a HTTP 404 output header
		$this->response->status = 404;
		$this->template->content = View::factory('404', $data);
	}
}