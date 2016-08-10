<?php

require_once("database.php");
require "product.php";

class Queries {

	public $_connect;

	public $_connected;

	public $_show_all_products;

	public $_insert_product;

	public $product;

	public $productName = $_POST['product_name'];
	public $productType = $_POST['product_type'];
	public $description = $_POST['description'];
	public $stock = $_POST['stock'];
	public $price = $_POST['price'];

	public function __construct() {
			$this->productName = $productName;
			$this->productType - $productType;
			$this->description = $description;
			$$this->stock = $stock;
			$this->price = $price;
	}

	public function showAllProducts() {
		try {

			$_connect = Database::getInstance();
			$this->_connected = $_connect->connect();
			$this->_show_all_products = $this->_connected->prepare("SELECT * FROM product");
			$this->_show_all_products->execute();
			return $this->_show_all_products->fetchAll();
		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}

	public function insertProduct() {
		try {
			$_connect = Database::getInstance();
			$this->_connected = $_connect->connect();
			$this->_connected->prepare("INSERT INTO product (product_name, product_type, description, stock, price) VALUES (?, ?, ?, ?, ?)");
			$this->_connected->bindParam(1, $this->productName);
			$this->_connected->bindParam(2, $this->productType);
			$this->_connected->bindParam(3, $this->description);
			$this->_connected->bindParam(4, $this->stock);
			$this->_connected->bindParam(5, $this->price);
			$this->_insert_product = $this->_connected->execute();
		} catch(Exeption $e) {
			echo $e->getMessage();
		}
	}
}



?>