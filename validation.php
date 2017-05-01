<?php
session_start();
if (isset($_GET["log"]) && isset($_GET["key"]))
{
	include './config/database.php';
	include './exist_in_db.php';

	$login = $_GET["log"];
	$key = $_GET["key"];

	try {
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$sql = $conn->prepare("SELECT token,active FROM user WHERE login like :login ");
		$sql->bindParam(':login', $login);
		$sql->execute();
		$row = $sql->fetch();
		$keysql = $row["token"];
		$active = $row["active"];
		if ($active == '1')
		{
			echo "<div class='error'>Your account is already active</div>\n";
		}
		else
		{
			if ($key == $keysql)
			{
				$sql = $conn->prepare("UPDATE user SET active = 1 WHERE login like :login");
				$sql->bindParam(':login', $login);
				$sql->execute();
				$_SESSION["loggued_on_user"] = $login;
				header("Location: index.php");
			}
			else
			{
				echo "<div class='error'>An error occurred. Please try again or contact the website.</div>\n";
			}
		}
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
		<form action="create_user.php" method="post" class="show">
			<input type="text" name="login" value="" placeholder="Login" id="name" required /><br />
			<input type="text" placeholder="Email" name="email" value="" required /><br/>
			<input type="text" placeholder="Password" minlength=8 name="passwd" value="" required /><br />
			<input type="submit" name="submit" value="Sign up">
			<a href="login.php">Login</a>
		</form>
		</div>
	</body>
</html>
