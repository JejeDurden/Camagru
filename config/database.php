<?php
	$DB_DSN = "mysql:host=127.0.0.1";
	$DB_USER = "root";
	$DB_PASSWORD = "root";
	$DB_NAME="CamagruDB";
	$conn = new PDO("$DB_DSN;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
?>
