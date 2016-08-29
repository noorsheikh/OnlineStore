<?php
// remove the below line before deployment
ini_set('errors_display', 'On');

include "../init.php";

$query = new Queries;

echo $query->showCategories();
?>