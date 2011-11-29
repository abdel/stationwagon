<?php

class Controller_Common extends Controller_Template {

	public function before()
	{
        parent::before();

        if ($this->request->action != null)
        {
            $action = array($this->request->action);
        }
        else
        {
            $action = array('index');
        }

        // Check user access
        $access = Auth::has_access(array(
            $this->request->controller,
            $this->request->action
        ));

		if ($access != true)
        {
            Response::redirect('users/login');
        }
        else
        {
            if (Auth::check())
		    {
		    	$this->user_id = Auth::instance()->get_user_id();
		    	$this->user_id = $this->user_id[1];
		    }
        }
	}

	public function action_404()
	{
		$messages = array('Aw, crap!', 'Bloody Hell!', 'Uh Oh!', 'Nope, not here.', 'Huh?');
		$data['title'] = $messages[array_rand($messages)];

		// Set a HTTP 404 output header
		$this->response->status = 404;
		$this->template->content = View::forge('404', $data);
	}
}

/* End of file common.php */
