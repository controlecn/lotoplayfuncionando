<?

include('../include_functions.php');
checkAccess(2);
include('functions_imap.php');

$username = $_POST["username"];
$message = $_POST["message"];
$subject = $_POST["subject"];
$account_id = $_POST["account_id"];

$userid = GetRow("SELECT id FROM users WHERE username = '$username'");
$email = GetRow("SELECT email FROM users WHERE username = '$username'");

sendTicketEmail($account_id, $email, $subject, $message);

$ticket_id = SqlQuery("INSERT INTO tickets (account_id, subject, status, userid, email, ticket_type, ticket_date) VALUES ('$account_id', '".addslashes($subject)."', '1', '$userid', '$email', '1', NOW())");
$content_id = SqlQuery("INSERT INTO tickets_contents (ticket_id, content_time, content_type, contents) VALUES ('$ticket_id', NOW(), '2', '".addslashes($message)."')");
echo "INSERT INTO tickets (account_id, subject, status, userid, email, ticket_type, ticket_date) VALUES ('$account_id', '".addslashes($subject)."', '1', '$userid', '$email', '1', NOW())<br>";
echo "INSERT INTO tickets_contents (ticket_id, content_time, content_type, contents) VALUES ('$ticket_id', NOW(), '2', '".addslashes($message)."')";

//Header("Location: tickets_info.php?id=$ticket_id");

?>