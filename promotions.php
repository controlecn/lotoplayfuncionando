<?

$html_title = "promotions";
$openTab = "promotions";

include("include_header.php");

$page = sql_injection_check($_GET["page"]);

switch ($page) {
	case "month":			$content_page = "month"; break;
	case "friends":			$content_page = "friends"; break;
	case "bonus":			$content_page = "bonus"; break;
	//case "vip":				$content_page = "vip"; break;
	case "super_rounds":	$content_page = "super_rounds"; break;
	case "surprise_bonus":	$content_page = "surprise_bonus"; break;
	//case "free_rounds":		$content_page = "free_rounds"; break;
	default: 				$content_page = "main"; break;
}

include("promotions_$content_page.php");

include("include_bottom.php"); ?>