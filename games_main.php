	<div class="games_content">
		<div class="left">
        	<div>
				<? showContent("GAMES_MAIN"); ?>
				<center>
				<? if ($logged==0) { ?>
                <a href="<?=$links["REGISTRATION"]?>" class="blink"><?=$lang["games_register"]?></a>
				<? } else { ?>
				<a href="javascript:open_games();" class="blink"><?=$lang["games_opengames"]?></a>
				<? } ?>
				</center>
			</div>
        </div>
        <div class="right">
        	<div>
            <img src="img/<?=$global_lang?>/games_bingoroom.jpg" width="296" height="168" alt="<?=$alt["games_bingoroom"]?>" /><br /><br />
            <a href="javascript:open_games('bingo75');"><img src="img/<?=$global_lang?>/btn_enterbingo.jpg" border="0" alt="<?=$alt["games_bingoroom_enter"]?>" /></a>
            </div>
      </div>
	</div>
    <div style="margin-top: 17px;"></div>
    <div class="games_styles"><a href="<?=str_replace("%%game%%", "bingo75", $links["GAMES_GAME_MAIN"])?>"><img src="img/<?=$global_lang?>/label_bingoroom.gif" alt="<?=$alt["games_bingoroom_label"]?>" border="0" /></a><a href="<?=str_replace("%%game%%", "bingo75", $links["GAMES_GAME_MAIN"])?>"><img src="img/<?=$global_lang?>/gamestyle_bingoroom.jpg" border="0" alt="<?=$alt["games_bingoroom_image"]?>" /></a><br /><a href="<?=str_replace("%%game%%", "bingo75", $links["GAMES_GAME_MAIN"])?>" class="blink"><?=$lang["games_see_all"]?></a></div>
    <div class="games_styles"><a href="<?=$links["GAMES_VIDEOBINGO"]?>"><img src="img/<?=$global_lang?>/label_videobingo.gif" alt="<?=$alt["games_videobingo_label"]?>" border="0" /></a><a href="<?=$links["GAMES_VIDEOBINGO"]?>"><img src="img/<?=$global_lang?>/gamestyle_videobingo.jpg" border="0" alt="<?=$alt["games_videobingo_image"]?>" /></a><br /><a href="<?=$links["GAMES_VIDEOBINGO"]?>" class="blink"><?=$lang["games_see_all"]?></a></div>
    <div class="games_styles"><a href="<?=$links["GAMES_SLOTS"]?>"><img src="img/<?=$global_lang?>/label_slots.gif" alt="<?=$alt["games_slots_label"]?>" border="0" /></a><a href="<?=$links["GAMES_SLOTS"]?>"><img src="img/<?=$global_lang?>/gamestyle_slots.jpg" border="0" alt="<?=$alt["games_slots_image"]?>" /></a><br /><a href="<?=$links["GAMES_SLOTS"]?>" class="blink"><?=$lang["games_see_all"]?></a></div>
    <div class="games_styles"><a href="<?=str_replace("%%game%%", "videopoker", $links["GAMES_GAME_MAIN"])?>"><img src="img/<?=$global_lang?>/label_tablegames.gif" alt="<?=$alt["games_videopoker_label"]?>" border="0" /></a><a href="<?=str_replace("%%game%%", "videopoker", $links["GAMES_GAME_MAIN"])?>"><img src="img/<?=$global_lang?>/gamestyle_tablegames.jpg" border="0" alt="<?=$alt["games_videopoker_image"]?>" /></a><br /><a href="<?=str_replace("%%game%%", "videopoker", $links["GAMES_GAME_MAIN"])?>" class="blink"><?=$lang["games_see_all"]?></a></div>
    <div style="clear: both;"></div>