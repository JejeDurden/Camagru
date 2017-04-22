<?PHP

if ($_POST["login"] !== NULL || $_POST["passwd"] !== NULL || $_POST["submit"] !== "OK")
{
	$pb = 0;
	$tab_accounts = unserialize(file_get_contents("./private/passwd"));
	foreach ($tab_accounts as $key => $elem)
	{
		foreach ($elem as $login => $mdp)
		{
			if ($login === $_POST["login"])
			{
				$pb = 1;
				echo ("LOGIN DEJA EXISTANT\n");
				exit();
			}
		}
	}
	if ($pb === 0)
	{
		$account = [$_POST["login"] => hash("whirlpool", $_POST["passwd"])];
		$tab_accounts[] = $account;
		file_put_contents("./private/passwd", serialize($tab_accounts));
		header('Location: index.php');
	}
}
else
	echo ("ERROR\n");
?>
