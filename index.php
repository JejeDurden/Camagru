<?PHP
session_start();
include './config/database.php';
/*if(!empty($_SESSION["loggued_on_user"]))
{
	echo "<div class='bonjour'><h1>Bonjour ".$_SESSION["loggued_on_user"]."</h1>";
	echo "<a href='modif.html'>Modifier un compte</a>";
	echo "<a href='del_user.html'>Supprimer un compte</a>";
	echo "<form action='logout.php'><button class='button' name='logout'>Logout</button></form></div>";
}
else
{
	header("Location: create_user.php");
}*/
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
			<div class="title">Camagru</div>
		</header>
		<div class="main">
		<video id="video" width="640" height="480" autoplay></video>
		<button id="snap">Snap</button>
		<canvas id="canvas" width="640" height="480"></canvas>
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
		<footer>
			<div><p>If you want to say hello or ask questions, do not hesitate to contact us !</p></div>
			<div><h3>hello@camagru.com</h3></div>
			<div><p>Developed with love by jdesmare in 2017</p></div>
		</footer>
	</body>
	<script>
		var video = document.getElementById('video');
		if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia)
		{
			navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream)
			{
				video.src = window.URL.createObjectURL(stream);
				video.play();
			});
			var canvas = document.getElementById('canvas');
			var context = canvas.getContext('2d');
			var video = document.getElementById('video');
			document.getElementById("snap").addEventListener("click", function() {
				context.drawImage(video, 0, 0, 640, 480);
				});
		}
	</script>
</html>
