<?php

class Controller_Articles extends Controller_Wagon {

    public function action_index()
    {
        $this->data['hello'] = 'Hello world!';
        $this->view('articles/index');
    }
}