<?php

// Including the init configuration file.
include "./Database/Database.php";

/**
 * Class for managing all of the database queries.
 *
 */
class ProductQueries {

	// Database instantiation variable.
	public $_db;

	// Database connection variable.
	public $_connect;

	// List all products through this variable.
	public $_show_all_products;

	// Inserting new product to the database.
	public $_insert_product;

	// Deleting all products from the database.
	public $_delete_products;

	// Product inserting query.
	public $insert_query;

	// Show single product.
	public $show_product;

	// Delete single product.
	public $delete_product;

	// Update single product.
	public $update_product;

	// Product database field declaration.
	public $productName = "";
	public $productType = "";
	public $description = "";
	public $stock = 0;
	public $price = 0;

	
	// Main constructor of the Queries class.
	public function __construct() {

		// Getting the database instance and connecting to the database.
		$this->_db = Database::getInstance();
		$this->_connect = $this->_db->connect();

		// Checking the form fields for data.
		if(isset($_POST['product_name'])) {
			$this->productName = htmlspecialchars($_POST['product_name']);
		}
		if(isset($_POST['product_type'])) {
			$this->productType = htmlspecialchars($_POST['product_type']);
		}
		if(isset($_POST['description'])) {
			$this->description = htmlspecialchars($_POST['description']);
		}
		if(isset($_POST['stock'])) {
			$this->stock = htmlspecialchars($_POST['stock']);
		}
		if(isset($_POST['price'])) {
			$this->price = htmlspecialchars($_POST['price']);
		}
	}

	/**
	 * Function to list all of the products to the clients.
	 *
	 */
	public function showProducts() {
		try {

			$this->_show_all_products = $this->_connect->prepare("SELECT * FROM product");
			$this->_show_all_products->execute();
			return $this->_show_all_products->fetchAll();
		} catch(Exception $e) {
			echo $e->getMessage();
			die();
		}
	}

	/**
	 * Function to insert a new product in the database through form.
	 *
	 */
	public function insertProduct() {
		try {

			$this->insert_query = "INSERT INTO product (product_name, product_type, description, stock, price) VALUES ('$this->productName', '$this->productType', '$this->description', $this->stock, $this->price)";
			
			$this->_insert_product = $this->_connect->prepare($this->insert_query);
			$this->_insert_product->execute();
			if(isset($_POST['submit'])) {
				return header("Location: http://localhost/onlinestore/");
			}
		} catch(Exeption $e) {
			echo $e->getMessage();
			die();
		}
	}

	/**
	 * Function to delete all products in the product table.
	 *
	 */
	public function deleteAllProducts() {
		try {
			
			$this->_delete_products = $this->_connect->prepare("TRUNCATE TABLE product");
			return $this->_delete_products->execute();
		} catch(Exception $e) {
			echo $e->getMessage();
			die();
		}
	}



	/**
	 * Function for retriving single product through product_id
	 *
	 */
	public function showProduct($id) {
		try {
			$this->show_product = $this->_connect->prepare("SELECT * FROM product WHERE product_id =" . $id);
			$this->show_product->execute();
			return $this->show_product->fetch();
		} catch(Exception $e) {
			echo $e->getMessage();
			die();
		}
	}



	/**
	 * Function for deleting single product through product_id
	 *
	 */
	public function deleteProduct($id) {
		try {
			$this->delete_product = $this->_connect->prepare("DELETE FROM product WHERE product_id =" . $id);
			$this->delete_product->execute();
			
		} catch(Exception $e) {
			echo $e->getMessage();
			die();
		}
	}

	/**
	 * Function for delete a single product by product_id
	 *
	 */
	public function updateProduct($id) {
		try {
			$this->update_product = $this->_connect->prepare("UPDATE product SET product_name = '$this->productName', product_type = '$this->productType', description = '$this->description', stock = $this->stock, price = $this->price WHERE product_id =" . $id);
			return $this->update_product->execute();
		} catch(Exception $e) {
			echo $e->getMessage();
			die();
		}
	}
}

?>