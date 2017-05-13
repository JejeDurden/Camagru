<?php
session_start();
if (isset($_GET["log"]) && isset($_GET["key"]))
{
	$email = $_GET["log"];
	$key = $_GET["key"];
}
if ($email && $key && isset($_POST["submit"]))
{
	include './config/database.php';
	include './exist_in_db.php';

	$password = hash('whirlpool', $_POST["password"]);
	$confpassword = hash('whirlpool', $_POST["confpasswd"]);

	try {
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$sql = $conn->prepare("SELECT token,password FROM user WHERE email like :email ");
		$sql->bindParam(':email', $email);
		$sql->execute();
		$row = $sql->fetch();
		$keysql = $row["token"];
		$active = $row["password"];
		if ($key !== $keysql)
		{
			echo "<div class='error'>Your password has already been changed</div>\n";
		}
		else
		{
			if ($password === $confpassword)
			{
				$sql = $conn->prepare("UPDATE user SET token = 0 WHERE email like :email ");
				$sql->bindParam(':email', $email);
				$sql->execute();
				$sql = $conn->prepare("UPDATE user SET password = :password WHERE email like :email ");
				$sql->bindParam(':email', $email);
				$sql->bindParam(':password', $password);
				$sql->execute();
				$sql = $conn->prepare("SELECT login FROM user WHERE email like :email ");
				$sql->bindParam(':email', $email);
				$row = $sql->fetch();
				$login = $row["login"];
				$SESSION["loggued_on_user"] = $login;
				header("Location: login.php");
				exit();
			}
			else
			{
				echo "<div class='error'>Your password and password confirmation are not matching. Please try again.</div>\n";
			}
		}
	}
	catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage() . "\n";
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
		<?PHP
		echo "<form action='reset_pwd.php?log=". $email . "&key=" . $key ."' method='post'>";
		?>
			<input type="password" placeholder="New Password" minlength=8 name="passwd" value="" required /><br />
			<input type="password" placeholder="Confirm password" minlength=8 name="confpasswd" value="" required /><br />
			<input type="submit" name="submit" value="Change Password">
		</form>
		</div>
	</body>
</html>
