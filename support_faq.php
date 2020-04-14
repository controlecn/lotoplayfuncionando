<h1><?=$lang["support_faq"]?></h1>
<br />
<?

$category = $_REQUEST["category"];
$question = $_REQUEST["question"];

if (($category)&&(!$question)) {

	echo "<div id=\"container\">";

	// List all the questions in the category

	$sql = "SELECT * FROM faq_questions where categoryId = $category";
	$result = mysql_query($sql, $mysql_link);
	
	echo "<ul id=\"questions\">";

	if ($result) {
	
		$i = 1;

		while ($row = mysql_fetch_array($result)) {

			$id = $row["id"];
			$question = $row["question"];
			$answer = $row["answer"];

			echo "<li id=\"q$i\"><a href=\"#a$i\" class=\"blink\">$question</a></li>";
			
			$i++;

		}

	mysql_free_result($result);

	}
	
	echo "</ul>";

	echo "<br />";

	/** Print out the questions **/

	$sql = "SELECT * FROM faq_questions where categoryId = $category";
	$result = mysql_query($sql, $mysql_link);

	if ($result) {
	
		$i = 1;

		while ($row = mysql_fetch_array($result)) {

			$id = $row["id"];
			$question = $row["question"];
			$answer = $row["answer"];
			
			?>
			<div id="a<?=$i?>" class="faq-a">
				<h2><a href="#"><img src="img/<?=$global_lang?>/faq-return-to-top.gif" alt="<?=$alt["support_backtotop"]?>" class="return-top" border="0" /></a><?=$question?></h2>
				<p><?=$answer?></p>
			</div>
			<br /><br />
			<?
			
			$i++;

			// echo "<a name=\"q$id\"></a><h3>$question</h3><p>$answer</p><br />";

		}

	mysql_free_result($result);

	}
	
	echo "</div>";

	echo "<a href=\"".$links["SUPPORT_FAQ"]."\" class=\"blink\">".$lang["support_faq_back"]."</a>";

} else {

	// OverView

	$sql = "SELECT * FROM faq_categories";
	$result = mysql_query($sql, $mysql_link);

	if ($result) {

		while ($row = mysql_fetch_array($result)) {

			$id = $row["id"];
			$name = $row["name"];
			$description = $row["description"];

			echo "<a href=\"".$links["SUPPORT_FAQ"].$qr."category=$id\" class=\"blink\">$name</a><p>$description</p><br />";

		}

	mysql_free_result($result);

	}

}
?>
<br /><a href="<?=$links["SUPPORT"]?>" class="blink"><?=$lang["support_back"]?></a>