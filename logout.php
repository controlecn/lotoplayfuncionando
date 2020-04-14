<?

setcookie("session", "", 1);
$referer = $_SERVER["HTTP_REFERER"];
Header("Location: $referer");

?>