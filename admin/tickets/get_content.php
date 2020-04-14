<?

include('../include_functions.php');
checkAccess(2);

$content_id = $_GET["id"];

echo GetRow("SELECT contents FROM tickets_contents WHERE id = $content_id");


?>