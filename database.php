<?php

class Database {

	public $_connection;

	public static $_instance;

	public static function getInstance() {
		if(!static::$_instance) {
			static::$_instance = new self;
		}

		return static::$_instance;
	}

	public function __construct() {
		try {
			$this->_connection = new PDO('sqlite:online_store.db');
			if($this->_connection) {
				echo "Database connected successfully!";
			} else {
				echo "Unable to connect to the database!";
			}
		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}

	public function connect() {
		return $this->_connection;
	}

}

?>