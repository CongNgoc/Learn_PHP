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
		public function insertData($data, $type = "single")
		{	
			if($type == "single")
			{
				$newQuery 	= $this->createQueryInsert($data);
				$query 		= "INSERT INTO `$this->_table`(". $newQuery['cols'] .") VALUES (". $newQuery['vals'].");";
				$this->query($query);
			}
			else
			{
				foreach ($data as $value) {
					$newQuery 	= $this->createQueryInsert($value);
					$query 	= "INSERT INTO `$this->_table`(". $newQuery['cols'] .") VALUES (". $newQuery['vals'].");";
					$this->query($query);
				}
			}
			
			return $this->lastId();
		}
		
		// LAST ID
		public function lastId()
		{
			return $this->_connect->insert_id;
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

		//UPDATE DATA 
		public function updateData($data, $where)
		{
			$queryELements 	= $this->createQueryUpdate($data);
			$where 			= $this->createWhereQuery($where);
			$query = "UPDATE `$this->_table` SET ". $queryELements ." WHERE " . $where .";";
			$this->query($query);
			return $this->affectedRows();
		}

		//CREATE QUERY UPDATE
		public function createQueryUpdate($query)
		{
			$newQuery = "";
			if(!empty($query))
			{
				foreach ($query as $key => $value) 
				{
					$newQuery  .= ", `$key` = '$value'";
				}
			}
			$newQuery = substr($newQuery, 2);
			return $newQuery;
		}

		//CREATE NEW WHERE FOR QUERY UPDATE
		public function createWhereQuery($where)
		{
			$newWhere = '' ;
			$arrWhere = array();
			if(!empty($where))
			{
				foreach ($where as $value)
				{
					$arrWhere[] = "`$value[0]` = '$value[1]'"; 
					$arrWhere[] = $value[2]; 
				}
				$newWhere = implode(" ", $arrWhere);
				return $newWhere;
			}
		} 

		//AFFECTED ROWS
		public function affectedRows()
		{
			return $this->_connect->affected_rows;
		}

		//DELETE DATA
		public function deleteData()
		{
			
		}

	}