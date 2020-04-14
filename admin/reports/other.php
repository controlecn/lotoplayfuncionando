<?

include('../include_functions.php');

checkAccess(2);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
.font_title {
	font-family: Arial, Helvetica, sans-serif;
	font-size:38px;
	font-weight: bold;
}
.font_item {
	font-family: Arial, Helvetica, sans-serif;
	font-size:20px;
	font-weight: bold;
}
.item_text {
	font-family: Arial, Helvetica, sans-serif;
	font-size:18px;
}
.item_display {
	font-family: Arial, Helvetica, sans-serif;
	font-size:18px;
	font-weight: bold;
	color:#3300CC;
}
-->
</style></head>
<?

function showItem ($name, $value, $color) {

	if ($color==1) {
		$cor = "#ededed";
	} else {
		$cor = "#d9d9d9";
	}

?>
  <tr>
    <td class="item_text" width="250" bgcolor="<?=$cor?>"><?=$name?>:</td>
    <td class="item_display" bgcolor="<?=$cor?>"><?=$value?></td>
  </tr>
<?

}

function lastday($month = '', $year = '') {
   if (empty($month)) {
      $month = date('m');
   }
   if (empty($year)) {
      $year = date('Y');
   }
   $result = strtotime("{$year}-{$month}-01");
   $result = strtotime('-1 second', strtotime('+1 month', $result));
   return date('Y-m-d', $result);
}


?>
<body>
<font class="font_title">Outras informações</font>

<br /><br /> 
<font class="font_item">Fraudes:</font>
<br /><br />
<table width="600" border="0" cellspacing="3" cellpadding="0">
<?

// Pre config
$month = date("m");
$year = date("Y");
$today = date("j");

// Alertas de Fraude
$fraud_alerts = GetRow("SELECT COUNT(id) FROM fraud_alerts");
showItem ("Alertas de Fraude", $fraud_alerts, 1);

// Comentarios sobre clientes
$fraud_comments = GetRow("SELECT COUNT(id) FROM fraud_comments");
showItem ("Comentarios sobre clientes", $fraud_comments, 2);


?>
</table>

<br /><br /> 
<font class="font_item">Compras e Saques:</font>
<br /><br />
<table width="600" border="0" cellspacing="3" cellpadding="0">
<?

// Compras Abertas
$open_buy = GetRow("SELECT COUNT(id) FROM `transfers_buy` WHERE status = '0'");
showItem ("Compras Abertas", $open_buy, 1);

// Saques Abertos
$open_pay = GetRow("SELECT COUNT(id) FROM `transfers_payout` WHERE status = '1'");
showItem ("Saques Abertos", $open_pay, 1);


?>
</table>

<br /><br /> 
<font class="font_item">Estilo de jogo mais popular:</font>
<br /><br />
<script language="JavaScript" src="../js/FusionCharts.js"></script>
<div id="chartdiv1"></div>
  <script type="text/javascript">
	var chart = new FusionCharts("Charts/Pie3D.swf", "ChartId", "600", "300", "0", "0");
	chart.setDataURL("Data/poptype.php");		   
	chart.render("chartdiv1");
  </script>
  
<br /><br /> 
<font class="font_item">Jogos mais populares:</font>
<br /><br />
<script language="JavaScript" src="../js/FusionCharts.js"></script>
<div id="chartdiv2"></div>
  <script type="text/javascript">
	var chart = new FusionCharts("Charts/Pie3D.swf", "ChartId", "600", "300", "0", "0");
	chart.setDataURL("Data/popgames.php");		   
	chart.render("chartdiv2");
  </script>
  
<br /><br /> 
<font class="font_item">Video-Bingo mais popular:</font>
<br /><br />
<script language="JavaScript" src="../js/FusionCharts.js"></script>
<div id="chartdiv3"></div>
  <script type="text/javascript">
	var chart = new FusionCharts("Charts/Pie3D.swf", "ChartId", "600", "300", "0", "0");
	chart.setDataURL("Data/popvideobingo.php");		   
	chart.render("chartdiv3");
  </script>
  
<br /><br /> 
<font class="font_item">Rodilho mais popular:</font>
<br /><br />
<script language="JavaScript" src="../js/FusionCharts.js"></script>
<div id="chartdiv4"></div>
  <script type="text/javascript">
	var chart = new FusionCharts("Charts/Pie3D.swf", "ChartId", "600", "300", "0", "0");
	chart.setDataURL("Data/popslots.php");		   
	chart.render("chartdiv4");
  </script>

<br /><br /> 
  
<br /><br /> 
  
</body>

</html>
