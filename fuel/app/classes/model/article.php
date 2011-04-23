<?php

class Model_Article extends Orm\Model {
	
	protected static $_belongs_to = array('category');
	
	protected static $_observers = array(
		'Orm\\Observer_CreatedAt' => array('before_insert'),
		'Orm\\Observer_UpdatedAt' => array('before_save'),
	);
	
	protected static $_properties = array(
		'id', 
		'user_id',
		'category_id',
		''
	);
}

/* End of file article.php */