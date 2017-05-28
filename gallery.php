<?PHP
session_start();
include './config/database.php';
if(empty($_SESSION["loggued_on_user"]))
{
	header("Location: create_user.php");
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
			<a href='index.php'><h1>Camagru</h1></a><ul>
			<li><a href='logout.php'>Log Out</a></li>
			<li><a href='account.php'>My account</a></li>
			<li><a href='index.php'>Snap</a></li></ul>
		</header>
		<div class="gallery">
			<h3>Gallery</h1>
		<?PHP
		$dup = $conn;
		try {
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$sql = $conn->query("SELECT * FROM image");
			while ($row = $sql->fetch())
			{
				echo "<div class='blockgallery'>";
				echo "<a href='snap_view.php?id=" . $row["id"] . "'><img class='imggallery' src='" . $row["path"] . "'></a>";
				$id = $row["id"];
				try {
					$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
					$dup = $conn->prepare("SELECT COUNT(*) FROM hearts WHERE imageID = :id ");
					$dup->bindParam(':id', $id);
					$dup->execute();
					$hearts = $dup->fetch();
					{
						echo "<div class='underimgside'>";
						echo "<a href='add_like.php?id=" . $id . "&path=gallery'><img class='heart' src='./public/img/heart.png'></a><span class='count'>" . $hearts[0] . "</span>";
					}
				}
				catch(PDOException $e) {
					echo "<div class='error'>Connection failed: " . $e->getMessage() . "\n</div>";
				}
				try {
					$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
					$dup = $conn->prepare("SELECT COUNT(*) FROM comments WHERE imageID = :id ");
					$dup->bindParam(':id', $id);
					$dup->execute();
					$comments = $dup->fetch();
					{
						echo "<a href='snap_view.php?id=" . $row["id"] . "'>";
						echo "<img class='comment' src='./public/img/comment.png'></a><span class='count'>" . $comments[0] . "</span>";
						echo "</div>";
						echo "</div>";
					}
				}
				catch(PDOException $e) {
					echo "<div class='error'>Connection failed: " . $e->getMessage() . "\n</div>";
				}
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
