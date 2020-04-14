<? if (($_GET["username"]=="Visitante")&&($_GET["email"]=="visitante@lotoplay.com")) {
	die("<b>VISITANTE SEM CADASTRO</b>");
}

?><?
include('../include_functions.php');
checkAccess(1);

$username = $_GET["username"];
$email = $_GET["email"];
$user_id = GetRow("SELECT id FROM users WHERE username = '$username' AND email = '$email'");

if ($_POST["submitbutton"]) {

	$comment = addslashes($_POST["comment"]);
	
	SqlQuery("INSERT INTO fraud_comments (operator, user_id, comment_date, comment) VALUES ('$logged_user', '$user_id', NOW(), '$comment')");

}

?><html>
<head>
<title>LotoPlay - Sistema de controle</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/styles.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#F7F7F7" style="margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td bgcolor="#FFFFFF"><font class="tabletop"><form method="post" action="comments.php?username=<?=$_GET["username"]?>&email=<?=$_GET["email"]?>"><input type="text" name="comment" size="40"><input type="submit" name="submitbutton" value="Enviar!"></form></td>
	</tr>
<?

$comment_count = GetRow("SELECT COUNT(id) FROM fraud_comments WHERE user_id = '$user_id'");

if ($comment_count==0) {

			?>
	<tr>
		<td bgcolor="#FFFFFF"><font class="tabletop">Nao tem commentarios...</td>
	</tr>
			<?


} else {

	$result = mysql_query("SELECT * FROM fraud_comments WHERE user_id = $user_id ORDER BY id DESC", $mysql_link);

	$a = 0;

	if ($result) {

		while ($row = mysql_fetch_array($result)) {

			$id = $row["id"];
			$operator = $row["operator"];
			$comment_date = changeMysqlTime($row["comment_date"]);
			$comment = $row["comment"];

			if($a%2 == 0) {
				$color = "#FFFFFF";
				$a++;
			} else {
				$color = "#F7F7F7";
				$a++;
			}


			?>
	<tr>
		<td bgcolor="<?=$color?>"><font class="tabletop"><?=$comment_date?> <?=$operator?>:</font><br><font class="tabletext"><?=$comment?></font></td>
	</tr>
			<?
			
			

		}

	mysql_free_result($result);

	}
	
}

?>


</table>

</body>
</html>