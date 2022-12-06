var oCg = {};

function init(){
    document.getElementById("btquit").addEventListener("click",salir,false);
	document.getElementById("btnueva").addEventListener("click",limpiar,false);
	document.getElementById("btguardar").addEventListener("click",guardar,false);
	init_cg();
    //document.getElementById("crespno").addEventListener("change",updHeader,false);
    // definiendo comportamiento.
    document.getElementById("cmodo").addEventListener("change",modEditForm,false);
    document.getElementById("cmodo").value = "1";
    modEditForm();
	// poniendo la fecha del momento en que se habre.
	document.getElementById("dtrndate").value = get_date_comp();
	document.getElementById("pantalla_guardar").style.display="none";
	// catalogo de cuentas.
	document.getElementById("btcctaid").addEventListener("click",function(){get_menu_list("cgctas","showmenulist","cctaid","upddet");},false);
	document.getElementById("cctaid").addEventListener("change",upddet,false);
}
function deleteRow(row){
    var d = row.parentNode.parentNode.rowIndex;
    document.getElementById('tdetalles').deleteRow(d);
    cksum();
}
function cksum(){
	var otabla = document.getElementById("tdetalles");
	var lndiferencia = 0, lndebe = 0,lnhaber = 0;
	var lnveces = otabla.rows.length;
	for (var i = 0; i < lnveces; ++i){
		// debe
		if (otabla.rows[i].cells[2].children[0].value == ""){
			lndebe += 0.00;
		}else{
			lndebe += parseFloat(otabla.rows[i].cells[2].children[0].value);
		}

		//haber
		if (otabla.rows[i].cells[3].children[0].value == ""){
			lnhaber += 0.00;
		}else{
			lnhaber += parseFloat(otabla.rows[i].cells[3].children[0].value);
		}
	}
	// cargando los valores del total.
	lndiferencia = (lndebe - lnhaber).toFixed(2);
	document.getElementById("tdiferencia").value = lndiferencia;
	document.getElementById("tdebe").value  = lndebe.toFixed(2);
	document.getElementById("thaber").value = lnhaber.toFixed(2);
}
function set_validation_table(){
	var oinput1 = document.querySelectorAll("#ndebe");
	var oinput2 = document.querySelectorAll("#nhaber");
	for (var i=0; i<oinput1.length; i++){
		// poniendo a la escucha del evento ONCHANGE cada objeto
		oinput1[i].onchange = cksum;
		oinput2[i].onchange = cksum;
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
	oDatos.append("cctaid",document.getElementById("cctaid").value);
	// enviando el request.
	oRequest.open("POST","../modelo/crud_cgctas.php",false); 
	oRequest.send(oDatos);
	// recibiendo el json.
	var odata = JSON.parse(oRequest.response); 
	// mostrando pantalla de edicion de archivo
	if (odata == null){
		getmsgalert("Codigo de Cuenta No registrado");
		return;
	}	
	//class="ckey"
	otabla = document.getElementById("tdetalles");
	lcecho = "<tr> ";
	lcecho += '<td scope="col" name="id">' + odata.cctaid + '</td>';
	lcecho += '	<td scope="col" name="cdescd">' + odata.cdesc + '</th>';
	lcecho +='	<td scope="col" ><input type="number" name="ndebe" id="ndebe"  /></td>';
	lcecho += '	<td scope="col" ><input type="number" name="nhaber" id="nhaber"  /></td>';
	lcecho += '	<td>';
	lcecho += "		<img src='../photos/escoba.ico' id='btquitar' class='botones_row'  onclick='deleteRow(this)' title='Eliminar Registro'/>";
	lcecho += '	</td>';
	lcecho += '</tr>';
	
	otabla.insertRow(-1).innerHTML = lcecho;
	document.getElementById("cctaid").value = "";

	// ---------------------------------------------------------------------------------------------------------
	// c)- configurando detalle para que responda a eventos.
	// ---------------------------------------------------------------------------------------------------------
	set_validation_table();
	cksum();
}
function init_cg(){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	oDatos.append("accion","JSON")
	oRequest.open("POST","../modelo/crud_cgsetup.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	oCg = JSON.parse(oRequest.response);

}
function showformaddline(){
	document.getElementById("form_detelle").style.display="inline-block";
}
function limpiar(){
	get_clear_view();
	// recarga la ventana y refresca todos los valores del backend
	window.location.href = "../view/cgmast_1.php";
}
// Comportamiento del combo
function modEditForm(){
    // pone en forma de editable la forma.
	document.getElementById("tdetalles").innerHTML="";
    if (document.getElementById("cmodo").value == "1" ){
        // modo registrar.
        document.getElementById("ctrnno").disabled = true;
        document.getElementById("crespno").disabled = false;
        // quitando la opcion de que despliegue el menu
        document.getElementById("btctrnno").addEventListener("click",function(){return false;},false);
    }else{
        document.getElementById("ctrnno").disabled  = false;
        document.getElementById("crespno").disabled = true;
        // permitiendo que se despliegue el menu
        document.getElementById("btctrnno").addEventListener("click",function(){get_menu_list("cgmast_1","showmenulist","ctrnno");},false);
		
    }
}
function salir(){
	//var pantalla = document.defaultView;
	document.getElementById("cgmast_1").style.display="none";	
}
function salir_detalle(){
	document.getElementById("form_detelle").style.display="none";
}
function guardar(){
	// enviando el request.
	if (!isvalidentry()){
		return ;
	}
	// b)- Validando que hayan detalles a procesar.
	var otabla = document.getElementById("tdetalles");
	var lnrows = otabla.rows.length ;
	if(lnrows == 0){
		getmsgalert("No hay detalle del comprobante.");
		return ;
	}
	// b)- armando JSON.
	// b.1)- Armando el encabezado.
	odata  = '{"cmodo":"'     + document.getElementById("cmodo").value 		+ '",';
	odata += ' "crespno":"'   + document.getElementById("crespno").value	+ '",';
	odata += ' "ctrnno":"'    + document.getElementById("ctrnno").value 	+ '",';
	odata += ' "dtrndate":"'  + document.getElementById("dtrndate").value   + '",';
	odata += ' "cdesc":"'     + document.getElementById("cdesc").value   	+ '",';
	odata += ' "nrate":'     + document.getElementById("nrate").value   	+ ',';
	odata += ' "cperid":"' 	  + document.getElementById("cperid").value  	+ '",';
	odata += ' "ctype":"'     + document.getElementById("ctype").value   	+ '",';
	odata += ' "mnotas":"'    + document.getElementById("mnotas").value   	+ '",';
		// b.2)- Armando el detalle
	odata += ' "xdetail":[' ;
	// recorriendo la tabla en busca de abono y factura.
	lnveces = 1;
	for (var i = 0; i<lnrows; ++i){
		// obteniendo valor de celdas en cada fila
		otabla.rows[i].cells[2].children[0].value
		lcctaid  = otabla.rows[i].cells[0].innerText;
		lcdesc   = otabla.rows[i].cells[1].innerText;
		lndebe   = parseFloat(otabla.rows[i].cells[2].children[0].value );		// porcentual.
		lnhaber  = parseFloat(otabla.rows[i].cells[3].children[0].value );	
    	// si hay algo en el monto a aplicar en cualquier fila, procesara el pago y continua.
			// si es la primera vez
			if (lnveces == 1){
				odata += '{"cctaid":"' + lcctaid + '","cdesc":"' + lcdesc + '","ndebe":' + lndebe + ',"nhaber":' + lnhaber +  '}' ;
				lnveces = 2;
			}else{
				odata += ',{"cctaid":"' + lcctaid + '","cdesc":"' + lcdesc + '","ndebe":' + lndebe + ',"nhaber":' + lnhaber + '}' ;
			} // if (lnveces == 1){
	} // for (var i = 1; i<lnrows; ++i){
	odata += ']}' ;
	
	// codigo request para enviar al crud de php
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("json",odata);
	oDatos.append("accion","NEW");
	oRequest.open("POST","../modelo/crud_cgmast_1.php",false); 
	oRequest.send(oDatos);

	// ---------------------------------------------------------------------
	// C)- Cerrando proceso
	// ---------------------------------------------------------------------
	var odata = oRequest.responseText.trim(); 
	// mostrando el boton de imprimir factura

/* 	btVer.style.display    ="inline";
	// mostrando el boton de nueva factura continua trabajando.
	btnuevaf.style.display ="inline";
	// ocultando boton de salir simple ocultar pantalla.
	btsalvar.style.display ="none";
	btsalir.style.display  ="none";
	// mostrando el nuevo numero de factura.
	ctrnno1.value = odata;
 */


}
function update_window(){
	// --------------------------------------------------------------------------------------
	// Con esta funcion se hace una peticion al servidor para obtener un JSON, con los 
	// datos de la tabla master 
	// --------------------------------------------------------------------------------------
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	oDatos.append("accion","JSON")
	oRequest.open("POST","../modelo/crud_cgmast_1.php",false); 
	oRequest.send(oDatos);
	// desplegando pantalla de menu con su informacion.
	var odata = JSON.parse(oRequest.response);
	if (odata != null){
		document.getElementById("crespno").value  = odata.crespno;
		document.getElementById("dtrndate").value = odata.dtrndate;
		document.getElementById("cperid").value   = odata.cperid;
		document.getElementById("cdesc").value    = odata.cdesc;
		document.getElementById("ctype").value    = odata.ctype;
		document.getElementById("nrate").value    = odata.nrate;
		// cargando el detalle.
		for (let index = 0; index < odata.length; index++) {
				cctaid = odata[3][index];		
				
				lcline = "<tr>";
				lcline =+ "<td></td>";
				lcline =+ "<td></td>";
				lcline =+ "</tr>"; 
			}		
		}else{
			alert("Modulo no configurado");
		}
}
function isvalidentry(){
	return true;
}
window.onload=init;