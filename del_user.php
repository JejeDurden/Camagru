<?PHP

if ($_POST["passwd"] !== NULL)
{
	$tab_accounts = unserialize(file_get_contents("./private/passwd"));
	foreach ($tab_accounts as $key => $elem)
	{
		$login = key($elem);
		if ($elem[$login] == hash("whirlpool", $_POST["passwd"]))
		{
			unset($tab_accounts[$key]);
		}
	}
	file_put_contents("./private/passwd", serialize($tab_accounts));
	header('Location: index.php');
}
else
	echo ("ERROR\n");
?>
