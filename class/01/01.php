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

	$arrData = array( 
					array ('name'=>'Member', 'status' => 0, 'ordering' => 9),
					array ('name'=>'Nguyen Ngoc Cong', 'status' => 1, 'ordering' => 90)
				);

	$arr_result = $database->insertData($arrData, 'multy');
	
	echo "New Record has id " . $arr_result;