<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Estatísticas de amigao", "../");

$friendstotal = GetRow("SELECT COUNT(id) FROM users_friends");
$complete = GetRow("SELECT COUNT(id) FROM users_friends WHERE percentage = 100");
$sentemail = GetRow("SELECT COUNT(id) FROM users_friends WHERE percentage = 0");
$registered = GetRow("SELECT COUNT(id) FROM users_friends WHERE percentage = 25");
$boughtonce = GetRow("SELECT COUNT(id) FROM users_friends WHERE percentage = 50");
$boughttwice = GetRow("SELECT COUNT(id) FROM users_friends WHERE percentage = 75");

?>
<font class="tabletop"><?=$lang_friendsstatistics_friendstotal?>:</font><br>
<font class="tabletext"><?=$friendstotal?></font><br><br>

<font class="tabletop"><?=$lang_friendsstatistics_complete?>:</font><br>
<font class="tabletext"><?=$complete?></font><br><br>

<font class="tabletop"><?=$lang_friendsstatistics_sentemail?>:</font><br>
<font class="tabletext"><?=$sentemail?></font><br><br>

<font class="tabletop"><?=$lang_friendsstatistics_registered?>:</font><br>
<font class="tabletext"><?=$registered?></font><br><br>

<font class="tabletop"><?=$lang_friendsstatistics_boughtonce?>:</font><br>
<font class="tabletext"><?=$boughtonce?></font><br><br>

<font class="tabletop"><?=$lang_friendsstatistics_boughttwice?>:</font><br>
<font class="tabletext"><?=$boughttwice?></font>

<? gui_bottom(); ?>