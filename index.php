<?PHP
session_start();
include './config/database.php';
if(empty($_SESSION["loggued_on_user"]))
{
	header("Location: create_user.php");
	exit();
}
if ($_POST["fileToUpload"])
{
	$target_dir = "./public/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	if (!empty($_FILES["upload"]["tmp_name"]))
	{
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	}
	else
	{
		$check = false;
	}
	if ($check !== false)
	{
		echo "<div class='sent'>File is an image - " . $check["mime"] . ".</div>";
		$uploadOk = 1;
	}
	else
	{
		echo "<div class='error'>File is not an image. Please try again</div>\n";
		$uploadOk = 0;
	}
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
			<li><a href='account.php'>My account</a></li>
			<li><a href='gallery.php'>Gallery</a></li></ul>
		</header>
		<div class="main">
			<div id="video">
				<video autoplay id="cam"></video>
				<canvas id="image" draggable=true></canvas>
			</div>
			<button id="snap" onclick="javascript:snap()">Snap</button>
			<form id="upload" enctype="multipart/form-data" action="index.php" method="post">
				<input type="file" name="fileToUpload" id="fileToUpload" onchange="javascript:sendImg()">
				<input type="submit" value="Upload Image" id="Btnsubmit" onclick="javascript:upload()">
			</form>
		<form action="index.php">
		<fieldset>
			<div class="filter">
					<label class="radio-label" for="love"><img src="./public/img/love.png"></label>
					<input class="radio-input" id="love"  type="radio" name="filter" value="./public/img/love.png" onchange="show_img('love')">
					<label class="radio-label" for="hand"><img src="./public/img/hand.png"></label>
					<input class="radio-input" id="hand" type="radio" name="filter" value="./public/img/hand.png" onchange="show_img('hand')">
					<label class="radio-label" for="bulb"><img src="./public/img/bulb.png"></label>
					<input class="radio-input" id="bulb" type="radio" name="filter" value="./public/img/bulb.png" onchange="show_img('bulb')">
					<label class="radio-label" for="lippoutou"><img src="./public/img/lippoutou.png"></label>
					<input class="radio-input" id="lippoutou" type="radio" name="filter" value="./public/img/lippoutou.png" onchange="show_img('lippoutou')">
					<label class="radio-label" for="loubard"><img src="./public/img/loubard.png"></label>
					<input class="radio-input" id="loubard" type="radio" name="filter" value="./public/img/loubard.png" onchange="show_img('loubard')">
					<label class="radio-label" for="pika"><img src="./public/img/pika.png"></label>
					<input class="radio-input" id="pika" type="radio" name="filter" value="./public/img/pika.png" onchange="show_img('pika')">
					<label class="radio-label" for="kokiyas"><img src="./public/img/kokiyas.png"></label>
					<input class="radio-input" id="kokiyas" type="radio" name="filter" value="./public/img/kokiyas.png" onchange="show_img('kokiyas')">
					<label class="radio-label" for="bulls"><img src="./public/img/bulls.png"></label>
					<input class="radio-input" id="bulls" type="radio" name="filter" value="./public/img/bulls.png" onchange="show_img('bulls')">
					<label class="radio-label" for="smile"><img src="./public/img/smile.png"></label>
					<input class="radio-input" id="smile" type="radio" name="filter" value="./public/img/smile.png" onchange="show_img('smile')">
					<label class="radio-label" for="noel"><img src="./public/img/noel.png"></label>
					<input class="radio-input" id="noel" type="radio" name="filter" value="./public/img/noel.png" onchange="show_img('noel')">
			</div>
		</fieldset>
		</div>
		</form>
		<aside>
		<h3>Last pics</h3>
		<?PHP
		$dup = $conn;
		try {
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$sql = $conn->query("SELECT * FROM image ORDER BY id DESC LIMIT 4");
			while ($row = $sql->fetch())
			{
				echo "<div class='imgside'>";
				echo "<a href='snap_view.php?id=" . $row["id"] . "'><img class='smallimg' src='" . $row["path"] . "'></a>";
				$id = $row["id"];
				try {
					$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
					$dup = $conn->prepare("SELECT COUNT(*) FROM hearts WHERE imageID = :id ");
					$dup->bindParam(':id', $id);
					$dup->execute();
					$hearts = $dup->fetch();
					{
						echo "<div class='underimgside'>";
						echo "<img class='heart' src='./public/img/heart.png'><span class='count'>" . $hearts[0] . "</span>";
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
						echo "<img class='comment' src='./public/img/comment.png'><span class='count'>" . $comments[0] . "</span>";
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
		<script src="video.js" charset="utf-8"></script>
	</body>
</html>
