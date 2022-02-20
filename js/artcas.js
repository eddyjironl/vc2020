function init(){
	document.getElementById("btquit").addEventListener("click",cerrar_pantalla_artcas,false);
	document.getElementById("btguardar").addEventListener("click",guardar,false);
	document.getElementById("btnueva").addEventListener("click",get_clear_view,false);
	document.getElementById("btdelete").addEventListener("click",borrar,false);
	// configurando las variables de estado.
	gckeyid   = "cpaycode";
	gckeydesc = "cdesc";
	gcbtkeyid = "btcpaycode";

	// -------------------------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	document.getElementById("btcpaycode").addEventListener("click",function(){
        get_menu_list("artcas","showmenulist","cpaycode");
    },false);
	document.getElementById("cpaycode").addEventListener("change",valid_ckeyid,false);
	
}
// cerrar pantalla principal
function cerrar_pantalla_artcas(){
	document.getElementById("artcas").style.display="none";
}
// guardar registro principal
function guardar(){
	var oform = document.getElementById("artcas");
	// validaciones de campos obligatorios.
	if(document.getElementById("cpaycode").value ==""){
		getmsgalert("Falta el codigo de condicion de pago");
		return ;
	}
	if(document.getElementById("cdesc").value ==""){
		getmsgalert("Falta la descripcion de la condicion");
		return ;
	}
	if(document.getElementById("cstatus").value ==""){
		getmsgalert("No indico Estado");
		return ;
	}
	oform.submit();
}
// borrando registro principal
function borrar(){
	var xkeyid = document.getElementById("cpaycode").value;
	if(xkeyid != ""){
		if (!confirm("Esta seguro de borrar este registro")){
			return ;
		}
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("cpaycode",xkeyid);
		oDatos.append("accion","DELETE");
		// obteniendo el menu
		oRequest.open("POST","../modelo/crud_artcas.php",false); 
		oRequest.send(oDatos);
		get_clear_view();
	}else{
		getmsgalert("No ha indicado un codigo para borrar");
	}
}
function valid_ckeyid(pcaction){
	var lcxkeyvalue = document.getElementById("cpaycode").value;
	if (lcxkeyvalue !=""){
		update_window(lcxkeyvalue,"btcpaycode");
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
	oDatos.append("cpaycode",pckeyid);
	oDatos.append("accion","JSON");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_artcas.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){
		document.getElementById("cpaycode").value = odata.cpaycode;
		document.getElementById("cdesc").value 	  = odata.cdesc;
		document.getElementById("cstatus").value  = odata.cstatus;
		document.getElementById("cctaid1").value  = odata.cctaid1;
		document.getElementById("cctaid2").value  = odata.cctaid2;
		document.getElementById("cctaid3").value  = odata.cctaid3;
		document.getElementById("cctaid4").value  = odata.cctaid4;
		document.getElementById("cctaid5").value  = odata.cctaid5;
		document.getElementById("mnotas").value   = odata.mnotas;
		document.getElementById("nday").value    = odata.nday;
		document.getElementById("lvalidcrd").checked = (odata.lvalidcrd == "1")? true:false;
		document.getElementById("lqtypay").checked   = (odata.lqtypay == "1")? true:false;
		estado_key("I");
	}else{
		ck_new_key();
	}
}
window.onload=init;