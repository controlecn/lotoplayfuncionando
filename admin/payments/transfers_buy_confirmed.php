<?

include('../include_functions.php');
checkAccess(1);
include('../include_guifunctions.php');

gui_header("Compras Liberadas", "../");

$showQt = $_REQUEST["showQt"];

if (!$showQt) $showQt = "today";

if ($showQt=="today") {
	// Today
	$timeperiod = "AND boughtWhen BETWEEN '".date("Y-m-d")." 00:00:00' AND '".date("Y-m-d")." 23:59:59' ";
} else if ($showQt=="week") {
	// This week
	$timeperiod = "AND boughtWhen > DATE_SUB('".date("Y-m-d")."', INTERVAL DAYOFWEEK('".date("Y-m-d")."') DAY) ";
} else if ($showQt=="month") {
	// This Month
	$timeperiod = "AND boughtWhen BETWEEN DATE_SUB(CURDATE(), INTERVAL DAYOFMONTH(NOW())-1 DAY) AND LAST_DAY(NOW()) ";
} else {
	// All
	$timeperiod = "";
}

?>
<script>
function confirmDelete() {
    return confirm('Tem certeza que quer cancelar?');
}

function confirmValid() {
    return confirm('<?=$lang_boughtcredits_confirmvalid?>');
}
</script>
<?

$update = $_REQUEST["update"];

if ($update=="yes") {

	echo "<B>$lang_global_changed</b><br>";

}


?>

<form id="ChangeForm" name="ChangeForm" action="transfers_buy_confirmed.php">
<select name="showQt" class="tabletext">
<option value="today"<? if($showQt=="today") { echo " selected"; } ?>>Hoje</option>
<option value="week"<? if($showQt=="week") { echo " selected"; } ?>>Esta semana</option>
<option value="month"<? if($showQt=="month") { echo " selected"; } ?>>Este mes</option>
<option value="all"<? if($showQt=="all") { echo " selected"; } ?>>Todos</option>
</select>
<input type="submit" name="submitbutton" value="Mostra">
</form>

<?

gui_tabletop(array($lang_boughtcredits_table_username, $lang_boughtcredits_table_form, $lang_boughtcredits_table_value, $lang_boughtcredits_table_date, "Doc"), 1);

$sql = "Select * from transfers_buy WHERE status = '1' {$timeperiod}ORDER BY id DESC";

$result = mysql_query($sql, $mysql_link);

	$i = 0;
	$a = 0;

if ($result) {

	while ($row = mysql_fetch_array($result)) {

		$i++;

		if($a%2 == 0) {
			$color = "#FFFFFF";
			$a++;
		} else {
 			$color = "#F7F7F7";
 			$a++;
		}

		$id = $row["id"];
		$userId = $row["userId"];
		$bankId = $row["bankId"];
		//$creditValue = $row["value"];
		$value = $row["value"];
		$cents = $row["cents"];
		$affliateId = $row["affliateId"];
		$boughtWhen = changeMysqlTime($row["boughtWhen"]);
		$doc = $row["doc"];
		
		if (strlen($cents)==1) {

			$cents = "0$cents";

		}

		$valor = "$value,$cents";

		$username = GetRow("Select username From users Where id = $userId");
		$bank = GetRow("Select name From buy_paymentforms Where id = $bankId");

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="8"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tabletext"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="../users/user_info.php?id=<?=$userId?>" class="link"><?=$username?></a></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$bank?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$lang_system_moneybefore?> <?=$valor?> <?=$lang_system_moneyafter?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$boughtWhen?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$doc?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext" align="center"><a href="transfers_buy_cancel.php?id=<?=$id?>" onclick="return confirmDelete()"><img src="../images/icons/delete.gif" alt="Cancelar" border="0"></a></td>
  </tr>
		<?

	}

mysql_free_result($result);

}

if ($i==0) {

		echo "
		  <tr>
		    <td bgcolor=\"#FFFFFF\" colspan=\"8\" class=\"tabletext\" height=\"23\" align=\"center\">$lang_global_emptytable</td>
		  </tr>
		";

}

?>
</table>
<? gui_bottom("../"); ?>