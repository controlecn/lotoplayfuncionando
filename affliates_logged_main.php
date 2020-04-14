<?

$result = mysql_query("SELECT totalValue,affliateValue FROM transfers_affliates WHERE affliateId = '$affliate_logged_user'", $mysql_link);

$sales1 = 0;
$sales2 = 0;

if ($result) {

	while ($row = mysql_fetch_array($result)) {
		$sales1 = $sales1 + $row["totalValue"];
		$sales2 = $sales2 + $row["affliateValue"];
	}

	mysql_free_result($result);

}

$clients = GetRow("SELECT COUNT(id) FROM users WHERE affliateId = '$affliate_logged_user'");

?>
	
	
	<h1><?=$lang["affliates_main_title"]?></h1>
	
    <img src="img/<?=$global_lang?>/px.gif" height="10" width="1" alt="px" />
    
    <div class="my_account_main_table">
    	<div>
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><?=$lang["affliates_main_name"]?>:<br /><a href="<?=GetRow("SELECT url FROM users_affliates WHERE id = '".$affliate_logged_user."'");?>" class="blink_small" target="_blank"><?=GetRow("SELECT name FROM users_affliates WHERE id = '".$affliate_logged_user."'");?></a></td>
                <td><?=$lang["affliates_main_clients"]?>:<br /><b><?=$clients?></b></td>
                <td><?=$lang["affliates_main_sales"]?>:<br /><b><?=$lang["currency_1"]?><?=formatMoney($sales1)?><?=$lang["currency_2"]?></b></td>
				<td><?=$lang["affliates_main_comission"]?>:<br /><b><?=$lang["currency_1"]?><?=formatMoney($sales2)?><?=$lang["currency_2"]?></b></td>
				<td><a href="<?=$links["LOGOUT_AFFILIATES"]?>"><img src="img/<?=$global_lang?>/btn_logout.jpg" border="0" alt="<?=$alt["account_login_logout"]?>" /></a></td>
              </tr>
            </table>
		</div>
    </div>
    
    <img src="img/<?=$global_lang?>/px.gif" height="40" width="1" alt="px" />
    
    <div class="my_account_menu">
    	<div class="icon"><a href="<?=$links["AFFILIATES_SALES"]?>"><img src="img/<?=$global_lang?>/ico_sales.jpg" border="0" alt="<?=$lang["affliates_main_sales_title"]?>" /></a></div>
        <div class="content_area">
        	<div class="link"><a href="<?=$links["AFFILIATES_SALES"]?>"><?=$lang["affliates_main_sales_title"]?></a></div>
            <div class="description"><?=$lang["affliates_main_sales_description"]?></div>
        </div>
    </div>

    <div class="my_account_menu">
    	<div class="icon"><a href="<?=$links["AFFILIATES_CLIENTS"]?>"><img src="img/<?=$global_lang?>/ico_clients.jpg" border="0" alt="<?=$lang["affliates_main_clients_title"]?>" /></a></div>
        <div class="content_area">
        	<div class="link"><a href="<?=$links["AFFILIATES_CLIENTS"]?>"><?=$lang["affliates_main_clients_title"]?></a></div>
            <div class="description"><?=$lang["affliates_main_clients_description"]?></div>
        </div>
    </div>
	
    <div class="my_account_menu">
    	<div class="icon"><a href="<?=$links["AFFILIATES_BANNERS"]?>"><img src="img/<?=$global_lang?>/ico_banners.jpg" border="0" alt="<?=$lang["affliates_main_banners_title"]?>" /></a></div>
        <div class="content_area">
        	<div class="link"><a href="<?=$links["AFFILIATES_BANNERS"]?>"><?=$lang["affliates_main_banners_title"]?></a></div>
            <div class="description"><?=$lang["affliates_main_banners_description"]?></div>
        </div>
    </div>

    <div class="my_account_menu">
    	<div class="icon"><a href="<?=$links["AFFILIATES_CHANGE"]?>"><img src="img/<?=$global_lang?>/ico_changereg.jpg" border="0" alt="<?=$lang["affliates_main_change_title"]?>" /></a></div>
        <div class="content_area">
        	<div class="link"><a href="<?=$links["AFFILIATES_CHANGE"]?>"><?=$lang["affliates_main_change_title"]?></a></div>
            <div class="description"><?=$lang["affliates_main_change_description"]?></div>
        </div>
    </div>
	
    <div class="my_account_menu">
    	<div class="icon"><a href="<?=$config["support_url"]?>" target="_blank"><img src="img/<?=$global_lang?>/ico_support.jpg" border="0" alt="<?=$lang["affliates_main_support_title"]?>" /></a></div>
        <div class="content_area">
        	<div class="link"><a href="<?=$config["support_url"]?>" target="_blank"><?=$lang["affliates_main_support_title"]?></a></div>
            <div class="description"><?=$lang["affliates_main_support_description"]?></div>
        </div>
    </div>
    
    <div style="clear: both;"></div>