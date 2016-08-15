<?php

/**
 * Database data declaration class
 *
 */
class Database {

	// Used for setting up database connection.
	private $_connection;

	// Used for instantiating database.
	private static $_instance;

	// Function for getting database instance.
	public static function getInstance() {
		if(!static::$_instance) {
			static::$_instance = new self;
		}

		return static::$_instance;
	}

	// Main constructor of the Database class.
	public function __construct() {
		try {
			$this->_connection = new PDO('sqlite:Database/online_store.db');
		} catch(Exception $e) {
			echo $e->getMessage();
			die();
		}
	}

	// Function for connecting to the database.
	public function connect() {
		return $this->_connection;
	}

}

?>