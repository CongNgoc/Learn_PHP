<?php

	class Database
	{
		protected $_connect;
		protected $_database;
		protected $_table;
		protected $_resultQuery;

		// CONNECT DATABASE
		// Establish connection to database, when class is instantiated
		public function __construct($params)
		{
			$_link = new mysqli($params['server'], $params['username'], $params['password'], $params['database']);
			if(mysqli_connect_errno()) {
				echo "Connection Failed: " . mysqli_connect_errno();
				exit();
			}
			else
			{
				$this->_connect 	= $_link;
				$this->_database 	= $params['database'];
				$this->_table 		= $params['table'];
			}
		}

		//SET CONNECT
		public function setConnect($connect)
		{
			$this->_connect = $connect;
		}

		// SET CONNECT
		public function setDatabase($database = null)
		{
			if($database != null)
			{
				$this->_database = $database;
			}
			$this->_connect->select_db($this->_database);
		}

		//SET TABLE
		public function setTable($table)
		{
			$this->_table = $table;
		}

		//DISCONNECT DATABASE
		public function __destruct()
		{
			$this->_connect->close();
		}

		//INSERT DATA
		public function insertData($data)
		{
			$newQuery 	= $this->createQueryInsert($data);
			$query 		= "INSERT INTO `$this->_table`(". $newQuery['cols'] .") VALUES (". $newQuery['vals'].");";
			$this->query($query);
		}
		
		//CREATE QUERY INSERT
		public function createQueryInsert($data)
		{
			$cols = "";
			$vals = "";
			$newQuery = array();
			if(!empty($data))
			{
				foreach ($data as $key => $value) {
					$cols .= ", `$key`";
					$vals .= ", '$value'";
				}
			}
			$newQuery['cols'] = substr($cols, 2);
			$newQuery['vals'] = substr($vals, 2);
			return $newQuery;
		}

		//QUERY TO DATABASE
		public function query($query)
		{
			$this->_resultQuery = $this->_connect->query($query);
			return $this->_resultQuery;
		}
	}