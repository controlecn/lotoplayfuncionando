<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$nome = $_POST["nome"];
$email = $_POST["email"];

SqlQuery("INSERT INTO newsletter_emails (nome, email) VALUE ('$nome', '$email')");

Header("Location: emails_overview.php?update=yes");

?>