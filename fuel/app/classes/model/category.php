<?php

class Model_Category extends Orm\Model {
	
	protected static $_has_many = array('articles');
	
	protected static $_observers = array(
		'Orm\\Observer_CreatedAt' => array('before_insert'),
		'Orm\\Observer_UpdatedAt' => array('before_save'),
	);
	
	protected static $_properties = array(
		'id', 
		'user_id',
		'name',
		'description',
		'created_at',
		'updated_at',
	);
}

/* End of file category.php */