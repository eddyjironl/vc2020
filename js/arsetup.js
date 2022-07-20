function init(){
	var otbinfo1 = document.getElementById("tbinfo1");
	var otbinfo2 = document.getElementById("tbinfo2");
	var obtsave  = document.getElementById("btsave");
	document.getElementById("btquit").addEventListener("click",salir,false);
	// poniendo los botones a la escucha.
	otbinfo1.addEventListener("click",tabshow,false);
	otbinfo2.addEventListener("click",tabshow,false);
	obtsave.addEventListener("click",guardar,false);
	// poniendo visible el objeto tab del info 
	document.getElementById("finfo1").style.display = "block";
	document.getElementById("tbinfo1").setAttribute("class","active");
	document.getElementById("btcxccls").addEventListener("click",verificar_cxc,false);

	// refrescando la pantalla con todo sus contenidos.
	update_window();
}
function verificar_cxc(){
	var oRequest = new XMLHttpRequest();
	var oDatos   = new FormData();
	oDatos.append("program","conf_cxc");
	oDatos.append("ccustno",document.getElementById("ccustno1").value);
	oRequest.open("POST","../modelo/armodule.php");
	oRequest.send(oDatos);
	document.getElementById("ccustno1").value = "";
	alert("Proceso Concluido");
}

function salir(){
	//var pantalla = document.defaultView;
	document.getElementById("arsetup").style.display="none";	
}
function guardar(){
	var oform = document.getElementById("arsetup");
	oform.submit();
}
function update_window(){
	// --------------------------------------------------------------------------------------
	// Con esta funcion se hace una peticion al servidor para obtener un JSON, con los 
	// datos de la tabla master 
	// --------------------------------------------------------------------------------------
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	oDatos.append("accion","JSON")
	oRequest.open("POST","../menu/menu_arsetup.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	document.getElementById("ninvno").value   = odata.ninvno;
	document.getElementById("ncashno").value  = odata.ncashno;
	document.getElementById("nadjno").value   = odata.nadjno;
	document.getElementById("nncno").value    = odata.nncno;
	document.getElementById("nndno").value    = odata.nndno;
	document.getElementById("ncotno").value   = odata.ncotno;
	document.getElementById("ccustno").value  = odata.ccustno;
	document.getElementById("cwhseno").value  = odata.cwhseno;
	document.getElementById("cpaycode").value = odata.cpaycode;
	document.getElementById("ccateno").value  = odata.ccateno;
	document.getElementById("ctypcost").value = odata.ctypcost;
	document.getElementById("ctypdesc").value = odata.ctypdesc;
	document.getElementById("ctaxproc").value = odata.ctaxproc;
	document.getElementById("minvno").value   = odata.minvno;
	document.getElementById("mestados").value = odata.mestados;
	document.getElementById("mcoti").value    = odata.mcoti;
	document.getElementById("ncashamt").value = odata.ncashamt;
	document.getElementById("ninvlinmax").value = odata.ninvlinmax;
	// piniendo los cheks box en forma.	
	if(odata.linvno == "1"){
		document.getElementById("linvno").setAttribute("checked","checked");	
	}

	if(odata.lestados == "1"){
		document.getElementById("lestados").setAttribute("checked","checked");	
	}

	if(odata.lcoti == "1"){
		document.getElementById("lcoti").setAttribute("checked","checked");	
	}
}
function tabshow(e){
	// evitando que el tipo de boton haga un submit por defecto y recargue la pagina.
	e.preventDefault();
	var oTabFormBoton = e.target.id;
	
	// poniendo ocultos todos los div pantallas ocultos
	var oTabForm = document.getElementsByClassName("tabcontent");
	for (i = 0; i < oTabForm.length; i++) {
		oTabForm[i].style.display = "none";
	}
	// obteniendo todos los links del tab y dejandolos normales.
	/*var oTabLinks = document.getElementsByClassName("tablinks");
	for (i = 0; i < oTabLinks.length; i++) {
		var mama = oTabLinks[i];
		mama.setAttribute("class","tablinks");
		//oTabLinks[i].setAttribute("class","tablinks");
	}
	*/

	if(oTabFormBoton == "tbinfo1"){
		document.getElementById("finfo1").style.display = "block";
		document.getElementById("tbinfo2").setAttribute("class","")
	}
	
	if(oTabFormBoton == "tbinfo2"){
		document.getElementById("finfo2").style.display = "block";
		document.getElementById("tbinfo1").setAttribute("class","")
	}
	document.getElementById(oTabFormBoton).setAttribute("class","active");

}
window.onload=init;