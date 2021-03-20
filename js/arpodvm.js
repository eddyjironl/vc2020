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
	var oRow = "<tr>";
	//oRow += "<td class= 'saytextd' width='90px'>"  + odata.cservno + "</td>";
	oRow += "<td class= 'saytextd' width='150px'>" + odata.cdesc   + "</td>";
	oRow += "<td  class='input_min'  width='60px'><input type='number' class='input_min'  id='nqty' name='nqty' class='textkey' value=1></td>";
	oRow += "<td  class='input_min' ><input type='text'  class='input_min' id='nprice' name='nprice' value=" + odata.nprice + "></td>";
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