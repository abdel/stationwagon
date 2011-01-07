<?php

class Controller_Categories extends Controller_Template {

    public function action_index()
    {
        $data['categories'] = Model_Category::find('all');
        $this->template->content = View::factory('categories/index');
    }
}