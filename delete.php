<?php
  // remove the below line before deployment
  ini_set('errors_display', 'On');

  include "init.php";

  $query = new ProductQueries;
  $id = $_GET['id'];
  $product = $query->deleteProduct($id);

  header("Location: http://localhost/onlinestore/")
?>