<?php
session_start();
include './config/database.php';
if(empty($_SESSION["loggued_on_user"]))
{
	header("Location: create_user.php");
}
$login = $_SESSION["loggued_on_user"];
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
$imageID = $_GET["id"];
$path = $_GET["path"];
try
{
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = $conn->prepare('SELECT * FROM hearts WHERE userID = :login AND imageID = :imageID');
	$sql->bindParam(':login', $userID);
	$sql->bindParam(':imageID', $imageID);
	$sql->execute();
	$row = $sql->fetch();
	if (!$row)
	{
		try
		{
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = $conn->prepare("INSERT INTO hearts (userID, imageID) VALUES (:userID, :imageID)");
			$sql->bindParam(':userID', $userID);
			$sql->bindParam(':imageID', $imageID);
			$sql->execute();
		}
		catch (PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage() . "\n";
		}
	}
	else
	{
		try
		{
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = $conn->prepare("DELETE FROM hearts WHERE userID = :userID AND imageID = :imageID");
			$sql->bindParam(':userID', $userID);
			$sql->bindParam(':imageID', $imageID);
			$sql->execute();
		}
		catch (PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage() . "\n";
		}
	}
}
catch (PDOException $e)
{
	echo "Connection failed: " . $e->getMessage() . "\n";
}

if ($path == "gallery")
{
	header("Location: gallery.php");
}
else if ($path == "snap_view")
{
	header("Location: snap_view.php?id=" . $imageID);
}

?>
