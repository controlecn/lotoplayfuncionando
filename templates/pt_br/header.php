<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="verify-v1" content="RoiLE6/pzZjwJYwu5GlNB2NZczw+yk8v44ikaNWh4Lk=" />
<title><?=$titles[$html_title]?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?=$lang["html_description"]?>" />
<meta name="keywords" content="<?=$lang["html_keywords"]?>" />
<meta name="DC.title" content="bingo lotoplay com video bingos on line acumulados diarios, indique seus amigos e ganhe creditos tradicional com rodadas especiais" />
<meta name="expires" content="never" />
<meta name="distribution" content="Global" />
<meta name="robots" content="index,follow,all" />
<meta name="Classification" content="general" />
<meta http-equiv="imagetoolbar" content="yes" />
<meta name="revisit-after" content="7 days" />
<link href="css/<?=$global_lang?>/styles.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" />
<script src="js/<?=$global_lang?>/scripts.js" type="text/javascript"></script>
</head>

<body>
<div id="scroll">
	<h1>Bingo vip lotoplay -  video bingo online com premiacao diaria e acumulados reais!</h1>
	<h2>Visite bingo lotoplay.com, jogue nos bingos online</h2>
	<h3>O video bingo online com grandes premios. A realidade de um verdadeiro salao de bingo on line</h3>
	<h4>bingo 75 bolas, showball, tesouros do mar, superbingo, bingo master, bingo 2008, mania das frutas, video poker, nineballs </h4>

	<dl>
		<dt>Bingos e jogos on line?</dt>
		<dd><a href="http://www.reidobingo-net.umbler.net/videobingo.html">voce joga se diverte e ganha de verdade, se diversao em jogos on line,  passa tempo!</a></dd>
	</dl>

	<dl>
		<dt>Bingo, games online?</dt>

		<dd><a href="http://www.reidobingo-net.umbler.net/bingo.html">Games Online e todos os jogos de Bingo online voce joga 24 horas bingo vip!</a></dd>
	</dl>
	
	<dl>
		<dt>video bingo online?</dt>
		<dd><a href="http://www.reidobingo-net.umbler.net/<?=$links["GAMES"]?>">Todos os jogos de bingo online: bingo 75 bolas, super Bingo 75, tesouros do mar, superbingo, bingomaster, bingo master, mania das frutas, video poker, bingo 2008 on line</a></dd>
	</dl>

	<ul>

		<li><a href="http://www.reidobingo-net.umbler.net/<?=$links["AFFILIATES"]?>">afiliados</a></li>
		<li><a href="http://www.reidobingo-net.umbler.net/<?=$links["ACCOUNT"]?>">conta</a></li>
		<li><a href="http://www.reidobingo-net.umbler.net/<?=$links["PROMOTIONS_FRIENDS"]?>">amigos nos jogos</a></li>
		<li><a href="http://www.reidobingo-net.umbler.net/<?=$links["SUPPORT_NEWS"]?>">noticias on line</a></li>
		<li><a href="http://www.reidobingo-net.umbler.net/<?=$links["PROMOTIONS"]?>">premios de bingos</a></li>
		<li><a href="http://www.reidobingo-net.umbler.net/<?=$links["GAMES"]?>">jogos on line</a>

		</li>
		<li><a href="http://www.reidobingo-net.umbler.net/<?=$links["SUPPORT"]?>">ajuda on line</a></li>
		<li><a href="http://www.reidobingo-net.umbler.net/<?=$links["REGISTRATION"]?>">cadastre-se</a></li>
		<li><a href="http://www.reidobingo-net.umbler.net/bingo.php">bingo</a></li>
	</ul>
</div>

<div class="website">
<!-- HEADER STARTS -->
<div class="header">
	<div id="logo">
		<div class="container_logo"><div class="logo"><a href="<?=$links["INDEX"]?>"><img src="img/<?=$global_lang?>/logo.gif" border="0" alt="Lotoplay" /></a><br /><div class="players_text"></div></div></div>
		<div class="container_support">
		<? if ($logged==1) { ?>
            <a href="<?=$config["support_url"]?>" target="_blank"><img src="img/<?=$global_lang?>/top_support.gif" border="0" alt="Atendimento online" /></a>
		<? } else { ?>
		<div class="menu_item_<? if ($openTab=="registration") { echo "open"; } else { echo "closed"; } ?>"><div class="mp"><a href="<?=$links["REGISTRATION"]?>"><?=$lang["menu_register"]?></a></div></div>
		<? } ?>


        </div>
		<div class="container_login">
        	<div class="loginpanel">
			
				<? if ($logged==1) { 
				
					$credits_bonus = getCredits($user_data["id"]);
					$credits = $credits_bonus[0];
					$bonus = $credits_bonus[1];
				?>
					<div style="margin-top: 5px;"></div>
                	<div class="loginform_txt">Usuario:&nbsp;&nbsp;</div>
                    <div class="loginform_field"><b><?=$user_data["username"]?></b></div>
                    <div class="loginform_txt">Creditos:&nbsp;&nbsp;</div>
                    <div class="loginform_field"><b><?=$lang["currency_1"]?><?=credits2money($credits)?><?=$lang["currency_2"]?></b></div>
					<div class="loginform_txt">Bonus:&nbsp;&nbsp;</div>
                    <div class="loginform_field"><b><?=$lang["currency_1"]?><?=credits2money($bonus)?><?=$lang["currency_2"]?></b></div>
					<div class="loginform_txt">Pontos:&nbsp;&nbsp;</div>
                    <div class="loginform_field"><b><?=GetRow("SELECT points FROM users WHERE id = '".$user_data["id"]."'")?></b></div>
                    <center><font class="wtext"><a href="javascript:open_games()" class="wlink">Jogar</a> - <a href="<?=$links["ACCOUNT_BUY"]?>" class="wlink">Comprar Créditos</a> - <a href="<?=$links["ACCOUNT_PAYOUT"]?>" class="wlink">Resgatar</a> - <a href="<?=$links["LOGOUT"]?>" class="wlink">Sair</a></font></center>
				
				<? } else { ?>

            	<center><a href="<?=$links["REGISTRATION"]?>" class="wlink">Cadastre-se aqui!</a></center>
                <div style="margin-top: 5px;"></div>
            	<form method="post" action="<?=$links["LOGIN_UPDATE"]?>">
                	<div class="loginform_txt">Usuario:&nbsp;&nbsp;</div>
                    <div class="loginform_field"><input name="username" type="text" class="txtbox_grad" value="" /></div>
                    <div class="loginform_txt">Senha:&nbsp;&nbsp;</div>
                    <div class="loginform_field"><input name="password" type="password" class="txtbox_grad" value="" /></div>
                    <div class="loginform_forgot"><div style="padding-top: 3px"><a href="<?=$links["FORGOT_PASSWORD"]?>" class="wlink">Esqueceu a senha?</a></div></div>
                    <div class="loginform_submit"><input type="image" src="img/<?=$global_lang?>/btn_entrar.gif" alt="Entrar" /></div>
                </form>
				
				<? } ?>
            </div>
        </div>
	</div>
	<div id="menu">
		<div class="menu_item_<? if ($openTab=="index") { echo "open"; } else { echo "closed"; } ?>"><div class="mp"><a href="<?=$links["INDEX"]?>">Ini­cio</a></div></div>
		<div class="menu_spacer">&nbsp;</div>
		<div class="menu_item_<? if ($openTab=="games") { echo "open"; } else { echo "closed"; } ?>"><div class="mp"><a href="<?=$links["GAMES"]?>"><?=$lang["menu_games"]?></a></div></div>
		<div class="menu_spacer">&nbsp;</div>
		<div class="menu_item_<? if ($openTab=="account") { echo "open"; } else { echo "closed"; } ?>"><div class="mp"><a href="<?=$links["ACCOUNT"]?>"><?=$lang["menu_account"]?></a></div></div>
		<div class="menu_spacer">&nbsp;</div>
		<? if ($logged==1) { ?>
		<div class="menu_item_<? if ($openTab=="registration") { echo "open"; } else { echo "closed"; } ?>"><div class="mp"><a href="#"><?=$lang["menu_register"]?></a></div></div>
		<? } else { ?>
		<div class="menu_item_<? if ($openTab=="registration") { echo "open"; } else { echo "closed"; } ?>"><div class="mp"><a href="<?=$links["REGISTRATION"]?>"><?=$lang["menu_register"]?></a></div></div>
		<? } ?>
		<div class="menu_spacer">&nbsp;</div>
		<div class="menu_item_<? if ($openTab=="affliates") { echo "open"; } else { echo "closed"; } ?>"><div class="mp"><a href="<?=$links["AFFILIATES"]?>"><?=$lang["menu_affliates"]?></a></div></div>
		<div class="menu_spacer">&nbsp;</div>
		<div class="menu_item_<? if ($openTab=="promotions") { echo "open"; } else { echo "closed"; } ?>"><div class="mp"><a href="<?=$links["PROMOTIONS"]?>"><?=$lang["menu_promotions"]?></a></div></div>
		<div class="menu_spacer">&nbsp;</div>
		<? if ($logged==1) { ?>
		<div class="menu_item_<? if ($openTab=="support") { echo "open"; } else { echo "closed"; } ?>"><div class="mp"><a href="<?=$links["SUPPORT"]?>"><?=$lang["menu_support"]?></a></div></div>
		<? } else { ?>
		<div class="menu_item_<? if ($openTab=="registration") { echo "open"; } else { echo "closed"; } ?>"><div class="mp"><a href="<?=$links["REGISTRATION"]?>"><?=$lang["menu_register"]?></a></div></div>
		<? } ?>

	</div>
</div>
<!-- HEADER ENDS -->

<!-- CONTENT STARTS -->
<div class="content">