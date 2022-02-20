function init(){
	document.getElementById("btquit").addEventListener("click",cerrar_pantalla_principal,false);
	document.getElementById("btguardar").addEventListener("click",guardar,false);
	document.getElementById("btnueva").addEventListener("click",get_clear_view,false);
	document.getElementById("btdelete").addEventListener("click",borrar,false);
	//document.getElementById("btctserno").addEventListener("click",getmenulist,false);
	// configurando las variables de estado.
	gckeyid   = "ctserno";
	gckeydesc = "cdesc";
	gcbtkeyid = "btctserno";
	// ------------------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	document.getElementById("ctserno").addEventListener("change",valid_ckeyid,false);
	document.getElementById("btctserno").addEventListener("click",function(){
        get_menu_list("artser","showmenulist","ctserno");
    },false);

	// ------------------------------------------------------------------------	
}
// cerrar pantalla principal
function cerrar_pantalla_principal(){
	document.getElementById("artser").style.display="none";
}
// guardar registro principal
function guardar(){
	var oform = document.getElementById("artser");
	// validaciones de campos obligatorios.
	if(document.getElementById("ctserno").value ==""){
		getmsgalert("Falta el codigo del tipo de Inventario");
		return ;
	}
	if(document.getElementById("cdesc").value ==""){
		getmsgalert("Falta la descripcion del tipo inventario");
		return ;
	}
	oform.submit();
}
// borrando registro principal
function borrar(){
	var xkeyid = document.getElementById("ctserno").value;
	if(xkeyid != ""){
		if (!confirm("Esta seguro de borrar este registro")){
			return ;
		}
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("ctserno",xkeyid);
		oDatos.append("accion","DELETE");
		// obteniendo el menu
		oRequest.open("POST","../modelo/crud_artser.php",false); 
		oRequest.send(oDatos);
		get_clear_view();
	}else{
		getmsgalert("No ha indicado un codigo para borrar");
	}
}
function valid_ckeyid(){
	var lcxkeyvalue = document.getElementById("ctserno").value;
	if(lcxkeyvalue != ""){
		update_window(lcxkeyvalue,"btctserno");
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
	oDatos.append("ctserno",pckeyid);
	oDatos.append("accion","JSON");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_artser.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){
		document.getElementById("ctserno").value   = odata.ctserno;
		document.getElementById("cdesc").value 	   = odata.cdesc;
		document.getElementById("cstatus").value   = odata.cstatus;
		document.getElementById("mnotas").value    = odata.mnotas;
		estado_key("I");
	}else{
		ck_new_key();
	}
}
window.onload=init;