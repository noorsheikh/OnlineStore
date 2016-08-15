<?php
// remove the below line before deployment
ini_set('errors_display', 'On');

include "init.php";

$query = new ProductQueries;

$id = $_GET['id'];

$update = $query->updateProduct($id);

$product = $query->showProduct($id);

var_dump($product);
echo "Name: " . $product['product_name'];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Online Store</title>
	<form method="POST" action="<?php $update ?>">
		<table>
			<tr>
				<td><label for="product_name">Product Name:</label></td>
				<td><input type="text" name="product_name" value="<?php echo $product['product_name']; ?>"></td>
			</tr>
			<tr>
				<td><label for="product_type">Product Type:</label></td>
				<td><input type="text" name="product_type" value="<?php echo $product['product_type']; ?>"></td>
			</tr>
			<tr>
				<td><label for="description">Description:</label></td>
				<td><textarea name="description"></textarea></td>
			</tr>
			<tr>
				<td><label for="stock">Stock:</label></td>
				<td><input type="text" name="stock" value=""></td>
			</tr>
			<tr>
				<td><label for="price">Price:</label></td>
				<td><input type="text" name="price"></td>
			</tr>
			<tr>
				<td><input type="submit" name="submit" value="Create New"></td>
			</tr>
		</table>
	</form>
</head>
<body>

</body>
</html>