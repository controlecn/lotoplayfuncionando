<?

include('../include_functions.php');
checkAccess(2);
error_reporting(0);

$onoff = $_POST["onoff"];
$min = $_POST["min"];
$max = $_POST["max"];

$error = 0;

if (verifyNumber($min)==0) {
	$error = 1;
}

if (verifyNumber($max)==0) {
	$error = 2;
}

if ($error==0) {

	setSetupVar("surprise_bonus_active", $onoff);
	setSetupVar("surprise_bonus_min", $min);
	setSetupVar("surprise_bonus_max", $max);

	Header("Location: options.php?update=yes");
	
} else {

	Header("Location: options.php?error=$error");

}

?>