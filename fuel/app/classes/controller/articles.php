<?php

class Controller_Articles extends Controller_Wagon {
    
    /**
     * @access public
     */
    public function action_index()
    {
        $this->data['hello'] = 'Hello world!';
        $this->view('articles/index');
    }
	
    public function action_404()
    {
		
    }
}

/* End of file articles.php */