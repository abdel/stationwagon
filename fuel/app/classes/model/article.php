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
		'title',
		'body',
		'published',
		'created_at',
		'updated_at',
    );

    public static function validate($factory)
    {
        $val = Validation::factory($factory);

        $val->add('category_id', 'Category');

        $val->add('title', 'Title')
            ->add_rule('required');

        $val->add('body', 'Body')
            ->add_rule('required');

        return $val;
    }
}

/* End of file article.php */
