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
	// refrescando la pantalla con todo sus contenidos.
	update_window();
}
function salir(){
	//var pantalla = document.defaultView;
	document.getElementById("cgsetup").style.display="none";	
}
function guardar(){
	var oform = document.getElementById("cgsetup");
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
	if (odata != null){
		//cargando los valores de la pantalla.
		document.getElementById("ntrnno1").value   = odata.ntrnno1;
		document.getElementById("ntrnno2").value   = odata.ntrnno2;
		document.getElementById("ntrnno3").value   = odata.ntrnno3;
		document.getElementById("ntrnno4").value   = odata.ntrnno4;
		document.getElementById("cperid").value    = odata.cperid;
		document.getElementById("cctano1").value   = odata.cctano1;
		document.getElementById("cctano2").value   = odata.cctano2;
		document.getElementById("cctano3").value   = odata.cctano3;
		document.getElementById("cctano4").value   = odata.cctano4;
		document.getElementById("cctano5").value   = odata.cctano5;
		document.getElementById("cctano6").value   = odata.cctano6;

		document.getElementById("cmonid").value    = odata.cmonid;
		document.getElementById("cfirma1").value   = odata.cfirma1;
		document.getElementById("cfirma2").value   = odata.cfirma2;
		document.getElementById("cfirma3").value   = odata.cfirma3;
		document.getElementById("ctitulo1").value  = odata.ctitulo1;
		document.getElementById("ctitulo2").value  = odata.ctitulo2;
		document.getElementById("ctitulo3").value  = odata.ctitulo3;
		document.getElementById("lviewf1").checked = (odata.lviewf1 == "1")? true:false;
		document.getElementById("lviewf2").checked = (odata.lviewf2 == "1")? true:false;
		document.getElementById("lviewf3").checked = (odata.lviewf3 == "1")? true:false;

		document.getElementById("llogoBC").checked = (odata.llogoBC == "1")? true:false;
		document.getElementById("llogobg").checked = (odata.llogoBC == "1")? true:false;
		document.getElementById("llogoer").checked = (odata.llogoBC == "1")? true:false;
		document.getElementById("nrentax").value   = odata.nrentax;

		document.getElementById("cmic1desc").value = odata.cmic1desc;
		document.getElementById("cmic2desc").value = odata.cmic2desc;
		document.getElementById("cmic3desc").value = odata.cmic3desc;
		document.getElementById("cmic4desc").value = odata.cmic4desc;
		document.getElementById("cmic5desc").value = odata.cmic5desc;

		document.getElementById("lmic1desc").checked = (odata.lmic1desc == "1")? true:false;
		document.getElementById("lmic2desc").checked = (odata.lmic2desc == "1")? true:false;
		document.getElementById("lmic3desc").checked = (odata.lmic3desc == "1")? true:false;
		document.getElementById("lmic4desc").checked = (odata.lmic4desc == "1")? true:false;
		document.getElementById("lmic5desc").checked = (odata.lmic5desc == "1")? true:false;

		document.getElementById("nmic1desc").value = odata.nmic1desc;
		document.getElementById("nmic2desc").value = odata.nmic2desc;
		document.getElementById("nmic3desc").value = odata.nmic3desc;
		document.getElementById("nmic4desc").value = odata.nmic4desc;
		document.getElementById("nmic5desc").value = odata.nmic5desc;

		document.getElementById("lmic1desc1").checked = (odata.lmic1desc1 == "1")? true:false;
		document.getElementById("lmic2desc1").checked = (odata.lmic2desc1 == "1")? true:false;
		document.getElementById("lmic3desc1").checked = (odata.lmic3desc1 == "1")? true:false;
		document.getElementById("lmic4desc1").checked = (odata.lmic4desc1 == "1")? true:false;
		document.getElementById("lmic5desc1").checked = (odata.lmic5desc1 == "1")? true:false;

		document.getElementById("lmic1desc2").checked = (odata.lmic1desc2 == "1")? true:false;
		document.getElementById("lmic2desc2").checked = (odata.lmic2desc2 == "1")? true:false;
		document.getElementById("lmic3desc2").checked = (odata.lmic3desc2 == "1")? true:false;
		document.getElementById("lmic4desc2").checked = (odata.lmic4desc2 == "1")? true:false;
		document.getElementById("lmic5desc2").checked = (odata.lmic5desc2 == "1")? true:false;

		document.getElementById("lmic1desc3").checked = (odata.lmic1desc3 == "1")? true:false;
		document.getElementById("lmic2desc3").checked = (odata.lmic2desc3 == "1")? true:false;
		document.getElementById("lmic3desc3").checked = (odata.lmic3desc3 == "1")? true:false;
		document.getElementById("lmic4desc3").checked = (odata.lmic4desc3 == "1")? true:false;
		document.getElementById("lmic5desc3").checked = (odata.lmic5desc3 == "1")? true:false;

		document.getElementById("lmic1desc4").checked = (odata.lmic1desc4 == "1")? true:false;
		document.getElementById("lmic2desc4").checked = (odata.lmic2desc4 == "1")? true:false;
		document.getElementById("lmic3desc4").checked = (odata.lmic3desc4 == "1")? true:false;
		document.getElementById("lmic4desc4").checked = (odata.lmic4desc4 == "1")? true:false;
		document.getElementById("lmic5desc4").checked = (odata.lmic5desc4 == "1")? true:false;

		document.getElementById("ngrupid").value = odata.ngrupid;
		document.getElementById("lnConfRChk").checked = (odata.lnConfRChk == "1")? true:false;

	}else{
		alert("Modulo no configurado");
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