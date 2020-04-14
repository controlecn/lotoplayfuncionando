<?

include('../../include_functions.php');
checkAccess(2);
error_reporting(0);

$hours = $_POST["hours"];
$active = $_POST["active"];
$players_min = $_POST["players_min"];
$players_max = $_POST["players_max"];
$cards_min = $_POST["cards_min"];
$cards_max = $_POST["cards_max"];
$prize_percents = $_POST["prize_percents"];

$error = 0;

if (verifyNumber($players_min)==0) {
	$error = 1;
}

if (verifyNumber($players_max)==0) {
	$error = 2;
}

if (verifyNumber($cards_min)==0) {
	$error = 3;
}

if (verifyNumber($cards_max)==0) {
	$error = 4;
}

if (verifyFloat($prize_percents)==0) {
	$error = 5;
}

if ($error==0) {
	SqlQuery("UPDATE cron_vip SET active = '$active', players_min = '$players_min', players_max = '$players_max', cards_min = '$cards_min', cards_max = '$cards_max', prize_percents = '$prize_percents' WHERE hours = '$hours'");
	Header("Location: vip_hours.php");
} else {
	Header("Location: vip_hours_edit.php?hours=$hours&error=$error");
}

?>