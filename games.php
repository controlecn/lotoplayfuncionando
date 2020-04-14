<?

$html_title = "games";
$openTab = "games";

include("include_header.php");

$page = sql_injection_check($_GET["page"]);

if (substr($page, 0, 5)=="game_") {

	$page = str_replace("game_", "", $page);
	$game = substr($page, 0, strpos($page, "_"));
	$page = str_replace($game."_", "", $page);
	
	$error = 0;
	
	if ($game=="bingo75") {
		$game_type = 1;
	} else if (($game=="halloween")||($game=="circus")||($game=="cb2009")||($game=="carnaval")||($game=="treasuresoftheocean")||($game=="fruitmania")) {
		$game_type = 2;
	} else if ($game=="videopoker") {
		$game_type = 3;
	} else {
		$game_type = 4;
	}
	
	if (($game!="bingo75")&&($game!="bingo90")&&($game!="bingomaster")&&($game!="bonusbingo")&&($game!="carnaval")&&($game!="cb2009")&&($game!="circus")&&($game!="egyptdiamonds")&&($game!="fruitmania")&&($game!="halloween")&&($game!="lucky25")&&($game!="megabingo")&&($game!="nineballs")&&($game!="showbingoball")&&($game!="silverball")&&($game!="superbingo75")&&($game!="superbingo2008")&&($game!="superbingo")&&($game!="treasuresoftheocean")&&($game!="turbo90")&&($game!="videopoker")) {
		$error = 1;
	}
	
	if (($page!="main")&&($page!="tour")&&($page!="keyboard")&&($page!="elements")) {
		$error = 1;
	}
	
	if ($error==1) {
		$content_page = "main";
	} else {
		$content_page = "game_$page";
	}

} else {

	switch ($page) {
		case "videobingo":	$content_page = "videobingo"; break;
		case "slots":		$content_page = "slots"; break;
		default: 			$content_page = "main"; break;
	}
	
}

include("games_$content_page.php");

include("include_bottom.php"); ?>