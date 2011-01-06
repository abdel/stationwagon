<?php

class Controller_Categories extends Controller_Template {

    public function action_index()
    {
        $this->template->content = View::factory('categories/index');
    }
}