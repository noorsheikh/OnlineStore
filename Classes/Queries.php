<?php

// Including the init configuration file.
include "../Database/Database.php";

/**
 * Class for managing all of the database queries.
 *
 */
class Queries {

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

	// show all products.
	public $allProducts;

	// List all categories through this variable.
	public $_show_all_categories;

	// show all categories.
	public $allCategories;

	// List all types through this variable.
	public $_show_all_types;

	// show all types.
	public $allTypes;

	// Last inserted record id.
	public $id;

	// Product database field declaration.
	public $productName = "";
	public $categoryId = "";
	public $description = "";
	public $stock = 0;
	public $price = 0;
	public $imageUrl = "";
	public $typeId = 0;

	
	// Main constructor of the Queries class.
	public function __construct() {

		// Getting the database instance and connecting to the database.
		$this->_db = Database::getInstance();
		$this->_connect = $this->_db->connect();

		// Checking the form fields for data.
		if(isset($_POST['product_name'])) {
			$this->productName = htmlspecialchars($_POST['product_name']);
		}
		if(isset($_POST['category_id'])) {
			$this->categoryId = htmlspecialchars($_POST['category_id']);
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
		if(isset($_POST['image_url'])) {
			$this->imageUrl = htmlspecialchars($_POST['image_url']);
		}
		if(isset($_POST['type_id'])) {
			$this->typeId = htmlspecialchars($_POST['type_id']);
		}
	}

	/**
	 * Function to list all of the products to the clients.
	 *
	 */
	public function showProducts() {
		try {

			// Query all products join with categories
			$this->_show_all_products = $this->_connect->prepare("select p.*, c.category_name, b.type_name from product p join category c on c.category_id = p.category_id join type b on b.type_id = p.type_id");
			$this->_show_all_products->execute();
			$this->allProducts = $this->_show_all_products->fetchAll(PDO::FETCH_ASSOC);

			return json_encode(array(
				'error' => false,
				'items' => $this->allProducts
			), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

		} catch(PDOException $e) {
			echo json_encode(array(
				'error' => true,
				'message' => $e->getMessage()
			), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
		}
	}

	/**
	 * Function to insert a new product in the database through form.
	 *
	 */
	public function insertProduct() {
		try {

			// Form validation
			if( 
				empty($_POST['product_name']) ||
				empty($_POST['category_id']) ||
				empty($_POST['description']) ||
				empty($_POST['stock']) ||
				empty($_POST['price']) ||
				empty($_POST['image_url']) ||
				empty($_POST['type_id'])
			) {
				throw new PDOException('Please insert the missing data!');
			}

			// Insert data into the product table
			$this->insert_query = "INSERT INTO product (product_name, category_id, description, stock, price, image_url, brnad_id) VALUES ('$this->productName', $this->categoryId, '$this->description', $this->stock, $this->price, '$this->imageUrl', $this->typeId)";
			
			$this->_insert_product = $this->_connect->prepare($this->insert_query);
			$this->_insert_product->execute();

			return json_encode(array(
				'error' => false,
				'item' => $this->_insert_product
			), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

		} catch(PDOException $e) {
			echo json_encode(array(
				'error' => true,
				'message' => $e->getMessage()
			), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
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

	/**
	 * Function to list all of the categories to the clients.
	 *
	 */
	public function showCategories() {
		try {

			// Query all categories
			$this->_show_all_categories = $this->_connect->prepare("SELECT * FROM category");
			$this->_show_all_categories->execute();
			$this->allCategories = $this->_show_all_categories->fetchAll(PDO::FETCH_ASSOC);

			return json_encode(array(
				'error' => false,
				'categories' => $this->allCategories
			), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

		} catch(PDOException $e) {
			echo json_encode(array(
				'error' => true,
				'message' => $e->getMessage()
			), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
		}
	}

	/**
	 * Function to list all of the types to the clients.
	 *
	 */
	public function showTypes() {
		try {

			// Query all types
			$this->_show_all_types = $this->_connect->prepare("SELECT * FROM type");
			$this->_show_all_types->execute();
			$this->allTypes = $this->_show_all_types->fetchAll(PDO::FETCH_ASSOC);

			return json_encode(array(
				'error' => false,
				'types' => $this->allTypes
			), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

		} catch(PDOException $e) {
			echo json_encode(array(
				'error' => true,
				'message' => $e->getMessage()
			), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
		}
	}
}

?>