<?

ini_set('expose_php', 0);
error_reporting(E_ALL ^ E_NOTICE);

include("include_langdetect.php");

$config["mysql_host"] = "mysql873.umbler.com";
$config["mysql_user"] = "luckpriz";
$config["mysql_pass"] = "190290ff";
$config["mysql_data"] = "luckprize";
$config["server_port"] = "";
$config["static_url"] = "http://reidobingo-net.umbler.net/";
$config["gameserver"] = 2; // 1: reidobingo-net.umbler.net 2: Lotoplay
$config["support_url"] = $config["static_url"] . "support/request.php?l=lotop&amp;x=1&amp;deptid=1";

$mysql_link = mysql_connect($config["mysql_host"], $config["mysql_user"], $config["mysql_pass"]);
//mysql_select_db($config["mysql_data"]."_".$global_lang, $mysql_link);
mysql_select_db($config["mysql_data"], $mysql_link);

mysql_query("SET NAMES 'utf8'", $mysql_link);

include("include_functions.php");
include("include_session.php");
include("include_class_phpmailer.php");

include("templates/$global_lang/links.php");

if ($links["TYPE"]==1) {
	$qr = "&";
       $qr2 = "?";
    } else {
	$qr = "&";
	$qr2 = "&";
}

?>