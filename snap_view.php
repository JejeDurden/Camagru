<?PHP
session_start();
include './config/database.php';
if(empty($_SESSION["loggued_on_user"]))
{
	header("Location: create_user.php");
	exit();
}
else if (empty($GET["id"]))
{
	header("Location: index.php");
	exit();
}
?>

<html>
	<div id="bglog"></div>
	<head>
		<meta charset="UTF-8" />
		<title>Camagru</title>
		<link rel="stylesheet" type="text/css" href="./public/css/stylesheet.css">
	</head>
	<body>
		<header>
			<a href='/'><h1>Camagru</h1></a><ul>
			<li><a href='logout.php'>Log Out</a></li>
			<li><a href='account.php'>Mon compte</a></li>
			<li><a href='gallery.php'>Gallery</a></li></ul>
			<li><a href='index.php'>Snap</a></li></ul>
		</header>
		<div class="main">
			<div id="video">
				<div id="image">
					<?php
						$id = $GET["id"];
						try {
							$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
							$sql = $conn->prepare("SELECT image WHERE id = :id");
							$sql->bindParam(':id', $id);
							$sql->execute;
							$row = $sql->fetch();
							echo "<tr>";
							echo "<td>" . $row['id'] ."</td>";
							echo "</tr>";
						}
						catch(PDOException $e) {
							echo "<div class='error'>Connection failed: " . $e->getMessage() . "\n</div>";
						}
					?>
		</aside>
		<div class ="footer">
			<div><p>If you want to say hello or ask questions, do not hesitate to contact us !</p></div>
			<div><h1>hello@camagru.com</h3></div>

					?>
				</div>
			</div>
		</div>
		<aside>
		<h3>Last pics</h3>
		<?PHP
		try {
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$sql = $conn->query("SELECT * FROM image");
			$i = 0;
			while ($row = $sql->fetch() && $i < 10)
			{
				echo "<tr>";
				echo "<td>" . $row['id'] ."</td>";
				echo "</tr>";
				$i++;
			}
		}
		catch(PDOException $e) {
			echo "<div class='error'>Connection failed: " . $e->getMessage() . "\n</div>";
		}
		?>
		</aside>
		<div class ="footer">
			<div><p>If you want to say hello or ask questions, do not hesitate to contact us !</p></div>
			<div><h1>hello@camagru.com</h3></div>
			<div><p>Developed from Paris with love by jdesmare in 2017</p></div>
		</div>
	</body>
</html>
