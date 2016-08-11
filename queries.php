<?php

require_once("database.php");

class Queries {

	public $_connect;

	public $_connected;

	public $_show_all_products;

	public $_insert_product;

	public $_delete_products;

	public $product;

	public $insert_query;

	public $productName = "";
	public $productType = "";
	public $description = "";
	public $stock = 0;
	public $price = 0;

	

	public function __construct() {
		if(isset($_POST['product_name'])) {
			$this->productName = $_POST['product_name'];
		}
		if(isset($_POST['product_type'])) {
			$this->productType = $_POST['product_type'];
		}
		if(isset($_POST['description'])) {
			$this->description = $_POST['description'];
		}
		if(isset($_POST['stock'])) {
			$this->stock = $_POST['stock'];
		}
		if(isset($_POST['price'])) {
			$this->price = $_POST['price'];
		}
	}

	public function showAllProducts() {
		try {

			$this->_connect = Database::getInstance();
			$this->_connected = $this->_connect->connect();
			$this->_show_all_products = $this->_connected->prepare("SELECT * FROM product");
			$this->_show_all_products->execute();
			return $this->_show_all_products->fetchAll();
		} catch(Exception $e) {
			echo $e->getMessage();
			die();
		}
	}

	public function insertProduct() {
		try {

			$this->insert_query = "INSERT INTO product (product_name, product_type, description, stock, price) VALUES ('$this->productName', '$this->productType', '$this->description', '$this->stock', $this->price)";
			$this->_connect = Database::getInstance();
			$this->_connected = $this->_connect->connect();
			$this->_insert_product = $this->_connected->prepare($this->insert_query);
			$this->_insert_product->execute();
			if(isset($_POST['submit'])) {
				return header("Location: http://localhost/onlinestore/");
			}
		} catch(Exeption $e) {
			echo $e->getMessage();
			die();
		}
	}

	public function deleteAllProducts() {
		try {
			$this->_connect = Database::getInstance();
			$this->_connected = $this->_connect->connect();
			$this->_delete_products = $this->_connected->prepare("TRUNCATE TABLE product");
			return $this->_delete_products->execute();
		} catch(Exception $e) {
			echo $e->getMessage();
			die();
		}
	}
}

?>