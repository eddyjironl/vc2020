function init(){
	document.getElementById("btquit").addEventListener("click",cerrar_pantalla_principal,false);
	document.getElementById("btnueva").addEventListener("click",clear_view,false);
	document.getElementById("dtrndate").addEventListener("change",get_tc_rate,false);
	document.getElementById("cwhseno").addEventListener("change",refresh_window,false);
	document.getElementById("btguardar").addEventListener("click",show_sub_screen,false);
	document.getElementById("btsalvar").addEventListener("click",guardar,false);
	document.getElementById("area_bloqueo").style.display="none";
	document.getElementById("btsalir").addEventListener("click",cerrar_sub_pantalla,false);
	document.getElementById("btnuevaf").addEventListener("click",clear_view,false);
	document.getElementById("btVer").addEventListener("click",print_invoice,false);
	//------------------------------------------------------------------
	// configurando los botones del tab.
	document.getElementById("tbinfo1").addEventListener("click",tabshow,false);
	document.getElementById("tbinfo2").addEventListener("click",tabshow,false);
	document.getElementById("tbinfo3").addEventListener("click",tabshow,false);

	document.getElementById("finfo1").style.display = "block";
	document.getElementById("tbinfo1").setAttribute("class","active");

	// -----------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	document.getElementById("cservno1").addEventListener("change",upddet,false);
	document.getElementById("btcservno11").addEventListener("click",function(){
        get_menu_list("arserm","showmenulist","cservno1","upddet");
    },false);
	
	btVer.style.display    = "none";
	btnuevaf.style.display = "none";
	btsalvar.style.display = "inline";
	btsalir.style.display  = "inline";
}
// ----------------------------------------------------------------------
// MENU DE articulos
// ----------------------------------------------------------------------
function print_invoice(){
	var lcadjno = document.getElementById("cadjno").value;
	// verfificando que no tenga letas.. solo numeros.
	document.getElementById("pantalla").submit();
}
function show_sub_screen(){
	document.getElementById("area_bloqueo").style.display="inline-block";
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

	var lmnotas = document.getElementById("mnotas").value;
	// b)- armando JSON.
	// b.1)- Armando el encabezado.
	odata += '{"cwhseno":"'  + document.getElementById("cwhseno").value  + '",';
	odata += ' "cwhseno1":"' + document.getElementById("cwhseno1").value + '",';
	odata += ' "dtrndate":"' + document.getElementById("dtrndate").value + '",';
	odata += ' "ccateno":"'  + document.getElementById("ccateno").value  + '",';
	odata += ' "ccateno1":"' + document.getElementById("ccateno1").value + '",';
	odata += ' "crespno":"'  + document.getElementById("crespno").value  + '",';
	odata += ' "crefno":"'   + document.getElementById("crefno").value   + '",';
	odata += ' "ntc":'       + document.getElementById("ntc").value   	 + ',';
	//odata += ' "mnotas":"'   + document.getElementById("mnotas").value   + '",';
	// b.2)- Armando el detalle
	odata += ' "articulos":[' ;
	// recorriendo la tabla en busca de abono y factura.
	for (var i = 0; i<lnrows; ++i){
		// obteniendo valor de celdas en cada fila
		lncost   = parseFloat(otabla.rows[i].cells[2].children["ncost"].value);
		lnqty    = parseFloat(otabla.rows[i].cells[3].children["nqty"].value);
		lcservno = otabla.rows[i].cells[0].innerText;
    	// si hay algo en el monto a aplicar en cualquier fila, procesara el pago y continua.
		if (!isNaN(lnvalue)){
			// si es la primera vez
			if (lnveces == 1){
				odata += '{"cservno":"' + lcservno + '","ncost":' + lncost + ',"nqty":' + lnqty + '}' ;
				lnveces = 2;
			}else{
				odata += ',{"cservno":"' + lcservno + '","ncost":' + lncost + ',"nqty":' + lnqty + '}' ;
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
	oDatos.append("mnotas",lmnotas);
	oDatos.append("accion","NEW");
	oRequest.open("POST","../modelo/crud_aradjm.php",false); 
	oRequest.send(oDatos);
	document.getElementById("cadjno").value = oRequest.responseText.trim();
	// cargando comportamiento de los botones
	//*****************************************************************************
	// mostrando el boton de imprimir factura
	btVer.style.display    ="inline";
	// mostrando el boton de nueva factura continua trabajando.
	btnuevaf.style.display ="inline";
	// ocultando boton de salir simple ocultar pantalla.
	btsalvar.style.display ="none";
	btsalir.style.display  ="none";
}
function refresh_window(){
	if(cwhseno.value == ""){
		dtrndate.value = "";
	}else{
		dtrndate.value = get_date_comp();
	}
	get_tc_rate();
}
function clear_view(){
	cerrar_sub_pantalla();
	document.getElementById("tdetalles").innerHTML = "";
	get_clear_view();
	cksum();
}
function cerrar_pantalla_principal(){
	document.getElementById("aradjm").style.display="none";
}
function cerrar_sub_pantalla(){
	document.getElementById("area_bloqueo").style.display="none";
	// cargando comportamiento de los botones
	//*****************************************************************************
	// mostrando el boton de imprimir factura
	btVer.style.display    ="none";
	// mostrando el boton de nueva factura continua trabajando.
	btnuevaf.style.display ="none";
	// ocultando boton de salir simple ocultar pantalla.
	btsalvar.style.display ="inline";
	btsalir.style.display  ="inline";

}
function get_tc_rate(){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("dtrndate",document.getElementById("dtrndate").value);
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
function isvalidentry(){
	// Por defecto deja pasar.
	var llcont = false;
	// campos requeridos
	if(document.getElementById("cadjno").value != ""){
		llcont = true;
	}
	if (document.getElementById("cwhseno").value == ""){
		getmsgalert("Indique una bodega");
		llcont = true;
	}
	if (document.getElementById("ccateno").value == ""){
		getmsgalert("Indique un Tipo de Requisa");
		llcont = true;
	}
	if (document.getElementById("dtrndate").value == ""){
		getmsgalert("Indique una Fecha");
		llcont = true;
	}
	if (document.getElementById("crefno").value == ""){
		getmsgalert("Indique un numero de referencia ");
		llcont = true;
	}
	return llcont;
}
function upddet(){
	// validaciones standar previas.
	if (isvalidentry()){
		return;
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
	//otabla.insertRow(1);
	var oRow = "<tr>";
	oRow += "<td class= 'saytextd' width='90px'>"  + odata.cservno + "</td>";
	oRow += "<td class= 'saytextd' width='220px'>" + odata.cdesc   + "</td>";
	oRow += "<td width='70px'><input type='number' id='ncost' name='ncost' class='textkey' value=" + odata.ncost + "></td>";
	oRow += "<td class= 'sayamtd' width='70px'><input type='number' id='nqty' name='nqty' class='textkey' value=1></td>";
	oRow += "<td width='20px'><img src='../photos/escoba.ico' class='botones_row' onclick='deleteRow(this)' title='Eliminar Linea'/></td>";
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
	var oinput2 = document.querySelectorAll("#ncost");
	for (var i=0; i<oinput1.length; i++){
		// poniendo a la escucha del evento ONCHANGE cada objeto
		oinput1[i].onchange = cksum;
		oinput2[i].onchange = cksum;
	}
}
function deleteRow(row){
      var d = row.parentNode.parentNode.rowIndex;
      document.getElementById('tdetalles').deleteRow(d);
	  cksum();
}
function cksum(){

	var otabla = document.getElementById("tdetalles");
	var lnsalesamt = 0;
	var lnveces = otabla.rows.length ;
	
	for (var i = 0; i < lnveces; ++i){
		lnsalesamt += parseFloat(otabla.rows[i].cells[3].children["nqty"].value) * parseFloat(otabla.rows[i].cells[2].children["ncost"].value);
	}
	// cargando los valores del total.
	ntotamt.value  = parseFloat(lnsalesamt).toFixed(2);
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

window.onload=init;
