<? include('include_functions.php'); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lotoplay</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	color: #000000;
	font-weight: bold;
	padding-left: 15px;
	font-size: 24px;
	padding-right: 15px;
}
.style2 {
	font-family: Arial, Helvetica, sans-serif;
	color: #FFFFFF;
	font-size: 18px;
	text-decoration: none;
	float: left;
	margin-left: 65px;
}
.style2:hover {
	color: #fde900;
}
-->
</style></head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="51" background="images/top_back.gif"><span class="style1">criativawebsites.com.br/lotoplay</span></td>
    <td height="51" background="images/top_back.gif" align="right"><form target="mainFrame" method="post" action="find.php"><input type="text" name="find"><input type="submit" name="submitbutton" value="Localizar"></form></td>
  </tr>
  <tr>
    <td colspan="2" background="images/mback.gif" height="34">
	
    <a href="left_payments.php" target="leftFrame" class="style2" style="margin-left: 35px;">Pagamentos</a>
    <a href="left_reports.php" target="leftFrame" class="style2">Relatórios</a>
    <a href="left_games.php" target="leftFrame" class="style2">Jogos</a>
	<? if ($access==2) { ?>
    <a href="left_settings.php" target="leftFrame" class="style2">Configurações</a>
    <a href="left_marketing.php" target="leftFrame" class="style2">Marketing</a>
	<? } ?>
    <a href="left_support.php" target="leftFrame" class="style2">Suporte</a>
    </td>
  </tr>
</table>

</body>
</html>
