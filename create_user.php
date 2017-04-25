<?php
include './config/database.php';
include './exist_in_db.php';

$login = $_POST["login"];
$email = $_POST["email"];
$password = $_POST["passwd"];
$password = hash('whirlpool', $password);

if (loginCheck($login, $conn) === 0 && emailCheck($email, $conn) === 0 && pwdCheck($password, $conn) === 0)
{
	try {
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$sql = $conn->prepare("INSERT INTO user (login, email, password) VALUES (:login, :email, :password)");
			$sql->bindParam(':login', $login);
			$sql->bindParam(':email', $email);
			$sql->bindParam(':password', $password);
			$sql->execute();
			$_SESSION["loggued_on_user"] = $login;
			header("Location: index.php");
	}
	catch(PDOException $e) {
			echo "Connection failed: " . $e->getMessage() . "\n";
	}
	$conn = null;
}
else
{
	echo "Error\n";
	header("Location: index.php");
}
?>

