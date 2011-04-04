<?php

class Model_Category extends Orm\Model {
 
    protected static $_has_many = array('articles');
}