<?

include('../include_functions.php');
checkAccess(2);
include('functions_imap.php');

set_time_limit(0);

checkMail();

Header("Location: tickets_abertos.php");

?>