<?php

<<<<<<< HEAD
class Controller_Articles extends Controller_Template {

	/*
		@access		public
	*/
	public function action_index()
	{
		
	}
=======
class Controller_Articles extends Controller_Wagon {
    
    /**
     * @access public
     */
    public function action_index()
    {
        $this->data['hello'] = 'Hello world!';
        $this->view('articles/index');
    }
>>>>>>> origin/master
	
    public function action_404()
    {
		
    }
}

<<<<<<< HEAD
/* End of file articles.php */
=======
/* End of file articles.php */
>>>>>>> origin/master
