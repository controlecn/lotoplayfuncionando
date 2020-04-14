	<h1><?=$lang["account_main_title"]?></h1>
    
    <img src="img/<?=$global_lang?>/px.gif" height="10" width="1" alt="px" />
    
    <div class="my_account_main_table">
    	<div>
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><?=$lang["account_main_username"]?>:<br /><b><?=$user_data["username"]?></b></td>
                <td><?=$lang["account_main_credits"]?>:<br /><b><?=$lang["currency_1"]?><?=credits2money($credits)?><?=$lang["currency_2"]?> (<?=$credits?> <?=$lang["account_main_credits"]?>)</b></td>
                <td><?=$lang["account_main_bonus"]?>:<br /><b><?=$lang["currency_1"]?><?=credits2money($bonus)?><?=$lang["currency_2"]?> (<?=$bonus?> <?=$lang["account_main_credits"]?>)</b></td>
                <td><?=$lang["account_main_points"]?>:<br /><b><?=GetRow("SELECT points FROM users WHERE id = '".$user_data["id"]."'")?></b></td>
                <td><?=$lang["account_main_friends"]?>:<br /><b><?=GetRow("SELECT COUNT(id) FROM users_friends WHERE userId = '".$user_data["id"]."'");?></b></td>
				<td><a href="<?=$links["LOGOUT"]?>"><img src="img/<?=$global_lang?>/btn_logout.jpg" border="0" alt="<?=$alt["account_login_logout"]?>" /></a></td>
              </tr>
            </table>
		</div>
    </div>
    
    <img src="img/<?=$global_lang?>/px.gif" height="40" width="1" alt="px" /><br />
    
    <div class="my_account_menu">
    	<div class="icon"><a href="<?=$links["ACCOUNT_BUY"]?>"><img src="img/<?=$global_lang?>/ico_buycredits.jpg" border="0" alt="<?=$lang["account_main_buy_title"]?>" /></a></div>
        <div class="content_area">
        	<div class="link"><a href="<?=$links["ACCOUNT_BUY"]?>"><?=$lang["account_main_buy_title"]?></a></div>
            <div class="description"><?=$lang["account_main_buy_description"]?></div>
        </div>
    </div>
    
    <div class="my_account_menu">
    	<div class="icon"><a href="<?=$links["ACCOUNT_PAYOUT"]?>"><img src="img/<?=$global_lang?>/ico_payout.jpg" border="0" alt="<?=$lang["account_main_payout_title"]?>" /></a></div>
        <div class="content_area">
        	<div class="link"><a href="<?=$links["ACCOUNT_PAYOUT"]?>"><?=$lang["account_main_payout_title"]?></a></div>
            <div class="description"><?=$lang["account_main_payout_description"]?></div>
        </div>
    </div>
	
    <div class="my_account_menu">
    	<div class="icon"><a href="<?=$links["ACCOUNT_MESSAGES"]?>"><img src="img/<?=$global_lang?>/ico_messages.jpg" border="0" alt="<?=$lang["account_main_messages_title"]?>" /></a></div>
        <div class="content_area">
        	<div class="link"><a href="<?=$links["ACCOUNT_MESSAGES"]?>"><?=$lang["account_main_messages_title"]?></a></div>
            <div class="description"><?=$lang["account_main_messages_description"]?></div>
        </div>
    </div>
    
    <div class="my_account_menu">
    	<div class="icon"><a href="<?=$links["ACCOUNT_TRANSFERS"]?>"><img src="img/<?=$global_lang?>/ico_extract.jpg" border="0" alt="<?=$lang["account_main_transfers_title"]?>" /></a></div>
        <div class="content_area">
        	<div class="link"><a href="<?=$links["ACCOUNT_TRANSFERS"]?>"><?=$lang["account_main_transfers_title"]?></a></div>
            <div class="description"><?=$lang["account_main_transfers_description"]?></div>
        </div>
    </div>
    
    <div class="my_account_menu">
    	<div class="icon"><a href="<?=$links["ACCOUNT_RESULTS"]?>"><img src="img/<?=$global_lang?>/ico_results.jpg" border="0" alt="<?=$lang["account_main_results_title"]?>" /></a></div>
        <div class="content_area">
        	<div class="link"><a href="<?=$links["ACCOUNT_RESULTS"]?>"><?=$lang["account_main_results_title"]?></a></div>
            <div class="description"><?=$lang["account_main_results_description"]?></div>
        </div>
    </div>
	
    <div class="my_account_menu">
    	<div class="icon"><a href="<?=$links["ACCOUNT_POINTS"]?>"><img src="img/<?=$global_lang?>/ico_points.jpg" border="0" alt="<?=$lang["account_main_points_title"]?>" /></a></div>
        <div class="content_area">
        	<div class="link"><a href="<?=$links["ACCOUNT_POINTS"]?>"><?=$lang["account_main_points_title"]?></a></div>
            <div class="description"><?=$lang["account_main_points_description"]?></div>
        </div>
    </div>
    
    <div class="my_account_menu">
    	<div class="icon"><a href="<?=$links["ACCOUNT_FRIENDS"]?>"><img src="img/<?=$global_lang?>/ico_friends.jpg" border="0" alt="<?=$lang["account_main_friends_title"]?>" /></a></div>
        <div class="content_area">
        	<div class="link"><a href="<?=$links["ACCOUNT_FRIENDS"]?>"><?=$lang["account_main_friends_title"]?></a></div>
            <div class="description"><?=$lang["account_main_friends_description"]?></div>
        </div>
    </div>
    
    <div class="my_account_menu">
    	<div class="icon"><a href="<?=$links["ACCOUNT_CHANGE"]?>"><img src="img/<?=$global_lang?>/ico_changereg.jpg" border="0" alt="<?=$lang["account_main_change_title"]?>" /></a></div>
        <div class="content_area">
        	<div class="link"><a href="<?=$links["ACCOUNT_CHANGE"]?>"><?=$lang["account_main_change_title"]?></a></div>
            <div class="description"><?=$lang["account_main_change_description"]?></div>
        </div>
    </div>
    
    <div class="my_account_menu">
    	<div class="icon"><a href="<?=$config["support_url"]?>" target="_blank"><img src="img/<?=$global_lang?>/ico_support.jpg" border="0" alt="<?=$lang["account_main_support_title"]?>" /></a></div>
        <div class="content_area">
        	<div class="link"><a href="<?=$config["support_url"]?>" target="_blank"><?=$lang["account_main_support_title"]?></a></div>
            <div class="description"><?=$lang["account_main_support_description"]?></div>
        </div>
    </div>
    
    <div style="clear: both;"></div>