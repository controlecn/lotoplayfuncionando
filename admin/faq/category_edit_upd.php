<?

include('../include_functions.php');
checkAccess(2);
error_reporting(0);

$categoryId = $_REQUEST["categoryId"];
$id = $_POST["id"];
$answer = addslashes($_POST["answer"]);
$question = addslashes($_POST["question"]);

$sql = "Update faq_questions Set answer = '$answer', question = '$question' Where id = $id";

SqlQuery($sql);

Header("Location: category.php?categoryId=$categoryId&update=yes");

?>