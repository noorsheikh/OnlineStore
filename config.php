<?php

// remove the below line before deployment
ini_set('errors_display', 'On');

try {
	$connection = new PDO('sqlite:online_store.db');
	if($connection) {
		echo "Database connected successfully!";
	} else {
		echo "Unable to connect to the database!";
	}
} catch(Exception $e) {
	echo $e->getMessage();
}

?>