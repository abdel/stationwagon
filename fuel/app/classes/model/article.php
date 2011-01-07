<?php

class Model_Article extends ActiveRecord\Model {
    
    protected $belongs_to = array('category');
}