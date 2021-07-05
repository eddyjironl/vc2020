function init(){
	document.getElementById("btquit").addEventListener("click",cerrar_pantalla_principal,false);
	document.getElementById("btguardar").addEventListener("click",guardar,false);
	document.getElementById("btnueva").addEventListener("click",get_clear_view,false);
	document.getElementById("btdelete").addEventListener("click",borrar,false);
	document.getElementById("ctserno").addEventListener("change",valid_ckeyid,false);
	//document.getElementById("btctserno").addEventListener("click",getmenulist,false);
	// configurando las variables de estado.
	gckeyid   = "ctserno";
	gckeydesc = "cdesc";
	gcbtkeyid = "btctserno";
	// ------------------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	document.getElementById("btctserno").addEventListener("click",show_menu_artser,false);
	//document.getElementById("bt_m_refresh").addEventListener("click",show_menu_arcust,false);
	// una funcion de ordenamiento segun el menu que se elija.
	// Lista de ordenamiento
	document.getElementById("mx_opc_order").addEventListener("click",get_mx_detalle,false);
	// opcion de busqueda
	document.getElementById("mx_cbuscar").addEventListener("input",get_mx_detalle,false);
	// ------------------------------------------------------------------------	
}
// ----------------------------------------------------------------------
// MENU DE CLIENTES.
// ----------------------------------------------------------------------

function show_menu_artser(){
	document.getElementById("xm_area_menu").style.display="inline";
	var o_mx_lista = "";
	// armando el listado
	o_mx_lista += '	<select class="listas" id="mx_opc_order"> ';
	o_mx_lista += ' 	<option value = "ctserno">Tipo de Articulo</option> ';
	o_mx_lista += '		<option value = "cdesc">Descripcion</option> ';
	o_mx_lista += '	</select> ';
	// armando el encabezado 
	var o_mx_Header = "";
	o_mx_Header += ' <table id="mx_head" class="table_det"> ';
	o_mx_Header += '	<thead> ';
	o_mx_Header += '		<tr> ';
	o_mx_Header += '			<td width="70px">Tipo Articulo</td> ';
	o_mx_Header += '			<td width="200px">Descripcion</td> ';
	o_mx_Header += '		</tr> ';
	o_mx_Header += '	</thead> ';
	o_mx_Header += '</table> ';
	// armando detalle de contenidos.
	// cambiando el encabezado .
	document.getElementById("mx_head").innerHTML = o_mx_Header;
	document.getElementById("mx_opc_order").innerHTML = o_mx_lista;
	get_mx_detalle();
}
// obteniendo el detalle de menus.
function get_mx_detalle(){
		// A) filtrando y ordenando el detalle.
		// ordenamiento por default
		var lcorder = document.getElementById("mx_opc_order").value;
		document.getElementById("mx_opc_order").value = lcorder;
		// filtro de busqueda por defecto
		var lcwhere = document.getElementById("mx_cbuscar").value;

		// ejecutando la insercion del nuevo usuario.
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("accion","MENU");
		oDatos.append("orden", lcorder);
		oDatos.append("filtro",lcwhere);
		oRequest.open("POST","../modelo/crud_artser.php",false); 
		oRequest.send(oDatos);
		var odata = JSON.parse(oRequest.response);
		//cargando los valores de la pantalla.
		if (odata != null){
			var lnrows = odata.length;
			var o_mx_detalles = '<table id="mx_detalle"> ';
			o_mx_detalles += '<tbody>';
			for (var i = 0; lnrows > i; ++i){
				o_mx_detalles += '<tr class="xm_row_menu"> ';
				o_mx_detalles += '	<td width="70px"> '+ odata[i]["ctserno"]  + '</td> ';
				o_mx_detalles += '	<td width="200px">'+ odata[i]["cdesc"]+ '</td> ';
				o_mx_detalles += '</tr> ';
			}
			o_mx_detalles += '</tbody> ';
		}else{
			o_mx_detalles = "<h1>No hay datos en el archivo</h1>";
		}
		document.getElementById("mx_detalle").innerHTML = o_mx_detalles;
		// aplicando el llamado de la funcion de seleccion
		var oRowDet = document.querySelectorAll("#mx_detalle tr");
		lnRows = oRowDet.length;
		for (var i=0; lnRows >i; ++i){
			oRowDet[i].addEventListener("click",select_xkey,false);
		}		
	}
function select_xkey(e){
	var lckey  = e.currentTarget.cells[0].innerText;
	var lcdesc = e.currentTarget.cells[1].innerText;
	document.getElementById("ctserno").value = lckey;
	cerrar_mx_view();
	update_window(lckey);
}

// -----------------------------------------------------------------------
// cerrar pantalla principal
function cerrar_pantalla_principal(){
	document.getElementById("artser").style.display="none";
}
// guardar registro principal
function guardar(){
	var oform = document.getElementById("artser");
	// validaciones de campos obligatorios.
	if(document.getElementById("ctserno").value ==""){
		getmsgalert("Falta el codigo del tipo de Inventario");
		return ;
	}
	if(document.getElementById("cdesc").value ==""){
		getmsgalert("Falta la descripcion del tipo inventario");
		return ;
	}
	oform.submit();
}
// borrando registro principal
function borrar(){
	var xkeyid = document.getElementById("ctserno").value;
	if(xkeyid != ""){
		if (!confirm("Esta seguro de borrar este registro")){
			return ;
		}
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("ctserno",xkeyid);
		oDatos.append("accion","DELETE");
		// obteniendo el menu
		oRequest.open("POST","../modelo/crud_artser.php",false); 
		oRequest.send(oDatos);
		get_clear_view();
	}else{
		getmsgalert("No ha indicado un codigo para borrar");
	}
}

function getmenulist(pcmenuid){
	var menuid  = pcmenuid.target.id;
	var oMenu   = document.getElementById("vmenu");
	var oLista  = document.getElementById("vlista");
	var oMhead  = document.getElementById("vcolumnas");
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","PANTALLA_MENU");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_artser.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	oLista.innerHTML = oRequest.responseText;
	oRequest.open("POST","../modelo/crud_artser.php",false); 
	oDatos.append("opcion","H");
	oRequest.send(oDatos);
	oMhead.innerHTML = oRequest.responseText;
	// habriendo el menu con los datos requeridos.
	oMenu.style.display = "block";
}
	
function valid_ckeyid(){
	var lcxkeyvalue = document.getElementById("ctserno").value;
	update_window(lcxkeyvalue,"btctserno");
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
	oDatos.append("ctserno",pckeyid);
	oDatos.append("accion","JSON");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_artser.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){
		document.getElementById("ctserno").value   = odata.ctserno;
		document.getElementById("cdesc").value 	   = odata.cdesc;
		document.getElementById("cstatus").value   = odata.cstatus;
		document.getElementById("mnotas").value    = odata.mnotas;
		estado_key("I");
	}else{
		ck_new_key();
	}
}
window.onload=init;