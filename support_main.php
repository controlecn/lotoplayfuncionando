	<div class="support_left">
    	<div class="support_panel">
        	<div>
			<? showContent("SUPPORT_MAIN"); ?>
            <br />
            <center><a href="<?=$config["support_url"]?>" target="_blank"><img src="img/<?=$global_lang?>/btn_support.jpg" border="0" alt="<?=$alt["support_chatonline"]?>" /></a></center>
            </div>
		</div>
        
        <div style="margin-top: 17px"></div>
        
        <div class="links">
            <div>
            	<a href="<?=$links["SUPPORT_FAQ"]?>" class="blink"><?=$lang["support_faq"]?></a><br /><br />
                <a href="<?=$links["SUPPORT_RULES"]?>" class="blink"><?=$lang["support_rules"]?></a><br /><br />
                <a href="<?=$links["SUPPORT_NEWS"]?>" class="blink"><?=$lang["support_news"]?></a><br /><br />
                <a href="<?=$links["SUPPORT_ABOUTUS"]?>" class="blink"><?=$lang["support_aboutus"]?></a><br /><br />
                <a href="<?=$links["SUPPORT_CONTACTUS"]?>" class="blink"><?=$lang["support_contactus"]?></a>
            </div>
        </div>
        
        <div class="advice">
        <a href="<?=$links["SUPPORT_ADVICE"]?>"><img src="img/<?=$global_lang?>/support_advice.jpg" border="0" alt="<?=$alt["support_advice"]?>" /></a>
        </div>
        
    </div>
    
    <div class="support_right">
    	<div>
        	<img src="img/<?=$global_lang?>/label_testimonials.gif" alt="<?=$alt["support_testimonials"]?>" /><br />

			<?
			$result = mysql_query("SELECT username,testimonial FROM `testimonials` ORDER BY rand() LIMIT 4", $mysql_link);

			if ($result) {

				while ($row = mysql_fetch_array($result)) {
				
					$username = $row["username"];
					$testimonial = $row["testimonial"];
					

				?>
				<p>"<?=$testimonial?>"</p>
				<div class="green_text"><?=$username?></div>
				<?

				}

				mysql_free_result($result);

			}
			
			?>
            <br />
            <center><a href="<?=$links["SUPPORT_TESTIMONIALS"]?>" class="blink"><?=$lang["support_more_testimonials"]?></a></center>
        </div>
    </div>

	<div style="clear: both;"></div>