function init(){
	document.getElementById("quit").addEventListener("click",close_pantalla,false);
    document.getElementById("quit2").addEventListener("click",close_pantalla,false);

    document.getElementById("add").addEventListener("click",show_window_add,false);
    document.getElementById("add2").addEventListener("click",add_data_range,false);
	document.getElementById("plrent_add").style.display = "none";
    // cargamdp los datos por primera vez table_detail

    var oTableDet = document.getElementById("mx_detalle");
    var oRequest = new XMLHttpRequest();
    // Creando objeto para empaquetado de datos.
    var oDatos   = new FormData();
    // adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
    oDatos.append("accion","SHOW_DATA");
    oRequest.open("POST","../modelo/crud_plrent.php",false); 
    oRequest.send(oDatos);
    var odata = oRequest.responseText;
    //cargando los valores de la pantalla.
    if (odata != null){
        oTableDet.innerHTML = odata;
    }    
}
function deleteRow(pcuid){
		if (!confirm("Esta seguro de borrar este registro")){
			return ;
    	}
    var oTableDet = document.getElementById("mx_detalle");
    var oRequest  = new XMLHttpRequest();
    // Creando objeto para empaquetado de datos.
    var oDatos    = new FormData();
    // adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
    oDatos.append("accion","DELETEROW");
    oDatos.append("cuid",pcuid);
    oRequest.open("POST","../modelo/crud_plrent.php",false); 
    oRequest.send(oDatos);
    var odata = oRequest.responseText;
    //cargando los valores de la pantalla.
    if (odata != null){
        oTableDet.innerHTML = odata;
    }    
}

function edit_row(pcuid){
    var oRequest  = new XMLHttpRequest();
    // Creando objeto para empaquetado de datos.
    var oDatos    = new FormData();
    // adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
    oDatos.append("accion","JSON");
    oDatos.append("cuid",pcuid);
    oRequest.open("POST","../modelo/crud_plrent.php",false); 
    oRequest.send(oDatos);
    var odata = JSON.parse(oRequest.response);
    if (odata != null){
        document.getElementById("plrent_add").style.display="block";
        document.getElementById("cuid").value    = odata.cuid;
        document.getElementById("nstar").value   = odata.nstar;
        document.getElementById("nend").value    = odata.nend;
        document.getElementById("nrate").value   = odata.nrate;
        document.getElementById("npayamt").value = odata.npayamt;
    }
   

}
function close_pantalla(e){
    var oform = e.target.form.id;
    document.getElementById(oform).style.display = "none";
    if (oform == "plrent"){
        document.getElementById("plrent_add").style.display = "none";
    }
}
function show_window_add(){
    document.getElementById("plrent_add").style.display="block";
    document.getElementById("cuid").value    = "";
    document.getElementById("nstar").value   = 0;
    document.getElementById("nend").value    = 0;
    document.getElementById("nrate").value   = 0;
    document.getElementById("npayamt").value = 0;
}

function add_data_range(){
    var oTableDet = document.getElementById("mx_detalle");
    var loform = document.getElementById("plrent_add");
    var oRequest = new XMLHttpRequest();
    // Creando objeto para empaquetado de datos.
    var oDatos   = new FormData();
    // adicionando datos en formato CLAVE/VALOR en el objeto datos para enviar como parametro a la consulta AJAX
    oDatos.append("accion","NEW");
    
    oDatos.append("cuid",cuid.value);
    oDatos.append("nstar",nstar.value);
    oDatos.append("nend",nend.value);
    oDatos.append("nrate",nrate.value);
    oDatos.append("npayamt",npayamt.value);
    
    oRequest.open("POST","../modelo/crud_plrent.php",false); 
    oRequest.send(oDatos);
    var odata = oRequest.responseText;
    //cargando los valores de la pantalla.
    document.getElementById("plrent_add").style.display = "none";
    if (odata != null){
        oTableDet.innerHTML = odata;
    }else{
        oTableDet.innerHTML = "";
    }
    
}

window.onload=init;
