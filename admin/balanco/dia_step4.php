<?



include('../include_functions.php');
checkAccess(1);
include('../include_guifunctions.php');

gui_header("Balanço do dia - Passo 4 (Final)", "../");

$dia_id = $_REQUEST["dia"];

$data = GetRow("SELECT dia FROM balanco_dias WHERE id = '".$dia_id."'");

$dia_year = substr($data, 0, 4);
$dia_month = substr($data, 5, 2);
$dia_day = substr($data, 8, 2);

SqlQuery("UPDATE balanco_dias SET confirmado = '1' WHERE id = '$dia_id'");

$result = mysql_query("SELECT * FROM `balanco_vendas` WHERE `dia` = '$dia_id' AND confirmed = '2'", $mysql_link);

if ($result) {

	while ($row = mysql_fetch_array($result)) {

		$boughtid = $row["boughtid"];

		SqlQuery("DELETE FROM statistics_sales WHERE boughtid = '$boughtid'");

	}

mysql_free_result($result);

}

SqlQuery("UPDATE transfers_buy SET status = '2' WHERE boughtWhen < DATE_ADD('$data 00:00:00', INTERVAL 1 DAY)  AND status = '0'");

?>
<h2>Data do Balanço: <?=$dia_day?> / <?=$dia_month?> / <?=$dia_year?></h2>

Relatório Confirmado!

<? gui_bottom(); ?>