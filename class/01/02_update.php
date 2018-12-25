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
	
	$data 	= array('status' => 1, 'ordering' => 90, 'name' => 'User');
	$where00	= array(
						array('status', 1, 'and'),
						array('ordering', 90),
				);
	$where01	= array(
						array('id', 3),
				);
	
	$result =  $database->updateData($data ,$where01);

	echo $result;
	
