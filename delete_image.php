<?PHP
session_start();
include './config/database.php';
if(empty($_SESSION["loggued_on_user"]))
{
	header("Location: create_user.php");
}
$login = $_SESSION["loggued_on_user"];
try
{
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = $conn->prepare("SELECT id FROM user WHERE login = :login");
	$sql->bindParam(':login', $login);
	$sql->execute();
	$row = $sql->fetch();
	$userID = $row["id"];
}
catch (PDOException $e)
{
	echo "Connection failed: " . $e->getMessage() . "\n";
}
$imageID = $_GET["id"];
try
{
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = $conn->prepare("DELETE FROM image WHERE userID = :userID AND id = :imageID");
	$sql->bindParam(':userID', $userID);
	$sql->bindParam(':imageID', $imageID);
	$sql->execute();
}
catch (PDOException $e)
{
	echo "Connection failed: " . $e->getMessage() . "\n";
}

	header("Location: index.php");

?>
