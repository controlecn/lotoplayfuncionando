<?

include('../../include_functions.php');
checkAccess(2);
include('../../include_guifunctions.php');
gui_header("Rodadas Especiais - Adicionar", "../../");

?>
<form name="updateForm" id="updateForm" method="POST" action="special_rounds_add_upd.php">
<font class="tabletop">

Data/Hora:<br>
<input class="tabletext" type="text" name="round_time" value="AAAA-MM-DD HH:MM:SS" style="width: 360px">
<br><br>

Tipo:<br>
<select name="round_type">
	<option value="1">Rodada Super Prêmiada - Prêmio Fixo em créditos</option>
	<option value="2">Rodada Super Prêmiada - Prêmio Fixo em objeto</option>
</select>
<br><br>

Prêmio (Objeto):<br>
<input class="tabletext" type="text" name="round_object" style="width: 160px" maxlength="14"> - Deixa vazio se for prêmio fixo em crèditos
<br><br>

Prêmio:<br>
<input class="tabletext" type="text" name="round_prize" style="width: 60px" value="0"> créditos
<br><br>

VIP:<br>
<select name="round_vip">
	<option value="0">Ganhador NÃO pode ser VIP</option>
	<option value="1">Ganhador pode ser VIP</option>
	<option value="2">Ganhador deve ser VIP</option>
</select>
<br><br>

Ganhadores:<br>
<select name="round_winners">
	<option value="0">Apenas 1 ganhador</option>
	<option value="1">Pode ter muitos ganhadores do mesmo prêmio</option>
</select>
<br><br>

<input type="submit" value="Adicionar" name="submitbutton">

</font>
</form>
<? gui_bottom(); ?>