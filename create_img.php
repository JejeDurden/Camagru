<?php
session_start();
if (!file_exists('./public/snaps'))
{
	mkdir('./public/snaps', 0775, true);
}

$img = $_POST['data'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = './public/snaps/'.mktime().'.png';
$login = $_SESSION["loggued_on_user"];
$success = file_put_contents($file, $data);

include_once './config/database.php';
try
{
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = $conn->prepare('SELECT id FROM user WHERE login = :login');
	$sql->bindParam(':login', $login);
	$sql->execute();
	$row = $sql->fetch();
	$userID = $row["id"];
}
catch (PDOException $e)
{
	echo $sql.'<br>'.$e->getMessage();
}

try
{
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sth = $conn->prepare('INSERT INTO image (path, userID) VALUES (:path, :userID)');
	$sth->bindParam(':path', $file);
	$sth->bindParam(':userID', $userID);
	$sth->execute();
}
catch (PDOException $e)
{
	echo $sql.'<br>'.$e->getMessage();
}

$conn = NULL;

header("Location: index.php");
exit();
