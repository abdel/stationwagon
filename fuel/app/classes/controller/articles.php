<?php

class Controller_Articles extends Controller_Wagon {

    public function action_index()
    {
        $this->view('articles/index');
    }
}