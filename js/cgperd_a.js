function init(){
	document.getElementById("cmdquit").addEventListener("click",cerrar_pantalla_principal,false);
	document.getElementById("cmdok").addEventListener("click",change_perid,false);
    document.getElementById("cyear").addEventListener("change",updte_global_perd_cg,false);
}
function cerrar_pantalla_principal(){
    document.getElementById("cgperd_a").style.display="none";
}
// cambiando el listado de la lista anterior
function updte_global_perd_cg(){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cyear",document.getElementById("cyear").value);
	oDatos.append("accion","get_lista_periodos");
	// obteniendo el menu
	oRequest.open("POST","../modelo/cgpuente.php",false); 
    oRequest.send(oDatos);
	document.getElementById("cperid").innerHTML = oRequest.response;
}
function change_perid(){
	var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cyear", document.getElementById("cyear").value);
	oDatos.append("cperid",document.getElementById("cperid").value);
	oDatos.append("accion","set_change_cperid");
	// obteniendo el menu
	oRequest.open("POST","../modelo/cgpuente.php",false); 
    oRequest.send(oDatos);
	cerrar_pantalla_principal();
}
window.onload=init;