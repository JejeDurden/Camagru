<?php

$DB_DSN = "mysql:host=127.0.0.1";
$DB_USER = "root";
$DB_PASSWORD = "root";
$DB_NAME="CamagruDB";

try {
		$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$conn ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
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
			password VARCHAR(150) NOT NULL,
			active INT(2) NOT NULL DEFAULT '0',
			token VARCHAR(32) NOT NULL
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
			author VARCHAR(50) NOT NULL,
			author_mail VARCHAR(50) NOT NULL,
			name VARCHAR(50) NOT NULL,
			path VARCHAR(50) NOT NULL,
			heart INT(6) NOT NULL
		)";
		$conn->exec($sql);
		echo "Image Table created successfully\n";
}
catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage() . "\n";
}

$conn = null;

try {
		$conn = new PDO("$DB_DSN;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE comments (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			content VARCHAR(250) NOT NULL,
			image_id INT(6) NOT NULL
		)";
		$conn->exec($sql);
		echo "Comments Table created successfully\n";
}
catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage() . "\n";
}

$conn = null;

?>
