<?

include('../include_functions.php');
checkAccess(2);

$userid = $_GET["userid"];

$session = md5(uniqid(rand().generate_password(30)));
	
while (GetRow("SELECT COUNT(id) FROM sessions WHERE sessionId = '$session'")!=0) {
	srand((double)microtime()*1000000);
	$session = md5(uniqid(rand()));
}

SqlQuery("INSERT INTO `sessions` (`sessionId`,`userId`,`sessionStart`,`lastACTIVE`,`userType`) VALUES ('$session', '$userid', NOW(), NOW(), '1')");
setcookie("session", $session, time()+300, "/");
	
Header("Location: ../../");

?>