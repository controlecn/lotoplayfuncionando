<h1><?=$lang["affliates_clients_title"]?></h1>

<table width="610" border="0" cellspacing="0" cellpadding="4">
	<tr>
		<td width="210"><b><?=$lang["affliates_clients_username"]?></b></td>
		<td width="200"><b><?=$lang["affliates_clients_buys"]?></b></td>
		<td width="200"><b><?=$lang["affliates_clients_comission"]?></b></td>
	</tr>
</table>
<table width="610" border="0" cellspacing="0" cellpadding="4" style="border: 1px #888888 solid">
<?

$result = mysql_query("SELECT id,username FROM users WHERE affliateId = '$affliate_logged_user' ORDER BY username", $mysql_link);

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
		$username = $row["username"];
		$buys = GetRow("SELECT SUM(totalValue) FROM transfers_affliates WHERE affliateId = '$affliate_logged_user' AND userId = '$id'");
		$comission = GetRow("SELECT SUM(affliateValue) FROM transfers_affliates WHERE affliateId = '$affliate_logged_user' AND userId = '$id'");

		?>
		<tr>
			<td width="210" bgcolor="<?=$color?>"><b><?=$username?></b></td>
			<td width="200" bgcolor="<?=$color?>"><b><?=$lang["currency_1"]?><?=formatMoney($buys)?><?=$lang["currency_2"]?></b></td>
			<td width="200" bgcolor="<?=$color?>"><b><?=$lang["currency_1"]?><?=formatMoney($comission)?><?=$lang["currency_2"]?></b></td>
		</tr>
		<?
	}

	mysql_free_result($result);
	
	if ($a==0) {
		?>
		<tr>
			<td bgcolor="#F7F7F7"><?=$lang["affliates_clients_nothing"]?></td>
		</tr>
		<?
	}

}

?>
</table>
<br />

<a href="<?=$links["AFFILIATES"]?>" class="blink"><?=$lang["affliates_back"]?></a>
