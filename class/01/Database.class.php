<?php

	class Database
	{
		protected $_link;
		protected $_result;
		protected $_numRows;

		private $_host = "host";
		private $_username = "root";
		private $_password = " ";
		private $_database = "";

		// Establish connection to database, when class is instantiated
		public function __construct()
		{
			$this->_link = new mysqli($this->host, $this->username, $this->password, $this->database);
			if(mysqli_connect_errno()) {
				echo "Connection Failed: " . mysqli_connect_errno();
				exit();
			}
		}

		// Sends the query to the connection
		public function query($sql)
		{
			$this->_result = $this->_link->query($sql) or die (mysqli_error($this->_result));
			return $this->_result;
		}

		// Inserts into databse
		
	}