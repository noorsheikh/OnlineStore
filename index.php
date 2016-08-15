<?php
// remove the below line before deployment
ini_set('errors_display', 'On');

include "init.php";

$query = new ProductQueries;
$products = $query->showProducts();

// $query->deleteAllProducts();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Online Store</title>
</head>
<body>
	<a href="new.php" >New</a>
	<table>
		<tr>
			<td>Product ID</td>
			<td>Product Name</td>
			<td>Product Type</td>
			<td>Description</td>
			<td>Stock</td>
			<td>Price</td>
			<td>Action</td>
		</tr>
	<?php foreach($products as $item) { ?>
		<tr>
			<td><a href="product.php?id=<?php echo $item['product_id']; ?>" ><?php echo $item['product_id']; ?></a></td>
			<td><?php echo $item['product_name']; ?></td>
			<td><?php echo $item['product_type']; ?></td>
			<td><?php echo $item['description']; ?></td>
			<td><?php echo $item['stock']; ?></td>
			<td><?php echo $item['price']; ?></td>
			<td><a href="product.php?id=<?php echo $item['product_id']; ?>" > View</a><a href="update.php?id=<?php echo $item['product_id']; ?>" > Update</a><a href="delete.php?id=<?php echo $item['product_id']; ?>" > Delete</a></td>
		</tr>
	<?php } ?>
	</table>
</body>
</html>