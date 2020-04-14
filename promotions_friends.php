	<div class="contact_left">
      <div class="contact_panel">
            <div>
				<? showContent("PROMO_FRIENDS"); ?>
				
				<br /><center>
				<? if ($logged==1) { ?>
					<a href="<?=$links["ACCOUNT_FRIENDS"]?>" class="blink"><?=$lang["promotions_friends_access"]?></a>
				<? } else { ?>
					<a href="<?=$links["REGISTRATION"]?>" class="blink"><?=$lang["promotions_friends_register"]?></a>
				<? } ?>
				
				</center>
            </div>
      </div>
	</div>
    <div class="contact_right">
    	<img src="img/<?=$global_lang?>/label_howtojoin.gif" alt="<?=$lang["promotions_friends_how"]?>" /><br />
        
        <div class="contact_why">
      	  <div class="check"><img src="img/<?=$global_lang?>/icon_check.gif" alt="<?=$lang["promotions_friends_how"]?>" /></div>
          <div class="text2"><?=$lang["promotions_friends_step1"]?></div>
        </div>
        
        <div class="contact_why">
      	  <div class="check"><img src="img/<?=$global_lang?>/icon_check.gif" alt="<?=$lang["promotions_friends_how"]?>" /></div>
          <div class="text2"><?=$lang["promotions_friends_step2"]?></div>
        </div>

        <div class="contact_why">
      	  <div class="check"><img src="img/<?=$global_lang?>/icon_check.gif" alt="<?=$lang["promotions_friends_how"]?>" /></div>
          <div class="text1"><?=$lang["promotions_friends_step3"]?></div>
        </div>
        
        <div class="contact_why">
      	  <div class="check"><img src="img/<?=$global_lang?>/icon_check.gif" alt="<?=$lang["promotions_friends_how"]?>" /></div>
          <div class="text1"><?=$lang["promotions_friends_step4"]?></div>
        </div>
        
        <div class="contact_why">
      	  <div class="check"><img src="img/<?=$global_lang?>/icon_check.gif" alt="<?=$lang["promotions_friends_how"]?>" /></div>
          <div class="text1"><?=$lang["promotions_friends_step5"]?></div>
        </div>
        
        <div class="contact_why">
      	  <div class="check"><img src="img/<?=$global_lang?>/icon_check.gif" alt="<?=$lang["promotions_friends_how"]?>" /></div>
          <div class="text2"><?=$lang["promotions_friends_step6"]?></div>
        </div>
        
        <div class="contact_why">
      	  <div class="check"><img src="img/<?=$global_lang?>/icon_check.gif" alt="<?=$lang["promotions_friends_how"]?>" /></div>
          <div class="text2"><?=$lang["promotions_friends_step7"]?></div>
        </div>
       
    </div>
    <div style="clear: both; height: 10px"></div>
	
<a href="<?=$links["PROMOTIONS"]?>" class="blink"><?=$lang["promotions_back"]?></a>