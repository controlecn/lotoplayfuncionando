<?

include('../include_functions.php');
checkAccess(2);

$game = $_REQUEST["game"];
$liberar = $_REQUEST["liberar"];
$jackpot = $_REQUEST["jackpot"];

$error = 0;

if (verifyFloat($jackpot)==0) {
	$error = 1;
}

if ($error==0) {

	if (!$liberar) $liberar = 0;
	
	SqlQuery("UPDATE games SET jackpot = '$jackpot', rng_jackpot = '$liberar' WHERE game = '$game'");

	$fp = fsockopen("reidobingo-net.umbler.net",$config["server_port"],$errno,$errstr);
	fputs($fp,"ROOT update_configuration $game\0");
	$rec_auth = fread($fp, 2048);
	fclose($fp);
	
	if ($liberar==1) {
		makeLog("Acumulado liberado para o jogo $game");
	}

	echo "Acumulado Atualizado!";
	
} else {

	Header("Location: editJackpot.php?error=$error&game=$game");

}

?>