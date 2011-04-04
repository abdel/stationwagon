<?php

class Model_Article extends Orm\Model {
    
    protected static $_belongs_to = array('category');
}