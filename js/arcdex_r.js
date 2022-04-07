var xMenuId = "";
function init(){
	document.getElementById("btquit").addEventListener("click",cerrar_pantalla,false);
	document.getElementById("btprint").addEventListener("click",print,false);
	document.getElementById("btnueva").addEventListener("click",nueva,false);
	// ------------------------------------------------------------------------
	// CODIGO PARA LOS MENUS INTERACTIVOS.
	// CADA MENU
	// servicio

	document.getElementById("btcservno_1").addEventListener("click",function(){
        get_menu_list("arserm","showmenulist","cservno_1","");
    },false);
	// bodega
	document.getElementById("btcwhseno_1").addEventListener("click",function(){
        get_menu_list("arwhse","showmenulist","cwhseno_1","");
    },false);
    document.getElementById("btcwhseno_2").addEventListener("click",function(){
        get_menu_list("arwhse","showmenulist","cwhseno_2","");
    },false);
}
function nueva(){
	var objects = document.querySelectorAll("input");
	for (var i=0; i<objects.length; i++){
		objects[i].value = "";
	}
}
function cerrar_pantalla(){
	document.getElementById("arcdex_r").style.display="none";
}
function print(){
 document.getElementById("arcdex_r").submit();
}
window.onload=init;