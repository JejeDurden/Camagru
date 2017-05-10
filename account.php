<?PHP
session_start();
include './config/database.php';
if(empty($_SESSION["loggued_on_user"]))
{
	header("Location: create_user.php");
}
else if ($_POST["submit"] == "delete")
{
	
}
?>

<html>
	<div id="bglog"></div>
	<head>
		<meta charset="UTF-8" />
		<title>Camagru</title>
		<link rel="stylesheet" type="text/css" href="./public/css/stylesheet.css">
	<script>
		function showDiv() {
			document.getElementById("show").style.display = "block";
		}
	</script>
	</head>
	<body>
		<header>
			<a href='/'><h1>Camagru</h1></a><ul>
			<li><a href='logout.php'>Log Out</a></li>
			<li><a href='gallery.php'>Gallery</a></li>
			<li><a href='index.php'>Snap</a></li></ul>
		</header>
		<div class="modif">
			<div><h2>My account</h2>
				<h4 onclick="showDiv()">Change username</h4>
				<div id="show">
				<input type="text" name="newlogin" value="New login">
				<input type="submit" name="submit" value="Submit">
				</div>
				<input id="delete" type="submit" name="delete" value="Delete My Account">
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
		<div class ="footer2">
			<div><p>If you want to say hello or ask questions, do not hesitate to contact us !</p></div>
			<div><h1>hello@camagru.com</h3></div>
			<div><p>Developed from Paris with love by jdesmare in 2017</p></div>
		</div>
	</body>
</html>