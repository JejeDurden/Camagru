<?php
session_start();
if (isset($_POST["submit"]))
{
	include './config/database.php';
	include './email.php';

	$email = $_POST["email"];
	$key = md5(microtime(TRUE)*10000);

	try {
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$sql = $conn->prepare("INSERT INTO user (email, token) VALUES (:email, :key)");
		$sql->bindParam(':email', $email);
		$sql->bindParam(':key', $key);
		$sql->execute();
		sendMail($email, $email, $key);
		echo "<div class='sent'>Email sent. Please log in your mailbox to reset your password</div>\n";
	}
	catch(PDOException $e) {
		echo "<div class='error'>Connection failed: " . $e->getMessage() . "\n </div>";
	}
	$conn = null;
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
		<form action="reset.php" method="post">
			<input type="text" placeholder="Email" name="email" value="" required /><br/>
			<input type="submit" name="submit" value="Reset Password"><br />
			<a href="login.php">Login</a>
			<a href="create_user.php">Sign Up</a>
		</form>
		</div>
	</body>
</html>
