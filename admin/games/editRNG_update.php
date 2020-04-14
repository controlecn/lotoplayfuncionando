<?

include('../include_functions.php');
include("include_verify_rng.php");

checkAccess(2);
$game = $_POST["game"];

$rng1 = $_POST["rng1"];
$rng2 = $_POST["rng2"];
$rng3 = $_POST["rng3"];
$rng4 = $_POST["rng4"];

if (($game!="halloween")&&($game!="circus")&&($game!="cb2009")&&($game!="videopoker")) {
	$verify1 = verify_rng($game, $rng1);
	$verify2 = verify_rng($game, $rng2);
	$verify3 = verify_rng($game, $rng3);
	$verify4 = verify_rng($game, $rng4);
} else {
	$verify1 = verify_slot2($rng1);
	$verify2 = verify_slot2($rng2);
	$verify3 = verify_slot2($rng3);
	$verify4 = verify_slot2($rng4);
}

if (($verify1==1)&&($verify2==1)&&(($verify3==1))&&(($verify4==1))) {

	// No Errors...

	if (($game!="halloween")&&($game!="circus")&&($game!="cb2009")&&($game!="videopoker")) {
	
		$rng1 = explode(",", $rng1);
		$rng2 = explode(",", $rng2);
		$rng3 = explode(",", $rng3);
		$rng4 = explode(",", $rng4);
	
		shuffle($rng1);
		shuffle($rng2);
		shuffle($rng3);
		shuffle($rng4);
		
		$rng1 = implode(",", $rng1);
		$rng2 = implode(",", $rng2);
		$rng3 = implode(",", $rng3);
		$rng4 = implode(",", $rng4);
		
	}
	
	makeLog("Mudanca de RNG para o jogo $game");

	SqlQuery("UPDATE games SET rng1 = '$rng1', rng2 = '$rng2', rng3 = '$rng3', rng4 = '$rng4' WHERE game = '$game'");

	$fp = fsockopen("reidobingo-net.umbler.net", $config["server_port"], $errno, $errstr, 3);
	fputs($fp,"ROOT update_configuration $game\0");
	$rec_changeinfo = fread($fp, 2048);
	fclose($fp);

	echo "Atualizado sem erros.";
	
}



?>