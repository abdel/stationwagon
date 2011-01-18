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
            'include' => 'category',
        ));
        
        $this->template->title = 'Articles';
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
            $add_article->add('category_id', 'Category')->add_rule('required');
            $add_article->add('title', 'Title')->add_rule('required');
            $add_article->add('body', 'Body')->add_rule('required');
            
            if ( $add_article->run() == TRUE )
            {
                $article = new Model_Article(array(
                    'category_id' => $add_article->validated('category_id'),
                    'title' => $add_article->validated('title'),
                    'body' => $add_article->validated('body'),
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
        $this->template->title = 'Add Article';
        $this->template->content = View::factory('articles/add', $data);
    }
    
    public function action_edit($id)
    {
        $article = Model_Article::find($id);
        
        if ( Input::method() == 'POST' )
        {
            $edit_article = Validation::factory('edit_article');
            $edit_article->add('category_id')->add_rule('required');
            $edit_article->add('title')->add_rule('required');
            $edit_article->add('body')->add_rule('required');
            
            if ( $edit_article->run() == TRUE )
            {
                $article->category_id = $edit_article->validated('category_id');
                $article->title = $edit_article->validated('title');
                $article->body = $edit_article->validated('body');
                $article->save();

                Session::set_flash('message', 'Article successfully updated.');

                Output::redirect('articles/edit/'.$article->id);
            }
            else
            {
                $data['errors'] = $edit_article->show_errors();
            }
        }
        
        $data['article'] = $article;
        $data['categories'] = Model_Category::find('all');
        $this->template->title = 'Edit Article - '.$article->title;
        $this->template->content = View::factory('articles/edit', $data);
    }
    
    
    public function action_delete($id)
    {
        Model_Article::find($id)->delete();
        
        Output::redirect('articles/index');
    }
}