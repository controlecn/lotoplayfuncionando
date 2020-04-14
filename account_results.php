<?

if ($banned==1) {
			
	showContent("ERROR_404");
			
} else { ?>
<h1><?=$lang["account_results_title"]?></h1><br />

<img src="img/<?=$global_lang?>/label_otherresults.gif" alt="<?=$alt["account_results_bonus"]?>" /><br />
<table width="460" border="0" cellspacing="0" cellpadding="4">
	<tr>
		<td width="140"><b><?=$lang["account_results_bonusresults_date"]?></b></td>
		<td width="140"><b><?=$lang["account_results_bonusresults_prize"]?></b></td>
		<td width="180"><b><?=$lang["account_results_bonusresults_winner"]?></b></td>
	</tr>
</table>
<table width="460" border="0" cellspacing="0" cellpadding="4" style="border: 1px #888888 solid">
<?

$sql = "Select userid,qt,resultdate from bonus_results where resultdate < NOW() ORDER BY resultdate DESC LIMIT 10";
$result = mysql_query($sql, $mysql_link);

if ($result) {

	$i = 0;
	$a = 0;

	while ($row = mysql_fetch_array($result)) {
	
		$a++;
	
		if($i%2 == 0) {
			$color = "#F7F7F7";
			$i++;
		} else {
			$color = "#FFFFFF";
			$i++;
		}

		$id = $row["id"];
		$resultdate = changeMysqlTime($row["resultdate"]);
		$qt = $row["qt"];
		$username = GetRow("SELECT username FROM users WHERE id = '".$row["userid"]."'");

		?>
		<tr>
			<td width="140" bgcolor="<?=$color?>"><b><?=$resultdate?></b></td>
			<td width="140" bgcolor="<?=$color?>"><b><?=$lang["currency_1"]?><?=credits2money($qt)?><?=$lang["currency_2"]?></b></td>
			<td width="180" bgcolor="<?=$color?>"><b><?=$username?></b></td>
		</tr>
		<?
	}

	mysql_free_result($result);
	
	if ($a==0) {
		?>
		<tr>
			<td bgcolor="#F7F7F7"><?=$lang["account_results_bonusresults_nothing"]?></td>
		</tr>
		<?
	}

}

?>
</table><br />

<img src="img/<?=$global_lang?>/label_bingo75results.gif" alt="<?=$alt["account_results_bingo75"]?>" /><br />

<table width="942" border="0" cellspacing="0" cellpadding="4">
	<tr>
		<td width="105"><b><?=$lang["account_results_bingoresults_date"]?></b></td>
		<td width="80"><b><?=$lang["account_results_bingoresults_roundid"]?></b></td>
		<td width="95"><b><?=$lang["account_results_bingoresults_players"]?></b></td>
		<td width="70"><b><?=$lang["account_results_bingoresults_cards"]?></b></td>
		<td width="110"><b><?=$lang["account_results_bingoresults_prize"]?></b></td>
		<td width="80"><b><?=$lang["account_results_bingoresults_balls"]?></b></td>
		<td><b><?=$lang["account_results_bingoresults_winners"]?></b></td>
	</tr>
</table>
<table width="942" border="0" cellspacing="0" cellpadding="4" style="border: 1px #888888 solid">
<?

$sql = "Select id,bingoDate,gameId,players,cards,jackpot,balls,winnersId from bingo75_results where gameEnds < NOW() Order by gameEnds DESC LIMIT 10";
$result = mysql_query($sql, $mysql_link);

if ($result) {

	$i = 0;
	$a = 0;

	while ($row = mysql_fetch_array($result)) {
	
		$a++;
	
		if($i%2 == 0) {
			$color = "#F7F7F7";
			$i++;
		} else {
			$color = "#FFFFFF";
			$i++;
		}

		$id = $row["id"];
		$bingoDate = changeMysqlTime($row["bingoDate"]);
		$gameId = $row["gameId"];
		$players = $row["players"];
		$cards = $row["cards"];
		$jackpot = $row["jackpot"];
		$balls = $row["balls"];
		$winnersId = $row["winnersId"];

		if (!$winnersId) {
			$winners = $lang["account_results_bingoresults_nowinners"];
		} else {
			$winners = str_replace(",", ", ", $winnersId);
		}

		$winners = shortString($winners, 25);

		?>
		<tr>
			<td width="105" bgcolor="<?=$color?>"><b><?=$bingoDate?></b></td>
			<td width="80" bgcolor="<?=$color?>"><b><?=$gameId?></b></td>
			<td width="95" bgcolor="<?=$color?>"><b><?=$players?></b></td>
			<td width="70" bgcolor="<?=$color?>"><b><?=$cards?></b></td>
			<?  if (is_numeric($jackpot)) { ?>
			<td width="110" bgcolor="<?=$color?>"><b><?=$lang["currency_1"]?><?=credits2money($jackpot)?><?=$lang["currency_2"]?></b></td>
			<? } else { ?>
			<td width="110" bgcolor="<?=$color?>"><b><?=$jackpot?></b></td>
			<? } ?>
			<td width="80" bgcolor="<?=$color?>"><b><?=$balls?></b></td>
			<td bgcolor="<?=$color?>"><b><?=$winners?></b></td>
		</tr>
		<?
	}

	mysql_free_result($result);
	
	if ($a==0) {
		?>
		<tr>
			<td bgcolor="#F7F7F7"><?=$lang["account_results_bingoresults_nothing"]?></td>
		</tr>
		<?
	}

}

?>
</table>
<br />

<br /><br /><a href="<?=$links["ACCOUNT"]?>" class="blink"><?=$lang["account_back"]?></a>
<? } ?>