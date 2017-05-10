<?php

function sendMail($dest, $login, $key) {
	$obj = "Activation de votre compte";
	$from = "From: validate@camagru.com";
	$msg = 'Welcome on Camagru,
		To activate your account and access content on our website, please click
		on the following link :
		http://localhost:8080/Camagru/validation.php?log='.urlencode($login).'&key='.urlencode($key).'
		Cheers,
		Camagru Team';
	$message = wordwrap($msg, 70, "\r\n");
	mail($dest, $obj, $message, $from);
}

function commentMail($dest, $login, $pic) {
	$obj = "Nouveau commentaire";
	$from = "From: noresponse@camagru.com";
	$msg = 'Hello'.$login.',
		To activate your account and access content on our website, please click
		on the following link :
		http://localhost:8080/Camagru/snap_view.php?pic='.urlencode($pic).'
		Cheers,
		Camagru Team';
	$message = wordwrap($msg, 70, "\r\n");
	mail($dest, $obj, $message, $from);
}

?>
