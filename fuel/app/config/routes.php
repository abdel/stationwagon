<?php
return array(
	'_root_'  => 'users/index',  // The default route
	'_404_'   => 'common/404',    // The main 404 route

	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);
