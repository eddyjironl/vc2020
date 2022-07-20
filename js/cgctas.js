function init(){
	document.getElementById("btquit").addEventListener("click",cerrar_pantalla_principal,false);
	document.getElementById("btguardar").addEventListener("click",guardar,false);
	document.getElementById("btnueva").addEventListener("click",get_clear_view,false);
	document.getElementById("btdelete").addEventListener("click",borrar,false);
	// configurando las variables de estado.
	gckeyid   = "cctaid";
	gckeydesc = "cdesc";
	gcbtkeyid = "btcctaid";

	document.getElementById("btcctaid").addEventListener("click",function(){
        get_menu_list("cgctas","showmenulist","cctaid");
    },false);

	document.getElementById("btcmic1no").addEventListener("click",function(){
        get_menu_list("cgmic1","showmenulist","cmic1no","valid_mi1xno");
    },false);

	document.getElementById("btcmic2no").addEventListener("click",function(){
        get_menu_list("cgmic2","showmenulist","cmic2no","valid_mi2xno");
    },false);
	document.getElementById("btcmic3no").addEventListener("click",function(){
        get_menu_list("cgmic3","showmenulist","cmic3no","valid_mi3xno");
    },false);
	document.getElementById("btcmic4no").addEventListener("click",function(){
        get_menu_list("cgmic4","showmenulist","cmic4no","valid_mi4xno");
    },false);
	document.getElementById("btcmic5no").addEventListener("click",function(){
        get_menu_list("cgmic5","showmenulist","cmic5no","valid_mi5xno");
    },false);

	document.getElementById("cctaid").addEventListener("change",valid_ckeyid,false);
	document.getElementById("cmic1no").addEventListener("change",valid_mi1xno,false);
	document.getElementById("cmic2no").addEventListener("change",valid_mi2xno,false);
	document.getElementById("cmic3no").addEventListener("change",valid_mi3xno,false);
	document.getElementById("cmic4no").addEventListener("change",valid_mi4xno,false);
	document.getElementById("cmic5no").addEventListener("change",valid_mi5xno,false);

	document.getElementById("cgrupid").addEventListener("change",updtype,false);

}
function updtype(){
	/*
	<option Value = "A">Activo</option>
	<option Value = "B">Pasivo</option>
	<option Value = "C">Capital</option>
	<option Value = "D">Ingresos</option>
	<option Value = "E">Gastos</option>
	<option Value = "F">Cta de Orden Deudor</option>
	<option Value = "X">Cta de Orden Acreedor</option>
	*/
	var lcvalue = document.getElementById("cgrupid").value;
	switch (lcvalue) {
		case "A":
			document.getElementById("ctype").value = "D";
			break;
		case "F":
			document.getElementById("ctype").value = "D";
			break;
		case "E":
			document.getElementById("ctype").value = "D";
			break;
		default:
			document.getElementById("ctype").value = "H";
		break;
	}
}
function cerrar_pantalla_principal(){
	document.getElementById("cgctas").style.display="none";
}
function guardar(){
	var oform = document.getElementById("cgctas");
	// validaciones de campos obligatorios.
	if(document.getElementById("cctaid").value ==""){
		getmsgalert("Falta el codigo");
		return ;
	}
	if(document.getElementById("cdesc").value ==""){
		getmsgalert("Falta la descripcion");
		return ;
	}
	if(document.getElementById("ctype").value ==""){
		getmsgalert("Falta indicar el tipo de cuenta ");
		return ;
	}
	oform.submit();
}
function borrar(){
	var xkeyid = document.getElementById("cctaid").value;
	if(xkeyid != ""){
		if (!confirm("Esta seguro de borrar este registro")){
			return ;
		}
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("cctaid",xkeyid);
		oDatos.append("accion","DELETE");
		// obteniendo el menu
		oRequest.open("POST","../modelo/crud_cgctas.php",false); 
		oRequest.send(oDatos);
		get_clear_view();
	}else{
		getmsgalert("No ha indicado un codigo para borrar");
	}
}
function valid_ckeyid(){
	var lcxkeyvalue = document.getElementById("cctaid").value;
	if (lcxkeyvalue != ""){	
		update_window(lcxkeyvalue,"btcctaid");
	}	
}
function valid_mi1xno(){
	var lcxkeyvalue = document.getElementById("cmic1no").value;
	if (lcxkeyvalue != ""){	
		valid_cmicxno(lcxkeyvalue,"btcmic1no",1);
	}	
}
function valid_mi2xno(){
	var lcxkeyvalue = document.getElementById("cmic2no").value;
	if (lcxkeyvalue != ""){	
		valid_cmicxno(lcxkeyvalue,"btcmic2no",2);
	}	
}
function valid_mi3xno(){
	var lcxkeyvalue = document.getElementById("cmic3no").value;
	if (lcxkeyvalue != ""){	
		valid_cmicxno(lcxkeyvalue,"btcmic3no",3);
	}	
}
function valid_mi4xno(){
	var lcxkeyvalue = document.getElementById("cmic4no").value;
	if (lcxkeyvalue != ""){	
		valid_cmicxno(lcxkeyvalue,"btcmic4no",4);
	}	
}
function valid_mi5xno(){
	var lcxkeyvalue = document.getElementById("cmic5no").value;
	if (lcxkeyvalue != ""){	
		valid_cmicxno(lcxkeyvalue,"btcmic5no",5);
	}	
}
function update_window(pckeyid){
	// --------------------------------------------------------------------------------------
	// Con esta funcion se hace una peticion al servidor para obtener un JSON, con los 
	// datos de la persona un solo objeto json que sera el cliente.
	// --------------------------------------------------------------------------------------
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cctaid",pckeyid);
	oDatos.append("accion","JSON");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_cgctas.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	let lxvalor = oRequest.response;

	//if (typeof(lxvalor) == "undefined" || typeof(lxvalor) == 'string' || typeof(lxvalor) == null ){
	//	var odata = null;
	//}else{
		var odata = JSON.parse(lxvalor);
	//}
	//cargando los valores de la pantalla.
	if (odata != null){
		document.getElementById("cctaid").value  = odata.cctaid;
		document.getElementById("cdesc").value 	 = odata.cdesc;
		document.getElementById("ctype").value   = odata.ctype;
		document.getElementById("cgrupid").value = odata.cgrupid;
		document.getElementById("cmic1no").value = odata.cmic1no;
		document.getElementById("cmic2no").value = odata.cmic2no;
		document.getElementById("cmic3no").value = odata.cmic3no;
		document.getElementById("cmic4no").value = odata.cmic4no;
		document.getElementById("cmic5no").value = odata.cmic5no;
		document.getElementById("mnotas").value  = odata.mnotas;
		document.getElementById("lpost").checked = (odata.lpost == "1")? true:false;
		document.getElementById("lapplyir").checked = (odata.lapplyir == "1")? true:false;
		document.getElementById("ndebe").value  = odata.ndebe;
		document.getElementById("nhaber").value = odata.nhaber;
		document.getElementById("namount").value = odata.namount;

		document.getElementById("ndebe_d").value  = odata.ndebe_d;
		document.getElementById("nhaber_d").value = odata.nhaber_d;
		document.getElementById("namount_d").value = odata.namount_d;

		document.getElementById("cdescmic1").value = (odata.cdesc1 == null)?"":odata.cdesc1;
		document.getElementById("cdescmic2").value = (odata.cdesc2 == null)?"":odata.cdesc2;
		document.getElementById("cdescmic3").value = (odata.cdesc3 == null)?"":odata.cdesc3;
		document.getElementById("cdescmic4").value = (odata.cdesc4 == null)?"":odata.cdesc4;
		document.getElementById("cdescmic5").value = (odata.cdesc5 == null)?"":odata.cdesc5;
		

		estado_key("I");
	}else{
		ck_new_key();
	}
}
function valid_cmicxno(pcvalue, pcobject, pcuid){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("pcvalue",pcvalue);
	oDatos.append("pcuid",pcuid);
	oDatos.append("accion","CMICXNO");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_cgctas.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){
		lcdescmicx = "cdescmic"+pcuid;
		document.getElementById(lcdescmicx).value = odata.cdesc;
	}else{ 
		alert("Agrupacion "+ pcuid + " no definida.");
	}
}
window.onload=init;