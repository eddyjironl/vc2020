function init(){
	document.getElementById("btquit").addEventListener("click",cerrar_pantalla_principal,false);
	document.getElementById("btguardar").addEventListener("click",guardar,false);
	document.getElementById("btnueva").addEventListener("click",clear_view,false);
	document.getElementById("btdelete").addEventListener("click",borrar,false);
	//document.getElementById("btctserno").addEventListener("click",getmenulist,false);
	// configurando las variables de estado.
	gckeyid   = "cbanno";
	gckeydesc = "cdesc";
	gcbtkeyid = "btcbanno";
	// ------------------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	document.getElementById("cbanno").addEventListener("change",valid_ckeyid,false);
	document.getElementById("btcbanno").addEventListener("click",function(){
        get_menu_list("cgbanm","showmenulist","cbanno");
    },false);

	document.getElementById("cctaid").addEventListener("change",valid_ckeyid_cta,false);
	document.getElementById("btcctaid").addEventListener("click",function(){
        get_menu_list("cgctas","showmenulist","cctaid","valid_ckeyid_cta");
    },false);

	document.getElementById("cmonid").addEventListener("change",valid_ckeyid_cmonid,false);
	document.getElementById("btcmonid").addEventListener("click",function(){
        get_menu_list("cgmonm","showmenulist","cmonid","valid_ckeyid_cmonid");
    },false);
	// ocultando pantalla de adicionar 
	// ------------------------------------------------------------------------	
    document.getElementById("addcta").style.display="none";
    document.getElementById("btnueva1").addEventListener("click",show_add_form,false);
    document.getElementById("btclose").addEventListener("click",close_add_form,false);
    document.getElementById("btsave12").addEventListener("click",addrow,false);

}
function clear_view(){
    get_clear_view();
    document.getElementById("tdetalles").innerHTML = "";
}
// cerrar pantalla principal
function cerrar_pantalla_principal(){
	document.getElementById("cgbanm").style.display="none";
}
// guardar registro principal
function guardar(){
	var oform = document.getElementById("cgbanm");
	// validaciones de campos obligatorios.
	if(document.getElementById("cbanno").value ==""){
		getmsgalert("Falta el codigo del Banco");
		return ;
	}
	if(document.getElementById("cdesc").value ==""){
		getmsgalert("Falta la descripcion del banco");
		return ;
	}
	oform.submit();
}
// borrando registro principal
function borrar(){
	var xkeyid = document.getElementById("cbanno").value;
	if(xkeyid != ""){
		if (!confirm("Esta seguro de borrar este registro")){
			return ;
		}
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("cbanno",xkeyid);
		oDatos.append("accion","DELETE");
		// obteniendo el menu
		oRequest.open("POST","../modelo/crud_cgbanm.php",false); 
		oRequest.send(oDatos);
		get_clear_view();
	}else{
		getmsgalert("No ha indicado un codigo para borrar");
	}
}
function valid_ckeyid(){
	var lcxkeyvalue = document.getElementById("cbanno").value;
	if(lcxkeyvalue != ""){
		update_window(lcxkeyvalue,"btcbanno");
	}

}	
function valid_ckeyid_cta(){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cctaid",document.getElementById("cctaid").value);
	oDatos.append("accion","JSON");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_cgctas.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
    var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata == null){
		alert("Cuenta Invalida o no Existe");
	}else{
		document.getElementById("cctaiddesc").value = odata.cdesc;
	}
}
function valid_ckeyid_cmonid(){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cmonid",document.getElementById("cmonid").value);
	oDatos.append("accion","JSON");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_cgmonm.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
    var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata == null){
		alert("Cuenta Invalida o no Existe");
	}else{
		document.getElementById("cmonidcdesc").value = odata.cdesc;
	}

}
function show_add_form(){
    document.getElementById("cbanno1").value = document.getElementById("cbanno").value;
	document.getElementById("cuid").value = "";
	document.getElementById("cdesc1").value = "";
	document.getElementById("cmonidcdesc").value = "";
	document.getElementById("cctaiddesc").value = "";
	document.getElementById("cmonid").value = "";
	document.getElementById("cctaid").value = "";
	document.getElementById("cckqno").value = "";
	document.getElementById("mnotas1").value = "";

    document.getElementById("addcta").style.display="inline-block";
}
function editRow(pid){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cuid",pid);
	oDatos.append("accion","JSON_ID");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_cgbanm.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
    var odata = JSON.parse(oRequest.response);
    if(odata != null ){
        document.getElementById("cuid").value    = odata.cuid;
        document.getElementById("cbanno").value  = odata.cbanno;
        document.getElementById("cdesc1").value  = odata.cdesc1;
        document.getElementById("cctaid").value  = odata.cctaid;
        document.getElementById("cctaiddesc").value  = odata.cctaidcdesc;
        document.getElementById("cmonid").value  = odata.cmonid;
        document.getElementById("cmonidcdesc").value = odata.cmonidcdesc;
        document.getElementById("cckqno").value  = odata.cckqno;
        document.getElementById("mnotas1").value = odata.mnotas1;
        // desplegando la pantalla de edicion.
        document.getElementById("addcta").style.display="block";
    }
}	
function close_add_form(){
    document.getElementById("addcta").style.display="none";
}
function addrow(){
    // adicionando la linea nueva.
	// validaciones de campos obligatorios.
	if(document.getElementById("cdesc1").value ==""){
		getmsgalert("Falta descripcion de cuenta");
		return ;
	}
	if(document.getElementById("cctaid").value ==""){
		getmsgalert("Falta la Cuenta contable");
		return ;
	}
	if(document.getElementById("cmonid").value ==""){
		getmsgalert("Falta la moneda");
		return ;
	}
	if(document.getElementById("cckqno").value ==""){
		getmsgalert("Falta el consecutivo de cheque");
		return ;
	}
	// cargando peticion al servidor paa guardar.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","NEWLINE");
	oDatos.append("cuid",document.getElementById("cuid").value);
	oDatos.append("cbanno",document.getElementById("cbanno").value);
	oDatos.append("cdesc1",document.getElementById("cdesc1").value);
	oDatos.append("cmonid",document.getElementById("cmonid").value);
	oDatos.append("cctaid",document.getElementById("cctaid").value);
	oDatos.append("cckqno",document.getElementById("cckqno").value);
	oDatos.append("mnotas1",document.getElementById("mnotas1").value);
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_cgbanm.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	close_add_form();
    RefreshDetail(document.getElementById("cbanno").value);
}
function deleteRow(pcuid){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cuid",pcuid);
	oDatos.append("accion","DELETEROW");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_cgbanm.php",false); 
	oRequest.send(oDatos);
	RefreshDetail(document.getElementById("cbanno").value);
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
	oDatos.append("cbanno",pckeyid);
	oDatos.append("accion","JSON");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_cgbanm.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
    var odata = JSON.parse(oRequest.response);
    var otabla = document.getElementById("tdetalles");
	//cargando los valores de la pantalla.
	if (odata != null){
        // cargando detalle de las cuentas.
        document.getElementById("cbanno").value = odata.cbanno;
        document.getElementById("cdesc").value 	= odata.cdesc;
        document.getElementById("mnotas").value = odata.mnotas;
        document.getElementById("chk").value    = odata.chk;

        RefreshDetail(odata.cbanno);
    	estado_key("I");
	}else{
		ck_new_key();
	}
}
function RefreshDetail(pcbanno){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cbanno",pcbanno);
	oDatos.append("accion","DETALLE_BAND");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_cgbanm.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
    document.getElementById("tdetalles").innerHTML = oRequest.response;
}

	/*
		function RefreshDetail(pcbanno){

			var oRequest = new XMLHttpRequest();
			// Creando objeto para empaquetado de datos.
			var oDatos   = new FormData();
			// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
			oDatos.append("cbanno",pcbanno);
			oDatos.append("accion","JSON_DET");
			// obteniendo el menu
			oRequest.open("POST","../modelo/crud_cgbanm.php",false); 
			oRequest.send(oDatos);
			// desplegando pantalla de menu con su informacion.
			var odata = JSON.parse(oRequest.response);
			var otabla = document.getElementById("tdetalles");
			for (var i = 0; i<odata["detalles"].length; i++) {
				//console.log(odata[i].cdesc1);
				var orow = "<tr class='grid_detail'>"; 
					orow += "    <td style='width:200px'>" + odata["detalles"][i]["cdesc1"]  + "</td>";
					orow += "    <td style='width:120px'>" + odata["detalles"][i]["cctaid"]  + "</td>";
					orow += "    <td style='width:120px'>" + odata["detalles"][i]["cmonid"]  + "</td>";
					orow += "    <td style='width:50px'>"  + odata["detalles"][i]["cckqno"]  + "</td>";
					orow += "    <td style='width:200px'>" + odata["detalles"][i]["mnotas1"] + "</td>";
					orow += "    <td style='width:100px'></td> ";
					orow += "        <img src='../photos/write.ico' id='bteditar' class='botones_row'  onclick='editRow("    + odata["detalles"][i]["cuid"] + ")' title='Editar Registro'/> ";
					orow += "        <img src='../photos/escoba.ico' id='btquitar' class='botones_row'  onclick='deleteRow(" + odata["detalles"][i]["cuid"] + ")' title='Eliminar Registro'/> ";
					orow += "    </td> ";
					orow += "</tr>";
				otabla.insertRow(-1).innerHTML = orow;
			}
			}
	 */
window.onload=init;