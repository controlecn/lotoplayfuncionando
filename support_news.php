<h1><?=$lang["support_news_title"]?></h1>
<br />
<?
$result = mysql_query("SELECT headline,story,newsdate FROM `news` ORDER BY id DESC LIMIT 4", $mysql_link);

if ($result) {

	while ($row = mysql_fetch_array($result)) {
		
		$headline = $row["headline"];
		$story = $row["story"];
		$newsdate = $row["newsdate"];
					

	?>
	<h3><?=$headline?></h3>
	<p><?=$story?></p><br /><br />
	<?

	}

	mysql_free_result($result);

}
			
?>
<a href="<?=$links["SUPPORT"]?>" class="blink"><?=$lang["support_back"]?></a>