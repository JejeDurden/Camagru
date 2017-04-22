<?PHP

if ($_POST["newpw"] !== NULL || $_GET["submit"] !== "OK")
{
	$tab_accounts = unserialize(file_get_contents("./private/passwd"));
	foreach ($tab_accounts as &$elem)
	{
		$login = key($elem);
		if ($elem[$login] == hash("whirlpool", $_POST["oldpw"]))
			$elem[$login] = hash("whirlpool", $_POST["newpw"]);
	}
	file_put_contents("./private/passwd", serialize($tab_accounts));
	header('Location: index.php');
}
else
	echo ("ERROR\n");
?>
