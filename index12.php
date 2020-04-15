<?

$html_title = "index";
$openTab = "index";

include("include_header.php");

?>
	<div class="main_content">
		<div class="left">
        	<div>
				<? showContent("INDEX") ?>

				<p>
				<? if ($logged==0) { ?>
                <a href="<?=$links["REGISTRATION"]?>" class="blink"><?=$lang["index_register"]?></a>
				<? } else { ?>
				<a href="javascript:open_games();" class="blink"><?=$lang["index_opengames"]?></a>
				<? } ?>
				</p>
			</div>
        </div>
        <div class="right">
        	<div>
          	  <a href="<?=$config["support_url"]?>"><img src="img/<?=$global_lang?>/principal_support.jpg" border="0" alt="<?=$alt["index_support"]?>" /></a>
            </div>
      </div>
	</div>
	
    <div style="margin-top: 10px;"></div>

    <img src="img/<?=$global_lang?>/px.gif" width="1" height="10" alt="<?=$alt["px"]?>" />
	
    <div class="main_how_works">
    	<h3><?=$lang["index_how_works"]?></h3>
        
        <img src="img/<?=$global_lang?>/px.gif" width="1" height="10" alt="<?=$alt["px"]?>" />
        
        <div class="step" style="background-color: #F7F7F7;">
			<div class="image"><div><img src="img/<?=$global_lang?>/principal_step_1.gif" alt="<?=$alt["index_step1"]?>" /></div></div>
			<? if ($logged==0) { ?>
            <div class="text"><div><a href="<?=$links["REGISTRATION"]?>" class="blink"><?=$lang["index_how_works_step1"]?></a></div></div>
			<? } else { ?>
			<div class="text"><div class="btext"><?=$lang["index_how_works_step1"]?></div></div>
			<? } ?>
        </div>
        
        <div class="step" style="background-color: #F7F7F7;">
			<div class="image"><div><img src="img/<?=$global_lang?>/principal_step_2.gif" alt="<?=$alt["index_step2"]?>" /></div></div>
            <div class="text"><div><a href="<?=$links["ACCOUNT_BUY"]?>" class="blink"><?=$lang["index_how_works_step2"]?></a></div></div>
        </div>
        
        <div class="step" style="background-color: #F7F7F7;">
			<div class="image"><div><img src="img/<?=$global_lang?>/principal_step_3.gif" alt="<?=$alt["index_step3"]?>" /></div></div>
            <div class="text"><div><a href="javascript:open_games();" class="blink"><?=$lang["index_how_works_step3"]?></a></div></div>
        </div>
    </div>
	
    <div style="height: 17px; clear: both;"></div>
    
	<div class="main_games">
    	<h3><?=$lang["index_games"]?></h3>
        
        <img src="img/<?=$global_lang?>/px.gif" width="1" height="10" alt="<?=$alt["px"]?>" />

		<?
		
		function showGame($game, $bg) {
		
			global $lang, $links, $global_lang, $alt;
		
			if ($game=="bingo75") {
				$name = "Bingo Tradicional";
			} else {
				$name = $lang["games_".$game."_title"];
			}
		
			?>
        <div class="gamesmall" style="background-color:<?=$bg?>;">
        	<div class="image"><div><a href="<?=str_replace("%%game%%", $game, $links["GAMES_GAME_MAIN"])?>" onmouseover="previewImage(event, '<?=$game?>');" onmouseout="closeImage();"><img src="img/<?=$global_lang?>/game_<?=$game?>_p.jpg" border="0" alt="<?=$alt["games_".$game."_image"]?>" /></a></div></div>
            <div class="text"><div><a href="<?=str_replace("%%game%%", $game, $links["GAMES_GAME_MAIN"])?>" class="blink_small"><?=$name?></a></div></div>
            <div class="jackpot_small"><div><?=$lang["currency_1"]?><?=getJackpot($game, $lang["currency_code"])?><?=$lang["currency_2"]?></div></div>
        </div>
			<?
		
		}
		
		showGame("superbingo", "#F7F7F7");
		showGame("silverball", "#F7F7F7");
		showGame("bingo75", "#F7F7F7");
		
		showGame("nineballs", "#FFFFFF");
		showGame("showbingoball", "#FFFFFF");
		showGame("turbo90", "#FFFFFF");
		
		showGame("bingomaster", "#F7F7F7");
		showGame("superbingo75", "#F7F7F7");
		showGame("megabingo", "#F7F7F7");
		
		showGame("lucky25", "#FFFFFF");
		showGame("bonusbingo", "#FFFFFF");
		showGame("superbingo2008", "#FFFFFF");
		
		showGame("treasuresoftheocean", "#F7F7F7");
		showGame("halloween", "#F7F7F7");
		showGame("carnaval", "#F7F7F7");
		
		showGame("circus", "#FFFFFF");
		showGame("fruitmania", "#FFFFFF");
		showGame("videopoker", "#FFFFFF");
	
		
		?>
        
    </div>
    
    <div style="height: 20px; clear: both;"></div>
    
    <div class="main_testimonal">
    	<div>"<?=GetRow("SELECT testimonial FROM testimonials WHERE `index` = 1")?>" - <b><?=GetRow("SELECT username FROM testimonials WHERE `index` = 1")?></b></div>
    </div>
    
    <div class="main_affliates">
    	<a href="<?=$links["AFFILIATES"]?>"><img src="img/<?=$global_lang?>/principal_affliates.jpg" border="0" alt="<?=$alt["index_affliates"]?>" /></a>
    </div>
	
    <div id="image_container" style="height: 119px; width: 193px; display: none; position: absolute;">
    	<img src="img/<?=$global_lang?>/game_loading.gif" id="game_image" alt="Jogo" />
    </div>
	
	<div style="clear: both;"></div>
	
	<img src="img/<?=$global_lang?>/px.gif" width="1" height="10" alt="<?=$alt["px"]?>" />
	
<? include("include_bottom.php"); ?>