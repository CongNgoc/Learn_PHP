<?php
	require_once 'Database.class.php';
	
	$params		= array(
						'server' 	=> 'localhost',
						'username'	=> 'root',
						'password'	=> '',
						'database'	=> 'db_user',
						'table'		=> 'group',
					);
	
	$database = new Database($params);
	
	$ids 	= array(3, 2);

	
	echo $database->deleteData($ids);
	
