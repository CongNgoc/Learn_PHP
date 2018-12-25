<?php

	require_once 'Database.class.php';

	$params = array(
					'server' 	=> 'localhost',
					'username'	=> 'root',
					'password'	=> '',
					'database'	=> 'db_user',
					'table'		=> 'group'
	);

	$database = new Database($params);

	$arrData = array('name'=>'Member 1234', 'status' => 0, 'ordering' => 9);

	$arr_result = $database->insertData($arrData);
	
	echo '<pre>';
	print_r($arr_result);
	echo '</pre>';