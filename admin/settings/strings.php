<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Conteúdo de Texto", "../");

?>
<form method="post" action="strings.php">
Localizar: <input type="text" name="find"><input type="submit" name="submitbutton" value="Localizar!">
</form>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td bgcolor="#F7F7F7" height="23" class="tabletop">Nome</td>
	<td bgcolor="#F7F7F7" height="23" class="tabletop">Texto</td>
  </tr>
<?

$file = file("../../templates/pt_br/strings.php");

$a = 0;

for ($b=0; $b<count($file); $b++) {

	$line = $file[$b];
	
	if (substr($line, 1, 5)=="lang[") {

		if($a%2 == 0) {
			$color = "#FFFFFF";
			$a++;
		} else {
 			$color = "#F7F7F7";
 			$a++;
		}
		
		$nome = substr($line, 7, strpos($line, "\"]")-7);
		$texto = str_replace("\n", "", str_replace("\";", "", substr($line, strpos($line, "\"]")+6)));
		
		if ($_POST["find"]) {
		
			if (substr_count(strtolower($texto), strtolower($_POST["find"]))!=0) {
			?>
		  <tr>
			<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="strings_edit.php?nome=<?=$nome?>" class="link"><?=$nome?></a></td>
			<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=shortString($texto, 100)?></td>
		  </tr>
			<?
			}

		} else {

		?>
  <tr>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="strings_edit.php?nome=<?=$nome?>" class="link"><?=$nome?></a></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=shortString($texto, 100)?></td>
  </tr>
		<?
		
		}
		
	}
	
}

?>
</table><br><br>
<? gui_bottom(); ?>