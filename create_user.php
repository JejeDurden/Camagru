<?php
session_start();
if (isset($_POST["submit"]))
{
	include './config/database.php';
	include './exist_in_db.php';
	include './email.php';

	$login = $_POST["login"];
	$email = $_POST["email"];
	$password = $_POST["passwd"];
	$password = hash('whirlpool', $password);
	$key = md5(microtime(TRUE)*10000);

	if (loginCheck($login, $conn) === 0 && emailCheck($email, $conn) === 0)
	{
		try {
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$sql = $conn->prepare("INSERT INTO user (login, email, password, token) VALUES (:login, :email, :password, :key)");
			$sql->bindParam(':login', $login);
			$sql->bindParam(':email', $email);
			$sql->bindParam(':password', $password);
			$sql->bindParam(':key', $key);
			$sql->execute();
			sendMail($email, $login, $key);
			echo "<div class='sent'>Email sent. Please log in your mailbox and validate your account.</div>\n";
		}
		catch(PDOException $e) {
			echo "Connection failed: " . $e->getMessage() . "\n";
		}
		$conn = null;
	}
	else
	{
		echo "<div class='error'>Login or email already used</div>\n";
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Camagru</title>
		<link rel="stylesheet" type="text/css" href="./public/css/stylesheet.css">
	</head>
	<body>
		<div id="bg"></div>
		<div id="log">
		<h1>Camagru</h1>
		<form action="create_user.php" method="post">
			<input type="text" name="login" value="" placeholder="Login" id="name" required /><br />
			<input type="text" placeholder="Email" name="email" value="" required /><br/>
			<input type="password" placeholder="Password" minlength=8 name="passwd" value="" required /><br />
			<input type="submit" name="submit" value="Sign up">
			<a href="login.php">Login</a>
		</form>
		</div>
	</body>
</html>
