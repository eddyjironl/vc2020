function init(){
	document.getElementById("btquit").addEventListener("click",cerrar_pantalla_principal,false);
	document.getElementById("btguardar").addEventListener("click",guardar,false);
	document.getElementById("btnueva").addEventListener("click",get_clear_view,false);
	document.getElementById("btdelete").addEventListener("click",borrar,false);
	//document.getElementById("btccateno").addEventListener("click",getmenulist,false);
	// configurando las variables de estado.
	gckeyid   = "ccateno";
	gckeydesc = "cdesc";
	gcbtkeyid = "btccateno";
	// ------------------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	document.getElementById("ccateno").addEventListener("change",valid_ckeyid,false);
	document.getElementById("btccateno").addEventListener("click",function(){
        get_menu_list("arcateg","showmenulist","ccateno","valid_ckeyid");
    },false);
}
// cerrar pantalla principal
function cerrar_pantalla_principal(){
	document.getElementById("arcate").style.display="none";
}
// guardar registro principal
function guardar(){
	var oform = document.getElementById("arcate");
	// validaciones de campos obligatorios.
	if(document.getElementById("ccateno").value ==""){
		getmsgalert("Falta el codigo del tipo de Inventario");
		return ;
	}
	if(document.getElementById("cdesc").value ==""){
		getmsgalert("Falta la descripcion del tipo inventario");
		return ;
	}
	// verificando que tenga indicado el comportamiento si es que es ajuste
	if(document.getElementById("ctypecate").value ==""){
		getmsgalert("Indique la Categoria del Registro");
		return ;
	}
	// verificando que tenga indicado el comportamiento si es que es ajuste
	if(document.getElementById("ctypecate").value =="A"){
		if (document.getElementById("ctypeadj").value ==""){
			getmsgalert("Debe indicar el comportamiento.");
			return ;
		}
	}
	
	oform.submit();
}
// borrando registro principal
function borrar(){
	var xkeyid = document.getElementById("ccateno").value;
	if(xkeyid != ""){
		if (!confirm("Esta seguro de borrar este registro")){
			return ;
		}
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("ccateno",xkeyid);
		oDatos.append("accion","DELETE");
		// obteniendo el menu
		oRequest.open("POST","../modelo/crud_arcate.php",false); 
		oRequest.send(oDatos);
		get_clear_view();
	}else{
		getmsgalert("No ha indicado un codigo para borrar");
	}
}
function valid_ckeyid(){
	var lcxkeyvalue = document.getElementById("ccateno").value;
	if(lcxkeyvalue != ""){
		update_window(lcxkeyvalue,"btccateno");
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
	oDatos.append("ccateno",pckeyid);
	oDatos.append("accion","JSON");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_arcate.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){
		document.getElementById("ccateno").value   = odata.ccateno;
		document.getElementById("cdesc").value 	   = odata.cdesc;
		document.getElementById("cstatus").value   = odata.cstatus;
		document.getElementById("ctypeadj").value  = odata.ctypeadj;
		document.getElementById("ctypecate").value = odata.ctypecate;
		document.getElementById("mnotas").value    = odata.mnotas;
		document.getElementById("cctaid").value     = odata.cctaid;
		document.getElementById("cctaid_tax").value = odata.cctaid_tax;
		document.getElementById("lctaresp").checked = (odata.lctaresp == "1")? true:false;
		document.getElementById("lexpcont").checked = (odata.lexpcont == "1")? true:false;
		document.getElementById("lupdcost").checked = (odata.lupdcost == "1")? true:false;
		estado_key("I");
	}else{
		ck_new_key();
	}
}
window.onload=init;