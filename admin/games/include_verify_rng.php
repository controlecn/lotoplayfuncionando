<?

function verify_slot2($rng) {

	$return = ( !preg_match('/^[0-9]+$/', $rng) ? 0 : $rng );
	
	if ($return==$rng) {
		$is_good = 1;
	} else {
		$is_good = 0;
	}
	
	if ($is_good==0) {
		echo "<B>ERRO: </B>'$rng' nao e numero!";
	}

	return $is_good;
	
}

function verify_rng($game, $rng) {

	$is_good = 1;

	if (($game=="carnaval")||($game=="fruitmania")||($game=="treasuresoftheocean")) {

		$allowed_numbers = array("0","13","14","15","23","24","25","33","34","35","43","44","45","53","54","55","63","64","65","73","74","75","83","84","85","93","94","95");

		$rng_array = explode(",", $rng);

		for ($a=0; $a<count($rng_array); $a++) {

			$rng_nr = $rng_array[$a];

			if ($rng_nr=="") {

				$is_good = 0;
				echo "<B>ERRO: </B>',,' encontrado em $game<br>";

			} else {

				if (!in_array($rng_nr, $allowed_numbers)) {
					$is_good = 0;
					echo "<B>ERRO: </B>'$rng_nr' encontrado em $game<br>";
				}

			}

		}
	
	} else if ($game=="videopoker") {

		$allowed_numbers = array("0","1","2","3","4","5","6","7","8","9","10");

		$rng_array = explode(",", $rng);

		for ($a=0; $a<count($rng_array); $a++) {

			$rng_nr = $rng_array[$a];

			if ($rng_nr=="") {

				$is_good = 0;
				echo "<B>ERRO: </B>',,' encontrado em $game<br>";

			} else {

				if (!in_array($rng_nr, $allowed_numbers)) {
					$is_good = 0;
					echo "<B>ERRO: </B>'$rng_nr' encontrado em $game<br>";
				}

			}

		}

	} else { // Video Bingo

		switch ($game) {
			case "superbingo": $max_number = 3; break;
			case "lucky25": $max_number = 5; break;
			case "bingomaster": $max_number = 9; break;
			case "bonusbingo": $max_number = 10; break;
			case "egyptdiamonds": $max_number = 4; break;
			case "megabingo": $max_number = 10; break;
			case "showbingoball": $max_number = 12; break;
			case "superbingo2008": $max_number = 3; break;
			case "superbingo75": $max_number = 12; break;
			case "silverball": $max_number = 3; break;
			case "nineballs": $max_number = 3; break;
			case "turbo90": $max_number = 4; break;
		}

		$allowed_numbers = array("0");

		for ($a=0; $a<$max_number; $a++) {
			$b = $a+1;
			array_push($allowed_numbers, (string)$b);
		}

		$rng_array = explode(",", $rng);

		for ($a=0; $a<count($rng_array); $a++) {

			$rng_nr = $rng_array[$a];

			if ($rng_nr!="0") {
				$rng_nr2 = ltrim($rng_nr, '0');
			} else {
				$rng_nr2 = $rng_nr;
			}

			if ($rng_nr=="") {

				$is_good = 0;
				echo "<B>ERRO: </B>',,' encontrado em $game<br>";

			} else if ((strlen($rng_nr)!=1)&&(substr($rng_nr,0,1)=="0")) {

				$is_good = 0;
				echo "<B>ERRO: </B>'$rng_nr' encontrado em $game<br>";

			} else {

				if (!in_array($rng_nr, $allowed_numbers)) {
					$is_good = 0;
					echo "<B>ERRO: </B>'$rng_nr' encontrado em $game<br>";
				}

			}

		}

	}

	$chr = "\n";
	if (substr_count($rng, $chr)!=0) {
		echo "<B>ERRO: </B>NEWLINE encontrado em $game<br>";
		$is_good = 0;
	}

	$chr = "
";
	if (substr_count($rng, $chr)!=0) {
		echo "<B>ERRO: </B>NEWLINE encontrado em $game<br>";
		$is_good = 0;
	}

	$illegal = array("'","\\","{","[","]","}","?","_","=",")","(","&","%","$","#","\"","!","°","¨",".","/","*","-","+");

	for ($a=0; $a<count($illegal); $a++) {

		$chr = $illegal[$a];
		if (substr_count($rng, $chr)!=0) {
			echo "<B>ERRO: </B>'$chr' encontrado em $game<br>";
			$is_good = 0;
		}

	}

	return $is_good;
}

?>