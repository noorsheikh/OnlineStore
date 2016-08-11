<?php
  // remove the below line before deployment
  ini_set('errors_display', 'On');

  include "queries.php";

  $query = new Queries;
  $id = $_GET['id'];
  $product = $query->showProduct($id);

  // $query->deleteAllProducts();
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
    <tr>
      <td><?php echo $product['product_id']; ?></td>
      <td><?php echo $product['product_name']; ?></td>
      <td><?php echo $product['product_type']; ?></td>
      <td><?php echo $product['description']; ?></td>
      <td><?php echo $product['stock']; ?></td>
      <td><?php echo $product['price']; ?></td>
    </tr>
  </table>
</head>
<body>

</body>
</html>