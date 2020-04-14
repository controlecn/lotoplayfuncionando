<?

$game = $_REQUEST["game"];

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);

switch ($game) {

	case "superbingo":	$realName = "Super Bingo";
						$numberoptions = Array(0,1,2,3);
						break;
						
	case "lucky25":		$realName = "25 Da Sorte";
						$numberoptions = Array(0,1,2,3,4,5);
						break;
						
	case "bingomaster":	$realName = "Bingo Master";
						$numberoptions = Array(0,1,2,3,4,5,6,7,8,9);
						break;
						
	case "bonusbingo":	$realName = "Bonus Bingo";
						$numberoptions = Array(0,1,2,3,4,5,6,7,8,9,10);
						break;
						
	case "egyptdiamonds":		$realName = "Diamantes Da Kleopatra";
						$numberoptions = Array(0,1,2,3,4);
						break;

	case "megabingo":	$realName = "Mega Bingo";
						$numberoptions = Array(0,1,2,3,4,5,6,7,8,9,10);
						break;
						
	case "showbingoball":	$realName = "Show Bingo Ball";
						$numberoptions = Array(0,1,2,3,4,5,6,7,8,9,10,11,12);
						break;
						
	case "superbingo2008":	$realName = "Super Bingo 2008";
						$numberoptions = Array(0,1,2,3);
						break;
						
	case "superbingo75":	$realName = "Super Bingo 75";
						$numberoptions = Array(0,1,2,3,4,5,6,7,8,9,10,11,12);
						break;
						
	case "silverball":	$realName = "Silver Ball";
						$numberoptions = Array(0,1,2,3);
						break;
						
	case "nineballs":	$realName = "Nine Balls";
						$numberoptions = Array(0,1,2,3);
						break;
						
	case "turbo90":		$realName = "Noventinha";
						$numberoptions = Array(0,1,2,3,4);
						break;
						
	case "carnaval":		$realName = "Carnaval";
						$numberoptions = Array(0,13,14,15,23,24,25,33,34,35,43,44,45,53,54,55,63,64,65,73,74,75,83,84,85,93,94);
						break;
						
	case "fruitmania":		$realName = "Mania Das Frutas";
						$numberoptions = Array(0,13,14,15,23,24,25,33,34,35,43,44,45,53,54,55,63,64,65,73,74,75,83,84,85,93,94);
						break;
						
	case "treasuresoftheocean":		$realName = "Tesouros Do Mar";
						$numberoptions = Array(0,13,14,15,23,24,25,33,34,35,43,44,45,53,54,55,63,64,65,73,74,75,83,84,85,93,94);
						break;
						
	case "videopoker":		$realName = "Video Poker";
						break;

	case "halloween":		$realName = "Halloween";
						break;
						
	case "cb2009":		$realName = "CB 2009";
						break;
						
	case "circus":		$realName = "Circus";
						break;
						

}

gui_header("Configuracao de RNG do ".$realName, "../");

$sql = "SELECT * FROM games WHERE game = '$game'";

$result = mysql_query($sql, $mysql_link);

	$i = 0;

if ($result) {

	$row = mysql_fetch_array($result);
    
	$rng1 = $row["rng1"];
	$rng2 = $row["rng2"];
	$rng3 = $row["rng3"];
	$rng4 = $row["rng4"];

	mysql_free_result($result);

}

?>
<script>
rngInUse = 0;

function randOrd(){
return (Math.round(Math.random())); }

function getSlot1(a) {

	returnVal = 0

	switch (a) {
		case 1:	returnVal = 13; break;
		case 2:	returnVal = 14; break;
		case 3:	returnVal = 15; break;
		case 4:	returnVal = 23; break;
		case 5:	returnVal = 24; break;
		case 6:	returnVal = 25; break;
		case 7:	returnVal = 33; break;
		case 8:	returnVal = 34; break;
		case 9:	returnVal = 35; break;
		case 10:	returnVal = 43; break;
		case 11:	returnVal = 44; break;
		case 12:	returnVal = 45; break;
		case 13:	returnVal = 53; break;
		case 14:	returnVal = 54; break;
		case 15:	returnVal = 55; break;
		case 16:	returnVal = 63; break;
		case 17:	returnVal = 64; break;
		case 18:	returnVal = 65; break;
		case 19:	returnVal = 73; break;
		case 20:	returnVal = 74; break;
		case 21:	returnVal = 75; break;
		case 22:	returnVal = 83; break;
		case 23:	returnVal = 84; break;
		case 24:	returnVal = 85; break;
		case 25:	returnVal = 93; break;
		case 26:	returnVal = 94; break;
	}
	
	return returnVal;

} 

function generateClick() {

<?

	$values = Array();

	for ($a=0; $a<count($numberoptions); $a++) {

		$numberNow = $numberoptions[$a];
		echo "	value$numberNow = document.getElementById(\"value_$numberNow\").value;
";

		array_push($values, "value$numberNow");

	}
	
	$valuesStr = implode(",", $values);
	
	echo "
	var rng_values = new Array($valuesStr);
";
	

	?>
	
	final_rng_array = new Array();
	
	
<? if (($game=="treasuresoftheocean")||($game=="carnaval")||($game=="fruitmania")) { ?>

	for (a=0;a<rng_values.length;a++) {
		howMany = rng_values[a];
		
		for (b=0; b<howMany; b++) {
			final_rng_array.push(getSlot1(a));
		}

	}

<? } else { ?>
	
	for (a=0;a<rng_values.length;a++) {
		howMany = rng_values[a];
		
		for (b=0; b<howMany; b++) {
			final_rng_array.push(a);
		}

	}
	
<? } ?>
	
	final_rng_array.sort(randOrd);
	
	rngTextArea = document.getElementById("rng"+rngInUse);
	rngTextArea.value = final_rng_array.toString();

	rngDiv = document.getElementById("rng_div");
	rngDiv.style.visibility = "hidden";

}

function closeGenerator() {

	rngDiv = document.getElementById("rng_div");
	rngDiv.style.visibility = "hidden";

}

function countArray(theArray, theNumber) {

	counter = 0;

	for (a=0; a<theArray.length; a++) {
	
		if (theArray[a]==theNumber) {
			counter++;
		}
	
	}
	
	return counter;

}

function generateNumbers(oEvent, whatRNG) {

	rngValuesBefore = document.getElementById("rng"+whatRNG).value;
	rngValuesBeforeArray = rngValuesBefore.split(",");

<?
	for ($a=0; $a<count($numberoptions); $a++) {

		$numberNow = $numberoptions[$a];
		echo "	document.getElementById(\"value_$numberNow\").value = countArray(rngValuesBeforeArray, \"$numberNow\");
";

	}
?>


	clickY = getY(document.getElementById("rng"+whatRNG));

	rngInUse = whatRNG;
					
	rngDiv = document.getElementById("rng_div");
	rngDiv.style.top =  clickY.toString() + "px";
	rngDiv.style.left = "120px";
	rngDiv.style.visibility = "visible";

}

function getY( oElement ) {
	var iReturnValue = 0;
	
	while( oElement != null ) {
		iReturnValue += oElement.offsetTop;
		oElement = oElement.offsetParent;
	}
	
	return iReturnValue;
}
</script>
<style>
.rngDiv {
	border: 3px solid #000000;
	padding: 10px;
	position: absolute;
	visibility: hidden;
	background-color: #FFFFFF;
}
</style>
<div class="rngDiv" id="rng_div">
<? 

for ($a=0; $a<count($numberoptions); $a++) {

	$numberNow = $numberoptions[$a];
	echo "<b>Número $numberNow:</b> <input type=\"text\" id=\"value_$numberNow\" name=\"value_$numberNow\" value=\"0\"><br>";

}

?>
<br>
<input type="button" name="generatebutton" value="Gerar" onclick="generateClick();"> - <a href="#" onclick="closeGenerator();" class="link">Fechar</a>
</div>
<form method="post" action="editRNG_update.php">
<? 

for ($a=1; $a<5; $a++) {

	$rng_name = "rng$a";

	$rng_value = $$rng_name;

	?>

<h2>RNG <?=$a?>:</h2>
<textarea name="rng<?=$a?>" id="rng<?=$a?>" rows="5" cols="70"><?=$rng_value?></textarea><br>
<? if (($game!="halloween")&&($game!="circus")&&($game!="cb2009")&&($game!="videopoker")) { ?>
<input type="button" name"rng<?=$a?>_generate" value="Gerar Números" onclick="generateNumbers(event, <?=$a?>);">
<? } ?>
<hr>

	<?
	
} 

?>
<input type="hidden" name="game" value="<?=$game?>">
<input type="submit" value="Atualizar!" name="submitbutton">
<br><br>
</form>


<? gui_bottom(); ?>