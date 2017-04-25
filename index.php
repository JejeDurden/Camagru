<?PHP
session_start();
if ($_SESSION["loggued_on_user"] == NULL)
{
	header("Location: create_user.php");
}
else
{
	echo "<div class='bonjour'><h1>Bonjour ".$_SESSION["loggued_on_user"]."</h1>";
	echo "<a href='modif.html'>Modifier un compte</a>";
	echo "<a href='del_user.html'>Supprimer un compte</a>";
	echo "<form action='logout.php'><button class='button' name='logout'>Logout</button></form></div>";
}
?>

<html>
	<div id="bglog"></div>
	<head>
		<meta charset="UTF-8" />
		<title>Camagru</title>
		<link rel="stylesheet" type="text/css" href="./css/stylesheet.css">
	</head>
	<body>
		<header><p>I am the header</p></header>
		<form action="create.php" method="post" class="show">
			<input type="text" name="login" value="" placeholder="Login" id="name"><br />
			<input type="text" placeholder="Email"name="email" value=""><br/>
			<input type="text" placeholder="Password"name="passwd" value=""><br />
			<input type="submit" value="Sign up">
			<a href="login.html">Login</a>
		</form>
		</div>
		<footer><p>I am the footer</p></footer>
	</body>
</html>
