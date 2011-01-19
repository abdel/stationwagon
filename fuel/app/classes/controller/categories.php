<?php

class Controller_Categories extends \Controller_User {
	
	public function before()
    {
        parent::before();
    }
    
    public function action_index()
    {
        $total_categories = count(Model_Category::find('all'));
        
        Pagination::set_config(array(
            'pagination_url' => 'categories/index',
            'per_page' => 5,
            'total_items' => $total_categories,
            'num_links' => 3,
        ));
        
        $categories = Model_Category::find('all', array(
            'offset' => Pagination::$offset,
            'limit' => Pagination::$per_page,
        ));
        
        $this->template->title = 'Categories';
        $this->template->content = View::factory('categories/index', array(
            'total_categories' => $total_categories,
            'categories' => $categories,
        ));
    }
    
    public function action_add()
    {
        $data = array();
        
        if ( Input::method() == 'POST' )
        {
            $add_category = Validation::factory('add_category');
            $add_category->add('name', 'Name')->add_rule('required');
            
            if ( $add_category->run() == TRUE )
            {
                $category = new Model_Category(array(
                    'name' => Input::post('name'),
                    'description' => Input::post('description'),
                    'created_time' => time(),
                ));

                $category->save();
                
                Session::set_flash('message', 'Category successfully added.');
                
                Output::redirect('categories/add');
            }
            else
            {
                $data['errors'] = $add_category->show_errors();
            }
        }
        
        $this->template->title = 'Add Category';
        $this->template->content = View::factory('categories/add', $data);
    }
    
    public function action_edit($id)
    {
        $category = Model_Category::find($id);
        
        if ( Input::method() == 'POST' )
        {
            $edit_category = Validation::factory('edit_category');
            $edit_category->add('name')->add_rule('required');
            
            if ( $edit_category->run() == TRUE )
            {
                $category->name = Input::post('name');
                $category->description = Input::post('description');
                $category->save();
            
                Session::set_flash('message', 'Category successfully updated.');
            
                Output::redirect('categories/edit/'.$category->id);
            }
            else
            {
                $data['errors'] = $edit_category->show_errors();
            }
        }
        
        $data['category'] = $category;
        $this->template->title = 'Edit Category - '.$category->name;
        $this->template->content = View::factory('categories/edit', $data);
    }
    
    public function action_delete($id)
    {
        Model_Category::find($id)->delete();
                
        Output::redirect('categories/index');
    }
}