function init(){
	document.getElementById("btquit").addEventListener("click",cerrar_pantalla_principal,false);
	document.getElementById("btguardar").addEventListener("click",guardar,false);
	document.getElementById("btnueva").addEventListener("click",clear_view,false);
	document.getElementById("btdelete").addEventListener("click",borrar,false);
	//document.getElementById("btctserno").addEventListener("click",getmenulist,false);
	// configurando las variables de estado.
	gckeyid   = "cmonid";
	gckeydesc = "cdesc";
	gcbtkeyid = "btcmonid";
	// ------------------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	document.getElementById("cmonid").addEventListener("change",valid_ckeyid,false);
	document.getElementById("btcmonid").addEventListener("click",function(){
        get_menu_list("cgmonm","showmenulist","cmonid");
    },false);

	// ------------------------------------------------------------------------	

	document.getElementById("cmdquit").addEventListener("click",close_form_cgmond,false);
    document.getElementById("cmdadd").addEventListener("click",show_form_cgmond,false);
    document.getElementById("cmdsave").addEventListener("click",guardar_tc,false);
    document.getElementById("cgmond").style.display="none";
}
function editRow(pcuid){
	var oRequest  = new XMLHttpRequest();
    // Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
    // adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cuid",pcuid);
	oDatos.append("accion","JSON_ID");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_cgmonm.php",false); 
	oRequest.send(oDatos);
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){
		document.getElementById("cmonid1").value  = odata.cmonid;
		document.getElementById("cuid").value     = odata.cuid ;
		document.getElementById("ntc").value      = odata.ntc;
		document.getElementById("dtrndate").value = odata.dtrndate;
		show_form_cgmond();
	}

}
function deleteRow(pcuid){
	var oRequest  = new XMLHttpRequest();
    // Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
    // adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cuid",pcuid);
	oDatos.append("accion","DELETEROW");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_cgmonm.php",false); 
	oRequest.send(oDatos);
	RefreshDetaliMoney(document.getElementById("cmonid").value);
}

function guardar_tc(){
    var xkeyid    = document.getElementById("cmonid").value;
    var cuid      = document.getElementById("cuid").value;
	var lntc      = document.getElementById("ntc").value;
    var ldtrndate = document.getElementById("dtrndate").value;
    var oRequest  = new XMLHttpRequest();
    // Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
    // adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cuid",cuid);
	oDatos.append("cmonid",xkeyid);
	oDatos.append("dtrndate",ldtrndate);
	oDatos.append("ntc",lntc);
	oDatos.append("accion","NEWLINE");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_cgmonm.php",false); 
	oRequest.send(oDatos);
	//get_clear_view();
    RefreshDetaliMoney(xkeyid);
    close_form_cgmond();
}
function show_form_cgmond(){
    let lcmonid = document.getElementById("cmonid").value;
    if (lcmonid == ""){
        alert("Especifique codigo de la moneda");
        return 
    }
    document.getElementById("cmonid1").value =  lcmonid;
    document.getElementById("cdesc1").value = document.getElementById("cdesc").value ;
    document.getElementById("cgmond").style.display="inline-block";
}
function close_form_cgmond(){
    document.getElementById("cuid").value = "";
    document.getElementById("cmonid1").value = "";
    document.getElementById("cdesc1").value  = "" ;
    document.getElementById("ntc").value = "";
    document.getElementById("dtrndate").value = "";
    document.getElementById("cgmond").style.display="none";
}
// cerrar pantalla principal
function cerrar_pantalla_principal(){
	document.getElementById("cgmonm").style.display="none";
}
// guardar registro principal
function guardar(){
	var oform = document.getElementById("cgmonm");
	// validaciones de campos obligatorios.
	if(document.getElementById("cmonid").value ==""){
		getmsgalert("Falta el codigo de Moneda");
		return ;
	}
	if(document.getElementById("cdesc").value ==""){
		getmsgalert("Falta la descripcion de Moneda");
		return ;
	}
	oform.submit();
}
// borrando registro principal
function borrar(){
	var xkeyid = document.getElementById("cmonid").value;
	if(xkeyid != ""){
		if (!confirm("Esta seguro de borrar este registro")){
			return ;
		}
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("cmonid",xkeyid);
		oDatos.append("accion","DELETE");
		// obteniendo el menu
		oRequest.open("POST","../modelo/crud_cgmonm.php",false); 
		oRequest.send(oDatos);
		clear_view();
	}else{
		getmsgalert("No ha indicado un codigo para borrar");
	}
}
function valid_ckeyid(){
	var lcxkeyvalue = document.getElementById("cmonid").value;
	if(lcxkeyvalue != ""){
		update_window(lcxkeyvalue,"btcmonid");
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
	oDatos.append("cmonid",pckeyid);
	oDatos.append("accion","JSON");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_cgmonm.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){
		document.getElementById("cmonid").value   = odata.cmonid;
		document.getElementById("cdesc").value 	  = odata.cdesc;
		document.getElementById("mnotas").value   = odata.mnotas;
		document.getElementById("csimbolo").value = odata.csimbolo;
		document.getElementById("cmetodo").value  = odata.cmetodo;
        RefreshDetaliMoney(pckeyid);
		estado_key("I");
	}else{
		ck_new_key();
	}
}
function clear_view(){
    document.getElementById("tdetalles").innerHTML="";
    get_clear_view();
}
function RefreshDetaliMoney(pcmonid){
    var oRequest = new XMLHttpRequest();
    // Creando objeto para empaquetado de datos.
    var oDatos   = new FormData();
    // adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
    oDatos.append("cmonid",pcmonid);
    oDatos.append("accion","DETALLE_BAND");
    // obteniendo el menu
    oRequest.open("POST","../modelo/crud_cgmonm.php",false); 
    oRequest.send(oDatos);
    document.getElementById("tdetalles").innerHTML = oRequest.response;
}
window.onload=init;