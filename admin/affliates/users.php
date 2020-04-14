<?

include('../include_functions.php');
include('../include_guifunctions.php');

checkAccess(2);

$socioId = $_REQUEST["socioId"];

$socioLogin = GetRow("Select login from users_affliates where id = $socioId");

gui_header("Usuarios de afiliado", "../");

?>
<script>
function confirmDelete() {
    return is_confirmed = confirm('<?=$lang_affliateusers_delete?>');
}
</script>
<?

gui_tabletop(array($lang_affliateusers_table_username, $lang_affliateusers_table_name, $lang_affliateusers_table_email, $lang_affliateusers_table_credits, $lang_affliateusers_table_tr), 1);

$sql = "Select * from users where affliateId = $socioId";

$result = mysql_query($sql, $mysql_link);

	$i = 0;
	$a = 0;

if ($result) {

	while ($row = mysql_fetch_array($result)) {

		$i++;

		unset($tr);

		$id = $row["id"];
		$fullname = $row["fullname"];
		$username = $row["username"];
		$email = $row["email"];

		$allcredits = getCredits($id);
		$saldo = $allcredits[0];

		$tr = GetRow("SELECT COUNT(id) FROM transfers WHERE userId = '$id'");

		if($a%2 == 0) {
			$color = "#FFFFFF";
			$a++;
		} else {
 			$color = "#F7F7F7";
 			$a++;
		}

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="8"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="../users/info.php?id=<?=$id?>" class="link"><?=$username?></a></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$fullname?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$email?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$saldo?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$tr?></td>
	<td bgcolor="<?=$color?>" height="23" align="center"><a href="../users/user_info.php?id=<?=$id?>"><img src="../images/icons/info.gif" alt="<?=$lang_accountsoverview_table_showinfo?>" border="0"></a>&nbsp;&nbsp;<a href="../payments/transfers.php?username=<?=$username?>"><img src="../images/icons/coins_info.gif" alt="<?=$lang_accountsoverview_table_showtransfers?>" border="0"></a>&nbsp;&nbsp;<a href="../users/user_delete.php?id=<?=$id?>&ref=2" onclick="return confirmDelete()"><img src="../images/icons/delete.gif" alt="<?=$lang_accountsoverview_table_deleteuser?>" border="0"></a></td>
  </tr>
		<?

	}

mysql_free_result($result);

}


if ($i==0) {

		echo "
		  <tr>
		    <td bgcolor=\"#FFFFFF\" colspan=\"8\" class=\"smalltext\" height=\"20\" align=\"center\">$lang_global_emptytable</td>
		  </tr>
		";

}

?>
</table><br>
<a href="javascript: history.back()" class="link">« <?=$lang_global_back?></a>
<? gui_bottom(); ?>