function init(){
	document.getElementById("btquit").addEventListener("click",cerrar_pantalla_principal,false);
	document.getElementById("btguardar").addEventListener("click",guardar,false);
	document.getElementById("btnueva").addEventListener("click",get_clear_view,false);
	document.getElementById("btdelete").addEventListener("click",borrar,false);
	// configurando las variables de estado.
	gckeyid   = "cwhseno";
	gckeydesc = "cdesc";
	gcbtkeyid = "btcwhseno";

	document.getElementById("btcwhseno").addEventListener("click",function(){
        get_menu_list("arwhse","showmenulist","cwhseno");
    },false);
	document.getElementById("cwhseno").addEventListener("change",valid_ckeyid,false);
}
// cerrar pantalla principal
function cerrar_pantalla_principal(){
	document.getElementById("arwhse").style.display="none";
}
// guardar registro principal
function guardar(){
	var oform = document.getElementById("arwhse");
	// validaciones de campos obligatorios.
	if(document.getElementById("cwhseno").value ==""){
		getmsgalert("Falta el codigo");
		return ;
	}
	if(document.getElementById("cdesc").value ==""){
		getmsgalert("Falta la descripcion");
		return ;
	}
	if(document.getElementById("cstatus").value ==""){
		getmsgalert("Falta indicar el estado ");
		return ;
	}
	oform.submit();
}
// borrando registro principal
function borrar(){
	var xkeyid = document.getElementById("cwhseno").value;
	if(xkeyid != ""){
		if (!confirm("Esta seguro de borrar este registro")){
			return ;
		}
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("cwhseno",xkeyid);
		oDatos.append("accion","DELETE");
		// obteniendo el menu
		oRequest.open("POST","../modelo/crud_arwhse.php",false); 
		oRequest.send(oDatos);
		get_clear_view();
	}else{
		getmsgalert("No ha indicado un codigo para borrar");
	}
}
function valid_ckeyid(){
	var lcxkeyvalue = document.getElementById("cwhseno").value;
	if(lcxkeyvalue != ""){
		update_window(lcxkeyvalue,"btcwhseno");
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
	oDatos.append("cwhseno",pckeyid);
	oDatos.append("accion","JSON");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_arwhse.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){
		document.getElementById("cwhseno").value = odata.cwhseno;
		document.getElementById("cdesc").value 	 = odata.cdesc;
		document.getElementById("cstatus").value = odata.cstatus;
		document.getElementById("crespno").value = odata.crespno;
		document.getElementById("mnotas").value  = odata.mnotas;
		document.getElementById("mdirecc").value = odata.mdirecc;
		document.getElementById("mtel").value    = odata.mtel;
		estado_key("I");
	}else{
		ck_new_key();
	}
}
window.onload=init;