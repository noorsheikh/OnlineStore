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
		} catch(Exception $e) {
			echo $e->getMessage();
			die();
		}
	}

	public function connect() {
		return $this->_connection;
	}

}

?>