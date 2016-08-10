<?php
	// remove the below line before deployment
	ini_set('errors_display', 'On');

	require("queries.php");

	$query = new Queries;
	$products = $query->showAllProducts();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Online Store</title>
	<table>
		<tr>
			<td>Product ID</td>
			<td>Product Name</td>
			<td>Product Type</td>
			<td>Description</td>
			<td>Stock</td>
			<td>Price</td>
		</tr>
	<?php foreach($products as $item) { ?>
		<tr>
			<td><?php echo $item['product_id']; ?></td>
			<td><?php echo $item['product_name']; ?></td>
			<td><?php echo $item['product_type']; ?></td>
			<td><?php echo $item['description']; ?></td>
			<td><?php echo $item['stock']; ?></td>
			<td><?php echo $item['price']; ?></td>
		</tr>
	<?php } ?>
	</table>
</head>
<body>

</body>
</html>