<?php

class Controller_Categories extends Controller_Common {
	
    public function action_index()
	{
		// Get total categories
        $total_categories = Model_Category::find()
            ->where('user_id', $this->user_id)
            ->count();
		
		// Setup pagination
		Config::set('pagination', array(
			'pagination_url' => 'categories/index',
			'per_page' => 5,
			'total_items' => $total_categories,
			'num_links' => 3,
		));
		
		// Get categories
		$categories = Model_Category::find('all', array(
			'offset' => Pagination::$offset,
			'limit' => Pagination::$per_page,
			'where' => array(
				array('user_id', '=', $this->user_id),
			),
		));
		
		$this->template->title = 'Categories';
		$this->template->content = View::factory('categories/index')
			->set('total_categories', $total_categories)
			->set('categories', $categories, false);
	}
	
	public function action_add()
	{
		// Setup validation
		$val = Validation::factory('add_category');
		$val->add('name', 'Name')->add_rule('required');
		$val->add('description', 'Description');
		
		if ($val->run())
		{
			// Set category details
			$category = new Model_Category(array(
				'user_id' => $this->user_id,
				'name' => $val->validated('name'),
				'description' => $val->validated('description'),
			));
			
			// Save
			if ($category->save())
			{
				Session::set_flash('success', 'Category successfully added.');
			}
			else
			{
				Session::set_flash('error', 'Something went wrong, please try again!');
			}
			
			Response::redirect('categories/add');
		}
		
		$this->template->title = 'Add Category';
		$this->template->content = View::factory('categories/add')
			->set('val', $val, false);
	}
	
	public function action_edit($id)
	{
		$category = Model_Category::find_by_id_and_user_id($id, $this->user_id);
		
		$val = Validation::factory('edit_category');
		$val->add('name', 'Name')->add_rule('required');
		$val->add('description', 'Description');
		
		if ($val->run())
		{
			$category->name = $val->validated('name');
			$category->description = $val->validated('description');
			
			if ($category->save())
			{
				Session::set_flash('success', 'Category successfully updated.');
			}
			else
			{
				Session::set_flash('error', 'Something went wrong, please try again!');
			}
			
			Response::redirect('categories/edit/'.$category->id);
		}
		
		$this->template->title = 'Edit Category - '.$category->name;
		$this->template->content = View::factory('categories/edit')
			->set('val', $val, false)
			->set('category', $category);
	}
	
	public function action_delete($id)
	{
		// Find and delete category
		Model_Category::find_by_id_and_user_id($id, $this->user_id)->delete();
		
		Response::redirect('categories');
	}
}

/* End of file categories.php */
