<?

$html_title = "support";
$openTab = "support";

include("include_header.php");

$page = sql_injection_check($_GET["page"]);

switch ($page) {
	case "faq":				$content_page = "faq"; break;
	case "rules":			$content_page = "rules"; break;
	case "news":			$content_page = "news"; break;
	case "aboutus":			$content_page = "aboutus"; break;
	case "contactus":		$content_page = "contactus"; break;
	case "contactus_upd":	$content_page = "contactus_upd"; break;
	case "testimonials":	$content_page = "testimonials"; break;
	case "advice":			$content_page = "advice"; break;
	default: 				$content_page = "main"; break;
}

include("support_$content_page.php");

include("include_bottom.php");

?>