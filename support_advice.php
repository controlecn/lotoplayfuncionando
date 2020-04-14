<h1><?=$lang["support_advice_title"]?></h1>
<br />
<?
$result = mysql_query("SELECT headline,story FROM `advice` ORDER BY id", $mysql_link);

if ($result) {

	while ($row = mysql_fetch_array($result)) {
		
		$headline = $row["headline"];
		$story = $row["story"];
					

	?>
	<h3><?=$headline?></h3>
	<p><?=$story?></p><br /><br />
	<?

	}

	mysql_free_result($result);

}
			
?>
<a href="<?=$links["SUPPORT"]?>" class="blink"><?=$lang["support_back"]?></a>