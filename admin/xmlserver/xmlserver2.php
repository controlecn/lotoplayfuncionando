<?

include('../include_functions.php');
checkAccess(1);
include('../include_guifunctions.php');

gui_header("Informacao de Servidor", "../");

?>
<link href="../css/thermo.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../js/thermo.js"></script>

<div class="rngDiv" id="rng_div">
<font class="gameTitle" id="username_font">Usuario</font> - <a href="#" onclick="closeRNG();" class="link">Fechar</a><br>
<img src="../images/px.gif" height="10" width="1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding: 10px" align="center"><table width="132" style="border: 2px solid #000000;"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="44"><img src="../images/arrow1.gif" width="44" height="14" id="arrow1_up" style="visibility: hidden;"></td>
        <td width="44"><img src="../images/arrow1.gif" width="44" height="14" id="arrow2_up" style="visibility: hidden;"></td>
		<td width="44"><img src="../images/arrow1.gif" width="44" height="14" id="arrow3_up" style="visibility: hidden;"></td>
      </tr>
      <tr>
        <td width="44" bgcolor="#fff600"><a href="#" onclick="setArrow(1);"><img src="../images/px.gif" height="44" width="44" border="0"></a></td>
        <td width="44" bgcolor="#ffad00"><a href="#" onclick="setArrow(2);"><img src="../images/px.gif" height="44" width="44" border="0"></a></td>
        <td width="44" bgcolor="#ff0000"><a href="#" onclick="setArrow(3);"><img src="../images/px.gif" height="44" width="44" border="0"></a></td>
      </tr>
      <tr>
        <td width="44"><img src="../images/arrow2.gif" width="44" height="14" id="arrow1_down" style="visibility: hidden;"></td>
        <td width="44"><img src="../images/arrow2.gif" width="44" height="14" id="arrow2_down" style="visibility: hidden;"></td>
		<td width="44"><img src="../images/arrow2.gif" width="44" height="14" id="arrow3_down" style="visibility: hidden;"></td>
      </tr>
    </table></td>
  </tr>
</table>
<img src="../images/px.gif" width="1" height="10">
<center><input type="button" name="submitbutton" value="Mudar" onclick="updateRNG();"></center>
</div>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td bgcolor="#F7F7F7" height="23" width="50">&nbsp;</td>
	<td bgcolor="#F7F7F7" height="23" width="5"></td>
	<td bgcolor="#F7F7F7" height="23" class="tabletop">Usuário</td>
	<td bgcolor="#F7F7F7" height="23" class="tabletop">Jogo</td>
	<td bgcolor="#F7F7F7" height="23" class="tabletop">Saldo</td>
	<td bgcolor="#F7F7F7" height="23" class="tabletop">Bonus</td>
	<td bgcolor="#F7F7F7" height="23" class="tabletop">Aposta</td>
	<td bgcolor="#F7F7F7" height="23" width="80" class="tabletop" align="center"><?=$lang_global_operation?></td>
  </tr>
<?

function parse_username($username) {
	
	$username = str_replace("&special_sp&", " ", $username);
	$username = str_replace("&special_u1&", "ú", $username);
	$username = str_replace("&special_u2&", "ü", $username);
	$username = str_replace("&special_a1&", "ã", $username);
	$username = str_replace("&special_a2&", "á", $username);
	$username = str_replace("&special_a3&", "â", $username);
	$username = str_replace("&special_a4&", "à", $username);
	$username = str_replace("&special_c1&", "ç", $username);
	$username = str_replace("&special_e1&", "é", $username);
	$username = str_replace("&special_e2&", "ê", $username);
	$username = str_replace("&special_i1&", "í", $username);
	$username = str_replace("&special_o1&", "õ", $username);
	$username = str_replace("&special_o2&", "ó", $username);
	$username = str_replace("&special_o3&", "ô", $username);
	
	return $username;

}

function getname($name) {

	switch ($name) {
		case "None": $realname = "Menu Principal"; break;
		case "silverball": $realname = "Silver Ball"; break;
		case "nineballs": $realname = "Nine Balls"; break;
		case "cb2009": $realname = "Campeonato Brasileiro"; break;
		case "circus": $realname = "Circus"; break;
		case "turbo90": $realname = "Noventinha"; break;
		case "lucky25": $realname = "25 Da Sorte"; break;
		case "bingo75": $realname = "Bingo Tradicional"; break;
		case "bingomaster": $realname = "Bingo Master"; break;
		case "bonusbingo": $realname = "Bonus Bingo"; break;
		case "carnaval": $realname = "Carnaval"; break;
		case "egyptdiamonds": $realname = "Diamantes da Kleopatra"; break;
		case "halloween": $realname = "Halloween"; break;
		case "fruitmania": $realname = "Mania Das Frutas"; break;
		case "megabingo": $realname = "Mega Bingo"; break;
		case "showbingoball": $realname = "Show Bingo Ball"; break;
		case "superbingo": $realname = "Super Bingo"; break;
		case "superbingo75": $realname = "Super Bingo 75"; break;
		case "superbingo2008": $realname = "Super Bingo 2008"; break;
		case "treasuresoftheocean": $realname = "Tesouros Do Mar"; break;
		case "videopoker": $realname = "Video Poker"; break;
	}
	
	return $realname;

}

$fp = fsockopen("reidobingo-net.umbler.net", 1024, $errno, $errstr, 3);

if (!$fp) {

		echo "
		  <tr>
		    <td bgcolor=\"#FFFFFF\" colspan=\"13\" class=\"tabletext\" height=\"23\" align=\"center\">Servidor Desligado</td>
		  </tr>
		";

} else {
	
	fputs($fp,"ROOT get_players\0");

	$rec_userinfo = fread($fp, 2048);
	$rec_userinfo = str_replace("\0", "", $rec_userinfo);
	fclose($fp);
	
	if ($rec_userinfo=="NOUSERS") {
	
		echo "
		  <tr>
		    <td bgcolor=\"#FFFFFF\" colspan=\"13\" class=\"tabletext\" height=\"23\" align=\"center\">Nehum usuario connectado...</td>
		  </tr>
		";
	
	} else {
		
		$rec_userinfo = explode(" ", $rec_userinfo);
		
		if (substr_count($rec_userinfo[1], ",")==0) {
		
			$users_watch = array($rec_userinfo[1]);
			$users_diamonds = array($rec_userinfo[2]);
			$users_username = array($rec_userinfo[3]);
			$users_game = array($rec_userinfo[4]);
			$users_credits = array($rec_userinfo[5]);
			$users_bonus = array($rec_userinfo[6]);
			$users_bet = array($rec_userinfo[7]);
			$users_thermo = array($rec_userinfo[8]);
		
		} else {
		
			$users_watch = explode(",", $rec_userinfo[1]);
			$users_diamonds = explode(",", $rec_userinfo[2]);
			$users_username = explode(",", $rec_userinfo[3]);
			$users_game = explode(",", $rec_userinfo[4]);
			$users_credits = explode(",", $rec_userinfo[5]);
			$users_bonus = explode(",", $rec_userinfo[6]);
			$users_bet = explode(",", $rec_userinfo[7]);
			$users_thermo = explode(",", $rec_userinfo[8]);

		}
		
		$i = 0;
		
		for ($b=0; $b<count($users_username); $b++) {

			$i++;

			if($a%2 == 0) {
				$color = "#FFFFFF";
				$a++;
			} else {
				$color = "#F7F7F7";
				$a++;
			}

			$username = $users_username[$b];
			$username2 = parse_username($username);
			
			$game = $users_game[$b];
			$credits = $users_credits[$b];
			$bonus = $users_bonus[$b];
			$bet = $users_bet[$b];
			$thermo = $users_thermo[$b];
			$watch = $users_watch[$b];
			
			$credits = $credits/4;
			$bonus = $bonus/4;
			
			$game_name = getname($game);
			
			if (($game!="none")&&($game!="bingo75")&&($game!="None")) {
				
				if ($thermo==1) {
					$color = "#fff600";
				} else if ($thermo==2) {
					$color = "#ffad00";
				} else {
					$color = "#ff0000";
				}
				
			}
			
			if ($watch==0) {
				$watch_icon = "still.gif";
			} else if ($watch==1) {
				$watch_icon = "up.gif";
			} else {
				$watch_icon = "down.gif";
			}
	

			//$sales_icon = "d_black.gif";
			
			
			?>
	  <tr>
		<td bgcolor="#94a6b5" height="1" colspan="8"></td>
	  </tr>
	  <tr>
		<td bgcolor="<?=$color?>" height="23" align="right"><img src="../images/icons/<?=$watch_icon?>"></td>
		<td bgcolor="<?=$color?>" height="23" width="5"></td>
		<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$username2?></td>
		<? if (($game=="none")||($game=="bingo75")||($game=="None")) { ?>
		<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$game_name?></td>
		<? } else { ?>
		<td bgcolor="<?=$color?>" height="23" class="tabletext"><a class="link" href="#" onclick="javascript:editRNG(event, '<?=$username?>', '<?=$userid?>', '<?=$thermo?>', '<?=$username2?>');"><?=$game_name?></a></td>
		<? } ?>
		<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$lang_system_moneybefore?> <?=$credits?> <?=$lang_system_moneyafter?></td>
		<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$lang_system_moneybefore?> <?=$bonus?> <?=$lang_system_moneyafter?>		</td>
		<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$bet?></td>
		<td bgcolor="<?=$color?>" height="23" align="center"><a href="xmlserver_disconnect.php?id=<?=$userid?>" onclick="return confirmDelete()"><img src="../images/icons/delete.gif" alt="Desconectar" border="0"></a></td>
	  </tr>
			<?

		}
		 
	}

}

?>
</table>
<? gui_bottom("../"); ?>