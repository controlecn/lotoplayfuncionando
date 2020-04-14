<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
include('functions_imap.php');
gui_header("Tickets Abertos", "../");

?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td bgcolor="#F7F7F7" height="23" width="5"></td>
	<td bgcolor="#F7F7F7" height="23" class="tabletop">Apelido / Email</td>
	<td bgcolor="#F7F7F7" height="23" class="tabletop">Data / Hora</td>
	<td bgcolor="#F7F7F7" height="23" class="tabletop">Assunto</td>
	<td bgcolor="#F7F7F7" height="23" width="80" class="tabletop" align="center"><?=$lang_global_operation?></td>
  </tr>
<?

$sql = "SELECT * FROM tickets WHERE status = 1 ORDER BY id DESC";

$result = mysql_query($sql, $mysql_link);

$i = 0;

if ($result) {

	while ($row = mysql_fetch_array($result)) {

		$i++;

		$id = $row["id"];
		$subject = $row["subject"];
		$userid = $row["userid"];
		$email = $row["email"];
		$ticket_type = $row["ticket_type"];
		$ticket_date = changeMysqlTime($row["ticket_date"]);
		
		if ($userid==0) {
			$apelido = $email;
		} else {
			$apelido = "<a href=\"../users/user_info.php?id=$userid\" class=\"link\">".GetRow("SELECT username FROM users WHERE id = $userid")."</a>";
		}
		
		$last_respond = GetRow("SELECT content_type FROM tickets_contents WHERE ticket_id = $id ORDER BY id DESC LIMIT 1");

		if ($last_respond==1) {
			$color = "#FFCC00";
		} else {
			$color = "#00CC00";
		}
		
		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="5"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="tickets_info.php?id=<?=$id?>" class="link"><?=$apelido?></a></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="tickets_info.php?id=<?=$id?>" class="link"><?=$ticket_date?></a></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="tickets_info.php?id=<?=$id?>" class="link"><?=$subject?></a></td>
	<? if ($access==1) { ?>
	<td bgcolor="<?=$color?>" height="23" align="center"><a href="tickets_info.php?id=<?=$id?>"><img src="../images/icons/info.gif" alt="<?=$lang_payout_table_info?>" border="0"></a></td>
	<? } else { ?>
	<td bgcolor="<?=$color?>" height="23" align="center"><a href="tickets_info.php?id=<?=$id?>"><img src="../images/icons/info.gif" alt="<?=$lang_payout_table_info?>" border="0"></a><a href="tickets_close.php?id=<?=$id?>"><img src="../images/icons/check.gif" alt="Fechar" border="0"></a><a href="tickets_delete.php?id=<?=$id?>"><img src="../images/icons/delete.gif" alt="SPAM" border="0"></a></td>
	<? } ?>
  </tr>

		<?

	}

mysql_free_result($result);

}

if ($i==0) {

		echo "
		  <tr>
		    <td bgcolor=\"#FFFFFF\" colspan=\"5\" class=\"smalltext\" height=\"23\" align=\"center\">$lang_global_emptytable</td>
		  </tr>
		";

}

?>
</table><br><br>
<? gui_bottom(); ?>