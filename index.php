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
		<script src="video.js" charset="utf-8"></script>
	</head>
	<body>
		<header>
			<a href='/'><h1>Camagru</h1></a><ul>
			<li><a href='logout.php'>Log Out</a></li>
			<li><a href='account.php'>Mon compte</a></li>
			<li><a href='gallery.php'>Gallery</a></li></ul>
		</header>
		<div class="main">
			<div id="video">
				<video autoplay></video>
				<canvas id="image" draggable=true></canvas>
			</div>
			<button id="snap" onclick="javascript:Snap()">Snap</button>
			<form action='index.php' id='upload'><input type='submit' value='Upload a File'></form>
		<form action="index.php">
		<fieldset>
			<div class="filter">
					<label class="radio-label" for="britney"><img src="./public/img/britney.png"></label>
					<input class="radio-input" id="britney"  type="radio" name="filter" value="./public/img/britney.png" onchange="show_img('britney')">
					<label class="radio-label" for="presi"><img src="./public/img/prési.png"></label>
					<input class="radio-input" id="presi" type="radio" name="filter" value="./public/img/prési.png" onchange="show_img('presi')">
					<label class="radio-label" for="cat"><img src="./public/img/cat.png"></label>
					<input class="radio-input" id="cat" type="radio" name="filter" value="./public/img/cat.png" onchange="show_img('cat')">
					<label class="radio-label" for="pelle"><img src="./public/img/pelle.jpeg"></label>
					<input class="radio-input" id="pelle" type="radio" name="filter" value="./public/img/pelle.jpeg" onchange="show_img('pelle')">
			</div>
		</fieldset>
		</div>
		</form>
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
