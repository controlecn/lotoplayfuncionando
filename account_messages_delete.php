<?

include("include_settings.php");

$id = sql_injection_check($_GET["id"]);

if (GetRow("SELECT COUNT(id) FROM messages WHERE userid = '".$user_data["id"]."' AND id = '$id'")!=0) {
	SqlQuery("DELETE FROM messages WHERE id = '$id'");
}

Header("Location: ".$links["ACCOUNT_MESSAGES"]);

?>