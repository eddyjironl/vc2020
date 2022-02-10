function init(){

    document.getElementById("btcplano").addEventListener("click",function(){
        get_menu_list("plmast","showmenulist","cplano");
    },false);


    document.getElementById("cplano").addEventListener("blur",valid_key,false);

    document.getElementById("add").addEventListener("click",show_screen_plmast_add,false);
    document.getElementById("quit").addEventListener("click",cerrar_pantalla,false);
    // ----------------------------------------------------------------------------------------------
}
function reset_msg(){
	document.getElementById("msg").innerHTML="";
}
function deleteRow(pcuid){
	var xkeyid = pcuid;
	if(xkeyid != ""){
		if (!confirm("Esta seguro de borrar este registro")){
			return ;
		}
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("cuid",xkeyid);
		oDatos.append("cplano",document.getElementById("cplano").value);
		oDatos.append("accion","DELETE_ROW");
		// obteniendo el menu
		oRequest.open("POST","../modelo/crud_plmast.php",false); 
		oRequest.send(oDatos);
		// desplegando pantalla de menu con su informacion.
		var odata = oRequest.responseText;
		document.getElementById("mx_detalle").innerHTML = odata;
	}
}
function edit_row(pcuid){
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("cuid",pcuid);
		oDatos.append("accion","EDIT_ROW");
		// obteniendo el menu
		oRequest.open("POST","../modelo/crud_plmast.php",false); 
		oRequest.send(oDatos);
		var odata = JSON.parse(oRequest.response);
		//cargando los valores de la pantalla.
		if (odata != null){
			show_screen_plmast_add();
			document.getElementById("cuid").value = odata.cuid;
			document.getElementById("cdeptno").value = odata.cdeptno;
			document.getElementById("cdesc1").value = odata.cdesc1;
			
		}
}
function get_clear_view_plmast(){
	get_clear_view();
	document.getElementById("mx_detalle").innerHTML = "";
}
function show_screen_plmast_add(){
	clear_window_plmast_add();
    document.getElementById("plmast_add").style.display="inline";
}
function cerrar_pantalla_principal(){
    document.getElementById("plmast").style.display="none";
}
function cerrar_pantalla(e){
	var oform = e.target.form.id;
    document.getElementById(oform).style.display = "none";
}
function guardar(){
	var oform = document.getElementById("plmast");
	// validaciones de campos obligatorios.
	if(document.getElementById("cplano").value ==""){
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
	var xkeyid = document.getElementById("cplano").value;
	if(xkeyid != ""){
		if (!confirm("Esta seguro de borrar este registro")){
			return ;
		}
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("cplano",xkeyid);
		oDatos.append("accion","DELETE");
		// obteniendo el menu
		oRequest.open("POST","../modelo/crud_plmast.php",false); 
		oRequest.send(oDatos);
		get_clear_view();
	}else{
		getmsgalert("No ha indicado un codigo para borrar");
	}
}
function valid_key(){
	var lcxkeyvalue = document.getElementById("cplano").value;
	if (lcxkeyvalue != ""){	
		update_window(lcxkeyvalue,"btcplano");
	}	
}
function valid_dept(){
	// refrescando descripcion del departamento
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cdeptno",document.getElementById("cdeptno").value);
	oDatos.append("accion","JSON");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_pldepm.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){
		document.getElementById("cdesc1").value = odata.cdesc;
	}else{
		alert("Codigo de Departamento Imvalido");
	}	
}
function add_new_dept(){
	if (document.getElementById("cplano").value == ""){
		alert("Codigo de planilla Vacio");
		return 
	}
	if (document.getElementById("cdeptno").value == ""){
		alert("Campo departamento sin codigo");
		return 
	}
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cuid",document.getElementById("cuid").value);
	oDatos.append("cplano",document.getElementById("cplano").value);
	oDatos.append("cdeptno",document.getElementById("cdeptno").value);
	oDatos.append("accion","NEW_DEPT_DETAIL");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_plmast.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = oRequest.responseText;
	document.getElementById("plmast_add").style.display = "none";
	document.getElementById("mx_detalle").innerHTML = odata;

}
function clear_window_plmast_add(){
	document.getElementById("cuid").value="";
	document.getElementById("cdeptno").value="";
	document.getElementById("cdesc1").value="";
}
function upd_dept_detail(pckeyid){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cplano",pckeyid);
	oDatos.append("accion","SHOW_DETAIL_DEPT");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_plmast.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = oRequest.responseText;
	document.getElementById("mx_detalle").innerHTML = odata;
	
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
	oDatos.append("cplano",pckeyid);
	oDatos.append("accion","JSON");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_plmast.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){
		document.getElementById("cplano").value  = odata.cplano;
		document.getElementById("cdesc").value 	 = odata.cdesc;
		document.getElementById("cstatus").value = odata.cstatus;
        document.getElementById("ctypemp").value = odata.ctypemp;
        document.getElementById("ctyppay").value = odata.ctyppay;
        document.getElementById("cmonth").value  = odata.cmonth;
        document.getElementById("tstar").value   = odata.tstar;
        document.getElementById("tend").value    = odata.tend;
        document.getElementById("dpay").value    = odata.dpay;
		upd_dept_detail(odata.cplano);
        estado_key("I");
		reset_msg();
	}else{
		ck_new_key();
	}
}

window.onload=init;