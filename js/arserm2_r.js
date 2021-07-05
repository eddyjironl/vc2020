var xMenuId = "";
function init(){
	document.getElementById("btquit").addEventListener("click",cerrar_pantalla,false);
	document.getElementById("btprint").addEventListener("click",print,false);
	document.getElementById("btnueva").addEventListener("click",nueva,false);
	// ------------------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	// clientes
	document.getElementById("btcrespno_1").addEventListener("click",show_menu_arresp,false);
	document.getElementById("btcrespno_2").addEventListener("click",show_menu_arresp,false);
	// bodega
	document.getElementById("btctserno_1").addEventListener("click",show_menu_artser,false);
	document.getElementById("btctserno_2").addEventListener("click",show_menu_artser,false);
	
	// una funcion de ordenamiento segun el menu que se elija.
	// Lista de ordenamiento
	document.getElementById("mx_opc_order").addEventListener("click",get_mx_detalle,false);
	// opcion de busqueda
	document.getElementById("mx_cbuscar").addEventListener("input",get_mx_detalle,false);
	// ------------------------------------------------------------------------
}
function nueva(){
	var objects = document.querySelectorAll("input");
	var olista = document.querySelectorAll("select");
	for (var i=0; i<objects.length; i++){
		objects[i].value = "";
	}
	
	// setiando los selects
	for (var i= 0; i<olista.length; i++){
		olista[i].value = "''";
	}
}

function cerrar_pantalla(){
	document.getElementById("arserm2_r").style.display="none";
}
function print(){
 document.getElementById("arserm2_r").submit();
}
// ----------------------------------------------------------------------
// MENU DE CLIENTES.
// ----------------------------------------------------------------------
function get_mx_detalle(){
	if (xMenuId == "btcrespno_1") {get_mx_detalle_arresp();}
	if (xMenuId == "btcrespno_2") {get_mx_detalle_arresp();}

	if (xMenuId == "btctserno_1") {get_mx_detalle_artser();}
	if (xMenuId == "btctserno_2") {get_mx_detalle_artser();}
}
function select_xkey(e){
	var lckey  = e.currentTarget.cells[0].innerText;
	var lcdesc = e.currentTarget.cells[1].innerText;
	//document.getElementById("ccustno").value = lckey;
	cerrar_mx_view();
	// refrescando el valor.
	if (xMenuId == "btcrespno_1"){document.getElementById("crespno_1").value = lckey;}
	if (xMenuId == "btcrespno_2"){document.getElementById("crespno_2").value = lckey;}
	// bodega
	if (xMenuId == "btctserno_1"){document.getElementById("ctserno_1").value = lckey;}
	if (xMenuId == "btctserno_2"){document.getElementById("ctserno_2").value = lckey;}
}
// Los diferentes menus
function show_menu_artser(e){
	// menu que llamo el comando.
	xMenuId = e.target.id;
	
	document.getElementById("xm_area_menu").style.display="inline";
	var o_mx_lista = "";
	// armando el listado
	o_mx_lista += '	<select class="listas" id="mx_opc_order"> ';
	o_mx_lista += ' 	<option value = "ctserno">Tipo Id</option> ';
	o_mx_lista += '		<option value = "cdesc">Descripcion</option> ';
	o_mx_lista += '	</select> ';
	// armando el encabezado 
	var o_mx_Header = "";
	o_mx_Header += ' <table id="mx_head" class="table_det"> ';
	o_mx_Header += '	<thead> ';
	o_mx_Header += '		<tr> ';
	o_mx_Header += '			<td width="70px">Tipo Articulo</td> ';
	o_mx_Header += '			<td width="200px">Descripcion </td> ';
	o_mx_Header += '		</tr> ';
	o_mx_Header += '	</thead> ';
	o_mx_Header += '</table> ';
	// armando detalle de contenidos.
	// cambiando el encabezado .
	document.getElementById("mx_head").innerHTML      = o_mx_Header;
	document.getElementById("mx_opc_order").innerHTML = o_mx_lista;
	get_mx_detalle_artser();
}
function get_mx_detalle_artser(){
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
function show_menu_arresp(e){
	// menu que llamo el comando.
	xMenuId = e.target.id;
	
	document.getElementById("xm_area_menu").style.display="inline";
	var o_mx_lista = "";
	// armando el listado
	o_mx_lista += '	<select class="listas" id="mx_opc_order"> ';
	o_mx_lista += ' 	<option value = "crespno">Responsable Id</option> ';
	o_mx_lista += '		<option value = "cfullname">Nombre Completo</option> ';
	o_mx_lista += '	</select> ';
	// armando el encabezado 
	var o_mx_Header = "";
	o_mx_Header += ' <table id="mx_head" class="table_det"> ';
	o_mx_Header += '	<thead> ';
	o_mx_Header += '		<tr> ';
	o_mx_Header += '			<td width="70px">Responsable Id</td> ';
	o_mx_Header += '			<td width="200px">Nombre Completo</td> ';
	o_mx_Header += '		</tr> ';
	o_mx_Header += '	</thead> ';
	o_mx_Header += '</table> ';
	// armando detalle de contenidos.
	// cambiando el encabezado .
	document.getElementById("mx_head").innerHTML      = o_mx_Header;
	document.getElementById("mx_opc_order").innerHTML = o_mx_lista;
	get_mx_detalle_arresp();
}
function get_mx_detalle_arresp(){
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
		oRequest.open("POST","../modelo/crud_arresp.php",false); 
		oRequest.send(oDatos);
		var odata = JSON.parse(oRequest.response);
		//cargando los valores de la pantalla.
		if (odata != null){
			var lnrows = odata.length;
			var o_mx_detalles = '<table id="mx_detalle"> ';
			o_mx_detalles += '<tbody>';
			for (var i = 0; lnrows > i; ++i){
				o_mx_detalles += '<tr class="xm_row_menu"> ';
				o_mx_detalles += '	<td width="70px"> '+ odata[i]["crespno"]  + '</td> ';
				o_mx_detalles += '	<td width="200px">'+ odata[i]["cfullname"]+ '</td> ';
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

window.onload=init;