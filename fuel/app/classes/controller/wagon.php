<?php

abstract class Controller_Wagon extends \Controller {
    
    protected $data;
    
    public function view($view)
    {
        $data['yield'] = $this->render($view, $this->data);
        $this->render('layouts/default', $data);
    }
}
