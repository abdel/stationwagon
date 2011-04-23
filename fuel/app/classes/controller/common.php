<?php

class Controller_Common extends Controller_Template {
	
	protected $role, $rights;
	
	public function before()
	{
		parent::before();
		
		if (Auth::check())
		{
			$this->user_id = Auth::instance()->get_user_id();
			$this->user_id = $this->user_id[1];
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

/* End of file common.php */