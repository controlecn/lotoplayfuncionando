<?

$sitepath = "../";

function gui_header($title, $path) {

	global $lang_system_title, $sitepath, $useLanguage;

	$sitepath = $path;

?><html>
<head>
<title><?=$lang_system_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?=$path?>css/styles.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="<?=$path?>js/FusionCharts.js"></script>
</head>

<body bgcolor="#F7F7F7" style="margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="28" background="<?=$path?>images/main_top_2.png" align="left" class="title_h"><?=$title?></td>
</tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="10" width="10"></td>
    <td height="10"></td>
    <td height="10" width="3"></td>
  </tr>
  <tr>
    <td width="10"></td>
    <td>


<?

}

function gui_bottom() {

	global $sitepath;

?></td>
    <td width="3"></td>
  </tr>
</table>
</table>
</body>
</html>
<?

}

function gui_tabletop($columns, $with_op=1) {

	global $lang_global_operation;

	?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td bgcolor="#F7F7F7" height="23" width="40">&nbsp;</td>
	<td bgcolor="#F7F7F7" height="23" width="5"></td>
	<? for ($a=0; $a<count($columns); $a++) { ?>
	<td bgcolor="#F7F7F7" height="23" class="tabletop"><?=$columns[$a]?></td>
	<? } ?>
	<? if ($with_op==1) { ?>
	<td bgcolor="#F7F7F7" height="23" width="80" class="tabletop" align="center"><?=$lang_global_operation?></td>
	<? } ?>
  </tr>
	<?

}

?>