<?php
session_start();
include './config/database.php';
include './email.php';
if(empty($_SESSION["loggued_on_user"]))
{
	header("Location: create_user.php");
}
$login = $_SESSION["loggued_on_user"];
$imageID = $_GET["id"];
$comment = $_POST["newcomment"];
try
{
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = $conn->prepare("SELECT id FROM user WHERE login = :login");
	$sql->bindParam(':login', $login);
	$sql->execute();
	$row = $sql->fetch();
	$userID = $row["id"];
}
catch (PDOException $e)
{
	echo "Connection failed: " . $e->getMessage() . "\n";
}
try
{
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = $conn->prepare("SELECT * FROM image WHERE id = :imageID");
	$sql->bindParam(':imageID', $imageID);
	$sql->execute();
	$row = $sql->fetch();
	$author = $row["userID"];
}
catch (PDOException $e)
{
	echo "Connection failed: " . $e->getMessage() . "\n";
}
if ($author != $userID)
{
	try
	{
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = $conn->prepare("SELECT * FROM user WHERE id = :id");
		$sql->bindParam(':id', $author);
		$sql->execute();
		$row = $sql->fetch();
		$author_mail = $row["email"];
		$author_login = $row["login"];
	}
	catch (PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage() . "\n";
	}
	commentMail($author_mail, $author_login, $imageID);
}
try
{
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = $conn->prepare('INSERT INTO comments (content, userID, imageID) VALUES (:content, :userID, :imageID)');
	$sql->bindParam(':content', $comment);
	$sql->bindParam(':userID', $userID);
	$sql->bindParam(':imageID', $imageID);
	$sql->execute();
}
catch (PDOException $e)
{
	echo "Connection failed: " . $e->getMessage() . "\n";
}

	header("Location: snap_view.php?id=" . $imageID);

?>
