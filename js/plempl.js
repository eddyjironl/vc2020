function init(){
	document.getElementById("btquit").addEventListener("click",cerrar_pantalla_principal,false);
	document.getElementById("btguardar").addEventListener("click",guardar,false);
	document.getElementById("btnueva").addEventListener("click",nueva,false);
	document.getElementById("btdelete").addEventListener("click",borrar,false);
	
	//document.getElementById("btccateno").addEventListener("click",getmenulist,false);
	// configurando las variables de estado.
	gckeyid   = "cempno";
	gckeydesc = "cfullname";
	gcbtkeyid = "btccempno";
	//------------------------------------------------------------------
	// configurando los botones del tab.
	document.getElementById("tbinfo1").addEventListener("click",tabshow,false);
	document.getElementById("tbinfo2").addEventListener("click",tabshow,false);
	document.getElementById("tbinfo3").addEventListener("click",tabshow,false);

	document.getElementById("finfo1").style.display = "block";
	document.getElementById("tbinfo1").setAttribute("class","active");

	// -----------------------------------------------------------------
	// ------------------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	// menu de empleados
	document.getElementById("btccempno").addEventListener("click",function(){
        get_menu_list("plempl","showmenulist","cempno");
    },false);
	
	// menu de ingresos/
	document.getElementById("btcingid").addEventListener("click",function(){
        get_menu_list("plingm","showmenulist","cingid");
    },false);

	document.getElementById("btcdedid1").addEventListener("click",function(){
        get_menu_list("pldedm","showmenulist","cdedid1");
    },false);

	document.getElementById("cempno").addEventListener("blur",valid_ckeyid,false);
	document.getElementById("cdedid1").addEventListener("blur",valid_deduction,false);
	document.getElementById("cingid").addEventListener("blur",valid_ingresos,false);
	
	// ------------------------------------------------------------------------	
	// adicionando deducciones e ingresos
	// ocultando la ventana de adicion de deducciones.
	document.getElementById("add_deduction").style.display = "none";
	document.getElementById("add_ingresos").style.display = "none";

	document.getElementById("btadd").addEventListener("click",show_add_deduction,false);
	document.getElementById("btadd2").addEventListener("click",show_add_ingresos,false);

	document.getElementById("btsalvar").addEventListener("click",add_deduction,false);
	document.getElementById("btsalvar_ing").addEventListener("click",add_ingresos,false);
	
	document.getElementById("btquit_ded").addEventListener("click",close_add_deduction,false);
	document.getElementById("btquit_ing").addEventListener("click",close_add_ingresos,false);
	// inicializando estado de pantalla de adicionar deducciones.
	starinitformded();
}

// valida la deduccion escrita en el campo deduccion de la pantalla de agregar deducciones.
function valid_deduction(){
	// ---------------------------------------------------------------------------------------------------------
	// a)- Verificando que el articulo exista.
	// ---------------------------------------------------------------------------------------------------------
	// haciendo request que devuelva el contenido de la fila en formato JSON.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos  = new FormData();
	var lcdedid = document.getElementById("cdedid1").value ;
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","JSON");
	oDatos.append("cdedid",lcdedid);
	// enviando el request.
	oRequest.open("POST","../modelo/crud_pldedm.php",false); 
	oRequest.send(oDatos);
	// recibiendo el json.
	var odata = JSON.parse(oRequest.response); 
	// mostrando pantalla de edicion de archivo
	if (odata == null){
		document.getElementById("cdedid1").value = "";
		getmsgalert("Codigo de Deduccion no registrada");
		return;
	}	
	document.getElementById("cdesc_ded").value = odata["cdesc"];
	document.getElementById("lapply").value = odata["lapply"];

}
function valid_ingresos(){
	// ---------------------------------------------------------------------------------------------------------
	// a)- Verificando que el articulo exista.
	// ---------------------------------------------------------------------------------------------------------
	// haciendo request que devuelva el contenido de la fila en formato JSON.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos  = new FormData();
	var lcingid = document.getElementById("cingid").value ;
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","JSON");
	oDatos.append("cingid",lcingid);
	// enviando el request.
	oRequest.open("POST","../modelo/crud_plingm.php",false); 
	oRequest.send(oDatos);
	// recibiendo el json.
	var odata = JSON.parse(oRequest.response); 
	// mostrando pantalla de edicion de archivo
	if (odata == null){
		document.getElementById("cingid").value = "";
		getmsgalert("Codigo de Ingresos no registrada");
		return;
	}	
	document.getElementById("cdesc_ing").value = odata["cdesc"];
	document.getElementById("lapply_ing").value = odata["lapply"];

}
// solo habre la pantalla de agregar deducciones
function show_add_deduction(){
	document.getElementById("add_deduction").style.display = "inline";
}
function show_add_ingresos(){
	document.getElementById("add_ingresos").style.display = "inline";
}
// solo cierra la pantalla de agregar deduccioens
function close_add_deduction(){
	document.getElementById("add_deduction").style.display = "none";
	starinitformded();
}
function close_add_ingresos(){
	document.getElementById("add_ingresos").style.display = "none";
	starinitformded();
}

function starinitformded(){
	// pantalla de deducciones.
	document.getElementById("cuid").value      = "";
	document.getElementById("cdedid1").value   = ""
	document.getElementById("nvalue_d").value  = 0.00;
	document.getElementById("crefno").value	   = "";
	document.getElementById("lapply_d").value  = 0;
	document.getElementById("npayamt").value   = 0.00;
	document.getElementById("cdesc_ded").value = "";
	// pantalla de ingresos
	document.getElementById("cuid_ing").value   = "";
	document.getElementById("cingid").value     = "";
	document.getElementById("nvalue_ing").value = 0.00;
	document.getElementById("lapply_ing").value = 0;
	document.getElementById("cdesc_ing").value  = "";
}

function add_deduction(){
	// deduccion a procesar
	var lcdedid = document.getElementById("cdedid1").value;
	var lcempno = document.getElementById("cempno").value;
	if(lcdedid == ""){
		alert("Deduccion no indicada");
		return ;
	}
	if (lcempno == ""){
		alert("Codigo de empleado Vacio");
		return ;
	}
	if (document.getElementById("nvalue_d").value == ""){
		alert("Valor de la deduccion no indicada");
		return ;
	}
	if (document.getElementById("npayamt").value == ""){
		alert("Valor de la Cuota no indicada");
		return ;
	}
	
	// ---------------------------------------------------------------------------------------------------------
	// a)- Verificando que el articulo exista.
	// ---------------------------------------------------------------------------------------------------------
	// haciendo request que devuelva el contenido de la fila en formato JSON.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","ADD_DEDT");
	oDatos.append("cuid", document.getElementById("cuid").value);
	oDatos.append("cempno", lcempno);
	oDatos.append("cdedid", lcdedid);
	oDatos.append("cdesc", document.getElementById("cdesc_ded").value);
	oDatos.append("nvalue", document.getElementById("nvalue_d").value);
	oDatos.append("npayamt",document.getElementById("npayamt").value);
	oDatos.append("crefno",document.getElementById("crefno").value);
	oDatos.append("lapply",document.getElementById("lapply_d").value);
	// enviando el request.
	oRequest.open("POST","../modelo/crud_plempl.php",false); 
	oRequest.send(oDatos);
	// recibiendo el json.
	var odata = oRequest.response; 
	// mostrando pantalla de edicion de archivo
	if (odata == null){
		getmsgalert("Codigo de Deduccion no registrada");
		return;
	}	
	// cerrando la pantalla de adicion de deducciones.
	close_add_deduction();
	// refrescando las deducciones existentes.
	create_table_deductions(odata);
}

function add_ingresos(){
	// deduccion a procesar
	var lcingid = document.getElementById("cingid").value;
	var lcempno = document.getElementById("cempno").value;
	if(lcingid == ""){
		alert("Ingreso no indicada");
		return ;
	}
	if (lcempno == ""){
		alert("Codigo de empleado Vacio");
		return ;
	}
	if (document.getElementById("nvalue_ing").value == ""){
		alert("Valor del ingreso no indicada");
		return ;
	}
	
	// ---------------------------------------------------------------------------------------------------------
	// a)- Verificando que el articulo exista.
	// ---------------------------------------------------------------------------------------------------------
	// haciendo request que devuelva el contenido de la fila en formato JSON.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion", "ADD_INGRESOS");
	oDatos.append("cuid",   document.getElementById("cuid_ing").value);
	oDatos.append("cempno", lcempno);
	oDatos.append("cingid", lcingid);
	oDatos.append("cdesc",  document.getElementById("cdesc_ing").value);
	oDatos.append("nvalue", document.getElementById("nvalue_ing").value);
	oDatos.append("lapply", document.getElementById("lapply_ing").value);
	// enviando el request.
	oRequest.open("POST","../modelo/crud_plempl.php",false); 
	oRequest.send(oDatos);
	// recibiendo el json.
	var odata = oRequest.response; 
	// mostrando pantalla de edicion de archivo
	if (odata == null){
		getmsgalert("Codigo de Ingreso no registrada");
		return;
	}	
	// cerrando la pantalla de adicion de deducciones.
	close_add_ingresos();
	// refrescando las deducciones existentes.
	document.getElementById("det_ingresos").innerHTML = odata;
}

function nueva(){
	get_clear_view();
	document.getElementById("det_deducciones").innerHTML="";
	document.getElementById("det_ingresos").innerHTML="";
}
// -----------------------------------------------------------------------

// cerrar pantalla principal
function cerrar_pantalla_principal(){
	document.getElementById("plempl").style.display="none";
}
// guardar registro principal
function guardar(){
	var oform = document.getElementById("plempl");
	// validaciones de campos obligatorios.
	if(document.getElementById("cempno").value ==""){
		getmsgalert("Indique el codigo de empleado");
		return ;
	}
	if(document.getElementById("cfullname").value ==""){
		getmsgalert("Indique el nombre del Empleado");
		return ;
	}
	
	oform.submit();
}
// borrando registro principal
function borrar(){
	var xkeyid = document.getElementById("cempno").value;
	if(xkeyid != ""){
		if (!confirm("Esta seguro de borrar este registro")){
			return ;
		}
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("cempno",xkeyid);
		oDatos.append("accion","DELETE");
		// obteniendo el menu
		oRequest.open("POST","../modelo/crud_plempl.php",false); 
		oRequest.send(oDatos);
		get_clear_view();
	}else{
		getmsgalert("No ha indicado un codigo para borrar");
	}
}
	
function valid_ckeyid(){
	var lcxkeyvalue = document.getElementById("cempno").value;

	if (lcxkeyvalue != ""){	
		update_window(lcxkeyvalue,"btccempno");
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
	oDatos.append("cempno",pckeyid);
	oDatos.append("accion","LIST");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_plempl.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){
		document.getElementById("cempno").value    = odata.cempno;
		document.getElementById("cfullname").value = odata.cfullname;
		document.getElementById("ccedid").value    = odata.ccedid;
		document.getElementById("dnacday").value   = odata.dnacday;
		document.getElementById("cmarital").value  = odata.cmarital;
		document.getElementById("csexo").value     = odata.csexo;
		document.getElementById("mnotas").value    = odata.mnotas;
		document.getElementById("mdirecc").value   = odata.mdirecc;
		document.getElementById("mtels").value     = odata.mtels;
		document.getElementById("dstar").value     = odata.dstar;
		document.getElementById("dend").value      = odata.dend;
		document.getElementById("cstatus").value   = odata.cstatus;
		document.getElementById("cdescmot").value  = odata.cdescmot;
		document.getElementById("cworkid").value   = odata.cworkid;
		document.getElementById("cdeptno").value   = odata.cdeptno;
		document.getElementById("cturno").value    = odata.cturno;
		document.getElementById("nsalary").value   = odata.nsalary;
		document.getElementById("nhrate").value    = odata.nhrate;
		document.getElementById("nhratext").value  = odata.nhratext;
		document.getElementById("ctypemp").value   = odata.ctypemp;
		document.getElementById("ctyppay").value   = odata.ctyppay;
		document.getElementById("ctyppay2").value  = odata.ctyppay2;
		document.getElementById("nsetpay").value   = odata.nsetpay;
		document.getElementById("cins").value      = odata.cins;
		document.getElementById("lnotausent").checked = (odata.lnotausent == "1")? true:false;
		// refrescando deducciones e ingresos.

		display_deductions(pckeyid);
		display_ingresos(pckeyid)
		// cambiando el estado de la pantalla.
		estado_key("I");
	}else{
		ck_new_key();
	}
}

function display_deductions(pcempno){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cempno",pcempno);
	oDatos.append("accion","deductions");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_plempl.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = oRequest.response;
	// CARGANDO TABLA.
	create_table_deductions(odata);
}

function create_table_deductions(odata){
	document.getElementById("det_deducciones").innerHTML = odata;

	// actualizar las funciones de las deducciones en la tabla.
	var otable_ded = document.getElementById("det_deducciones");
	var lnveces = otable_ded.rows.length;
	for (var i=0; i< lnveces; ++i){
		
		otable_ded.rows[i].cells[2].addEventListener("change",
		function(){
			otable_ded.rows[i].cells[3].children["nsaldo"].value = otable_ded.rows[i].cells[2].children["nvalue"].value;

		},false);
	}

}
function display_ingresos(pcempno){	
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cempno",pcempno);
	oDatos.append("accion","ingresos");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_plempl.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = oRequest.response;
	// CARGANDO TABLA.
	document.getElementById("det_ingresos").innerHTML = odata;

}

function tabshow(e){
	// evitando que el tipo de boton haga un submit por defecto y recargue la pagina.
	e.preventDefault();
	var oTabFormBoton = e.target.id;
	
	// poniendo ocultos todos los div pantallas ocultos
	var oTabForm = document.getElementsByClassName("tabcontent");
	for (i = 0; i < oTabForm.length; i++) {
		oTabForm[i].style.display = "none";
	}
	if(oTabFormBoton == "tbinfo1"){
		document.getElementById("finfo1").style.display = "block";
		document.getElementById("tbinfo2").setAttribute("class","")
		document.getElementById("tbinfo3").setAttribute("class","")
	}
	
	if(oTabFormBoton == "tbinfo2"){
		document.getElementById("finfo2").style.display = "block";
		document.getElementById("tbinfo1").setAttribute("class","")
		document.getElementById("tbinfo3").setAttribute("class","")
	}

	if(oTabFormBoton == "tbinfo3"){
		document.getElementById("finfo3").style.display = "block";
		document.getElementById("tbinfo2").setAttribute("class","")
		document.getElementById("tbinfo1").setAttribute("class","")
	}
	document.getElementById(oTabFormBoton).setAttribute("class","active");

}
function edit_deduction(pcuid){
	var oRequest = new XMLHttpRequest();
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cuid",pcuid);
	oDatos.append("accion","GET_INFO_DEDUCTION");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_plempl.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	if (odata == null){
		getmsgalert("Codigo de identificacion no registrada");
		return;
	}
	// Datos de la linea de deduccion.
	document.getElementById("cuid").value      = odata["cuid"];
	document.getElementById("cdedid1").value   = odata["cdedid"];
	document.getElementById("nvalue_d").value  = odata["nvalue"];
	document.getElementById("crefno").value	   = odata["crefno"];
	document.getElementById("lapply_d").value  = odata["lapply"];
	document.getElementById("npayamt").value   = odata["npayamt"];
	document.getElementById("cdesc_ded").value = odata["cdesc"];
	show_add_deduction();
}
function edit_ingresos(pcuid){
	var oRequest = new XMLHttpRequest();
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cuid",pcuid);
	oDatos.append("accion","GET_INFO_INGRESOS");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_plempl.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	if (odata == null){
		getmsgalert("Codigo de identificacion no registrada");
		return;
	}
	// Datos de la linea de deduccion.
	document.getElementById("cuid_ing").value   = odata["cuid"];
	document.getElementById("cingid").value     = odata["cingid"];
	document.getElementById("nvalue_ing").value = odata["nvalue"];
	document.getElementById("lapply_ing").value = odata["lapply"];
	document.getElementById("cdesc_ing").value  = odata["cdesc"];
	show_add_ingresos();
}

function delete_deduction(pcuid){
	var oRequest = new XMLHttpRequest();
	var oDatos   = new FormData();
	if (!confirm("Esta seguro de borrar este registro")){
		return ;
	}
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cuid",pcuid);
	oDatos.append("cempno",document.getElementById("cempno").value);
	oDatos.append("accion","DELETE_DED_LIST");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_plempl.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = oRequest.response;
	// CARGANDO TABLA.
	create_table_deductions(odata);
}	

function delete_ingreso(pcuid){
	var oRequest = new XMLHttpRequest();
	var oDatos   = new FormData();
	if (!confirm("Esta seguro de borrar este registro")){
		return ;
	}
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cuid",pcuid);
	oDatos.append("cempno",document.getElementById("cempno").value);
	oDatos.append("accion","DELETE_ING_LIST");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_plempl.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = oRequest.response;
	// CARGANDO TABLA.
	document.getElementById("det_ingresos").innerHTML = odata;
	//display_ingresos();

}



window.onload=init;