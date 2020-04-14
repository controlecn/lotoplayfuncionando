<?
include('../../include_functions.php');
checkAccess(2);

function display_game($title, $game, $type) {

	$game_in = GetRow("SELECT value FROM counters WHERE code = '".$game."_in'");

	if ($type==2) {
		$game_in = floor($game_in / 25);
	}

	?>
            <set label='<?=$title?>' value='<?=$game_in?>' />
	<?
}

?>
<chart formatNumberScale='0' palette='3' decimals='0' enableSmartLabels='1' enableRotation='0' bgColor='99CCFF,FFFFFF' bgAlpha='40,100' bgRatio='0,100' bgAngle='360' showBorder='1' startingAngle='70' >
<?

display_game("Carnaval", "carnaval", 1);
display_game("CB 2009", "cb2009", 2);
display_game("Circus", "circus", 2);
display_game("Mania Das Frutas", "fruitmania", 1);
display_game("Halloween", "halloween", 2);
display_game("Tesouros Do Mar", "treasuresoftheocean", 1);
?>
</chart>