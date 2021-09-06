function init(){
	document.getElementById("cmodule_select").addEventListener("change",change_module,false);
	document.getElementById("cmodule_select_small").addEventListener("change",change_module_small,false);
	
// ------------------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	document.getElementById("btcias").addEventListener("click",show_menu_sycomp,false);
	document.getElementById("btcias_samall").addEventListener("click",show_menu_sycomp,false);
	
	//document.getElementById("bt_m_refresh").addEventListener("click",show_menu_arcust,false);
	document.getElementById("xm_area_menu").style.display="none";

	// una funcion de ordenamiento segun el menu que se elija.
	// Lista de ordenamiento
	document.getElementById("mx_opc_order").addEventListener("click",get_mx_detalle,false);
	// opcion de busqueda
	document.getElementById("mx_cbuscar").addEventListener("input",get_mx_detalle,false);
	
	
// CONFIGURACION SMALL
	// ------------------------------------------------------------------------
	// opciones del menu SMALL
	document.getElementById("transacciones").addEventListener("click",change_module_small,false);
	document.getElementById("transacciones").addEventListener("mouseover",change_module_small,false);
	document.getElementById("reportes").addEventListener("click",change_module_small,false);
	document.getElementById("reportes").addEventListener("mouseover",change_module_small,false);
	document.getElementById("catalogos").addEventListener("click",change_module_small,false);
	document.getElementById("catalogos").addEventListener("mouseover",change_module_small,false);
	document.getElementById("Modulos").addEventListener("click",change_module_small,false);
	document.getElementById("Modulos").addEventListener("mouseover",change_module_small,false);
	document.getElementById("close_info").addEventListener("click",extends_barra_small,false);
	document.getElementById("logo_min").addEventListener("click",extends_barra_small,false);
	document.getElementById("info_small").style.display = "none";
	extends_barra_small();
}	
function extends_barra_small(){
	var ancho = document.getElementById("barra_small").clientHeight;
	var new_ancho = "30px";
	var lcdisplay = "none";
	if (ancho == 30){
		new_ancho = "450px";
		lcdisplay = "block";
	}
	document.getElementById("barra_small").style.height = new_ancho;
	document.getElementById("info_small").style.display = lcdisplay;
}
function close_menu(e){
	//alert(e.target.id);
	document.getElementById("area_menu_small").innerHTML = "";
}
// ----------------------------------------------------------------------
// MENU DE COMPAÑIAS PARA EL CAMBIO .
// ----------------------------------------------------------------------
function show_menu_sycomp(){
	document.getElementById("xm_area_menu").style.display="inline";
	var o_mx_lista = "";
	// armando el listado
	o_mx_lista += '	<select class="listas" id="mx_opc_order"> ';
	o_mx_lista += ' 	<option value = "ccompid">Compañia Id</option> ';
	o_mx_lista += '		<option value = "compdesc">Nombre Completo</option> ';
	o_mx_lista += '	</select> ';
	// armando el encabezado 
	var o_mx_Header = "";
	o_mx_Header += ' <table id="mx_head" class="table_det"> ';
	o_mx_Header += '	<thead> ';
	o_mx_Header += '		<tr> ';
	o_mx_Header += '			<td width="100px"> Compañia Id </td> ';
	o_mx_Header += '			<td width="200px"> Nombre Completo </td> ';
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
		oRequest.open("POST","../modelo/crud_sycomp.php",false); 
		oRequest.send(oDatos);
		var odata = JSON.parse(oRequest.response);
		//cargando los valores de la pantalla.
		if (odata != null){
			var lnrows = odata.length;
			var o_mx_detalles = '<table id="mx_detalle"> ';
			o_mx_detalles += '<tbody>';
			for (var i = 0; lnrows > i; ++i){
				o_mx_detalles += '<tr class="xm_row_menu"> ';
				o_mx_detalles += '	<td width="100px"> '+ odata[i]["ccompid"]  + '</td> ';
				o_mx_detalles += '	<td width="200px">'+ odata[i]["compdesc"]+ '</td> ';
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
	cerrar_mx_view();
	// actualizando la compañia en que estamos.
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("program","entry_cia_work");
	oDatos.append("ccompid",lckey);
	oRequest.open("POST","../modelo/symodule.php",false); 
	oRequest.send(oDatos);
	var oCia = JSON.parse(oRequest.response);
	if (oCia != null){
		document.getElementById("cia_desc").value = oCia.compdesc;
		document.getElementById("cia_desc_small").value = oCia.compdesc;
		// cerrando las pantallas que puedan existir
		document.getElementById("ventana").setAttribute('src', '');
		if (oCia.compdesc == ""){getmsgalert("No Compañias Definidas ");}
	}else{
		getmsgalert("Compañia Invalida");
	}	
}
// -----------------------------------------------------------------------
// ------------------------------------------------------------------------
// Configuracion de Menus. 
// poniendo a la escucha a los diferentes objetos del menu correspondiente.		
//------------------------------------------------------------------------
function change_module(){
	var omenu_ar = "",omenu_in = "",omenu_ct = "",omenu_sy = "";
	
	if (document.getElementById("cia_desc").value == ""){
		getmsgalert("Seleccione Compañia")	;
	 	return;
	}
	var omenu = document.getElementById("bmenu");
		// Definiendo modulo de Cuentas por cobrar.
	    omenu_ar =  '<ul id="menu"> '+
					'	<li><a>Transacciones</a>'+
					'		<ul>'+
					'			<li><a id="tr001"> Facturacion y Notas de Debito</a></li>'+
					'			<li><a id="tr002"> Recibos de Dinero </a></li>'+
					'			<li><a id="tr007"> Preventa a Clientes</a></li>'+
					'			<li><a id="sy004" href="../index.php">Salir</a></li>'+
					'		</ul>'+
					'	</li>'+
					'	<li><a>Reportes</a>'+
					'		<ul>'+
					'			<li><a id="rp001"> Resumen de Ventas</a></li>'+
					'			<li><a id="rp006"> Resumen de Utilidades </a></li>'+
					'			<li><a id="rp002"> Cuentas por Cobrar</a></li>'+
					'			<li><a id="rp003"> Estado de Cuentas</a></li>'+
					'			<li><a id="rp009"> Vencimiento de Cartera </a></li>'+
					'			<li><a id="rp004"> Resumen de Cobros</a></li>'+
					'		</ul>'+
					'	</li>'+
					'	<li><a>Catalogos</a>'+
					'		<ul>'+
					'			<li><a id="ca001">Catalogo de Clientes</a></li>'+
					'			<li><a id="ca002">Condiciones de Pago</a></li>'+
					'			<li><a id="ca003">Maestro de Inventarios</a></li>'+
					'			<li><a id="ca004">Tipos de Inventarios</a></li>'+
					'			<li><a id="ca005">Proveedores</a></li>'+
					'			<li><a id="ca006">Tipos de Requisas / Entradas y Salidas</a></li>'+
					'			<li><a id="ca007">Bodegas</a></li>'+
					'			<li><a id="ca008">Tipos de Cambio</a></li>'+
					'		</ul>'+
					'	</li>'+
					'	<li><a>Modulo</a>'+
					'		<ul>'+
					'			<li><a id="mod001">Config VC-2020 WEB</a></li>'+
					'			<li><a id="mod002">Importar Data</a></li>'+
					'		</ul>'+
					'	</li>'+
					' </ul>'
		omenu_in =  '<ul id="menu"> '+
					'	<li><a>Transacciones</a>'+
					'		<ul>'+
					'			<li><a id="tr004"> Entradas y Salidas de Inventario </a></li>'+
					'			<li><a id="sy004" href="../index.php">Salir</a></li>'+
					'		</ul>'+
					'	</li>'+
					'	<li><a>Reportes</a>'+
					'		<ul>'+
					'			<li><a id="rp005"> Lista de Precios</a></li>'+
					'			<li><a id="rp007"> Formato de Requisas</a></li>'+
					'			<li><a id="rp008"> Entradas y Salidas</a></li>'+
					'			<li><a id="rp010"> Movimientos de Inventario Valorisados AD</a></li>'+
					'			<li><a id="rp011"> Maximos y Minimos </a></li>'+
					'		</ul>'+
					'	</li>'+
					'	<li><a>Catalogos</a>'+
					'		<ul>'+
					'			<li><a id="ca003">Maestro de Inventarios</a></li>'+
					'			<li><a id="ca004">Tipos de Inventarios</a></li>'+
					'			<li><a id="ca005">Proveedores</a></li>'+
					'			<li><a id="ca006">Tipos de Requisas / Entradas y Salidas</a></li>'+
					'			<li><a id="ca007">Bodegas</a></li>'+
					'			<li><a id="ca008">Tipos de Cambio</a></li>'+
					'		</ul>'+
					'	</li>'+
					'	<li><a>Configuraciones</a>'+
					'		<ul>'+
					'			<li><a id="mod001">Config VC-2020 WEB</a></li>'+
					'			<li><a id="mod002">Importar Data</a></li>'+
					'		</ul>'+
					'	</li>'+
					' </ul>'

	// menu de administracion 
	omenu_sy =   '<ul id="menu"> '+
					'	<li><a>Transacciones</a>'+
					'		<ul>'+
					'			<li><a id="sy001"> Configuracion de la Compañia </a></li>'+
					'			<li><a id="sy002">Grupos de trabajo</a></li>'+
					'			<li><a id="sy004" href="../index.php">Salir</a></li>'+
					'		</ul>'+
					'	</li>'+
					' </ul>'
	var omodule = document.getElementById("cmodule_select").value;
	omenu.innerHTML = "";
	
	if (omodule == "AR"){
		omenu.innerHTML = omenu_ar;
		upd_armenu();
	}
	if (omodule == "IN"){
		omenu.innerHTML = omenu_in;
		upd_inmenu();
	}
	if (omodule == "CT"){
		omenu.innerHTML = omenu_ct;
		upd_ctmenu();
	}
	if (omodule == "SY"){
		omenu.innerHTML = omenu_sy;
		upd_symenu();
	}
}

function change_module_small(pcmenuid){
	var omenu_ar = "",omenu_in = "",omenu_ct = "",omenu_sy = "";
	
	if (document.getElementById("cia_desc_small").value == ""){
		getmsgalert("Seleccione Compañia")	;
	 	return;
	}
	var omenu = document.getElementById("area_menu_small");
	var omodule = document.getElementById("cmodule_select_small").value;

	omenu.innerHTML = "";
	if (omodule == "AR"){
		if (pcmenuid.target.id == "transacciones"){
			omenu_ar_trn =  '<ul id="menu"> '+
			'	<li><a>Transacciones</a>'+
			'		<ul>'+
			'			<li><a id="tr001"> Facturacion y Notas de Debito</a></li>'+
			'			<li><a id="tr002"> Recibos de Dinero </a></li>'+
			'			<li><a id="tr007"> Preventa a Clientes</a></li>'+
			'			<li><a id="sy004" href="../index.php">Salir</a></li>'+
			'		</ul>'+
			'	</li>'	+
			' </ul>'

		/*
			'			<li><a id="tr003"> Cotizaciones </a></li>'+
			'			<li><a id="tr006"> Administracion de Pedidos </a></li>'+
			'			<li><a id="tr008"> Facturacion de Pedidos </a></li>'+
		*/	
			omenu.innerHTML = omenu_ar_trn;
			document.getElementById("tr001").addEventListener("click",tr001,false);
			document.getElementById("tr002").addEventListener("click",tr002,false);
		//	document.getElementById("tr003").addEventListener("click",tr003,false);
			document.getElementById("tr007").addEventListener("click",tr007,false);
		}

		if (pcmenuid.target.id == "reportes"){
			omenu_ar_rpt =  '<ul id="menu"> '+
			'	<li><a>Reportes</a>'+
			'		<ul>'+
			'			<li><a id="rp001"> Resumen de Ventas</a></li>'+
			'			<li><a id="rp002"> Cuentas por Cobrar</a></li>'+
			'			<li><a id="rp003"> Estado de Cuentas</a></li>'+
			'			<li><a id="rp009"> Vencimiento de Cartera</a></li>'+
			'			<li><a id="rp004"> Resumen de Cobros</a></li>'+
			'			<li><a id="rp006"> Resumen de Utilidades </a></li>'+
			'		</ul>'+
			'	</li>'+
			' </ul>'
			omenu.innerHTML = omenu_ar_rpt;
			document.getElementById("rp001").addEventListener("click",rp001,false);
			document.getElementById("rp002").addEventListener("click",rp002,false);
			document.getElementById("rp003").addEventListener("click",rp003,false);
			document.getElementById("rp004").addEventListener("clicrk",rp004,false);
			document.getElementById("rp006").addEventListener("clicrk",rp006,false);
			document.getElementById("rp009").addEventListener("clicrk",rp009,false);
		}

		if (pcmenuid.target.id == "catalogos"){
			omenu_ar_mnt =  '<ul id="menu"> '+
			'	<li><a>Catalogos</a>'+
			'		<ul>'+
			'			<li><a id="ca001">Catalogo de Clientes</a></li>'+
			'			<li><a id="ca002">Condiciones de Pago</a></li>'+
			'			<li><a id="ca003">Maestro de Inventarios</a></li>'+
			'			<li><a id="ca004">Tipos de Inventarios</a></li>'+
			'			<li><a id="ca005">Proveedores</a></li>'+
			'			<li><a id="ca006">Tipos de Requisas / Entradas y Salidas</a></li>'+
			'			<li><a id="ca007">Bodegas</a></li>'+
			'			<li><a id="ca008">Tipos de Cambio</a></li>'+
			'		</ul>'+
			'	</li>'+
			' </ul>'
			omenu.innerHTML = omenu_ar_mnt;
			document.getElementById("ca001").addEventListener("click",ca001,false);
			document.getElementById("ca002").addEventListener("click",ca002,false);
			document.getElementById("ca003").addEventListener("click",ca003,false);
			document.getElementById("ca004").addEventListener("click",ca004,false);
			document.getElementById("ca005").addEventListener("click",ca005,false);
			document.getElementById("ca006").addEventListener("click",ca006,false);
			document.getElementById("ca007").addEventListener("click",ca007,false);
			document.getElementById("ca008").addEventListener("click",ca008,false);
		}

		if(pcmenuid.target.id == "Modulos"){
			// Definiendo modulo de Cuentas por cobrar.
			omenu_in_conf = '<ul id="menu"> '+
							'	<li><a>Configuraciones</a>'+
							'		<ul>'+
							'			<li><a id="mod001">Config VC-2020 WEB</a></li>'+
							'			<li><a id="mod002">Importar Data</a></li>'+
							'		</ul>'+
							'	</li>'+
							' </ul>'
			omenu.innerHTML = omenu_in_conf;
			document.getElementById("mod001").addEventListener("click",mod001,false);
		}
	}	//if (omodule == "AR"){

	if (omodule == "IN"){
		if (pcmenuid.target.id == "transacciones"){
			omenu_in_trn =  '<ul id="menu"> '+
				'	<li><a>Transacciones</a>'+
				'		<ul>'+
				'			<li><a id="tr004"> Entradas y Salidas de Inventario </a></li>'+
				'			<li><a id="sy004" href="../index.php">Salir</a></li>'+
				'		</ul>'+
				'	</li>'+
				' </ul>'

				omenu.innerHTML = omenu_in_trn;
			document.getElementById("tr004").addEventListener("click",tr004,false);
			//document.getElementById("tr003").addEventListener("click",tr003,false);
		}
	
		if (pcmenuid.target.id == "reportes"){
				omenu_in_rpt = '<ul id="menu"> '+
				'	<li><a>Reportes</a>'+
				'		<ul>'+
				'			<li><a id="rp005"> Lista de Precios</a></li>'+
				'			<li><a id="rp007"> Formato de Requisas</a></li>'+
				'			<li><a id="rp008"> Entradas y Salidas</a></li>'+
				'			<li><a id="rp010"> Movimientos de Inventario Valorisados AD</a></li>'+
				'			<li><a id="rp011"> Maximos y Minimos </a></li>'+
				'		</ul>'+
				'	</li>'+
				' </ul>'
				omenu.innerHTML = omenu_in_rpt;
				document.getElementById("rp005").addEventListener("click",rp005,false);
				document.getElementById("rp007").addEventListener("click",rp007,false);
				document.getElementById("rp008").addEventListener("click",rp008,false);
				document.getElementById("rp010").addEventListener("click",rp010,false);
				document.getElementById("rp011").addEventListener("click",rp011,false);
				
		}
	
		if (pcmenuid.target.id == "catalogos"){
				omenu_in_mnt =  '<ul id="menu"> '+
				'	<li><a>Catalogos</a>'+
				'		<ul>'+
				'			<li><a id="ca003">Maestro de Inventarios</a></li>'+
				'			<li><a id="ca004">Tipos de Inventarios</a></li>'+
				'			<li><a id="ca005">Proveedores</a></li>'+
				'			<li><a id="ca006">Entradas y Salidas</a></li>'+
				'			<li><a id="ca007">Bodegas</a></li>'+
				'			<li><a id="ca008">Tipos de Cambio</a></li>'+
				'		</ul>'+
				'	</li>'+
				' </ul>'
				omenu.innerHTML = omenu_in_mnt;
				document.getElementById("ca003").addEventListener("click",ca003,false);
				document.getElementById("ca004").addEventListener("click",ca004,false);
				document.getElementById("ca005").addEventListener("click",ca005,false);
				document.getElementById("ca006").addEventListener("click",ca006,false);
				document.getElementById("ca007").addEventListener("click",ca007,false);
				document.getElementById("ca008").addEventListener("click",ca008,false);
			
		}
		if(pcmenuid.target.id == "Modulos"){
			// Definiendo modulo de Cuentas por cobrar.
			omenu_in_conf = '<ul id="menu"> '+
							'	<li><a>Configuraciones</a>'+
							'		<ul>'+
							'			<li><a id="mod001">Config VC-2020 WEB</a></li>'+
							'			<li><a id="mod002">Importar Data</a></li>'+
							'		</ul>'+
							'	</li>'+
							' </ul>'
			omenu.innerHTML = omenu_in_conf;
			document.getElementById("mod001").addEventListener("click",mod001,false);
		}

	}	//if (omodule == "AR"){
	
}	//function change_module_small(pcmenuid){
function upd_ctmenu(){
	
}
function upd_symenu(){
	document.getElementById("sy001").addEventListener("click",sy001,false);
	document.getElementById("sy002").addEventListener("click",sy002,false);
	//document.getElementById("sy003").addEventListener("click",sy003,false);
	document.getElementById("sy004").addEventListener("click",sy004,false);
}
function upd_armenu(){
	document.getElementById("tr001").addEventListener("click",tr001,false);
	document.getElementById("tr002").addEventListener("click",tr002,false);
//	document.getElementById("tr003").addEventListener("click",tr003,false);
	document.getElementById("tr007").addEventListener("click",tr007,false);
	
	document.getElementById("rp001").addEventListener("click",rp001,false);
	document.getElementById("rp002").addEventListener("click",rp002,false);
	document.getElementById("rp003").addEventListener("click",rp003,false);
	document.getElementById("rp004").addEventListener("click",rp004,false);
	document.getElementById("rp006").addEventListener("click",rp006,false);
	document.getElementById("rp009").addEventListener("click",rp009,false);

	document.getElementById("ca001").addEventListener("click",ca001,false);
	document.getElementById("ca002").addEventListener("click",ca002,false);
	document.getElementById("ca003").addEventListener("click",ca003,false);
	document.getElementById("ca004").addEventListener("click",ca004,false);
	document.getElementById("ca005").addEventListener("click",ca005,false);
	document.getElementById("ca006").addEventListener("click",ca006,false);
	document.getElementById("ca007").addEventListener("click",ca007,false);
	document.getElementById("ca008").addEventListener("click",ca008,false);

	document.getElementById("mod001").addEventListener("click",mod001,false);
	document.getElementById("mod002").addEventListener("click",mod002,false);
	
}
function upd_inmenu(){
	document.getElementById("tr004").addEventListener("click",tr004,false);
	
	document.getElementById("ca003").addEventListener("click",ca003,false);
	document.getElementById("ca004").addEventListener("click",ca004,false);
	document.getElementById("ca005").addEventListener("click",ca005,false);
	document.getElementById("ca006").addEventListener("click",ca006,false);
	document.getElementById("ca007").addEventListener("click",ca007,false);
	document.getElementById("ca008").addEventListener("click",ca008,false);

	document.getElementById("rp005").addEventListener("click",rp005,false);
	document.getElementById("rp007").addEventListener("click",rp007,false);
	document.getElementById("rp008").addEventListener("click",rp008,false);
	document.getElementById("rp010").addEventListener("click",rp010,false);
	document.getElementById("rp011").addEventListener("click",rp011,false);

	document.getElementById("mod002").addEventListener("click",mod002,false);
	document.getElementById("mod001").addEventListener("click",mod001,false);
}
//------------------------------------------------------------------------
// transacciones 
//------------------------------------------------------------------------
function tr001(){
	var llcont = doform("tr001");
	if (llcont){
		document.getElementById("ventana").setAttribute("src","../view/arinvc.php");	
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function tr002(){
	//document.getElementById("pcerrar").style.display = "block";			
	var llcont = doform("tr002");
	if (llcont){
		document.getElementById("ventana").setAttribute("src","../view/arcash.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}

	
}
function tr003(){
	var llcont = doform("tr003");
	if (llcont){
		document.getElementById("ventana").setAttribute("src","../view/arcotm.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function tr004(){
	var llcont = doform("tr004");
	if (llcont){
		document.getElementById("ventana").setAttribute("src","../view/aradjm.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function tr007(){
	var llcont = doform("tr007");
	if (llcont){
		document.getElementById("ventana").setAttribute("src","../view/arpodvm.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}

}

//------------------------------------------------------------------------
// Reportes
//------------------------------------------------------------------------
function rp001(){
	var llcont = doform("rp001");
	if (llcont){
		document.getElementById("ventana").setAttribute("src","../view/arinvc_r.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function rp002(){
	// Con esta opcion se devuelve falso o verdadero para el uso de esta opcion con el usuario actual en esta compañia.
	var llcont = doform("rp002");
	if (llcont){
		// Reporte de Cuentas por Cobrar.
		document.getElementById("ventana").setAttribute("src","../view/arcash1_r.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function rp003(){
	var llcont = doform("rp003");
	if (llcont){
		// reporte estado de cuenta.
		document.getElementById("ventana").setAttribute("src","../view/arcustb_r.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function rp004(){
	var llcont = doform("rp004");
	if (llcont){
		document.getElementById("ventana").setAttribute("src","../view/arcash_r.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function rp005(){
	var llcont = doform("rp005");
	if (llcont){
		document.getElementById("ventana").setAttribute("src","../view/arserm_r.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function rp006(){
	// reporte de utilidades.
	var llcont = doform("rp006");
	if (llcont){
		document.getElementById("ventana").setAttribute("src","../view/arinvt1_r.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function rp007(){
	var llcont = doform("rp007");
	if (llcont){
		document.getElementById("ventana").setAttribute("src","../view/aradjm_r.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function rp008(){
	var llcont = doform("rp008");
	if (llcont){
		document.getElementById("ventana").setAttribute("src","../view/aradjt_r.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function rp009(){
	var llcont = doform("rp009");
	if (llcont){
		// vencimiento de cartera
		document.getElementById("ventana").setAttribute("src","../view/arcash2_r.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function rp010(){
	// Movimientos Valorizados al dia de hoy
	var llcont = doform("rp010");
	if (llcont){
		// vencimiento de cartera
		document.getElementById("ventana").setAttribute("src","../view/arserm1_r.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function rp011(){
	// Maximos y Minimos
	var llcont = doform("rp011");
	if (llcont){
		// vencimiento de cartera
		document.getElementById("ventana").setAttribute("src","../view/arserm2_r.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}

//------------------------------------------------------------------------
// catalogos
//------------------------------------------------------------------------
function ca001(){
	var llcont = doform("ca001");
	if (llcont){
		// vencimiento de cartera
		document.getElementById("ventana").setAttribute("src","../view/arcust.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}

}
function ca002(){
	var llcont = doform("ca002");
	if (llcont){
		// vencimiento de cartera
		document.getElementById("ventana").setAttribute("src","../view/artcas.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function ca003(){
	var llcont = doform("ca003");
	if (llcont){
		// vencimiento de cartera
		document.getElementById("ventana").setAttribute("src","../view/arserm.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function ca004(){
	var llcont = doform("ca004");
	if (llcont){
		// vencimiento de cartera
		document.getElementById("ventana").setAttribute("src","../view/artser.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function ca005(){
	var llcont = doform("ca005");
	if (llcont){
		// vencimiento de cartera
		document.getElementById("ventana").setAttribute("src","../view/arresp.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function ca006(){
	var llcont = doform("ca006");
	if (llcont){
		// vencimiento de cartera
		document.getElementById("ventana").setAttribute("src","../view/arcate.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function ca007(){
	var llcont = doform("ca007");
	if (llcont){
		// vencimiento de cartera
		document.getElementById("ventana").setAttribute("src","../view/arwhse.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function ca008(){
	var llcont = doform("ca008");
	if (llcont){
		// vencimiento de cartera
		document.getElementById("ventana").setAttribute("src","../view/armone.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
//------------------------------------------------------------------------
// modulos
//------------------------------------------------------------------------
function mod001(){
	var llcont = doform("mod001");
	if (llcont){
		// vencimiento de cartera
		document.getElementById("ventana").setAttribute("src","../view/arsetup.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}

}
function mod002(){
	var llcont = doform("mod002");
	if (llcont){
		// vencimiento de cartera
		document.getElementById("ventana").setAttribute("src","../view/import_data.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function sy001(){
	var llcont = doform("sy001");
	if (llcont){
		// vencimiento de cartera
		document.getElementById("ventana").setAttribute("src","../view/sycomp.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function sy002(){
	var llcont = doform("sy002");
	if (llcont){
		// vencimiento de cartera
		document.getElementById("ventana").setAttribute("src","../view/sygrup.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function sy003(){
	var llcont = doform("sy003");
	if (llcont){
		// vencimiento de cartera
		document.getElementById("ventana").setAttribute("src","../view/syperm.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
function sy004(){
	var llcont = doform("sy004");
	if (llcont){
		// vencimiento de cartera
		document.getElementById("ventana").setAttribute("src","../view/syperm.php");
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
window.onload=init;
