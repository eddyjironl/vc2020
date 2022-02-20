// iniciando carga
function init(){
	document.getElementById("btnueva").addEventListener("click",get_clear_view,false);
	document.getElementById("btguardar").addEventListener("click",guardar,false);
	document.getElementById("btdelete").addEventListener("click",borrar,false);
	document.getElementById("btquit").addEventListener("click",cerrar_pantalla_principal,false);
	// configurando las variables de estado.
	gckeyid   = "crespno";
	gckeydesc = "cfullname";
	gcbtkeyid = "btcrespno";

	document.getElementById("cfoto").addEventListener("change",show_foto,false);
	document.getElementById("crespno").addEventListener("change",valid_ckeyid,false);
	document.getElementById("btcrespno").addEventListener("click",function(){
        get_menu_list("arresp","showmenulist","crespno");
    },false);
}
function cerrar_pantalla_principal(){
	arresp.style.display="none";
}
function show_foto(){
	//"../photos/"+odata.cfoto
	var lcfoto = document.getElementById("cfoto").value;
	document.getElementById("cfoto1").setAttribute("src",lcfoto) ;
}
function guardar(){
	var oform = document.getElementById("arresp");
	// validaciones de campos obligatorios.
	if(document.getElementById("crespno").value ==""){
		getmsgalert("Falta el codigo de Proveedor");
		return ;
	}
	if(document.getElementById("cfullname").value ==""){
		getmsgalert("Falta el Nombre del Proveedor");
		return ;
	}
	if(document.getElementById("cstatus").value ==""){
		getmsgalert("No indico Estado del proveedor");
		return ;
	}
	if(document.getElementById("mtel").value ==""){
		getmsgalert("Indique un telefono de contacto");
		return ;
	}

	oform.submit();
}
function borrar(){
	var xkeyid = document.getElementById("crespno").value;
	if(xkeyid != ""){
		if (!confirm("Esta seguro de borrar este registro")){
			return ;
		}
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("crespno",xkeyid);
		oDatos.append("accion","DELETE");
		// obteniendo el menu
		oRequest.open("POST","../modelo/crud_arresp.php",false); 
		oRequest.send(oDatos);
		get_clear_view();
	}else{
		getmsgalert("No ha indicado un codigo de proveedor para borrar");
	}
}
// este procedimiento utiliza la vupdate_window(pckeyid,pcmenuid)entana de menu y la despliega y rellena los contenidos con el request.		;
function valid_ckeyid(){
	var lcrespno = document.getElementById("crespno").value;
	if(lcrespno !=""){
		update_window(lcrespno,"btcrespno");
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
	oDatos.append("crespno",pckeyid);
	oDatos.append("accion","JSON");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_arresp.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){
		document.getElementById("crespno").value = odata.crespno;
		document.getElementById("cstatus").value = odata.cstatus;
		document.getElementById("cctaid").value  = odata.cctaid;
		document.getElementById("cruc").value    = odata.cruc;
		document.getElementById("mtel").value    = odata.mtels;
		document.getElementById("ncomision").value = odata.ncomision;
		document.getElementById("mdirecc").value = odata.mdirecc;
		document.getElementById("mnotas").value  = odata.mnotas;
		document.getElementById("cfoto1").setAttribute("src",odata.cfoto) ;
		document.getElementById("cfullname").value = odata.cfullname;
		document.getElementById("ndays").value   = odata.ndays;
		// configurando los dias de la semana
		document.getElementById("llunes").checked = (odata.llunes == "1")? true:false;
		document.getElementById("lmartes").checked = (odata.lmartes == "1")? true:false;
		document.getElementById("lmiercoles").checked = (odata.lmiercoles == "1")? true:false;
		document.getElementById("ljueves").checked = (odata.ljueves == "1")? true:false;
		document.getElementById("lviernes").checked = (odata.lviernes == "1")? true:false;
		document.getElementById("lsabado").checked = (odata.lsabado == "1")? true:false;
		document.getElementById("ldomingo").checked = (odata.ldomingo == "1")? true:false;
		estado_key("I");
	}else{
		ck_new_key();
	}
}
			
window.onload=init;
