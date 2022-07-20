function init(){
	document.getElementById("btquit").addEventListener("click",cerrar_pantalla_principal,false);
	document.getElementById("btguardar").addEventListener("click",guardar,false);
	document.getElementById("btnueva").addEventListener("click",get_clear_view,false);
	document.getElementById("btdelete").addEventListener("click",borrar,false);
	//document.getElementById("btccateno").addEventListener("click",getmenulist,false);
	// configurando las variables de estado.
	gckeyid   = "cmicxno";
	gckeydesc = "cdesc";
	gcbtkeyid = "btcmicxno";
    lcid      = "2";
	// ------------------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	document.getElementById("cmicxno").addEventListener("change",valid_ckeyid,false);
	document.getElementById("btcmicxno").addEventListener("click",function(){
        get_menu_list("cgmic"+lcid,"showmenulist","cmicxno","valid_ckeyid");
    },false);
}
// cerrar pantalla principal
function cerrar_pantalla_principal(){
	document.getElementById("cgmicx").style.display="none";
}
// guardar registro principal
function guardar(){
	var oform = document.getElementById("cgmicx");
	// validaciones de campos obligatorios.
	if(document.getElementById("cmicxno").value ==""){
		getmsgalert("Falta codigo de grupo");
		return ;
	}
	if(document.getElementById("cdesc").value ==""){
		getmsgalert("Falta la descripcion del grupo");
		return ;
	}
	oform.submit();
}
// borrando registro principal
function borrar(){
	var xkeyid = document.getElementById("cmicxno").value;
	if(xkeyid != ""){
		if (!confirm("Esta seguro de borrar este registro")){
			return ;
		}
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("cmicxno",xkeyid);
		oDatos.append("cid",lcid);
		oDatos.append("accion","DELETE");
		// obteniendo el menu
		oRequest.open("POST","../modelo/crud_cgmicx.php",false); 
		oRequest.send(oDatos);
		get_clear_view();
	}else{
		getmsgalert("No ha indicado un codigo para borrar");
	}
}
function valid_ckeyid(){
	var lcxkeyvalue = document.getElementById("cmicxno").value;
	if(lcxkeyvalue != ""){
		update_window(lcxkeyvalue,"btcmicxno");
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
	oDatos.append("cmicxno",pckeyid);
	oDatos.append("cid",lcid);
	oDatos.append("accion","JSON");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_cgmicx.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){
		document.getElementById("cmicxno").value = odata.cmicxno;
		document.getElementById("cdesc").value 	 = odata.cdesc;
		document.getElementById("mnotas").value  = odata.mnotas;
		estado_key("I");
	}else{
		ck_new_key();
	}
}
window.onload=init;