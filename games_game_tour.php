<div class="game_main_left">
   	  <h1><?=$lang["games_".$game."_title"]?></h1>
   
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="4" height="10"></td>
          </tr>
          <tr>
            <td colspan="4" align="center">
				<object type="application/x-shockwave-flash" data="tour/<?=$global_lang?>/<?=$game?>.swf" width="565" height="326">
					<param name="allowScriptAccess" value="sameDomain" />
					<param name="movie" value="tour/<?=$global_lang?>/<?=$game?>.swf" />
					<param name="quality" value="high" />
					<param name="scale" value="exactfit" />
					<param name="bgcolor" value="#ffffff" />
				</object>
			</td>
          </tr>
          <tr>
            <td colspan="4" height="12"></td>
          </tr>
          <tr>
			<? if ($game_type!=1) { ?>
			<td><a href="<?=str_replace("%%game%%", $game, $links["GAMES_GAME_MAIN"])?>"><img src="img/<?=$global_lang?>/btn_screen.jpg" alt="<?=$alt["games_screen"]?>" border="0" /></a></td>
            <td><a href="<?=str_replace("%%game%%", $game, $links["GAMES_GAME_TOUR"])?>"><img src="img/<?=$global_lang?>/btn_tour.jpg" alt="<?=$alt["games_tour"]?>" border="0" /></a></td>
            <td><a href="<?=str_replace("%%game%%", $game, $links["GAMES_GAME_KEYBOARD"])?>"><img src="img/<?=$global_lang?>/btn_keyboard.jpg" alt="<?=$alt["games_keyboard"]?>" border="0" /></a></td>
			<td><a href="javascript:open_games('<?=$game?>');"><img src="img/<?=$global_lang?>/btn_play.jpg" alt="<?=$alt["games_play"]?>" border="0" /></a></td>
			<? } else { ?>
			<td width="110"><a href="<?=str_replace("%%game%%", $game, $links["GAMES_GAME_MAIN"])?>"><img src="img/<?=$global_lang?>/btn_screen.jpg" alt="<?=$alt["games_screen"]?>" border="0" /></a></td>
            <td width="170"><a href="<?=str_replace("%%game%%", $game, $links["GAMES_GAME_TOUR"])?>"><img src="img/<?=$global_lang?>/btn_tour.jpg" alt="<?=$alt["games_tour"]?>" border="0" /></a></td>
			<td colspan="2"><a href="javascript:open_games('<?=$game?>');"><img src="img/<?=$global_lang?>/btn_play.jpg" alt="<?=$alt["games_play"]?>" border="0" /></a></td>
			<? } ?>
          </tr>
          <tr>
            <td colspan="4" height="13"></td>
          </tr>
          <tr>
            <td colspan="4" height="72" style=" background:url(img/<?=$global_lang?>/panel_games_prizes.gif) no-repeat"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="20">&nbsp;</td>
                <td class="game_jackpot"><?=$lang["games_jackpot"]?>: <?=$lang["currency_1"]?><?=getJackpot($game, $lang["currency_code"])?><?=$lang["currency_2"]?></td>
                <td class="game_jackpot"><?=$lang["games_thismonth"]?>: <?=$lang["currency_1"]?><?=getMonth($game, $lang["currency_code"])?><?=$lang["currency_2"]?></td>
              </tr>
            </table></td>
          </tr>
        </table>

	</div>

	<div class="game_main_right">
    	<div>
        	<img src="img/<?=$global_lang?>/label_basicinfo.jpg" alt="<?=$alt["games_basicinfo"]?>" /><br />

            <div class="game_basicinfo">
              <div class="check"><img src="img/<?=$global_lang?>/icon_check2.gif" alt="<?=$lang["games_".$game."_fact1"]?>" /></div>
              <div class="text<?=$lang["games_".$game."_facts"][0]?>"><?=$lang["games_".$game."_fact1"]?></div>
            </div>
                
            <div class="game_basicinfo">
              <div class="check"><img src="img/<?=$global_lang?>/icon_check2.gif" alt="<?=$lang["games_".$game."_fact2"]?>" /></div>
              <div class="text<?=$lang["games_".$game."_facts"][1]?>"><?=$lang["games_".$game."_fact2"]?></div>
            </div>
			
            <div class="game_basicinfo">
              <div class="check"><img src="img/<?=$global_lang?>/icon_check2.gif" alt="<?=$lang["games_".$game."_fact3"]?>" /></div>
              <div class="text<?=$lang["games_".$game."_facts"][2]?>"><?=$lang["games_".$game."_fact3"]?></div>
            </div>
                
            <div class="game_basicinfo">
              <div class="check"><img src="img/<?=$global_lang?>/icon_check2.gif" alt="<?=$lang["games_".$game."_fact4"]?>" /></div>
              <div class="text<?=$lang["games_".$game."_facts"][3]?>"><?=$lang["games_".$game."_fact4"]?></div>
            </div>
			
            <div class="game_basicinfo">
              <div class="check"><img src="img/<?=$global_lang?>/icon_check2.gif" alt="<?=$lang["games_".$game."_fact5"]?>" /></div>
              <div class="text<?=$lang["games_".$game."_facts"][4]?>"><?=$lang["games_".$game."_fact5"]?></div>
            </div>
                
            <div class="game_basicinfo">
              <div class="check"><img src="img/<?=$global_lang?>/icon_check2.gif" alt="<?=$lang["games_".$game."_fact6"]?>" /></div>
              <div class="text<?=$lang["games_".$game."_facts"][5]?>"><?=$lang["games_".$game."_fact6"]?></div>
            </div>
			
            <div class="game_basicinfo">
              <div class="check"><img src="img/<?=$global_lang?>/icon_check2.gif" alt="<?=$lang["games_".$game."_fact7"]?>" /></div>
              <div class="text<?=$lang["games_".$game."_facts"][6]?>"><?=$lang["games_".$game."_fact7"]?></div>
            </div>
                
            <div class="game_basicinfo">
              <div class="check"><img src="img/<?=$global_lang?>/icon_check2.gif" alt="<?=$lang["games_".$game."_fact8"]?>" /></div>
			  <div class="text<?=$lang["games_".$game."_facts"][7]?>"><?=$lang["games_".$game."_fact8"]?></div>
			</div>
        
    </div>
</div>

<img src="img/<?=$global_lang?>/px.gif" height="10" width="1" alt="px" /><br />

<? if ($game_type==1) { ?>
<a href="<?=$links["GAMES"]?>" class="blink"><?=$lang["games_back"]?></a>
<? } else if ($game_type==2) { ?>
<a href="<?=$links["GAMES_SLOTS"]?>" class="blink"><?=$lang["games_back_slots"]?></a>
<? } else if ($game_type==3) { ?>
<a href="<?=$links["GAMES"]?>" class="blink"><?=$lang["games_back"]?></a>
<? } else { ?>
<a href="<?=$links["GAMES_VIDEOBINGO"]?>" class="blink"><?=$lang["games_back_videobingo"]?></a>
<? } ?>
<img src="img/<?=$global_lang?>/px.gif" height="10" width="1" alt="px" />