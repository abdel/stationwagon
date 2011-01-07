<?php

class Model_Category extends ActiveRecord\Model {
 
    protected $has_many = array('articles');
}