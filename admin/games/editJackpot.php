<?

$game = $_REQUEST["game"];

function getname($name) {

	switch ($name) {
		case "None": $realname = "Menu Principal"; break;
		case "silverball": $realname = "Silver Ball"; break;
		case "nineballs": $realname = "Nine Balls"; break;
		case "cb2009": $realname = "Campeonato Brasileiro"; break;
		case "circus": $realname = "Circus"; break;
		case "turbo90": $realname = "Noventinha"; break;
		case "lucky25": $realname = "25 Da Sorte"; break;
		case "bingo75": $realname = "Bingo Tradicional"; break;
		case "bingomaster": $realname = "Bingo Master"; break;
		case "bonusbingo": $realname = "Bonus Bingo"; break;
		case "carnaval": $realname = "Carnaval"; break;
		case "egyptdiamonds": $realname = "Diamantes da Kleopatra"; break;
		case "halloween": $realname = "Halloween"; break;
		case "fruitmania": $realname = "Mania Das Frutas"; break;
		case "megabingo": $realname = "Mega Bingo"; break;
		case "showbingoball": $realname = "Show Bingo Ball"; break;
		case "superbingo": $realname = "Super Bingo"; break;
		case "superbingo75": $realname = "Super Bingo 75"; break;
		case "superbingo2008": $realname = "Super Bingo 2008"; break;
		case "treasuresoftheocean": $realname = "Tesouros Do Mar"; break;
		case "videopoker": $realname = "Video Poker"; break;
	}
	
	return $realname;

}

$realName = getname($game);

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Acumulado do $realName", "../");

$liberar = GetRow("SELECT rng_jackpot FROM games WHERE game = '$game'");

$error = $_GET["error"];

?>

<form name="updateForm" id="updateForm" method="POST" action="editJackpot_update.php">

<? if ($error==1) { ?><b>Erro: Valor errado! (Acumulado)</b><br><br><? } ?>

<font class="tabletop">Acumulado:</font>

<input type="text" name="jackpot" value="<?=GetRow("SELECT jackpot FROM games WHERE game = '$game'")?>"><font class="tabletop"> Créditos</font>
<br><br>

<input type="checkbox" name="liberar" value="1" id="liberar"<? if ($liberar==1) echo " checked"; ?>> <label for="liberar" class="tabletop"> Liberar Acumulado</label>

<br><br>

<input type="hidden" value="<?=$game?>" name="game">
<input type="submit" value="Editar" name="submitbutton">

</font>

</form>
<? gui_bottom(); ?>