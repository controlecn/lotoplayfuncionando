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
<font class="font_title">Relatório de cadastros</font>

<br /><br /> 
<font class="font_item">Informações Básicas:</font>
<br /><br />
<table width="600" border="0" cellspacing="3" cellpadding="0">
<?

// Pre config
$month = date("m");
$year = date("Y");
$today = date("j");

// Número de Cadastros
$cadastros_total = GetRow("SELECT COUNT(id) FROM users");
showItem ("Número de Cadastros", $cadastros_total, 1);

//Novos cadastros hoje
$cadastros_hoje = GetRow("SELECT COUNT(id) FROM users WHERE `joinedWhen` BETWEEN '$year-$month-$today 00:00:00' AND DATE_ADD('$year-$month-$today 00:00:00', INTERVAL 24 HOUR)");
showItem ("Novos cadastros hoje", $cadastros_hoje, 2);

// Novos cadastros esse mes
$cadastros_thismonth = GetRow("SELECT COUNT(id) FROM users WHERE `joinedWhen` > '$year-$month-01 00:00:00'");
showItem ("Novos cadastros esse mes", $cadastros_thismonth, 1);

//Cadastros VIP
$cadastros_vip = GetRow("SELECT COUNT(id) FROM users WHERE super = '1'");
showItem ("Cadastros VIP", $cadastros_vip, 2);

//Cadastros Deletados
$cadastros_delete = GetRow("SELECT COUNT(id) FROM users WHERE `delete` = '1'");
showItem ("Cadastros Deletados", $cadastros_delete, 1);

//Cadastros Baneados
$cadastros_ban = GetRow("SELECT COUNT(id) FROM users WHERE `ban` = '1'");
showItem ("Cadastros Baneados", $cadastros_ban, 2);

//Cadastros de Teste
$cadastros_test = GetRow("SELECT COUNT(id) FROM users WHERE `test` = '1'");
showItem ("Cadastros de Teste", $cadastros_test, 2);

//Cadastros Ativos
$cadastros_active = GetRow("SELECT COUNT(id) FROM users WHERE `ban` = '0' AND super = '0' AND `delete` = '0' AND `test` = '0'");
showItem ("Cadastros Ativos", $cadastros_active, 1);

//Cadastros com CPF
$cadastros_cpf = GetRow("SELECT COUNT(id) FROM users WHERE `ban` = '0' AND super = '0' AND `delete` = '0' AND `test` = '0' AND ssn IS NOT NULL");
showItem ("Cadastros com CPF", $cadastros_cpf, 2);


?>
</table>

<br /><br /> 
<font class="font_item">Masculinos vs. Femininas:</font>
<br /><br />
<script language="JavaScript" src="../js/FusionCharts.js"></script>
<div id="chartdiv"></div>
  <script type="text/javascript">
	var chart = new FusionCharts("Charts/Pie3D.swf", "ChartId", "600", "300", "0", "0");
	chart.setDataURL("Data/mulheres_homens.php");		   
	chart.render("chartdiv");
  </script>

<br /><br /> 
<font class="font_item">Marketing:</font>
<br /><br />
<script language="JavaScript" src="../js/FusionCharts.js"></script>
<div id="chartdiv2"></div>
  <script type="text/javascript">
	var chart = new FusionCharts("Charts/Pie3D.swf", "ChartId", "600", "300", "0", "0");
	chart.setDataURL("Data/marketing.php");		   
	chart.render("chartdiv2");
  </script>
  
<br /><br /> 
<font class="font_item">Idade dos jogadores:</font>
<br /><br />
<script language="JavaScript" src="../js/FusionCharts.js"></script>
<div id="chartdiv3"></div>
  <script type="text/javascript">
	var chart = new FusionCharts("Charts/Pie3D.swf", "ChartId", "600", "300", "0", "0");
	chart.setDataURL("Data/age.php");		   
	chart.render("chartdiv3");
  </script>
  
<br /><br /> 
<font class="font_item">Idade dos homens:</font>
<br /><br />
<script language="JavaScript" src="../js/FusionCharts.js"></script>
<div id="chartdiv4"></div>
  <script type="text/javascript">
	var chart = new FusionCharts("Charts/Pie3D.swf", "ChartId", "600", "300", "0", "0");
	chart.setDataURL("Data/age_men.php");		   
	chart.render("chartdiv4");
  </script>
  
<br /><br /> 
<font class="font_item">Idade das mulheres:</font>
<br /><br />
<script language="JavaScript" src="../js/FusionCharts.js"></script>
<div id="chartdiv5"></div>
  <script type="text/javascript">
	var chart = new FusionCharts("Charts/Pie3D.swf", "ChartId", "600", "300", "0", "0");
	chart.setDataURL("Data/age_women.php");		   
	chart.render("chartdiv5");
  </script>

<br /><br /> 
  
<br /><br /> 
  
</body>

</html>
