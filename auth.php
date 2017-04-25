<?PHP
function auth($login, $passwd)
{
	$tab_accounts = unserialize(file_get_contents("./private/passwd"));
	foreach ($tab_accounts as $elem)
	{
		foreach ($elem as $user => $mdp)
		{
			if ($login === $user && hash("whirlpool", $passwd) === $mdp)
			{
				file_put_contents("./private/passwd", serialize($tab_accounts));
				return (TRUE);
			}
		}
	}
	file_put_contents("./private/passwd", serialize($tab_accounts));
	return (FALSE);
	}
?>
