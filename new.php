<?php
	// remove the below line before deployment
	ini_set('errors_display', 'On');

	require("queries.php");

	$query = new Queries;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Online Store</title>
	<form method="POST" action="<?php $query->insertProduct(); ?>">
		<table>
			<tr>
				<td><label for="product_name">Product Name:</label></td>
				<td><input type="text" name="product_name"></td>
			</tr>
			<tr>
				<td><label for="product_type">Product Type:</label></td>
				<td><input type="text" name="product_type"></td>
			</tr>
			<tr>
				<td><label for="description">Description:</label></td>
				<td><textarea name="description"></textarea></td>
			</tr>
			<tr>
				<td><label for="stock">Stock:</label></td>
				<td><input type="text" name="Stock"></td>
			</tr>
			<tr>
				<td><label for="price">Price:</label></td>
				<td><input type="text" name="price"></td>
			</tr>
		</table>
	</form>
</head>
<body>

</body>
</html>