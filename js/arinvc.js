var ninvlinmax = 0;
function init(){
	// cargando numero de transsaccion para esta factura temporal
	//document.getElementById("xtrnno").value = get_trnno();
	// identificando algunos elementos.
	document.getElementById("ccustno").addEventListener("change",upd_config_invoice,false);
	// poniendo el text de articulo a la escucha.
	document.getElementById("cservno1").addEventListener("change",upddet,false);
	// pantalla de actualizacion de regisrto de venta.
	//var obtguardar = document.getElementById("btguardar");
	// pone la pantalla lista para la proxima con los defaults de la pantalla de facturacion.
	document.getElementById("btnueva").addEventListener("click",clear_view,false);
	btguardar.addEventListener("click",call_pantalla_pago,false);
	btquit.addEventListener("click",cerrar_arinvc,false);
	// combo de pantalla de pago sobre el tipo de pago
    ctype.addEventListener("change",upd_desctype,false);
	dstardate.addEventListener("change",get_tc_rate,false);
	// Pantalla de guardar factura.   pantalla_actualiza_linea
	// -----------------------------------------------------------------
	efectivo.addEventListener("change",ck_vuelto,false);
	// ocultando la pantalla de pago 
	pantalla_pago.style.display="none";
	// poniendo boton de cerrar pantallas.
	btsalir.addEventListener("click",cerrar_pantalla_pago,false);
	btsalvar.addEventListener("click",guardar,false);
	btVer.style.display    = "none";
	btnuevaf.style.display = "none";
	btsalvar.style.display = "inline";
	btsalir.style.display  = "inline";
	btnuevaf.addEventListener("click",nueva_factura,false);
	btVer.addEventListener("click",print_invoice,false);
	// -----------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	document.getElementById("btcservno").addEventListener("click",show_menu_arserm,false);
	// una funcion de ordenamiento segun el menu que se elija.
	// Lista de ordenamiento
	document.getElementById("mx_opc_order").addEventListener("click",get_mx_detalle,false);
	// opcion de busqueda
	document.getElementById("mx_cbuscar").addEventListener("input",get_mx_detalle,false);
	// ------------------------------------------------------------------------
	clear_view();
}
// ----------------------------------------------------------------------
// MENU DE articulos
// ----------------------------------------------------------------------
function show_menu_arserm(){
	document.getElementById("xm_area_menu").style.display="inline";
	var o_mx_lista = "";
	// armando el listado
	o_mx_lista += '	<select class="listas" id="mx_opc_order"> ';
	o_mx_lista += ' 	<option value = "cservno">Articulo Id</option> ';
	o_mx_lista += '		<option value = "cdesc">Descripcion </option> ';
	o_mx_lista += '		<option value = "nprice">Precio </option> ';
	o_mx_lista += '		<option value = "nonhand">Existencia</option> ';
	o_mx_lista += '	</select> ';
	// armando el encabezado 
	var o_mx_Header = "";
	o_mx_Header += ' <table id="mx_head" class="table_det"> ';
	o_mx_Header += '	<thead> ';
	o_mx_Header += '		<tr> ';
	o_mx_Header += '			<td width="70px">Articulo Id </td> ';
	o_mx_Header += '			<td width="200px">Descripcion</td> ';
	o_mx_Header += '			<td width="50px">Precio</td> ';
	o_mx_Header += '			<td width="50px">Existencia</td> ';
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
				o_mx_detalles += '	<td width="50px"> '+ odata[i]["nonhand"] + '</td> ';
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
// -----------------------------------------------------------------------

function get_tc_rate(){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("dtrndate",document.getElementById("dstardate").value);
	oDatos.append("program","get_tc_rate");
	// obteniendo el menu
	oRequest.open("POST","../modelo/armodule.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){	
		document.getElementById("ntc").value = parseFloat(odata.ntc).toFixed(2);
	}else{
		document.getElementById("ntc").value = 1;
		getmsgalert("tipo de cambio no definido para esta fecha.");
	}
}
//obteniendo tipo de cambio 
// actualiza los parametros de facturacion del cliente al cambiar los terminos de facturacion.
function upd_config_invoice(){
	// haciendo request que devuelva el contenido de la fila en formato JSON.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","LIST");
	oDatos.append("ccustno",document.getElementById("ccustno").value);
	// enviando el request.
	oRequest.open("POST","../modelo/crud_arcust.php",false); 
	oRequest.send(oDatos);
	// recibiendo el json.
	var odata = JSON.parse(oRequest.response); 
	// mostrando pantalla de edicion de archivo
	document.getElementById("cwhseno").value  = odata.cwhseno;
	document.getElementById("cpaycode").value = odata.cpaycode;
	document.getElementById("crespno").value  = odata.crespno;
	document.getElementById("nlimcrd").value  = odata.nlimcrd;
	document.getElementById("nsalecust").value = odata.nlimcrd - odata.nbbalance;
}

function cerrar_arinvc(){
	arinvc.style.display = "none";
}
// funcion para calcular el vuelto 
function ck_vuelto(){
	if (parseFloat(efectivo.value) >= parseFloat(topay.value)){
		vuelto.value = parseFloat(efectivo.value - topay.value);	
	}else{
		vuelto.value = 0;	
	}
}
// imprime una factura 
function print_invoice(){arguments
	document.getElementById("pantalla_pago").submit()
}
// nueva factura despues de que se guardo la que se estaba haciendo.
function nueva_factura(){
	// oculta el boton de ver factura.
	btVer.style.display    = "none";
	// oculta boton de nueva para proxima factura.
	btnuevaf.style.display = "none";
	// oculta boton de guardar factura cuando ya se guardo.
	btsalvar.style.display = "inline";
	btsalir.style.display  = "inline";
	// cierra pantalla de pago
	cerrar_pantalla_pago();
	// recetea a default la pantalla principal de facturacion
	clear_view();
}
// actualiza el valor de la descripcion en el pago segun el tipo.
function upd_desctype(){
	if(ctype.value == "EF"){
		cdescpay.value="Pago en Efectivo";
	}
	if(ctype.value == "TG"){
		cdescpay.value="Targeta de Credito # ?";
	}
	if(ctype.value == "CK"){
		cdescpay.value="Cheque No ?";
	}
}
// llamando la pantalla de pago para guardar finalmente la factura.
function call_pantalla_pago(){
	var lnqtyelement = tdetalles.rows.length - 1;
	if (lnqtyelement == 0){
		getmsgalert("No hay detalle en esta factura.");
		return false;
	}
	pantalla_pago.style.display="inline";
	//ctrnno1.value  = xtrnno.value ;
	topay.value    = ntotamt.value;
	dpay.value     = dstardate.value;
	cdescpay.value = "Pago en efectivo";
	efectivo.focus();

}
function cerrar_pantalla_pago(){
	pantalla_pago.style.display="none";
	efectivo.value="";
	ck_vuelto();
}
function clear_view(){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	oRequest.open("POST","../menu/menu_arsetup.php",false); 
	oRequest.send();
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	// campos por defecto para el encabezado	
	document.getElementById("ccustno").value   = odata.ccustno;
	document.getElementById("cwhseno").value   = odata.cwhseno;
	document.getElementById("cpaycode").value  = odata.cpaycode;
	document.getElementById("dstardate").value = get_date_comp();
	document.getElementById("denddate").value  = get_date_comp();
	get_tc_rate();

	// limpiando otros campos para que no quede ningun datos.
	crefno.value = "";
	cdesc.value = "";
	mnotas.value = "";
	ctrnno1.value = "";
	// detalle de la factura poniendolo en blanco
	
	var lctable = 	'<thead>'+'<tr class="table_det">'+
		'	<th width="90px">Codigo</th>'+'	<th width="220px">Descripcion de Producto</th>'+
		'	<th width="75px">Precio</th>'+'	<th width="75px">Cantidad</th>'+
		'	<th width="50px">Descuento</th>'+'	<th width="50px">IVA %</th>'+
		'	<th width="75px">Monto</th>'+' </tr></thead>';

		document.getElementById("tdetalles").innerHTML = lctable;
		//document.getElementById("tdetalles").innerHTML = "";
	
	//articulos.innerHTML= "";	
	ninvlinmax = odata.ninvlinmax;
	// poniendo en cero el pago recibido
	efectivo.value = 0.00;
	nsubamt.value = 0.00;
	ntaxamt.value = 0.00;
	ntotamt.value = 0.00;
	nlimcrd.value = 0.00;
	nsalecust.value = 0.00;
	ndescamt.value = 0.00
	//poniendo foco en la barra de codigo para lectura del scanner.
	cservno1.focus();
}
function isvalidentry(){
	var lnqtyelement = tdetalles.rows.length - 1;
	// Validando el numero de lineas en el detalle de factura.
	if (lnqtyelement >= ninvlinmax){
		getmsgalert("Maximo de lineas por factura es " + ninvlinmax +" lleva "+lnqtyelement);
		return false;
	}
	// validando el cliente
	if (ccustno.value == ""){
		getmsgalert("Indique un cliente");
		ccustno.focus();
		return false;
	}
	// validando el bodega
	if (cwhseno.value == ""){
		getmsgalert("Indique un Bodega");
		cwhseno.focus();
		return false;
	}
	// validando el vendedor
	if (crespno.value == ""){
		getmsgalert("Indique un Vendedor");
		crespno.focus();
		return false;
	}
	// validando condiciones
	if (cpaycode.value == ""){
		getmsgalert("Indique un Vendedor");
		cpaycode.focus();
		return false;
	}
	// validando fecha de inicio
	if (dstardate.value == ""){
		getmsgalert("Indique fecha de facturacion");
		dstardate.focus();
		return false;
	}
	if (denddate.value == ""){
		getmsgalert("Indique fecha de facturacion");
		ddenddate.focus();
		return false;
	}
	
	return true;
}
// funcion de la cuadricula detalle productos
function set_validation_table(){
	var oinput1 = document.querySelectorAll("#nqty");
	var oinput2 = document.querySelectorAll("#nprice");
	var oinput3 = document.querySelectorAll("#ntax");
	var oinput4 = document.querySelectorAll("#ndesc");
	for (var i=0; i<oinput1.length; i++){
		// poniendo a la escucha del evento ONCHANGE cada objeto
		oinput1[i].onchange = cksum;
		oinput2[i].onchange = cksum;
		oinput3[i].onchange = cksum;
		oinput4[i].onchange = cksum;
        //oinput2[i].setAttribute("readonly",true);
	}
}
function upddet(){
	// validaciones standar previas.
	var llcont = isvalidentry();
	if (!llcont){
		document.getElementById("cservno1").value="";
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

	var oRow = "<tr class='listados'>";
	oRow += "<td width='90px' >" + odata.cservno   + "</td>";
	oRow += "<td width='220px'>" + odata.cdesc     + "</td>";
	oRow += "<td width='50px'><input type='number' class='textqty' name='nprice' id='nprice' value="+ odata.nprice +"></td>";
	oRow += "<td width='75px'><input type='number' class='textqty' name='nqty'   id='nqty'   value=1></td>";
	oRow += "<td width='50px'><input type='number' class='textqty' name='ndesc'  id='ndesc'  value=0></td>";
	oRow += "<td width='50px'><input type='number' class='textqty' name='ntax'   id='ntax'   value="+ odata.ntax +"></td>";
	oRow += "<td width='75px' name='nsalesamt_u' id='nsalesamt_u' class='textqty'>" + odata.nprice  + "</td>";
	oRow += "<td><img src='../photos/escoba.ico' id='btquitar' class='botones_row'  onclick='deleteRow(this)' title='Eliminar Registro'/></td>";
	oRow += "</tr>";
 	otabla.insertRow(-1).innerHTML = oRow;
	cservno1.value = "";

	// ---------------------------------------------------------------------------------------------------------
	// c)- configurando detalle para que responda a eventos.
	// ---------------------------------------------------------------------------------------------------------
	set_validation_table();
	cksum();
}
//refresca el valor de los totales de la tabla.

function guardar(){
	var lcservno = "",odata="", lnqty=0 ,lnveces=1, lncost = 0;
	// ---------------------------------------------------------------------
	// A)- verificando integridad de datos antes de guardar definitivamente.
	// ---------------------------------------------------------------------
	if (!isvalidentry()){
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
	// ------------------------------------------------------------------------------------------
	// b)- armando JSON.
	// b.1)- Armando el encabezado.
	odata += '{"ccustno":"'   + document.getElementById("ccustno").value  	+ '",';
	odata += ' "cpaycode":"'  + document.getElementById("cpaycode").value 	+ '",';
	odata += ' "cwhseno":"'   + document.getElementById("cwhseno").value   	+ '",';
	odata += ' "crespno":"'   + document.getElementById("crespno").value   	+ '",';
	odata += ' "dstardate":"' + document.getElementById("dstardate").value  + '",';
	odata += ' "denddate":"'  + document.getElementById("denddate").value   + '",';
	odata += ' "mnotas":"'    + document.getElementById("mnotas").value   	+ '",';
	odata += ' "crefno":"'    + document.getElementById("crefno").value   	+ '",';
	odata += ' "cdesc":"'     + document.getElementById("cdesc").value   	+ '",';
	odata += ' "ntc":"'       + document.getElementById("ntc").value   		+ '",';
	odata += ' "efectivo":"'  + document.getElementById("efectivo").value   + '",';
	odata += ' "dpay":"'      + document.getElementById("dpay").value   	+ '",';
	odata += ' "mnotasr":"'   + document.getElementById("mnotasr").value   	+ '",';
		// b.2)- Armando el detalle
	odata += ' "articulos":[' ;
	// recorriendo la tabla en busca de abono y factura.
	for (var i = 1; i<lnrows; ++i){
		// obteniendo valor de celdas en cada fila
		lnprice  = parseFloat(otabla.rows[i].cells[2].children["nprice"].value);
		lnqty    = parseFloat(otabla.rows[i].cells[3].children["nqty"].value);
		lndesc   = parseFloat(otabla.rows[i].cells[4].children["ndesc"].value);
		lntax    = parseFloat(otabla.rows[i].cells[5].children["ntax"].value);

		lcservno = otabla.rows[i].cells[0].innerText;
    	// si hay algo en el monto a aplicar en cualquier fila, procesara el pago y continua.
		if (!isNaN(lnvalue)){
			// si es la primera vez
			if (lnveces == 1){
				odata += '{"cservno":"' + lcservno + '","nprice":' + lnprice + ',"nqty":' + lnqty + ',"ndesc":' + lndesc +',"ntax":' + lntax +  '}' ;
				lnveces = 2;
			}else{
				odata += ',{"cservno":"' + lcservno + '","nprice":' + lnprice + ',"nqty":' + lnqty + ',"ndesc":' + lndesc +',"ntax":' + lntax +  '}' ;
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
	oDatos.append("accion","SAVE");
	oRequest.open("POST","../modelo/crud_arinvc.php",false); 
	oRequest.send(oDatos);

	// ---------------------------------------------------------------------
	// C)- Cerrando proceso
	// ---------------------------------------------------------------------
	var odata = oRequest.responseText.trim(); 
	// mostrando el boton de imprimir factura
	btVer.style.display    ="inline";
	// mostrando el boton de nueva factura continua trabajando.
	btnuevaf.style.display ="inline";
	// ocultando boton de salir simple ocultar pantalla.
	btsalvar.style.display ="none";
	btsalir.style.display  ="none";
	// mostrando el nuevo numero de factura.
	ctrnno1.value = odata;

	/*
	// enviando mensaje de configuracion.
	getmsgalert(oRequest.responseText.trim());
	clear_view();
	*/
}
function cksum(){
	var otabla = document.getElementById("tdetalles");
	var lnsalesamt = 0, lntaxamt = 0,lndescamt = 0, lnsalesamt_u = 0, lntaxamt_u = 0,lndescamt_u = 0;
	var lnveces = otabla.rows.length - 1;
	
	for (var i = 1; i <= lnveces; ++i){
		// costo de la linea 
		lnsalesamt_u = parseFloat(otabla.rows[i].cells[2].children[0].value) * parseFloat(otabla.rows[i].cells[3].children[0].value);
		lndescamt_u  = parseFloat(otabla.rows[i].cells[4].children[0].value);
		lntaxamt_u   = (lnsalesamt_u - lndescamt_u) * parseFloat(otabla.rows[i].cells[5].children[0].value)/100;
		otabla.rows[i].cells[6].innerText = lnsalesamt_u.toFixed(2);
		// totales
		lnsalesamt += lnsalesamt_u;
		lndescamt  += lndescamt_u;
		lntaxamt   += lntaxamt_u;
	}
	// cargando los valores del total.
	nsubamt.value  = lnsalesamt.toFixed(2);
	ndescamt.value = lndescamt.toFixed(2);
	ntaxamt.value  = lntaxamt.toFixed(2);
	ntotamt.value  = ((lnsalesamt + lntaxamt) - lndescamt).toFixed(2);
}
function deleteRow(row){
    var d = row.parentNode.parentNode.rowIndex;
    document.getElementById('tdetalles').deleteRow(d);
    cksum();
}
window.onload=init;