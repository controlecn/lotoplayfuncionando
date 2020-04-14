<?

$cmd = sql_injection_check($_GET["cmd"]);

if ($cmd=="get") {

	$my_points = GetRow("SELECT points FROM users WHERE id = '".$user_data["id"]."'");

	if ($my_points!=0) {
	
		$prize_credits = floor(($my_points / 10) / 0.25);
		$prize_bonus = $prize_credits * 5;
		
		$credits_bonus = getCredits ($user_data["id"]);
		$credits = $credits_bonus[0];
		$bonus = $credits_bonus[1];
		
		if (($credits==0)&&($bonus==0)&&(GetRow("SELECT COUNT(id) FROM transfers_payout WHERE status = 1 AND userId = '".$user_data["id"]."'")==0)) {
		
			SqlQuery("INSERT INTO transfers (userId,transferDate,value,transferType,information,affliateId,buy) VALUES ('".$user_data["id"]."', now(), '$prize_bonus', '2', '".$lang["transfers_convert_points"]."', '0','1')");

			$bonus = $bonus + $prize_bonus;
					
			SqlQuery("UPDATE users SET bonus = '$bonus' WHERE id = '".$user_data["id"]."'");
				
				// Update client
			update_credits($user_data["id"]);
			
			SqlQuery("INSERT INTO points_transfers (userid,transfertype,transferdate,points,description) VALUES ('".$user_data["id"]."','2',NOW(),'$my_points','Pontos convertidos')");
			
			SqlQuery("UPDATE users SET points = '0' WHERE id = '".$user_data["id"]."'");
			
		}
	}
	

}


$my_points = GetRow("SELECT points FROM users WHERE id = '".$user_data["id"]."'");

$prize_credits = floor(($my_points / 10) / 0.25);
$prize_bonus = $prize_credits * 5;

?>
<script type="text/javascript">
function confirmBuy(productname) {
    return confirm('<?=$lang["account_points_confirm"]?> '+productname);
}
</script>
<div class="my_account_points_left">
    	<h1><?=$lang["account_points_title"]?></h1>
        <br />
        <h3><?=$lang["account_points_yourpoints"]?>: <?=$my_points?></h3>
        <p><? showContent("POINTS_MAIN") ?></p>
		
		<br /><br />
		
		<? if ($my_points!=0) { ?>
		
		<?
		
			$credits_bonus = getCredits ($user_data["id"]);
			$credits = $credits_bonus[0];
			$bonus = $credits_bonus[1];
			
			if (($credits==0)&&($bonus==0)&&(GetRow("SELECT COUNT(id) FROM transfers_payout WHERE status = 1 AND userId = '".$user_data["id"]."'")==0)) {
				?><a href="<?=$links["ACCOUNT_POINTS"]?>&cmd=get" class="blink"><?=$lang["currency_1"]?><?=credits2money($prize_bonus)?><?=$lang["currency_2"]?> <?=$lang["account_points_bonus"]?></a> <br /><?
			} else {
				showContent("POINTS_NOGIVE");
			}
		
		?>		
		
		<? } ?>
		
    </div>
    
    <div class="my_account_points_right">
    	<div>
        	<img src="img/<?=$global_lang?>/label_historic.gif" alt="<?=$alt["account_points_history"]?>" /><br /><br />
            
            <p><?=$lang["account_points_history_content"]?>:</p>
            
            <br />
            
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>&nbsp;&nbsp;<b><?=$lang["account_points_history_description"]?></b></td>
                <td align="right"><b><?=$lang["account_points_history_points"]?>:</b>&nbsp;&nbsp;</td>
              </tr>
            </table>
            
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border: #AFAFAF solid 1px;">
			<?
			
				$result = mysql_query("SELECT transfertype,description,points FROM points_transfers WHERE userid = '".$user_data["id"]."' ORDER BY transferdate DESC LIMIT 9", $mysql_link);

				if ($result) {

					$i = 0;
					$a = 0;

					while ($row = mysql_fetch_array($result)) {
					
						$a++;
					
						if($i%2 == 0) {
							$color = "#FFFFFF";
							$i++;
						} else {
							$color = "#F7F7F7";
							$i++;
						}

						$description = $row["description"];
						$points = $row["points"];
						$transfertype = $row["transfertype"];
						
						if ($transfertype==1) {
							$prefix = "+";
							$classf = "green_text";
						} else {
							$prefix = "-";
							$classf = "red_text";
						}

						?>
						  <tr>
							<td bgcolor="<?=$color?>" height="34">&nbsp;&nbsp;<?=$description?></td>
							<td bgcolor="<?=$color?>" height="34" align="right" class="<?=$classf?>"><b><?=$prefix?><?=$points?></b>&nbsp;&nbsp;</td>
						  </tr>
						<?
					}

					mysql_free_result($result);

					if ($a==0) {
						?>
						<tr>
							<td bgcolor="#FFFFFF" colspan="2"><?=$lang["account_points_history_nopoints"]?></td>
						</tr>
						<?
					}

				}
			?>

            </table>
            
            
    </div>
    
</div>

<div style="clear: both;"></div>

<br />

<a href="<?=$links["ACCOUNT"]?>" class="blink"><?=$lang["account_transfers_back"]?></a>