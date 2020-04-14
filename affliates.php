<?

$html_title = "affliates";
$openTab = "affliates";

include("include_header.php");

if ($affliate_logged==1) {

	$page = sql_injection_check($_GET["page"]);

	switch ($page) {
		case "sales":				$content_page = "logged_sales"; break;
		case "clients":				$content_page = "logged_clients"; break;
		case "banners":				$content_page = "logged_banners"; break;
		case "banners_save":		$content_page = "logged_banners_save"; break;
		case "change":				$content_page = "logged_change"; break;
		default: 					$content_page = "logged_main"; break;
	}

} else {

	$page = sql_injection_check($_GET["page"]);

	switch ($page) {
		case "login":				$content_page = "login"; break;
		case "register":			$content_page = "register"; break;
		case "register_upd":		$content_page = "register_upd"; break;
		case "register_complete":	$content_page = "register_complete"; break;
		case "rules":				$content_page = "rules"; break;
		default: 					$content_page = "main"; break;
	}

}
	
include("affliates_$content_page.php");

include("include_bottom.php"); ?>