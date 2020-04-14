<?

include('../../include_functions.php');
checkAccess(2);
error_reporting(0);

$cardprice1 = $_POST["cardprice1"];
$cardprice2 = $_POST["cardprice2"];
$jackpot = $_POST["jackpot"];
$megaNumbers = $_POST["megaNumbers"];
$prize_percents = $_POST["prize_percents"];
$jackpot_percents = $_POST["jackpot_percents"];

$error = 0;

if (verifyFloat($jackpot)==0) {
	$error = 1;
}

if (verifyNumber($megaNumbers)==0) {
	$error = 2;
}

if (verifyNumber($cardprice1)==0) {
	$error = 3;
}

if (verifyNumber($cardprice2)==0) {
	$error = 4;
}

if (verifyFloat($prize_percents)==0) {
	$error = 5;
}

if (verifyFloat($jackpot_percents)==0) {
	$error = 6;
}

if ($error==0) {

	SqlQuery("UPDATE games SET jackpot = '$jackpot' WHERE game = 'bingo75'");
	setSetupVar("bingo75_norm_cardprice", $cardprice1);
	setSetupVar("bingo75_mega_cardprice", $cardprice2);
	setSetupVar("bingo75_prize_percents", $prize_percents);
	setSetupVar("bingo75_jackpot_percents", $jackpot_percents);
	setSetupVar("bingo75_meganumbers", $megaNumbers);
	
	$fp = fsockopen("reidobingo-net.umbler.net",$config["server_port"],$errno,$errstr);
	fputs($fp,"ROOT update_configuration bingo75\0");
	$rec_auth = fread($fp, 2048);

	Header("Location: options.php?update=yes");
	
} else {

	Header("Location: options.php?error=$error");

}

?>