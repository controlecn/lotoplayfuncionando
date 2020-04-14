<?

$id = sql_injection_check($_GET["id"]);

if ($id) {

	$name = GetRow("SELECT name FROM affliates_banners WHERE id = '$id'");
	$code = GetRow("SELECT code FROM affliates_banners WHERE id = '$id'");

	echo "<h1>$name</h1><br />";

	
	$code = str_replace("%%URL%%", $config["static_url"]."?a=$affliate_logged_user", $code);
	$code = str_replace("%%LP_URL%%", $config["static_url"], $code);
	echo $code;

}

?><br><br><b><?=$lang["affliates_banners_code"]?>:</b><br>
<pre><? echo htmlentities($code); ?></pre>
<br /><br /><a href="<?=$links["AFFILIATES_BANNERS"]?>" class="blink"><?=$lang["affliates_banners_back"]?></a>