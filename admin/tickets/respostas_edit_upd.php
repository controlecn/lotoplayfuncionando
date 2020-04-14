<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$id = $_POST["id"];
$nome = addslashes($_POST["nome"]);
$email = addslashes($_POST["email"]);

SqlQuery("UPDATE tickets_emails SET nome = '$nome', email = '$email' WHERE id = $id");

Header("Location: respostas_overview.php?update=yes");

?>