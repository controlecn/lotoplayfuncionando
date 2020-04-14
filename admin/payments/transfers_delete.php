<?

include('../include_functions.php');
checkAccess(1);

error_reporting(0);

$id = $_REQUEST["id"];

$sql = "Delete from transfers Where id = $id";

$userid = GetRow("SELECT userId FROM transfers WHERE id = $id");
$valor = GetRow("SELECT value FROM transfers WHERE id = $id");
$username = GetRow("SELECT username FROM users WHERE id = $userid");
makeLog("Transferencia $id Deletada. Valor: $valor. Usuario: $username");

SqlQuery($sql);

Header("Location: transfers.php");

?>