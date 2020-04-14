<?

include('../include_functions.php');
checkAccess(1);
include('../include_guifunctions.php');

gui_header("Compras Dependentes", "../");

?>
<script>
function confirmDelete() {
    return confirm('<?=$lang_boughtcredits_confirmdelete?>');
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

gui_tabletop(array($lang_boughtcredits_table_username, $lang_boughtcredits_table_form, $lang_boughtcredits_table_value, $lang_boughtcredits_table_date), 1);

$sql = "Select * from transfers_buy WHERE status = '0' AND bankId != '1001' ORDER BY id DESC";

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
		$value = $row["value"];
		$cents = $row["cents"];
		$affliateId = $row["affliateId"];
		$boughtWhen = changeMysqlTime($row["boughtWhen"]);

		if (strlen($cents)==1) {
			$cents = "0$cents";
		}

		$valor = "$value,$cents";

		$username = GetRow("Select username From users Where id = $userId");
		$bank = GetRow("Select name From buy_paymentforms Where id = $bankId");

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="7"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tabletext"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="../users/user_info.php?id=<?=$userId?>" class="link"><?=$username?></a></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$bank?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$lang_system_moneybefore?> <?=$valor?> <?=$lang_system_moneyafter?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$boughtWhen?></td>
	<td bgcolor="<?=$color?>" height="23" align="center"><a href="transfers_buy_confirm_doc.php?id=<?=$id?>"><img src="../images/icons/check.gif" alt="<?=$lang_boughtcredits_table_realize?>" border="0"></a></td>
  </tr>
		<?

	}

mysql_free_result($result);

}

if ($i==0) {

		echo "
		  <tr>
		    <td bgcolor=\"#FFFFFF\" colspan=\"7\" class=\"tabletext\" height=\"23\" align=\"center\">$lang_global_emptytable</td>
		  </tr>
		";

}

?>
</table>
<? gui_bottom("../"); ?>