<h1><?=$lang["affliates_banners_title"]?></h1>

<? showContent("AFFLIATES_BANNERS"); ?>

<br /><br />

<?
/*
for ($banner_size=1; $banner_size<=6; $banner_size++) {

	echo "<h2>".$lang["affliates_banners_size".$banner_size]."</h2>";
	
	$result = mysql_query("SELECT * FROM affliates_banners WHERE size = '$banner_size'", $mysql_link);

	if ($result) {

		while ($row = mysql_fetch_array($result)) {

			$id = $row["id"];
			$name = $row["name"];
			$code = $row["code"];
			
			$code = str_replace("%%URL%%", $links["AFFILIATES_BANNERS_SAVE"].$qr."id=$id", $code);
			$code = str_replace("%%LP_URL%%", $config["static_url"], $code);
		
			echo "<div class=\"affliate_banner\">$code</div>";

		}

		mysql_free_result($result);

	}
	
	echo "<div style=\"clear: both;\"></div>";
	echo "<img src=\"img/$global_lang/px.gif\" height=\"20\" width=\"1\" alt=\"px\" />";

}
*/

echo "Novos banners em breve!";

?>
<br /><a href="<?=$links["AFFILIATES"]?>" class="blink"><?=$lang["affliates_back"]?></a>