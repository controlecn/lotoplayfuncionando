<?

include('../include_functions.php');
include('../include_guifunctions.php');

checkAccess(1);

gui_header("Usuários ativos", "../");

$showUsers = $_POST["showUsers"];

if (!$showUsers) {

	$showUsers = "u10";

}

if ($showUsers=="-") {

	$showUsers = "u10";

}

switch ($showUsers) {

	case "u10":	$usersSql = "Select id,fullname,username,email,ip from users where super = 0 AND `delete` = '0' ORDER BY id DESC Limit 10";
			break;

	case "u25":	$usersSql = "Select id,fullname,username,email,ip from users where super = 0 AND `delete` = '0' ORDER BY id DESC Limit 25";
			break;

	case "u50":	$usersSql = "Select id,fullname,username,email,ip from users where super = 0 AND `delete` = '0' ORDER BY id DESC Limit 50";
			break;

	case "u100":	$usersSql = "Select id,fullname,username,email,ip from users where super = 0 AND `delete` = '0' ORDER BY id DESC Limit 100";
			break;

	case "u150":	$usersSql = "Select id,fullname,username,email,ip from users where super = 0 AND `delete` = '0' ORDER BY id DESC Limit 150";
			break;

	case "u200":	$usersSql = "Select id,fullname,username,email,ip from users where super = 0 AND `delete` = '0' ORDER BY id DESC Limit 200";
			break;

	case "hoje":	$usersSql = "Select id,fullname,username,email,ip from users where super = 0 AND joinedWhen BETWEEN '".date("Y-m-d")." 00:00:00' AND NOW() AND `delete` = '0' ORDER BY id DESC";
			break;

	case "estasemana":	$usersSql = "Select id,fullname,username,email,ip from users where super = 0 AND  joinedWhen > DATE_SUB('".date("Y-m-d")."', INTERVAL DAYOFWEEK('".date("Y-m-d")."') DAY) AND `delete` = '0' ORDER BY id DESC";
				break;

	case "estemes":		$usersSql = "Select id,fullname,username,email,ip from users where super = 0 AND  joinedWhen BETWEEN '".date("Y-m")."-01 00:00:00' AND NOW() AND `delete` = '0' ORDER BY id DESC";
				break;

	case "todos":		$usersSql = "Select id,fullname,username,email,ip from users where super = 0 AND `delete` = '0' ORDER BY id DESC";
				break;

}

?>
<script src="../js/jquery-1.2.3.min.js"></script>
<script src="../js/jquery.suggest.js"></script>
<link href="../css/jquery.suggest.css" rel="stylesheet" type="text/css" />
<script>
jQuery(function() {
jQuery("#selectusername").suggest("../autocomplete_users.php",{
onSelect: function() {document.forms[0].submit()}});
});
function confirmDelete() {
    return confirm('<?=$lang_accountsoverview_table_delete?>');
}

</script>
<form method="post" action="user_info.php">
<input type="text" name="username" id="selectusername">
<input type="hidden" name="fromForm" value="1">
<input type="submit" name="submitbutton" value="<?=$lang_accountsoverview_show_submitbutton?>" class="tabletop">
</form>
<form method="post" action="active.php">
<select name="showUsers" class="tabletext">
<option value="u10"<? if($showUsers=="u10") { echo " selected"; } ?>><?=$lang_accountsoverview_show_last10?></option>
<option value="u25"<? if($showUsers=="u25") { echo " selected"; } ?>><?=$lang_accountsoverview_show_last25?></option>
<option value="u50"<? if($showUsers=="u50") { echo " selected"; } ?>><?=$lang_accountsoverview_show_last50?></option>
<option value="u100"<? if($showUsers=="u100") { echo " selected"; } ?>><?=$lang_accountsoverview_show_last100?></option>
<option value="u150"<? if($showUsers=="u150") { echo " selected"; } ?>><?=$lang_accountsoverview_show_last150?></option>
<option value="u200"<? if($showUsers=="u200") { echo " selected"; } ?>><?=$lang_accountsoverview_show_last200?></option>
<option value="-">-----------------------------</option>
<option value="hoje"<? if($showUsers=="hoje") { echo " selected"; } ?>><?=$lang_accountsoverview_show_today?></option>
<option value="estasemana"<? if($showUsers=="estasemana") { echo " selected"; } ?>><?=$lang_accountsoverview_show_thisweek?></option>
<option value="estemes"<? if($showUsers=="estemes") { echo " selected"; } ?>><?=$lang_accountsoverview_show_thismonth?></option>
<option value="-">-----------------------------</option>
<option value="todos"<? if($showUsers=="todos") { echo " selected"; } ?>><?=$lang_accountsoverview_show_all?></option>
</select>
<input type="submit" name="submitbutton" value="<?=$lang_accountsoverview_show_submitbutton?>" class="tabletop">
</form>
<?

gui_tabletop(array($lang_accountsoverview_table_username, $lang_accountsoverview_table_name, $lang_accountsoverview_table_email, "Ip", $lang_accountsoverview_table_credits, $lang_accountsoverview_table_bonus, $lang_accountsoverview_table_transfers), 1);

$result = mysql_query($usersSql, $mysql_link);

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

		unset($tr);

		$id = $row["id"];
		$fullname = $row["fullname"];
		$username = $row["username"];
		$email = $row["email"];
		$ip = $row["ip"];

		$allcredits = getCredits($id);

		$saldo = $allcredits[0];
		$bonus = $allcredits[1];

		$tr = GetRow("SELECT COUNT(id) FROM transfers WHERE userId = $id");

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="10"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="user_info.php?id=<?=$id?>" class="link"><?=$username?></a></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$fullname?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="mailto:<?=$email?>" class="link"><?=$email?></a></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$ip?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$saldo?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$bonus?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$tr?></td>
	<td bgcolor="<?=$color?>" height="23" align="center"><a href="user_info.php?id=<?=$id?>"><img src="../images/icons/info.gif" alt="<?=$lang_accountsoverview_table_showinfo?>" border="0"></a>&nbsp;&nbsp;<a href="../payments/transfers.php?username=<?=$username?>"><img src="../images/icons/coins_info.gif" alt="<?=$lang_accountsoverview_table_showtransfers?>" border="0"></a>&nbsp;&nbsp;<a href="user_delete.php?id=<?=$id?>&ref=2" onclick="return confirmDelete()"><img src="../images/icons/delete.gif" alt="<?=$lang_accountsoverview_table_deleteuser?>" border="0"></a></td>
  </tr>
		<?

	}

mysql_free_result($result);

}

if ($i==0) {

		echo "
		  <tr>
		    <td bgcolor=\"#FFFFFF\" colspan=\"10\" class=\"smalltext\" height=\"23\" align=\"center\">$lang_global_emptytable</td>
		  </tr>
		";

}

?>
</table>
<? gui_bottom(); ?>