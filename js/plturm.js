function init(){
    document.getElementById("btquit").addEventListener("click",cerrar_pantalla_principal,false);
	document.getElementById("btguardar").addEventListener("click",guardar,false);
	document.getElementById("btnueva").addEventListener("click",get_clear_view,false);
	document.getElementById("btdelete").addEventListener("click",borrar,false);
		// configurando las variables de estado.
	gckeyid   = "cturno";
	gckeydesc = "cdesc";
	gcbtkeyid = "btcturno";
	document.getElementById("btcturno").addEventListener("click",function(){
        get_menu_list("plturm","showmenulist","cturno");
    },false);

    document.getElementById("cturno").addEventListener("blur",valid_key,false);
    // ----------------------------------------------------------------------------------------------
}
function cerrar_pantalla_principal(){
	document.getElementById("plturm").style.display="none";
}
function guardar(){
	var oform = document.getElementById("plturm");
	// validaciones de campos obligatorios.
	if(document.getElementById("cturno").value ==""){
		getmsgalert("Falta el codigo");
		return ;
	}
	if(document.getElementById("cdesc").value ==""){
		getmsgalert("Falta la descripcion");
		return ;
	}
	/*
    if(document.getElementById("cstatus").value ==""){
		getmsgalert("Falta indicar el estado ");
		return ;
	}
	*/
    oform.submit();
}
function borrar(){
	var xkeyid = document.getElementById("cturno").value;
	if(xkeyid != ""){
		if (!confirm("Esta seguro de borrar este registro")){
			return ;
		}
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("cturno",xkeyid);
		oDatos.append("accion","DELETE");
		// obteniendo el menu
		oRequest.open("POST","../modelo/crud_plturm.php",false); 
		oRequest.send(oDatos);
		get_clear_view();
	}else{
		getmsgalert("No ha indicado un codigo para borrar");
	}
}
function valid_key(){
	var lcxkeyvalue = document.getElementById("cturno").value;
	if (lcxkeyvalue != ""){	
		update_window(lcxkeyvalue,"btcturno");
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
	oDatos.append("cturno",pckeyid);
	oDatos.append("accion","JSON");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_plturm.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){
		document.getElementById("cturno").value = odata.cturno;
		document.getElementById("cdesc").value 	= odata.cdesc;
		//document.getElementById("cstatus").value  = odata.cstatus;
		document.getElementById("mnotas").value  = odata.mnotas;
        estado_key("I");
	}else{
		ck_new_key();
	}
}
window.onload=init;

