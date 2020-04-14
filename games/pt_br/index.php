<?
header("Cache-Control: public, no-cache");

include('../../include_settings.php');

$game = sql_injection_check($_GET["game"]);

if (($game!="bingo75")&&($game!="bingo90")&&($game!="bingomaster")&&($game!="bonusbingo")&&($game!="carnaval")&&($game!="cb2009")&&($game!="circus")&&($game!="egyptdiamonds")&&($game!="fruitmania")&&($game!="halloween")&&($game!="lucky25")&&($game!="megabingo")&&($game!="nineballs")&&($game!="showbingoball")&&($game!="silverball")&&($game!="superbingo75")&&($game!="superbingo2008")&&($game!="superbingo")&&($game!="treasuresoftheocean")&&($game!="turbo90")&&($game!="videopoker")) {
	$game = "";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LotoPlay</title>
<style type="text/css">
html, body {
  margin: 0; padding: 0;
  height: 100%;
}
</style>
<script type="text/javascript">

function openPage(whatPage) {
	document.forms.GoOut.action = "../../"+whatPage;
	document.forms.GoOut.submit();
}

function openChat() {
	document.forms.GoOut.action = "http://reidobingo-net.umbler.net/support/request.php?l=lotop&x=1&deptid=1";
	document.forms.GoOut.submit();
}

function closeWin() {
	window.close();
}

</script>
</head>
<body bgcolor="#491323">
<? if ($logged==1) { ?>
<object type="application/x-shockwave-flash" data="gameloader.swf?s=<?=$config["gameserver"]?>&yourSession=<?=$_COOKIE["session"]?>&yourUsername=<?=$user_data["username"]?>&game=<?=$game?><? if ($banned==1) { echo "&nc=1"; } else { echo "&nc=0"; } ?>" width="100%" height="100%" align="top" id="stage">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="movie" value="gameloader.swf?s=<?=$config["gameserver"]?>&yourSession=<?=$_COOKIE["session"]?>&yourUsername=<?=$user_data["username"]?>&game=<?=$game?><? if ($banned==1) { echo "&nc=1"; } else { echo "&nc=0"; } ?>" />
	<param name="quality" value="high" />
	<param name="scale" value="exactfit" />
	<param name="bgcolor" value="#ffffff" />
	<param name="menu" value="false" />
	<param name="salign" value="LT" />
</object>
<? } else { ?>
<object type="application/x-shockwave-flash" data="gameloader.swf?s=<?=$config["gameserver"]?>&free=1&game=<?=$game?><? if ($banned==1) { echo "&nc=1"; } else { echo "&nc=0"; } ?>" width="100%" height="100%" align="top" id="stage">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="movie" value="gameloader.swf?s=<?=$config["gameserver"]?>&free=1&game=<?=$game?><? if ($banned==1) { echo "&nc=1"; } else { echo "&nc=0"; } ?>" />
	<param name="quality" value="high" />
	<param name="scale" value="exactfit" />
	<param name="bgcolor" value="#ffffff" />
	<param name="menu" value="false" />
	<param name="salign" value="LT" />
</object>
<? } ?>
<form name="GoOut" id="GoOut" method="post" action="" target="_blank">
</form>
</body>
</html>
