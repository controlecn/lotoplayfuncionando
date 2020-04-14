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
display_game("Bingo Master", "bingomaster", 1);
display_game("Bonus Bingo", "bonusbingo", 1);
display_game("Diamantes da Kleopatra", "egyptdiamonds", 1);
display_game("25 Da Sorte", "lucky25", 1);
display_game("Mega Bingo", "megabingo", 1);
display_game("Nine Balls", "nineballs", 1);
display_game("Show Bingo Ball", "showbingoball", 1);
display_game("Silver Ball", "silverball", 1);
display_game("Super Bingo 75", "superbingo75", 1);
display_game("Super Bingo 2008", "superbingo2008", 1);
display_game("Super Bingo", "superbingo", 1);
display_game("Noventinha", "turbo90", 1);
?>
</chart>