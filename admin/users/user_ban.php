<?

	include('../include_functions.php');
	
	checkAccess(2);

	$id = $_REQUEST["id"];

	SqlQuery("UPDATE users SET ban = '1' WHERE id = '$id'");

	Header("Location: active.php");

?>