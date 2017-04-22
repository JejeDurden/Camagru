<?PHP
session_start();
if ($_SESSION["loggued_on_user"] != NULL)
{
	echo "<div class='bonjour'><h1>Bonjour ".$_SESSION["loggued_on_user"]."</h1>";
	echo "<form action='logout.php'><button class='button' name='logout'>Logout</button></form></div>";
}

?>

<html>
	<head>
		<meta charset="UTF-8" />
		<title>Camagru</title>
		<link rel="stylesheet" type="text/css" href="./css/stylesheet.css">
	</head>
	<body>
		<div id="tete">
			<a href="create.html">Créer un compte</a>
			<a href="login.html">Login</a>
			<a href="modif.html">Modifier un compte</a>
			<a href="del_user.html">Supprimer un compte</a>
		</div>
		<div id="banner">
		<h1>Camagru</h1>
		</div>
		<div id="center">
			<ul><?PHP
				?>
			</ul>
		</div>
		<br />
		<br />
		<?php
			?>
	</body>
</html>
