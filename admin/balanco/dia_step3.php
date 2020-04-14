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

?>
<h2>Data do Balanço: <?=$dia_day?> / <?=$dia_month?> / <?=$dia_year?></h2>

<a href="dia_step4.php?dia=<?=$dia_id?>" class="link" style="font-size: 34px">Confirmar e fechar o dia!</a>

<? gui_bottom(); ?>