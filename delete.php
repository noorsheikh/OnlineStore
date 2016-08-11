<?php
  // remove the below line before deployment
  ini_set('errors_display', 'On');

  include "queries.php";

  $query = new Queries;
  $id = $_GET['id'];
  $product = $query->deleteProduct($id);

  header("Location: http://localhost/onlinestore/")
?>