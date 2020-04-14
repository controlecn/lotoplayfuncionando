<?

$links = array();

$links["TYPE"] = 2; // 1: php, 2: html
$links["INDEX"] = "index.html";
$links["GAMES"] = "jogos.html";
$links["bingos"] = "bingos.html";
$links["bingo"] = "bingo.html";
$links["videobingos"] = "video bingos.html";
$links["videobingo"] = "videobingo.html";
$links["GAMES_VIDEOBINGO"] = "videobingo.html";
$links["GAMES_SLOTS"] = "cacaniquel.html";
$links["GAMES_GAME_MAIN"] = "jogos_%%game%%_tela.html";
$links["GAMES_GAME_TOUR"] = "jogos_%%game%%_tour.html";
$links["GAMES_GAME_KEYBOARD"] = "jogos_%%game%%_teclado.html";
$links["ACCOUNT"] = "conta.html";
$links["ACCOUNT_BUY_SHOW"] = "conta_comprar_mostrar.html";
$links["ACCOUNT_BUY"] = "conta_comprar.html";
$links["ACCOUNT_PAYOUT"] = "conta_resgatar.html";
$links["ACCOUNT_TRANSFERS"] = "conta_extrato.html";
$links["ACCOUNT_MESSAGES"] = "conta_mensagens.html";
$links["ACCOUNT_MESSAGES_DELETE"] = "conta_mensagens_deletar.html";
$links["ACCOUNT_RESULTS"] = "conta_resultados.html";
$links["ACCOUNT_POINTS"] = "conta_pontos.html";
$links["ACCOUNT_FRIENDS"] = "conta_amigos.html";
$links["ACCOUNT_CHANGE"] = "conta_alterar.html";
$links["ACCOUNT_CHANGEPASSWORD"] = "conta_alterar_senha.html";
$links["ACCOUNT_CHANGEPASSWORD_UPD"] = "conta_alterar_senha_upd.html";
$links["ACCOUNT_CONFIRM_CHANGEPASSWORD"] = "conta_alterar_senha_confirmar.html";
$links["ACCOUNT_PAYOUT_REVERT"] = "conta_resgatar_reverter.html";
$links["LOGOUT"] = "sair.html";
$links["REGISTRATION"] = "cadastro.html";
$links["REGISTRATION_UPD"] = "cadastro_upd.html";
$links["REGISTRATION_COMPLETE"] = "cadastro_completo.html";
$links["AFFILIATES"] = "afiliados.html";
$links["AFFILIATES_REGISTER"] = "afiliados_cadastro.html";
$links["AFFILIATES_REGISTER_UPD"] = "afiliados_cadastro_upd.html";
$links["AFFILIATES_REGISTER_COMPLETE"] = "afiliados_cadastro_completo.html";
$links["AFFILIATES_LOGIN"] = "afiliados_login.html";
$links["AFFILIATES_SALES"] = "afiliados_vendas.html";
$links["AFFILIATES_CLIENTS"] = "afiliados_clientes.html";
$links["AFFILIATES_BANNERS"] = "afiliados_banners.html";
$links["AFFILIATES_BANNERS_SAVE"] = "afiliados_banners_salvar.html";
$links["AFFILIATES_CHANGE"] = "afiliados_alterar.html";
$links["LOGOUT_AFFILIATES"] = "sair_afiliados.html";
$links["PROMOTIONS"] = "promocoes.html";
$links["PROMOTIONS_FRIENDS"] = "promocoes_amigos.html";
$links["PROMOTIONS_SUPERROUNDS"] = "promocoes_superrodadas.html";
$links["PROMOTIONS_BONUS"] = "promocoes_bonus.html";
$links["PROMOTIONS_SURPRISE_BONUS"] = "promocoes_bonussurpresa.html";
$links["PROMOTIONS_VIP"] = "promocoes_vip.html";
$links["PROMOTIONS_FREEROUNDS"] = "promocoes_rodadasgratuidas.html";
$links["PROMOTIONS_MONTH"] = "promocoes_mes.html";
$links["SUPPORT"] = "suporte.html";
$links["SUPPORT_FAQ"] = "suporte_faq.html";
$links["SUPPORT_RULES"] = "suporte_regras.html";
$links["SUPPORT_NEWS"] = "suporte_noticias.html";
$links["SUPPORT_ABOUTUS"] = "suporte_quemsomos.html";
$links["SUPPORT_CONTACTUS"] = "suporte_faleconosco.html";
$links["SUPPORT_CONTACTUSUPD"] = "suporte_faleconosco_upd.html";
$links["SUPPORT_ADVICE"] = "suporte_dicas.html";
$links["SUPPORT_TESTIMONIALS"] = "suporte_testemunhas.html";
$links["FORGOT_PASSWORD"] = "esquecisenha.html";
$links["LOGIN_UPDATE"] = "login.html";
$links["LOGIN_UPDATE_AFFILIATE"] = "login_afiliados.html";

/** support_faq.php

conta_pontos.html?cmd=get&id=<?=$id?>
afiliados_ativar.html?code=$valid_code
esquecisenha.html?affliate=1
esquecisenha.html?cmd=update&affliate=1
esquecisenha.html?cmd=update
afiliados_banners_salvar.html?affliateId=$affliate_logged_user&id=$id
conta_resgatar.html?cmd=update
conta_amigos.html?cmd=send
conta_alterar.html?cmd=update
conta_comprar_mostrar.html?cmd=add
conta_comprar_mostrar.html?cmd=show&id=<?=$id?>
conta_comprar.html?cmd=cancel&id=<?=$id?>
conta_resgatar_reverter.html?id=<?=$row["id"]?>

**/
?>