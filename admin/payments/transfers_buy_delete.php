<?

	include('../include_functions.php');
	checkAccess(1);
	
	$id = $_REQUEST["id"];
	SqlQuery("UPDATE transfers_buy SET status = '2', boughtWhen = NOW() WHERE id = $id");
	
	$userid = GetRow("SELECT userId FROM transfers_buy WHERE id = $id");
	$username = GetRow("SELECT username FROM users WHERE id = $userid");
	makeLog("Compra $id Cancelada. Usuario: $username");

	Header("Location: transfers_buy.php");

?>