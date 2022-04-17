<?php
	//Function to connect to database
	function getConnection() {
		try {
			$connection = new PDO( "mysql:host=localhost;dbname=unn_w19015804", "unn_w19015804", "Mohinee1997!" );
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $connection;
		} 
		catch (Exception $e) {
			throw new Exception("Connection error ". $e->getMessage(), 0, $e);
		}
	}

	//Function to save session variable
	function set_session($key, $value) {
		$_SESSION[$key] = $value;
		return true;
	}

	//Function to read session variable
	function get_session($key = 'false') {
		//Check if session element 'key' exists
		if (isset($_SESSION[$key])) {
			//Read the session’s value from the $_SESSION array 
			$value = $_SESSION[$key];
			//Return session's value
			return $value;
		}
	}




?>