<?

include('../include_functions.php');
checkAccess(2);
error_reporting(0);

$categoryId = $_POST["categoryId"];
$answer = addslashes($_POST["answer"]);
$question = addslashes($_POST["question"]);

$sql = "Insert into faq_questions (categoryId,question,answer) Values ('$categoryId', '$question', '$answer')";

SqlQuery($sql);

Header("Location: category.php?categoryId=$categoryId&update=yes");

?>