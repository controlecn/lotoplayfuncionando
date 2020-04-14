<?

include('../include_functions.php');

$id = $_GET["id"];

$content_type = GetRow("SELECT content_type FROM tickets_attachments WHERE id = $id");
$filename = GetRow("SELECT filename FROM tickets_attachments WHERE id = $id");

header("Content-Type: $content_type"); 
header("Content-Disposition: attachment; filename='$filename'");

echo GetRow("SELECT filedata FROM tickets_attachments WHERE id = $id");

?>