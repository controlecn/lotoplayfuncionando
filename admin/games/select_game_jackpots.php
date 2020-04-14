<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Escolhe o jogo (Acumulado)", "../");

?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><a href="editJackpot.php?game=bingo75"><img src="../../img/pt_br/game_bingo75.jpg" border="0"></a><br><b>R$ <?=getJackpot("bingo75", "BRL")?></b></td>
    <td align="center"><a href="editJackpot.php?game=bonusbingo"><img src="../../img/pt_br/game_bonusbingo.jpg" border="0"></a><br><b>R$ <?=getJackpot("bonusbingo", "BRL")?></b></td>
    <td align="center"><a href="editJackpot.php?game=carnaval"><img src="../../img/pt_br/game_carnaval.jpg" border="0"></a><br><b>R$ <?=getJackpot("carnaval", "BRL")?></b></td>
    <td align="center"><a href="editJackpot.php?game=egyptdiamonds"><img src="../../img/pt_br/game_egyptdiamonds.jpg" border="0"></a><br><b>R$ <?=getJackpot("egyptdiamonds", "BRL")?></b></td>
  </tr>
  <tr>
    <td colspan="4" height="15"></td>
  </tr>
  <tr>
    <td align="center"><a href="editJackpot.php?game=fruitmania"><img src="../../img/pt_br/game_fruitmania.jpg" border="0"></a><br><b>R$ <?=getJackpot("fruitmania", "BRL")?></b></td>
    <td align="center"><a href="editJackpot.php?game=lucky25"><img src="../../img/pt_br/game_lucky25.jpg" border="0"></a><br><b>R$ <?=getJackpot("lucky25", "BRL")?></b></td>
    <td align="center"><a href="editJackpot.php?game=megabingo"><img src="../../img/pt_br/game_megabingo.jpg" border="0"></a><br><b>R$ <?=getJackpot("megabingo", "BRL")?></b></td>
    <td align="center"><a href="editJackpot.php?game=nineballs"><img src="../../img/pt_br/game_nineballs.jpg" border="0"></a><br><b>R$ <?=getJackpot("nineballs", "BRL")?></b></td>
  </tr>
  <tr>
    <td colspan="4" height="15"></td>
  </tr>
  <tr>
    <td align="center"><a href="editJackpot.php?game=showbingoball"><img src="../../img/pt_br/game_showbingoball.jpg" border="0"></a><br><b>R$ <?=getJackpot("showbingoball", "BRL")?></b></td>
    <td align="center"><a href="editJackpot.php?game=silverball"><img src="../../img/pt_br/game_silverball.jpg" border="0"></a><br><b>R$ <?=getJackpot("silverball", "BRL")?></b></td>
    <td align="center"><a href="editJackpot.php?game=superbingo"><img src="../../img/pt_br/game_superbingo.jpg" border="0"></a><br><b>R$ <?=getJackpot("superbingo", "BRL")?></b></td>
    <td align="center"><a href="editJackpot.php?game=superbingo2008"><img src="../../img/pt_br/game_superbingo2008.jpg" border="0"></a><br><b>R$ <?=getJackpot("superbingo2008", "BRL")?></b></td>
  </tr>
  <tr>
    <td colspan="4" height="15"></td>
  </tr>
  <tr>
    <td align="center"><a href="editJackpot.php?game=superbingo75"><img src="../../img/pt_br/game_superbingo75.jpg" border="0"></a><br><b>R$ <?=getJackpot("superbingo75", "BRL")?></b></td>
    <td align="center"><a href="editJackpot.php?game=treasuresoftheocean"><img src="../../img/pt_br/game_treasuresoftheocean.jpg" border="0"></a><br><b>R$ <?=getJackpot("treasuresoftheocean", "BRL")?></b></td>
    <td align="center"><a href="editJackpot.php?game=turbo90"><img src="../../img/pt_br/game_turbo90.jpg" border="0"></a><br><b>R$ <?=getJackpot("turbo90", "BRL")?></b></td>
    <td align="center"><a href="editJackpot.php?game=halloween"><img src="../../img/pt_br/game_halloween.jpg" border="0"></a><br><b>R$ <?=getJackpot("halloween", "BRL")?></b></td>
  </tr>
  <tr>
	<td align="center"><a href="editJackpot.php?game=cb2009"><img src="../../img/pt_br/game_cb2009.jpg" border="0"></a><br><b>R$ <?=getJackpot("cb2009", "BRL")?></b></td>
	<td align="center"><a href="editJackpot.php?game=circus"><img src="../../img/pt_br/game_circus.jpg" border="0"></a><br><b>R$ <?=getJackpot("circus", "BRL")?></b></td>
    <td align="center"><a href="editJackpot.php?game=bingomaster"><img src="../../img/pt_br/game_bingomaster.jpg" border="0"></a><br><b>R$ <?=getJackpot("bingomaster", "BRL")?></b></td>
	<td align="center"></td>
  </tr>
</table>

<? gui_bottom(); ?>