<?php
session_start();
if (isset($_POST["submit"]))
{
	include './config/database.php';
	include './exist_in_db.php';

	$login = $_POST["login"];
	$password = $_POST["passwd"];
	$password = hash('whirlpool', $password);

	if (authCheck($login, $password, $conn) === 1)
	{
		$_SESSION["loggued_on_user"] = $login;
		header("Location: index.php");
	}
	else
	{
		echo "<div class='error'>Wrong login or password</div>\n";
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
		<form action="login.php" method="post" class="show">
			<input type="text" name="login" value="" placeholder="Login" id="name" required /><br />
			<input type="text" placeholder="Password"name="passwd" value="" required /><br />
			<input type="submit" name="submit" value="Log in">
			<a href="create_user.php">Sign Up</a><br/>
			<a href="reset.php">Reset password</a>
		</form>
		</div>
	</body>
</html>
