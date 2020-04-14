<?

if (!$_POST["view_qt"]) {
	$view_qt = 1;
} else {

	if (($_POST["view_qt"]!=1)&&($_POST["view_qt"]!=2)&&($_POST["view_qt"]!=3)) {
		$view_qt = 1;
	} else {
		$view_qt = $_POST["view_qt"];
	}

}

?><h1><?=$lang["account_messages_title"]?></h1>

<form method="post" action="<?=$links["ACCOUNT_MESSAGES"]?>" id="transfers_form">
<p><?=$lang["account_messages_view"]?>:
<select name="view_qt" onchange="document.getElementById('transfers_form').submit()">
	<option value="1"<? if ($view_qt==1) echo " selected=\"selected\""; ?>><?=$lang["account_messages_view_last10"]?></option>
	<option value="2"<? if ($view_qt==2) echo " selected=\"selected\""; ?>><?=$lang["account_messages_view_last20"]?></option>
	<option value="3"<? if ($view_qt==3) echo " selected=\"selected\""; ?>><?=$lang["account_messages_view_all"]?></option>
</select></p>
</form>
<br />
<?

switch ($view_qt) {
	case 1:	$sql = "SELECT * FROM messages WHERE userid = '".$user_data["id"]."' ORDER BY messagedate DESC LIMIT 10"; break;
	case 2:	$sql = "SELECT * FROM messages WHERE userid = '".$user_data["id"]."' ORDER BY messagedate DESC LIMIT 20"; break;
	case 3:	$sql = "SELECT * FROM messages WHERE userid = '".$user_data["id"]."' ORDER BY messagedate DESC"; break;
}



$result = mysql_query($sql, $mysql_link);

if ($result) {

	$i = 0;
	$a = 0;

	while ($row = mysql_fetch_array($result)) {
	
		$a++;
	
		if($i%2 == 0) {
			$color = "#F7F7F7";
			$i++;
		} else {
			$color = "#FFFFFF";
			$i++;
		}
		
		$id = $row["id"];
		
		SqlQuery("UPDATE messages SET read = '1' WHERE id = '$id'");

		$messagedate = changeMysqlTime($row["messagedate"]);
		$message = $row["message"];

		?>
		<table width="460" border="0" cellspacing="0" cellpadding="4" style="border: 1px #888888 solid">
		<tr>
			<td bgcolor="#F7F7F7" width="110"><b><?=$lang["account_messages_msg_message"]?> <?=$a?></b></td>
			<td bgcolor="#F7F7F7" align="right"><a href="<?=$links["ACCOUNT_MESSAGES_DELETE"]?><?=$qr2?>id=<?=$id?>" class="blink_small"><img src="img/<?=$global_lang?>/ico_delete.gif" border="0" /></a></td>
		</tr>
		<tr>
			<td bgcolor="#F7F7F7" colspan="2"><hr /></td>
		</tr>
		<tr>
			<td bgcolor="#F7F7F7" width="110" align="right"><?=$lang["account_messages_msg_date"]?>:</td>
			<td bgcolor="#F7F7F7" align="left"><b><?=$messagedate?></b></td>
		</tr>
		<tr>
			<td bgcolor="#F7F7F7" width="110" align="right"><?=$lang["account_messages_msg_from"]?>:</td>
			<td bgcolor="#F7F7F7"><b><?=$lang["account_messages_msg_lp"]?></b></td>
		</tr>
		<tr>
			<td bgcolor="#F7F7F7" width="110" align="right"><?=$lang["account_messages_msg_to"]?>:</td>
			<td bgcolor="#F7F7F7"><b><?=$lang["account_messages_msg_you"]?></b></td>
		</tr>
		<tr>
			<td bgcolor="#F7F7F7" colspan="2"><hr /></td>
		</tr>
		<tr>
			<td bgcolor="#F7F7F7" colspan="2"><b><?=$message?></b></td>
		</tr>
		</table><br />
		<?
	}

	mysql_free_result($result);
	
	if ($a==0) {
		?>
		<p><?=$lang["account_messages_nothing"]?></p>
		<?
	}

}

?>
<br />

<a href="<?=$links["ACCOUNT"]?>" class="blink"><?=$lang["account_transfers_back"]?></a>