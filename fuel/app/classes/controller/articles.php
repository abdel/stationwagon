<?php

class Controller_Articles extends Controller_Template {

    public function action_index()
    {   
        $total_articles = count(Model_Article::find('all'));
        
        Pagination::set_config(array(
            'pagination_url' => 'articles/index',
            'per_page' => 5,
            'total_items' => $total_articles,
            'num_links' => 3,
        ));
        
        $articles = Model_Article::find('all', array(
            'offset' => Pagination::$offset,
            'limit' => Pagination::$per_page,
        ));
        
        $this->template->content = View::factory('articles/index', array(
            'total_articles' => $total_articles,
            'articles' => $articles,
        ));
    }
    
    public function action_add()
    {
        if ( Input::method() == 'POST' )
        {
            $add_article = Validation::factory('add_article');
            $add_article->add('title', 'Title')->add_rule('required');
            $add_article->add('body', 'Body')->add_rule('required');
            
            if ( $add_article->run() == TRUE )
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
            else
            {
                $data['errors'] = $add_article->show_errors();
            }
        }
        
        $data['categories'] = Model_Category::find('all');
        $this->template->content = View::factory('articles/add', $data);
    }
    
    public function action_delete($id)
    {
        Model_Article::find($id)->destroy();
        
        Output::redirect('articles/index');
    }
}