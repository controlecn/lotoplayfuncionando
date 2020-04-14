var t=setTimeout("reloadpage();",15000);

isEditing = false;
userEditing = "";
thermoEditing = 2;

function updateRNG() {
	
	var xhr; 
	try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }

	catch (e) 
    {
        try {   xhr = new ActiveXObject('Microsoft.XMLHTTP');    }
        catch (e2) 
        {
          try {  xhr = new XMLHttpRequest();     }
          catch (e3) {  xhr = false;   }
        }
     }
	 
    xhr.onreadystatechange  = function()
    { 
         if(xhr.readyState  == 4)
         {
              if (xhr.status  == 200) {
			  
				if (xhr.responseText=="OK") {
					alert("Mudanca com successo");
					closeRNG();
					reloadpage();
				} else {
					alert("Erro!");
					isEditing = false;
					reloadpage();
				}
					
              }
         }
    }; 
	 
   xhr.open("GET", "setRNG.php?username="+userEditing+"&thermo="+thermoEditing,  true); 
   xhr.send(null); 

}

function editRNG(oEvent, username_xml, userid, thermo, username) {

	if (isEditing==false) {

		clickY = oEvent.screenY;
		clickY = clickY - 215;
						
		rngDiv = document.getElementById("rng_div");
		rngDiv.style.top =  clickY.toString() + "px";
		rngDiv.style.left = "160px";
		rngDiv.style.visibility = "visible";
						
		document.getElementById("username_font").innerHTML = username;
		
		document.getElementById("arrow1_up").style.visibility = "hidden";
		document.getElementById("arrow1_down").style.visibility = "hidden";
		document.getElementById("arrow2_up").style.visibility = "hidden";
		document.getElementById("arrow2_down").style.visibility = "hidden";
		document.getElementById("arrow3_up").style.visibility = "hidden";
		document.getElementById("arrow3_down").style.visibility = "hidden";
		
		arrow_down = document.getElementById("arrow"+thermo+"_up");
		arrow_up = document.getElementById("arrow"+thermo+"_down");
		
		arrow_down.style.visibility = "visible";
		arrow_up.style.visibility = "visible";
		
		isEditing = true;
		userEditing = username;
		thermoEditing = thermo;
		
	}

}

function setArrow(newArrow) {

	document.getElementById("arrow1_up").style.visibility = "hidden";
	document.getElementById("arrow1_down").style.visibility = "hidden";
	document.getElementById("arrow2_up").style.visibility = "hidden";
	document.getElementById("arrow2_down").style.visibility = "hidden";
	document.getElementById("arrow3_up").style.visibility = "hidden";
	document.getElementById("arrow3_down").style.visibility = "hidden";
	
	arrow_down = document.getElementById("arrow"+newArrow+"_up");
	arrow_up = document.getElementById("arrow"+newArrow+"_down");
	
	arrow_down.style.visibility = "visible";
	arrow_up.style.visibility = "visible";
	
	thermoEditing = newArrow;

}

function closeRNG() {

	document.getElementById("arrow1_up").style.visibility = "hidden";
	document.getElementById("arrow1_down").style.visibility = "hidden";
	document.getElementById("arrow2_up").style.visibility = "hidden";
	document.getElementById("arrow2_down").style.visibility = "hidden";
	document.getElementById("arrow3_up").style.visibility = "hidden";
	document.getElementById("arrow3_down").style.visibility = "hidden";

	rngDiv = document.getElementById("rng_div");
	rngDiv.style.visibility = "hidden";
	isEditing = false;

}

function confirmDelete() {
    return confirm('Tem certeza que voce quer desconectar este usuario?');
}

function reloadpage() {

	if (isEditing==false) {
		location.reload(true);
	} else {
		var t=setTimeout("reloadpage();",15000);
	}

}
