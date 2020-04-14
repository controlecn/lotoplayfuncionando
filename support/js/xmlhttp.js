function initxmlhttp() {

	var xmlhttp;
	
	if ( typeof XMLHttpRequest!='undefined' ) {

		// Mozilla
		try {
			xmlhttp = new XMLHttpRequest();
		} catch (e) {
			xmlhttp = false;
		}
		
	} else {
		// IE
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	if (!xmlhttp) {
		alert("Sorry...");
	}

	return xmlhttp ;
}