<?

include('../include_functions.php');
include('../include_guifunctions.php');

checkAccess(1);

gui_header("Usuários deletados", "../");


?>
<script>

function confirmDelete() {
    return confirm('<?=$lang_accountsoverview_table_delete?>');
}

</script>
<?

gui_tabletop(array($lang_accountsoverview_table_username, $lang_accountsoverview_table_name, $lang_accountsoverview_table_email, "Ip", $lang_accountsoverview_table_credits, $lang_accountsoverview_table_bonus, $lang_accountsoverview_table_transfers), 1);

$result = mysql_query("SELECT id,fullname,username,email,ip FROM users WHERE `ban` = '1'", $mysql_link);

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
	<td bgcolor="<?=$color?>" height="23" align="center"><a href="user_info.php?id=<?=$id?>"><img src="../images/icons/info.gif" alt="<?=$lang_accountsoverview_table_showinfo?>" border="0"></a>&nbsp;&nbsp;<a href="../payments/transfers.php?username=<?=$username?>"><img src="../images/icons/coins_info.gif" alt="<?=$lang_accountsoverview_table_showtransfers?>" border="0"></a>&nbsp;&nbsp;<a href="user_undelete.php?id=<?=$id?>"><img src="../images/icons/check.gif" alt="<?=$lang_accountsoverview_table_deleteuser?>" border="0"></a></td>
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