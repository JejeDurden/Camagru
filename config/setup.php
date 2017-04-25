<?php
include 'database.php';

try {
		$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE DATABASE CamagruDB";
		$conn->exec($sql);
		echo "Connected successfully\n";
}
catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage() . "\n";
}

$conn = null;

try {
		$conn = new PDO("$DB_DSN;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE user (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			login VARCHAR(50) NOT NULL,
			email VARCHAR(50) NOT NULL,
			password VARCHAR(150) NOT NULL
		)";
		$conn->exec($sql);
		echo "User Table created successfully\n";
}
catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage() . "\n";
}

$conn = null;

try {
		$conn = new PDO("$DB_DSN;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE image (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(50) NOT NULL
		)";
		$conn->exec($sql);
		echo "Image Table created successfully\n";
}
catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage() . "\n";
}

$conn = null;

?>
