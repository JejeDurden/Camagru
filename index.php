<?PHP
session_start();
include './config/database.php';
if(empty($_SESSION["loggued_on_user"]))
{
	header("Location: create_user.php");
}
else if ($_POST["submit"] == "Log Out")
{
	header("Location: logout.php");
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
		<?PHP
			echo "<a href='/'><h1>Camagru</h1></a><ul>";
			echo "<li><form action='logout.php'><input type='submit' value='Log Out'></form></li>";
			echo "<li><a href='gallery.php'>Gallery</a></li></ul>";
		?>
		</header>
		<div class="main">
		<script src="video.js" charset="utf-8"></script>
			<video id="video" width="640" height="480" autoplay></video>
			<button id="snap" onclick="javascript:Snap()">Snap</button>
			<div >
			<form action='index.php' id='upload'><input type='submit' value='Upload a File'></form>
		<div class="filter">
			<form action="index.php">
				<label for="britney"><img src="./public/img/britney.png"></label>
				<input type="radio" name="filter" value="britney">
				<label for="presi"><img src="./public/img/prési.jpg"></label>
				<input type="radio" name="filter" value="presi">
				<label for="cat"><img src="./public/img/cat.png"></label>
				<input type="radio" name="filter" value="cat">
				<label for="pelle"><img src="./public/img/pelle.jpeg"></label>
				<input type="radio" name="filter" value="pelle">
			</form>
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
			<div><h3>hello@camagru.com</h3></div>
			<div><p>Developed from Paris with love by jdesmare in 2017</p></div>
		</div>
	</body>
</html>
