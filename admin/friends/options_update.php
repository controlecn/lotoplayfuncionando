<?

include('../include_functions.php');
checkAccess(2);
error_reporting(0);

$friend1 = $_POST["friend1"];
$friend2 = $_POST["friend2"];
$friend3 = $_POST["friend3"];

$error = 0;

if (verifyNumber($friend1)==0) {
	$error = 1;
}

if (verifyNumber($friend2)==0) {
	$error = 2;
}

if (verifyNumber($friend3)==0) {
	$error = 3;
}

if ($error==0) {

	setSetupVar("friend_friend1", $friend1);
	setSetupVar("friend_friend2", $friend2);
	setSetupVar("friend_friend3", $friend3);

	Header("Location: options.php?update=yes");
	
} else {

	Header("Location: options.php?error=$error");

}

?>