<?php
include './config/database.php';

function loginCheck($login, $conn) {
	$stmt = $conn->prepare("SELECT login FROM user WHERE login = :login");
	$stmt->bindParam(':login', $login);
	$stmt->execute();

	if ($stmt->rowCount() > 0)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function emailCheck($email, $conn) {
	$stmt = $conn->prepare("SELECT email FROM user WHERE email = :email");
	$stmt->bindParam(':email', $email);
	$stmt->execute();
	if ($stmt->rowCount() > 0)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function pwdCheck($password, $conn) {
	$stmt = $conn->prepare("SELECT password FROM user WHERE password = :password");
	$stmt->bindParam(':password', $password);
	$stmt->execute();

	if ($stmt->rowCount() > 0)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function authCheck($login, $password, $conn) {
	$stmt = $conn->prepare("SELECT * FROM user WHERE login = :login AND password = :password AND active = '1'");
	$stmt->bindParam(':login', $login);
	$stmt->bindParam(':password', $password);
	$stmt->execute();

	if ($stmt->rowCount() > 0)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function getUserID($login) {
	$stmt = $conn->prepare("SELECT EXISTS (
	  SELECT * FROM user WHERE login = :login AND active = '1')");
	$stmt->bindParam(':login', $login);
	$stmt->execute();
	$result = $stmt->fetchAll();
	return ($result["id"]);
}
?>
