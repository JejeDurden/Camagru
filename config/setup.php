<?php
include 'database.php';
$DB_NAME="CamagruDB";

try {
		$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$conn->setAttribute($DB_OPTIONS);
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
		$conn->setAttribute($DB_OPTIONS);
		$sql = "CREATE TABLE user (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
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
		$conn->setAttribute($DB_OPTIONS);
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

mkdir("./private", 0777);
$account = ["godfather" => "cef8420e3086c47ccc52f16e052b727f106107f29f306954099ed47df51f6f924ddc578b91ba473484e440d14216b35295253a30980ad2323a181406fd65c27c"];
$tab_account[] = $account;
file_put_contents("./private/passwd", serialize($tab_account));

?>
