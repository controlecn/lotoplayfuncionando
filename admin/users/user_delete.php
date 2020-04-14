<?

	include('../include_functions.php');
	
	checkAccess(2);

	$id = $_GET["id"];

	SqlQuery("UPDATE users SET `delete` = '1' WHERE id = '$id'");

	Header("Location: deleted.php");

?>