<?php

class Controller_Articles extends Controller_Template {

    public function action_index()
    {
        $this->template->content = View::factory('articles/index');
    }
    
    public function action_add()
    {
        $article = new Model_Article(array(
			'category_id' => Input::post('category_id'),
			'title' => Input::post('title'),
            'body' => Input::post('body'),
            'created_time' => time(),
		));
        
        $article->save();
        
        Session::set_flash('message', 'Article successfully added.');
        
        Output::redirect('articles/add');
    }
}