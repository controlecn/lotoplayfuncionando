<?

// 1. pt_br
// 2. pt_pt
// 3. es_mx
// 4. es_sp

$uri = $_SERVER["REQUEST_URI"];
ereg("/([a-z_a-z]{5})", $uri, $regs);
$newlang = $regs[1];

if ($newlang) {

	if (($newlang!="pt_br")&&($newlang!="pt_pt")&&($newlang!="sp_mx")&&($newlang!="sp_sp")) {
		$global_lang = "pt_br";
	} else {
		// Language set by cookie
		$global_lang = $newlang;
	}

} else {

	// Language Detection

	$langs = array();

	if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
		preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $lang_parse);

		if (count($lang_parse[1])) {
			$langs = array_combine($lang_parse[1], $lang_parse[4]);
			
			foreach ($langs as $lang => $val) {
				if ($val === '') $langs[$lang] = 1;
			}

			arsort($langs, SORT_NUMERIC);
		}
	}

	if ($langs[0]=="pt-br") {
	
		// Brazil
		$global_lang = "pt_br";
		
	} else {

		$detect = 0;
	
		switch ($langs[0]) {
			case "es-mx": $global_lang = "sp_mx"; break;
			case "es-sp": $global_lang = "sp_sp"; break;
			case "es": $detect = 1; break;
			case "pt": $detect = 1; break;
			default: $detect = 1; break;
		}
		
		if ($detect==1) {

			include("include_ip2c.php");
			$ip2c=new ip2country();
			$ipcountry = $ip2c->get_country_code();
			
			if ($langs[0]=="es") {
			
				switch ($ipcountry) {
					case "MX": $global_lang = "sp_mx"; break;
					case "ES": $global_lang = "sp_sp"; break;
					default: $global_lang = "sp_sp"; break;
				}
			
			} else if ($langs[0]=="pt") {
			
				switch ($ipcountry) {
					case "BR": $global_lang = "pt_br"; break;
					case "PT": $global_lang = "pt_pt"; break;
					default: $global_lang = "pt_br"; break;
				}
			
			} else {
			
				switch ($ipcountry) {
					case "MX": $global_lang = "sp_mx"; break;
					case "ES": $global_lang = "sp_sp"; break;
					case "BR": $global_lang = "pt_br"; break;
					case "PT": $global_lang = "pt_pt"; break;
					default: $global_lang = "pt_br"; break;
				}
			
			}
			
		}
	
	}

}

?>