<?PHP

session_start();
unset($_SERVER["PHP_AUTH_USER"]);
unset($_SERVER["PHP_AUTH_PW"]);
$_SESSION["admin"] = NULL;
$_SESSION["loggued_on_user"] = NULL;
session_destroy();
header('Location: index.php');
exit();
?>
