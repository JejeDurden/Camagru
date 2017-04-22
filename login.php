<?PHP

include 'auth.php';
session_start();
$login = $_POST["login"];
$passwd = $_POST["passwd"];
if (auth($login, $passwd) === TRUE)
{
	$_SESSION["loggued_on_user"] = $login;
	header('Location: index.php');
}
else
{
	echo "Ce compte n'existe pas\n";
	$_SESSION["loggued_on_user"] = NULL;
}

?>
