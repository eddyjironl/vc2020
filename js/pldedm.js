function init(){
    document.getElementById("btquit").addEventListener("click",cerrar_pantalla_principal,false);
	document.getElementById("btguardar").addEventListener("click",guardar,false);
	document.getElementById("btnueva").addEventListener("click",get_clear_view,false);
	document.getElementById("btdelete").addEventListener("click",borrar,false);
		// configurando las variables de estado.
	gckeyid   = "cdedid";
	gckeydesc = "cdesc";
	gcbtkeyid = "btcdedid";
	document.getElementById("btcdedid").addEventListener("click",function(){
        get_menu_list("pldedm","showmenulist","cdedid");
    },false);

    document.getElementById("cdedid").addEventListener("change",valid_key,false);
    // ----------------------------------------------------------------------------------------------
}
function cerrar_pantalla_principal(){
	document.getElementById("pldedm").style.display="none";
}
function guardar(){
	var oform = document.getElementById("pldedm");
	// validaciones de campos obligatorios.
	if(document.getElementById("cdedid").value ==""){
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
function borrar(){
	var xkeyid = document.getElementById("cdedid").value;
	if(xkeyid != ""){
		if (!confirm("Esta seguro de borrar este registro")){
			return ;
		}
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("cdedid",xkeyid);
		oDatos.append("accion","DELETE");
		// obteniendo el menu
		oRequest.open("POST","../modelo/crud_pldedm.php",false); 
		oRequest.send(oDatos);
		get_clear_view();
	}else{
		getmsgalert("No ha indicado un codigo para borrar");
	}
}
function valid_key(){
	var lcxkeyvalue = document.getElementById("cdedid").value;
	if (lcxkeyvalue != ""){	
		update_window(lcxkeyvalue,"btcdedid");
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
	oDatos.append("cdedid",pckeyid);
	oDatos.append("accion","JSON");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_pldedm.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){
		document.getElementById("cdedid").value   = odata.cdedid;
		document.getElementById("cdesc").value 	  = odata.cdesc;
		document.getElementById("cstatus").value  = odata.cstatus;
		document.getElementById("cdescsh").value  = odata.cdescsh;
		document.getElementById("cctaid_d").value = odata.cctaid_d;
		document.getElementById("cctaid_h").value = odata.cctaid_h;
		document.getElementById("nvalue").value   = odata.nvalue;
		document.getElementById("mnotas").value   = odata.mnotas;

		document.getElementById("lclear").checked = (odata.lclear == "1")? true:false;
		estado_key("I");
	}else{
		ck_new_key();
	}
}
window.onload=init;

