function init(){
	document.getElementById("cmodule_select").addEventListener("change",change_module,false);
	document.getElementById("btcias").addEventListener("click",function(){
        get_menu_list("syscomp","showmenulist","cia_desc","select_company");
    },false);
	document.getElementById("cmodule_select").value = "AR";
	change_module();
}	
function select_company(){
	var lckey = document.getElementById("cia_desc").value;
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
function getmodulemenu(pcmodule){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("program","get_module_menu");
	oDatos.append("cmodule",pcmodule);
	oRequest.open("POST","../modelo/symodule.php",false); 
	oRequest.send(oDatos);
	var omenu_x = oRequest.response;
	return omenu_x;
}
function change_module(){
	var omenu_general = "";
	if (document.getElementById("cia_desc").value == ""){
		getmsgalert("Seleccione Compañia")	;
	 	return;
	}
	var omenu = document.getElementById("bmenu");
	omenu.innerHTML = "";
	omenu_general   = getmodulemenu(document.getElementById("cmodule_select").value);
	omenu.innerHTML = omenu_general;
	config_click_menu(document.getElementById("cmodule_select").value);
}
function config_click_menu(pcmodule){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("program","get_menu_id");
	oDatos.append("cmodule",pcmodule);
	oRequest.open("POST","../modelo/symodule.php",false); 
	oRequest.send(oDatos);
	var omenu_x = JSON.parse(oRequest.response);
	
	for (let i = 0; i < omenu_x.length; i++) {
		document.getElementById(omenu_x[i]["cmenuid"]).addEventListener("click",function(){
			ckviewallow(omenu_x[i]["cmenuid"],omenu_x[i]["cview"]);
		},false);
	}
}
/* Esta funcion llamara a todas las vistas y comprobara el derecho de acceso usando su ID, */
function ckviewallow(pcidmenu,pcurlview){
	var llcont = doform(pcidmenu);
	if (llcont){
		document.getElementById("ventana").setAttribute("src",pcurlview);	
	}else{
		getmsgalert("Usuario no tiene derecho de acceso");
	}
}
window.onload=init;
