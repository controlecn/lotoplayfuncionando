<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$id = $_POST["id"];
$fullname = $_POST["fullname"];
$username = $_POST["username"];
$email = $_POST["email"];

$error = 0;

if (GetRow("SELECT COUNT(id) FROM users WHERE username = '$username' AND id != '$id'")!=0) {
	$error = 1;
}

if (GetRow("SELECT COUNT(id) FROM users WHERE email = '$email' AND id != '$id'")!=0) {
	$error = 2;
}


if ($error==0) {

	SqlQuery("UPDATE users SET fullname = '$fullname', username = '$username', email = '$email' WHERE id = '$id'");

	Header("Location: user_info.php?id=$id");
	
} else {

	Header("Location: change.php?error=$error&id=$id");

}

?>