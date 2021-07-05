function init(){
    document.getElementById("cservno1").addEventListener("change",upddet,false);
	// -----------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	document.getElementById("btcservno").addEventListener("click",show_menu_arserm,false);
	// una funcion de ordenamiento segun el menu que se elija.
	// Lista de ordenamiento
	document.getElementById("mx_opc_order").addEventListener("click",get_mx_detalle,false);
	// opcion de busqueda
	document.getElementById("mx_cbuscar").addEventListener("input",get_mx_detalle,false);
	document.getElementById("dmnotas").style.display="none"
	document.getElementById("guardar_mnotas").addEventListener("click",guardar_comentario,false);
	document.getElementById("salir_mnotas").addEventListener("click",noguardar_comentario,false);
	document.getElementById("btmnotas").addEventListener("click",abrir_comentario,false);
	
	document.getElementById("guardar").addEventListener("click",guardar,false);
	document.getElementById("btguardar").addEventListener("click",guardar,false);

	document.getElementById("salir").addEventListener("click",cerrar_pantalla,false);
	document.getElementById("btquit").addEventListener("click",cerrar_pantalla,false);

	document.getElementById("btnueva").addEventListener("click",clear_view,false);
	document.getElementById("cubino").addEventListener("change",upd_ccustno_list,false);
	// ------------------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	document.getElementById("btcservno").addEventListener("click",show_menu_arserm,false);
	// una funcion de ordenamiento segun el menu que se elija.
	// Lista de ordenamiento
	document.getElementById("mx_opc_order").addEventListener("click",get_mx_detalle,false);
	// opcion de busqueda
	document.getElementById("mx_cbuscar").addEventListener("input",get_mx_detalle,false);
	// ------------------------------------------------------------------------
}


function cerrar_pantalla(){
	document.getElementById("arpodvm").style.display="none";
}
function upd_ccustno_list(){
	// ruta que esta seleccionada
	let lccustno = document.getElementById("cubino").value;
	xlmhtt = new XMLHttpRequest();
	oData  = new FormData();
	oData.append("accion","list");
	oData.append("ccustno",lccustno);
	xlmhtt.open("POST","../modelo/esp_arpodvm.php",false);
	xlmhtt.send(oData);
	document.getElementById("dlcliente").innerHTML=xlmhtt.response;

}
function get_master_screen(){
	arpodvm.submit();
}

function clear_view(){
	document.getElementById("tdetalles").innerHTML = "";
	get_clear_view();
	cksum();
}
function isvalidentry(){
	if(ccustno.value==""){
		getmsgalert("coloque un cliente");
		return true;
	}
	if(cpaycode.value==""){
		getmsgalert("indique las condiciones del pedido");
		return true;
	}
	return false;
}
function guardar(){
	var lcservno = "",odata="", lnqty=0 ,lnveces=1, lncost = 0;
	// ---------------------------------------------------------------------
	// A)- verificando integridad de datos antes de guardar definitivamente.
	// ---------------------------------------------------------------------
	if (isvalidentry()){
		return ;
	}

	// b)- Validando que hayan detalles a procesar.
	var otabla = document.getElementById("tdetalles");
	var lnrows = otabla.rows.length ;
	if(lnrows == 0){
		getmsgalert("No hay detalle de facturas cliente no tiene cuentas pendientes");
		return ;
	}
	// verificando que no haya campos NaN En cantidad o Costo.
	var lnvalue = parseFloat(document.getElementById("ntotamt").value).toFixed(2);
	if (isNaN(lnvalue)){
		llcont = false;
		getmsgalert("revise las cantidades o el total existe un dato no permitido");
		return ;
	}		

	// b)- armando JSON.
	// b.1)- Armando el encabezado.
	odata += '{"ccustno":"'  + document.getElementById("ccustno").value  + '",';
	odata += ' "cpaycode":"' + document.getElementById("cpaycode").value + '",';
	odata += ' "crutno":"'   + document.getElementById("cubino").value   + '",';
	odata += ' "mnotas":"'   + document.getElementById("mnotas").value   + '",';
	odata += ' "mnotash":"'  + document.getElementById("mnotash").value  + '",';
		// b.2)- Armando el detalle
	odata += ' "articulos":[' ;
	// recorriendo la tabla en busca de abono y factura.
	for (var i = 0; i<lnrows; ++i){
		// obteniendo valor de celdas en cada fila
		lncost   = parseFloat(otabla.rows[i].cells[2].children["nprice"].value);
		lnqty    = parseFloat(otabla.rows[i].cells[1].children["nqty"].value);
		lcservno = otabla.rows[i].cells[0].innerText;
    	// si hay algo en el monto a aplicar en cualquier fila, procesara el pago y continua.
		if (!isNaN(lnvalue)){
			// si es la primera vez
			if (lnveces == 1){
				odata += '{"cservno":"' + lcservno + '","nprice":' + lncost + ',"nqty":' + lnqty + '}' ;
				lnveces = 2;
			}else{
				odata += ',{"cservno":"' + lcservno + '","nprice":' + lncost + ',"nqty":' + lnqty + '}' ;
			} // if (lnveces == 1){
		} // if (!isNaN(lnvalue)){		
	} // for (var i = 1; i<lnrows; ++i){
	odata += ']}' ;
	
	// codigo request para enviar al crud de php
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("json",odata);
	oDatos.append("accion","NEW");
	oRequest.open("POST","../modelo/crud_arpodvm.php",false); 
	oRequest.send(oDatos);
	// enviando mensaje de configuracion.
	getmsgalert(oRequest.responseText.trim());
	clear_view();
}
function guardar_comentario(){
	document.getElementById("dmnotas").style.display="none";
	document.getElementById("arpodvm").style.display="block";
}
function noguardar_comentario(){
	document.getElementById("dmnotas").style.display="none";
	document.getElementById("arpodvm").style.display="block";
	document.getElementById("mnotas").value="";
}
function abrir_comentario(){
	document.getElementById("dmnotas").style.display="block";
	document.getElementById("arpodvm").style.display="none";
}
function show_menu_arserm(){
	document.getElementById("xm_area_menu").style.display="inline";
	var o_mx_lista = "";
	// armando el listado
	o_mx_lista += '	<select class="listas" id="mx_opc_order"> ';
	o_mx_lista += ' 	<option value = "cservno">Articulo Id</option> ';
	o_mx_lista += '		<option value = "cdesc">Descripcion </option> ';
	o_mx_lista += '	</select> ';
	// armando el encabezado 
	var o_mx_Header = "";
	o_mx_Header += ' <table id="mx_head" class="table_det"> ';
	o_mx_Header += '	<thead> ';
	o_mx_Header += '		<tr> ';
	o_mx_Header += '			<td width="70px">Item ID </td> ';
	o_mx_Header += '			<td width="200px">Descripcion</td> ';
	o_mx_Header += '			<td width="50px">Precio</td> ';
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
		oRequest.open("POST","../modelo/crud_arserm.php",false); 
		oRequest.send(oDatos);
		var odata = JSON.parse(oRequest.response);
		//cargando los valores de la pantalla.
		if (odata != null){
			var lnrows = odata.length;
			var o_mx_detalles = '<table id="mx_detalle"> ';
			o_mx_detalles += '<tbody>';
			for (var i = 0; lnrows > i; ++i){
				o_mx_detalles += '<tr class="xm_row_menu"> ';
				o_mx_detalles += '	<td width="70px"> '+ odata[i]["cservno"] + '</td> ';
				o_mx_detalles += '	<td width="200px">'+ odata[i]["cdesc"]   + '</td> ';
				o_mx_detalles += '	<td width="50px"> '+ odata[i]["nprice"]  + '</td> ';
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
	document.getElementById("cservno1").value = lckey;
	cerrar_mx_view();
	upddet();
	
}
function upddet(){
	// validaciones standar previas.
	/*
    if (isvalidentry()){
		return;
	}
    */
	// ---------------------------------------------------------------------------------------------------------
	// a)- Verificando que el articulo exista.
	// ---------------------------------------------------------------------------------------------------------
	// haciendo request que devuelva el contenido de la fila en formato JSON.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","JSON");
	oDatos.append("cservno",document.getElementById("cservno1").value);
	// enviando el request.
	oRequest.open("POST","../modelo/crud_arserm.php",false); 
	oRequest.send(oDatos);
	// recibiendo el json.
	var odata = JSON.parse(oRequest.response); 
	// mostrando pantalla de edicion de archivo
	if (odata == null){
		getmsgalert("Codigo de Articulo No registrado");
		return;
	}	
	
	// ---------------------------------------------------------------------------------------------------------
	// b)- insertando el articulo en el detalle de la tabla 
	// ---------------------------------------------------------------------------------------------------------
	var otabla = document.getElementById("tdetalles");
	//otabla.insertRow(1);
	//oRow += "<td class= 'tdcservno' width='20px'>"  + odata.cservno + "</td>";
	
	var oRow = "<tr>";
	oRow += "<td class= 'saytextd' id='tdcdesc'>" + odata.cdesc   + "</td>";
	oRow += "<td><input type='number'  id='nqty'   name='nqty'   value=1></td>";
	oRow += "<td><input type='text'    id='nprice' name='nprice' value=" + odata.nprice + "></td>";
	//oRow += "<td  class='input_min' ><input type='button'  class='input_min'  onclick='deleteRow(this)' value='Eliminar'></td>";
	oRow += "<td  id='rbtclear' ><img src='../photos/escoba.ico'  class='botones_row'  onclick='deleteRow(this)' title='Eliminar'/></td>";
	oRow += "</tr>";
 	otabla.insertRow(-1).innerHTML = oRow;
	cservno1.value = "";

	// ---------------------------------------------------------------------------------------------------------
	// c)- configurando detalle para que responda a eventos.
	// ---------------------------------------------------------------------------------------------------------
	set_validation_table();
	cksum();
}
function set_validation_table(){
	var oinput1 = document.querySelectorAll("#nqty");
	var oinput2 = document.querySelectorAll("#nprice");
	for (var i=0; i<oinput1.length; i++){
		// poniendo a la escucha del evento ONCHANGE cada objeto
		oinput1[i].onchange = cksum;
		oinput2[i].onchange = cksum;
        oinput2[i].setAttribute("readonly",true);
	}
}
function cksum(){

	var otabla = document.getElementById("tdetalles");
	var lnsalesamt = 0;
	var lnveces = otabla.rows.length ;
	
	for (var i = 0; i < lnveces; ++i){
		lnsalesamt += parseFloat(otabla.rows[i].cells[1].children["nqty"].value) * parseFloat(otabla.rows[i].cells[2].children["nprice"].value);
	}
	// cargando los valores del total.
	ntotamt.value  = parseFloat(lnsalesamt).toFixed(2);
}
function deleteRow(row){
    var d = row.parentNode.parentNode.rowIndex;
    document.getElementById('tdetalles').deleteRow(d);
    cksum();
}
window.onload=init;