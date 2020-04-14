<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$forAffliates = $_POST["forAffliates"];
$creditValue = $_POST["creditValue"];
$points = $_POST["points"];

$error = 0;

if (verifyNumber($forAffliates)==0) {
	$error = 1;
}

if ($error==0) {

	setSetupVar("payment_forAffliates", $forAffliates);
	setSetupVar("server_creditvalue", $creditValue);
	setSetupVar("payment_points", $points);

	Header("Location: options.php?update=yes");
	
} else {

	Header("Location: options.php?error=$error");

}

?>