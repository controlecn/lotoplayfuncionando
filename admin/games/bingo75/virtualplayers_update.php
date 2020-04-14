<?

include('../../include_functions.php');
checkAccess(2);
error_reporting(0);

$onoff = $_POST["onoff"];
$minplayers = $_POST["minplayers"];
$maxplayers = $_POST["maxplayers"];
$mincards = $_POST["mincards"];
$maxcards = $_POST["maxcards"];

$error = 0;

if (verifyNumber($minplayers)==0) {
	$error = 1;
}

if (verifyNumber($maxplayers)==0) {
	$error = 2;
}

if (verifyNumber($mincards)==0) {
	$error = 3;
}

if (verifyNumber($maxcards)==0) {
	$error = 4;
}

if ($error==0) {

	setSetupVar("bingo75_vip_onoff", $onoff);
	setSetupVar("bingo75_vip_players_min", $minplayers);
	setSetupVar("bingo75_vip_players_max", $maxplayers);
	setSetupVar("bingo75_vip_cards_min", $mincards);
	setSetupVar("bingo75_vip_cards_max", $maxcards);

	$fp = fsockopen("reidobingo-net.umbler.net",$config["server_port"],$errno,$errstr);
	fputs($fp,"ROOT update_configuration bingo75\0");
	$rec_auth = fread($fp, 2048);

	Header("Location: virtualplayers.php?update=yes");
	
} else {

	Header("Location: virtualplayers.php?error=$error");

}

?>