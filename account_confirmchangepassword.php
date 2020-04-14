<?

$key = sql_injection_check($_GET["key"]);

if (GetRow("SELECT COUNT(id) FROM users_changepassword WHERE verifykey = '$key'")!=0) {

	$user_id = GetRow("SELECT userid FROM users_changepassword WHERE verifykey = '$key'");
	$new_pass = GetRow("SELECT newpassword FROM users_changepassword WHERE verifykey = '$key'");
	
	SqlQuery("UPDATE users SET password = '$new_pass' WHERE id = '$user_id'");

	SqlQuery("DELETE FROM users_changepassword WHERE verifykey = '$key'");
	
	showContent("MYACCOUNT_CHANGEPASSWORD_OK");
} else {
	showContent("MYACCOUNT_CHANGEPASSWORD_NOTOK");
}


?>