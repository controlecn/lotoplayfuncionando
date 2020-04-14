<?

include('../include_functions.php');
checkAccess(2);
include('functions_imap.php');

$ticket_id = $_POST["ticket_id"];
$message = $_POST["message"];
$subject = $_POST["subject"];
$message_to = $_POST["message_to"];
$account_id = $_POST["account_id"];

sendTicketEmail($account_id, $message_to, $subject, $message);

SqlQuery("INSERT INTO tickets_contents (ticket_id, content_time, content_type, contents) VALUES ('$ticket_id', NOW(), '2', '".addslashes($message)."')");

Header("Location: tickets_info.php?id=$ticket_id");

?>