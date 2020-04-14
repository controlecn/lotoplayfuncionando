<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Estatísticas de afiliados", "../");

$affliates = GetRow("SELECT COUNT(id) FROM users_affliates");

/**** Affliates Sales ****/

$result = mysql_query("SELECT id,buyDate,totalValue,userId,affliateId,affliateValue,information FROM transfers_affliates", $mysql_link);

$valorTotal = 0;
$valorPercent = 0;

if ($result) {

	while ($row = mysql_fetch_array($result)) {

			$value = $row["totalValue"];
			$percent = $row["affliateValue"];

			$valorTotal = $valorTotal + $value;
			$valorPercent = $valorPercent + $percent;

	}

	mysql_free_result($result);

}


?>
<font class="tabletop"><?=$lang_affliates_statistics_affliates?>:</font><br>
<font class="tabletext"><?=$affliates?></font><br><br>

<font class="tabletop"><?=$lang_affliates_statistics_sales?>:</font><br>
<font class="tabletext"><?=$lang_system_moneybefore?> <?=formatMoney($valorTotal)?> <?=$lang_system_moneyafter?></font><br><br>

<font class="tabletop"><?=$lang_affliates_statistics_commission?>:</font><br>
<font class="tabletext"><?=$lang_system_moneybefore?> <?=formatMoney($valorPercent)?> <?=$lang_system_moneyafter?></font><br><br>

<? gui_bottom(); ?>