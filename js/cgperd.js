function init() {
    document.getElementById("cmdexit").addEventListener("click",cerrar_pantalla_principal,false);
    document.getElementById("cmdadd").addEventListener("click",genPerList,false);
}
function cerrar_pantalla_principal() {
    document.getElementById("cgperd").style.display="none";
}
function genPerList() {
    if (document.getElementById("cyear").value == ""){
        alert("Indique el año del periodo");
        document.getElementById("cyear").focus();
        return ;
    }
    if (document.getElementById("dtrndate").value == ""){
        alert("Indique fecha de inicio del periodo");
        document.getElementById("dtrndate").focus();
        return ;
    }
    // procesando codigo de generar periodo
    var oRequest = new XMLHttpRequest();
	// Creando objeto para empaquetado de datos.
	var oDatos   = new FormData();
	// adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
	oDatos.append("cyear",document.getElementById("cyear").value);
	oDatos.append("dtrndate",document.getElementById("dtrndate").value);
	oDatos.append("nperid",document.getElementById("nperid").value);
	oDatos.append("accion","NEW");
	// obteniendo el menu
	oRequest.open("POST","../modelo/crud_cgperd.php",false); 
	oRequest.send(oDatos);
    alert(oRequest.responseText);
    cerrar_pantalla_principal();
}
window.onload=init;
