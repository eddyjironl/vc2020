function init(){
	// Botones barra navegacion.
	document.getElementById("btquit").addEventListener("click",cerrar_pantalla_arserm,false);	
	document.getElementById("btnueva").addEventListener("click",clear_view,false);
	document.getElementById("btdelete").addEventListener("click",borrar,false);
	document.getElementById("btguardar").addEventListener("click",guardar,false);

	// TAB - poniendo los botones a la escucha.
	document.getElementById("tbinfo1").addEventListener("click",tabshow,false);
	document.getElementById("tbinfo2").addEventListener("click",tabshow,false);
	document.getElementById("tbinfo3").addEventListener("click",tabshow,false);

	// poniendo visible el objeto tab del info 
	document.getElementById("finfo1").style.display = "block";
	document.getElementById("tbinfo1").setAttribute("class","active");

	document.getElementById("btwqty").addEventListener("click",upd_arwqty_config,false);
	document.getElementById("cfoto").addEventListener("change",show_foto,false);
	// configurando tab2

	document.getElementById("bt_fsalir").addEventListener("click",cerrar_pantalla_actualiza_linea,false);
	document.getElementById("bt_fupd").addEventListener("click",upd_linea_kit,false);
	// pantalla de kardex
	document.getElementById("btsalir2").addEventListener("click",cerrar_pantalla_kardex,false);	
	document.getElementById("cdetcta").addEventListener("click",get_pantalla_kardex,false);	
	// configurando las variables de estado.
	gckeyid   = "cservno";
	gckeydesc = "cdesc";
	gcbtkeyid = "btcservno";

	// -----------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	//document.getElementById("cservno").addEventListener("blur",valid_ckeyid,false);
	//document.getElementById("cservno1").addEventListener("blur",upddet,false);
	document.getElementById("cservno").addEventListener("change",valid_ckeyid,false);
	document.getElementById("cservno1").addEventListener("blur",upddet,false);

	document.getElementById("btcservno").addEventListener("click",function(){
        get_menu_list("arserm","showmenulist","cservno");
    },false);

	document.getElementById("btcservno1").addEventListener("click",function(){
        get_menu_list("arserm","showmenulist","cservno1","upddet");
    },false);
	// cerrando pantalla de edicion de linea.
	cerrar_pantalla_actualiza_linea();
	cerrar_pantalla_kardex();
}
function upd_arwqty_config(){
	// ejecutando configuracion de la tabla de cantidades.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","UPD_ARWQTY");
	oDatos.append("cservno", document.getElementById("cservno").value);
	oRequest.open("POST","../modelo/crud_arserm.php",false); 
	oRequest.send(oDatos);
	document.getElementById("articulos3").innerHTML = oRequest.response;
}
function get_pantalla_kardex(){
	// haciendo request que devuelva el detalle de movimientos.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","KARDEX");
	oDatos.append("cservno",document.getElementById("cservno").value);
	// enviando el request.
	oRequest.open("POST","../modelo/crud_arserm.php",false); 
	oRequest.send(oDatos);
	// mostrando pantalla de edicion de archivo
	document.getElementById("kardex").innerHTML = oRequest.response;
	// recorriendo la tabla para sacar los valores.
	var lnonhand = 0;
	document.getElementById("cservnodesc").value = cdesc.value;
	var otabla = document.getElementById("tdetalles2");
	var lnrows = otabla.rows.length;
	if(lnrows == 0){
		getmsgalert("No hay transacciones para este articulo");
		return ;
	}
	document.getElementById("area_bloqueo").style.display="inline";
	// recorriendo la tabla para dar cancular la cantidad existente
	for (var i = 0; i<lnrows; ++i){
		lnonhand += parseFloat(otabla.rows[i].cells[5].innerText);;
	}	
	document.getElementById("nonhand1").value = lnonhand;
	document.getElementById("ntrntot").value = lnrows;
	// jalando la informacion del total por bodega.
	oDatos.append("accion","KARDEX_WHSENO");
	oDatos.append("cservno",document.getElementById("cservno").value);
	oRequest.open("POST","../modelo/crud_arserm.php",false); 
	oRequest.send(oDatos);
	document.getElementById("kardex_bodega").innerHTML = oRequest.response;
}
function cerrar_pantalla_kardex(){
	document.getElementById("area_bloqueo").style.display="none";
}
function upd_linea_kit(){
	// haciendo request que devuelva el contenido de la fila en formato JSON.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cuid",document.getElementById("idline").value);
	oDatos.append("accion","UPD_CUID");
	oDatos.append("cservno",document.getElementById("cservno").value);
	oDatos.append("nqty",document.getElementById("fnqty").value);
	oDatos.append("mnotas",document.getElementById("fmnotas").value);
	// enviando el request.
	oRequest.open("POST","../modelo/crud_arserm.php",false); 
	oRequest.send(oDatos);
	// mostrando pantalla de edicion de archivo
	document.getElementById("pantalla_actualiza_linea").style.display="none";
	document.getElementById("articulos").innerHTML = oRequest.response;
	cservno1.focus();
}
//limpiando el view
function clear_view(){
	var oinput = document.querySelectorAll("input");
	var olista = document.querySelectorAll("select");
	var oTexta = document.querySelectorAll("Textarea");
	for (var i=0; i<oinput.length; i++){
		oinput[i].value = "";
	}
	// limpiando las listas.
	for (var i=0; i<olista.length; i++){
		olista[i].value = "";
	}
	// limpiando las campos textarea.
	for (var i=0; i<oTexta.length; i++){
		oTexta[i].value = "";
	}
	document.getElementById("articulos").innerHTML= "";
	document.getElementById("articulos3").innerHTML= "";
	document.getElementById("cfoto1").setAttribute("src","") 
	document.getElementById("cservno").focus();
	estado_key("A")
}
// cerrando pantalla de edicion de clearInterval
function cerrar_pantalla_actualiza_linea(){
	document.getElementById("pantalla_actualiza_linea").style.display = "none";
}
// cerrando pantalla principal
function cerrar_pantalla_arserm(){
	arserm.style.display="none";
}
function show_foto(){
	//"../photos/"+odata.cfoto
	var lcfoto = document.getElementById("cfoto").value;
	document.getElementById("cfoto1").setAttribute("src",lcfoto) ;
}
function guardar(){
	var oform = document.getElementById("arserm");
	// validaciones de campos obligatorios.
	if(document.getElementById("cservno").value ==""){
		getmsgalert("Falta el codigo de Articulo");
		return ;
	}
	if(document.getElementById("cdesc").value ==""){
		getmsgalert("Falta el Nombre del Articulo");
		return ;
	}
	if(document.getElementById("cstatus").value ==""){
		getmsgalert("No indico Estado del Articulo");
		return ;
	}
	if(document.getElementById("nprice").value ==""){
		getmsgalert("Indique precio de venta");
		return ;
	}
	oform.submit();
}
function borrar(){
	var xkeyid = document.getElementById("cservno").value;
	if(xkeyid != ""){
		// validacion previa para borrar datos.
		if (!confirm("Esta seguro de borrar este registro")){
			return ;
		}
		var oRequest = new XMLHttpRequest();
		// Creando objeto para empaquetado de datos.
		var oDatos   = new FormData();
		// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
		oDatos.append("cservno",xkeyid);
		oDatos.append("accion","DELETE");
		// obteniendo el menu
		oRequest.open("POST","../modelo/crud_arserm.php",false); 
		oRequest.send(oDatos);
		var lcmsg = oRequest.responseText;
		if (lcmsg.length > 0  && lcmsg != "\t"){
			getmsgalert(lcmsg);			
		}else{
			get_clear_view();
		}
		
		
	}else{
		getmsgalert("No ha indicado un codigo de Articulo para borrar");
	}
}
	// este procedimiento utiliza la vupdate_window(pckeyid,pcmenuid)entana de menu y la despliega y rellena los contenidos con el request.		;
function valid_ckeyid(){
	var lcservno = document.getElementById("cservno").value;
	if (lcservno !=""){
		update_window(lcservno);
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
	oDatos.append("cservno",pckeyid);
	oDatos.append("accion","JSON");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_arserm.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	//cargando los valores de la pantalla.
	if (odata != null){
		document.getElementById("cservno").value    = odata.cservno;
		document.getElementById("cdesc2").value     = odata.cdesc2;
		document.getElementById("cdesc").value      = odata.cdesc;
		document.getElementById("cstatus").value    = odata.cstatus;
		document.getElementById("cctaid").value     = odata.cctaid;
		document.getElementById("cctaid_i").value   = odata.cctaid_i;
		document.getElementById("cctaid_c").value   = odata.cctaid_c;
		document.getElementById("mnotas").value     = odata.mnotas;
		document.getElementById("citemtype").value  = odata.citemtype;
		document.getElementById("crespno").value    = odata.crespno;
		document.getElementById("ctserno").value    = odata.ctserno;
		document.getElementById("nlastcost").value  = odata.nlastcost;
		document.getElementById("ncost").value      = odata.ncost;
		document.getElementById("ntax").value       = odata.ntax;
		document.getElementById("ndesc").value      = odata.ndesc;
		document.getElementById("nprice").value     = odata.nprice;
		document.getElementById("nminonhand").value = odata.nminonhand;
		document.getElementById("cfoto1").setAttribute("src",odata.cfoto) ;
		// configurando los dias de la semana
		document.getElementById("lallowneg").checked     = (odata.lallowneg == "1")? true:false;
		document.getElementById("lupdateonhand").checked = (odata.lupdateonhand == "1")? true:false;
		var ocant = get_inventory_onhand(odata.cservno);
		document.getElementById("nbuyamt").value = ocant;
	    refresh_det();
		refresh_arwqty();
		estado_key("I");
	}else{
		ck_new_key();
	}
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
		refresh_det();
	}
	if(oTabFormBoton == "tbinfo3"){
		document.getElementById("finfo3").style.display = "block";
		document.getElementById("tbinfo1").setAttribute("class","")
		document.getElementById("tbinfo2").setAttribute("class","")
		refresh_det();
	}
	document.getElementById(oTabFormBoton).setAttribute("class","active");
}
// inserta en el detalle este articulo
function upddet(){
	var llcont = document.getElementById("cservno").value;
	var llcont2 = document.getElementById("cservno1").value;
	if (llcont ==""){
		getmsgalert("No ha indicado el codigo del articulo compuesto");
		document.getElementById("cservno1").value="";
		document.getElementById("cservno").focus();
		return ;
	}

	if (llcont2 == ""){
		return ;		
	}
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cservno1",document.getElementById("cservno1").value);
	oDatos.append("accion","INSERT");
	oDatos.append("cservno",document.getElementById("cservno").value);
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_arserm.php",false); 
	oRequest.send(oDatos);
	// cargando el detalle.
	document.getElementById("cservno1").value="";
	document.getElementById("articulos").innerHTML = oRequest.response;
	cservno1.focus();
}
// ectualizando configuracion por bodega.
function refresh_arwqty(){
	var llcont = document.getElementById("cservno").value;
    if (llcont == ""){
		return ;
	}
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","REFRESH2");
	oDatos.append("cservno",document.getElementById("cservno").value);
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_arserm.php",false); 
	oRequest.send(oDatos);
	// cargando el detalle.
	document.getElementById("articulos3").innerHTML = oRequest.response;

}
// refresca el detalle de la pantalla.
function refresh_det(){
	var llcont = document.getElementById("cservno").value;
    if (llcont == ""){
		return ;
	}
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("accion","REFRESH");
	oDatos.append("cservno",document.getElementById("cservno").value);
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_arserm.php",false); 
	oRequest.send(oDatos);
	// cargando el detalle.
	document.getElementById("articulos").innerHTML = oRequest.response;
}
function eliminarFila(pcuid){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cuid",pcuid);
	oDatos.append("accion","DELETE_CUID");
	oDatos.append("cservno",document.getElementById("cservno").value);
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_arserm.php",false); 
	oRequest.send(oDatos);
	document.getElementById("articulos").innerHTML=oRequest.response;
	//cksum();
}
function editarFila(pcuid){
	// haciendo request que devuelva el contenido de la fila en formato JSON.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cuid",pcuid);
	oDatos.append("accion","LIST_CUID");
	oDatos.append("cservno",document.getElementById("cservno").value);
	// enviando el request.
	oRequest.open("POST","../modelo/crud_arserm.php",false); 
	oRequest.send(oDatos);
	// recibiendo el json.
	var odata = JSON.parse(oRequest.response); 
	// mostrando pantalla de edicion de archivo
	document.getElementById("pantalla_actualiza_linea").style.display="block";
	document.getElementById("idline").value   = pcuid;
	document.getElementById("fcservno").value = odata.cdesc;
	document.getElementById("fnqty").value    = odata.nqty;
	document.getElementById("fmnotas").value  = odata.mnotas;
}
function eliminarFila2(pcuid){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cuid",pcuid);
	oDatos.append("accion","DELETE_CUID2");
	oDatos.append("cservno",document.getElementById("cservno").value);
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_arserm.php",false); 
	oRequest.send(oDatos);
	document.getElementById("articulos3").innerHTML=oRequest.response;
	//cksum();
}
function editarFila2(pcuid){
	// haciendo request que devuelva el contenido de la fila en formato JSON.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	//obteniendo el id del registro que tocamos
	var fila = document.getElementById(pcuid);
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cuid",pcuid);
	oDatos.append("cservno",document.getElementById("cservno").value);
	//oDatos.append("cbinno",tabla.rows[]);oDatos.append("cestante",fila.cells[4].children[0].value);
	oDatos.append("cbinno",fila.cells[5].children[0].value);
	oDatos.append("cestante",fila.cells[4].children[0].value);
	oDatos.append("nqtymin",fila.cells[2].children[0].value);
	oDatos.append("nqtymax",fila.cells[3].children[0].value);
	oDatos.append("mnotas",fila.cells[1].children[0].value);
	oDatos.append("accion","UPD_CUID2");
	// enviando el request.
	oRequest.open("POST","../modelo/crud_arserm.php",false); 
	oRequest.send(oDatos);
	// recibiendo el json.
	var odata = JSON.parse(oRequest.response); 
	document.getElementById("articulos3").innerHTML = oRequest.response;
}
// actualiza los cambios en la linea de detalle.
window.onload=init;