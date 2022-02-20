// iniciando carga
function init(){
	document.getElementById("btnueva").addEventListener("click",get_clear_view,false);
	document.getElementById("btguardar").addEventListener("click",guardar,false);
	document.getElementById("btdelete").addEventListener("click",borrar,false);
	document.getElementById("btquit").addEventListener("click",salir,false);

	document.getElementById("cfoto").addEventListener("change",show_foto,false);
	document.getElementById("bnsalesamt").addEventListener("click",abrir_pantalla_ventas,false);
	document.getElementById("btsalir2").addEventListener("click",cerrar_pantalla_ventas,false);
	document.getElementById("btsalir3").addEventListener("click",cerrar_pantalla_pagos,false);
	// configurando las variables de estado.
	gckeyid   = "ccustno";
	gckeydesc = "cname";
	gcbtkeyid = "btcustno";
	// ------------------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	document.getElementById("ccustno").addEventListener("change",valid_ckeyid,false);
	
	document.getElementById("btcustno").addEventListener("click",function(){
        get_menu_list("arcust","showmenulist","ccustno");
    },false);
	// ------------------------------------------------------------------------
	cerrar_pantalla_ventas();
	cerrar_pantalla_pagos();
}
// -----------------------------------------------------------------------
function get_pagos(pcinvo){
	var lcinvno = pcinvo.id;
	abrir_pantalla_pagos(lcinvno);
}
function cerrar_pantalla_pagos(){
	document.getElementById("area_bloqueo2").style.display="none";
}
// habre detalle de pagos.
function abrir_pantalla_pagos(pcinvno){
	var lcinvodesc = "", lnsalesamt = 0, lntaxamt = 0, lndesamt = 0, lnbalance = 0, lnpayamt = 0;
	// haciendo request que devuelva el detalle de movimientos.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","PAY_TO_INVOICE");
	oDatos.append("cinvno",pcinvno);
	// enviando el request.
	oRequest.open("POST","../modelo/crud_arcash.php",false); 
	oRequest.send(oDatos);
	// mostrando pantalla de edicion de archivo
	document.getElementById("recibos_det").innerHTML = oRequest.response;
	// recorriendo la tabla para sacar los valores.
	var lnonhand = 0;
	document.getElementById("ccustnodesc2").value = cname.value;
	var otabla = document.getElementById("trecibos");
	var lnrows = otabla.rows.length;
	if(lnrows == 0){
		getmsgalert("No hay Pagos para Factura "+pcinvno );
		return ;
	}
	// recorriendo la tabla para dar cancular la cantidad existente
	for (var i = 0; i<lnrows; ++i){
		// Pagos recibidos 
		lnpayamt += parseFloat(otabla.rows[i].cells[5].innerText);
	}	

    // recorriendo la tabla de facturas para obtener los valores anteriores
	var otabla = document.getElementById("tdetalles2");
	var lnrows = otabla.rows.length;
	
	// recorriendo la tabla para dar cancular la cantidad existente
	for (var i = 0; i<lnrows; ++i){
		//obteniendo el dato de la factura que estamos detallando.
		if(otabla.rows[i].cells[0].innerText == pcinvno){
			// ventas bruta.
			lnsalesamt = parseFloat(otabla.rows[i].cells[5].innerText);
			// descuento
			lndesamt   = parseFloat(otabla.rows[i].cells[6].innerText);
			// impuesto
			lntaxamt   = parseFloat(otabla.rows[i].cells[7].innerText);
			// saldo
			lnbalance  = parseFloat(otabla.rows[i].cells[8].innerText);
			// descripcion de la Factura
			lcinvodesc = otabla.rows[i].cells[3].innerText;
		}	
	}	
	// totalizando la informacion.	
	document.getElementById("nsalesamt_r").value = lnsalesamt - lndesamt + lntaxamt;
	document.getElementById("npayamt").value = lnpayamt ;
	document.getElementById("nbalance_r").value = lnbalance ;
	document.getElementById("cinvodesc").value = "# "+pcinvno+" / " + lcinvodesc ;
	document.getElementById("area_bloqueo2").style.display="inline";
}
function cerrar_pantalla_ventas(){
	document.getElementById("area_bloqueo").style.display="none";
}
function abrir_pantalla_ventas(){
	var lnsalesamt = 0, lntaxamt = 0, lndesamt = 0, lnbalance = 0;
	// haciendo request que devuelva el detalle de movimientos.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","KARDEX");
	oDatos.append("ccustno",document.getElementById("ccustno").value);
	// enviando el request.
	oRequest.open("POST","../modelo/crud_arcust.php",false); 
	oRequest.send(oDatos);
	// mostrando pantalla de edicion de archivo
	document.getElementById("kardex").innerHTML = oRequest.response;
	// recorriendo la tabla para sacar los valores.
	var lnonhand = 0;
	document.getElementById("ccustnodesc").value = cname.value;
	var otabla = document.getElementById("tdetalles2");
	var lnrows = otabla.rows.length;
	if(lnrows == 0){
		getmsgalert("No hay transacciones para este cliente");
		return ;
	}
	// recorriendo la tabla para dar cancular la cantidad existente
	for (var i = 0; i<lnrows; ++i){
		// ventas bruta.
		lnsalesamt += parseFloat(otabla.rows[i].cells[5].innerText);
		// descuento
		lndesamt   += parseFloat(otabla.rows[i].cells[6].innerText);
		// impuesto
		lntaxamt   += parseFloat(otabla.rows[i].cells[7].innerText);
		// saldo
		lnbalance  += parseFloat(otabla.rows[i].cells[8].innerText);
	}	
	document.getElementById("nbsalesamt").value = lnsalesamt - lndesamt + lntaxamt;
	document.getElementById("nbbalance2").value = lnbalance;
	document.getElementById("area_bloqueo").style.display="inline";
}
function show_foto(){
	//"../photos/"+odata.cfoto
	var lcfoto = document.getElementById("cfoto").value;
	document.getElementById("cfoto1").setAttribute("src",lcfoto) ;
}
// cerrando pantalla principal
function salir(){
	arcust.style.display="none";
}
function guardar(){
	var oform = document.getElementById("arcust");
	// validaciones de campos obligatorios.
	if(document.getElementById("ccustno").value ==""){
		getmsgalert("Falta el codigo de cliente");
		return ;
	}
	if(document.getElementById("cname").value ==""){
		getmsgalert("Falta el Nombre del Cliente");
		return ;
	}
	if(document.getElementById("nlimcrd").value ==0){
		getmsgalert("No indico Limite de credito");
		return ;
	}
	oform.submit();
}
function borrar(){
	var xkeyid = document.getElementById("ccustno").value;
	if(xkeyid != ""){
		if (!confirm("Esta seguro de borrar este registro")){
			return ;
		}
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("ccustno",xkeyid);
		oDatos.append("accion","DELETE");
		// obteniendo el menu
		oRequest.open("POST","../modelo/crud_arcust.php",false); 
		oRequest.send(oDatos);
		// verificando que no haya un mensaje por no haber podido borrar.
		var lcmsg = oRequest.responseText;	
		if (lcmsg.length > 0 && lcmsg != "\t"){
			getmsgalert(lcmsg);			
		}else{
			get_clear_view();
		}
	}else{
		getmsgalert("No ha indicado un codigo de cliente para borrar");
	}
}
	// este procedimiento utiliza la vupdate_window(pckeyid,pcmenuid)entana de menu y la despliega y rellena los contenidos con el request.		;
function valid_ckeyid(){
	var lccustno = document.getElementById("ccustno").value;
	if (lccustno != ""){
		update_window(lccustno);
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
	oDatos.append("ccustno",pckeyid);
	oDatos.append("accion","LIST");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_arcust.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var persona = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (persona != null){
		document.getElementById("ccustno").value  = persona.ccustno;
		document.getElementById("dstar").value    = persona.dstar;
		document.getElementById("cname").value    = persona.cname;
		document.getElementById("cstatus").value  = persona.cstatus;
		document.getElementById("ctel").value 	  = persona.ctel;
		document.getElementById("cemail").value   = persona.cemail;
		document.getElementById("cweb").value 	  = persona.cweb;
		document.getElementById("cubino").value   = persona.cubino;
		document.getElementById("ccateno").value  = persona.ccateno;
		document.getElementById("cwhseno").value  = persona.cwhseno;
		document.getElementById("crespno").value  = persona.crespno;
		document.getElementById("cpaycode").value = persona.cpaycode;
		document.getElementById("cctaid").value   = persona.cctaid;
		document.getElementById("cpasword").value = persona.cpasword;
		document.getElementById("nlimcrd").value  = persona.nlimcrd;
		document.getElementById("mnotas").value   = persona.mnotas;
		document.getElementById("mdirecc").value  = persona.mdirecc;

		document.getElementById("cfoto1").setAttribute("src",persona.cfoto) ;		
		// configurando la foto.
		//document.getElementById("cfoto").value    = persona.cfoto;
		document.getElementById("nsalesamt").value = persona.nbsalestot;
		document.getElementById("nbbalance").value = persona.nbbalance;
		estado_key("I");
	}else{
		ck_new_key();
	}
}
window.onload=init;
