<?
include('../../include_functions.php');
checkAccess(2);

function get_game($game, $type) {

	$game_in = GetRow("SELECT value FROM counters WHERE code = '".$game."_in'");

	if ($type==2) {
		$game_in = floor($game_in / 25);
	}

	return $game_in;
	
}

$bingoroom = get_game("bingo75", 1);
$videobingo = get_game("bingomaster", 1) + get_game("bonusbingo", 1) + get_game("egyptdiamonds", 1) + get_game("lucky25", 1) + get_game("megabingo", 1) + get_game("nineballs", 1) + get_game("showbingoball", 1) + get_game("silverball", 1) + get_game("superbingo75", 1) + get_game("superbingo2008", 1) + get_game("superbingo", 1) + get_game("turbo90", 1);
$slots = get_game("carnaval", 1) + get_game("cb2009", 1) + get_game("circus", 1) + get_game("fruitmania", 1) + get_game("halloween", 1) + get_game("treasuresoftheocean", 1);
$videopoker = get_game("videopoker", 1);

?>
<chart formatNumberScale='0' palette='3' decimals='0' enableSmartLabels='1' enableRotation='0' bgColor='99CCFF,FFFFFF' bgAlpha='40,100' bgRatio='0,100' bgAngle='360' showBorder='1' startingAngle='70' >
   <set label='Sala De Bingo' value='<?=$bingoroom?>' />
   <set label='Video Bingo' value='<?=$videobingo?>' />
   <set label='Rodilhos' value='<?=$slots?>' />
   <set label='Video Poker' value='<?=$videopoker?>' />
</chart>