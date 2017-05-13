<?php
if (!file_exists('./public/snaps')) 
{
	mkdir('./public/snaps', 0775, true);
}

$img = $_POST['img'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = './public/snaps/'.mktime().'.png';
$userID = getUserID($SESSION["loggued_on_user"]);
$success = file_put_contents($file, $data);
echo $success ? $file : 'Unable to save the file.';
$file = 'snaps/'.mktime().'.png';

include_once '../config/database.php';
try 
{
	$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sth = $dbh->prepare('INSERT INTO image (path, userID) VALUES (:file, :userID)');
	$sth->bindParam(':file', $file);
	$sth->bindParam(':userID', $user);
	$sth->execute();
}
catch (PDOException $e) 
{
	echo $sql.'<br>'.$e->getMessage();
}

header("Location: index.php");
