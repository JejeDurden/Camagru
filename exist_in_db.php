<?php
include './config/database.php';

function loginCheck($login, $conn) {
	$stmt = $conn->prepare("SELECT login FROM user WHERE login = ':login'");
	$stmt->bindParam(':login', $login);
	$stmt->execute();

	if($stmt->rowCount() > 0)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function emailCheck($email, $conn) {
	$stmt = $conn->prepare("SELECT email FROM user WHERE email = ':email'");
	$stmt->bindParam(':email', $email);
	$stmt->execute();

	if($stmt->rowCount() > 0)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function pwdCheck($password, $conn) {
	$stmt = $conn->prepare("SELECT password FROM user WHERE password = ':password'");
	$stmt->bindParam(':password', $password);
	$stmt->execute();

	if($stmt->rowCount() > 0)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
?>
