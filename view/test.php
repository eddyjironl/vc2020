<?php
include("../modelo/vc_funciones.php");
if (vc_funciones::Star_session() == 1){
	return;
}
?>
<html>
	<head>
		<title>Sistema Visual Control v2020</title>
		<link   rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/vc_funciones.js"></script> 
		<link rel="shortcut icon" type="image/x-icon" href="../photos/vc2009.ico" />
	</head>
<script type="text/javascript">
	function init(){
		document.getElementById("crear").addEventListener("click",sendata,false);
	}
	
	function sendata(){
		document.getElementById("datos").innerText = "";
		var xmlhttp = new XMLHttpRequest();
		var oFdata  = new FormData();
		oFdata.append("ckey",document.getElementById("idd").value);
		xmlhttp.open("POST","../modelo/test.php",false);
		xmlhttp.send(oFdata);
		//document.getElementById("datos").innerText = xmlhttp.responseText;
		document.getElementById("datos").innerHTML = xmlhttp.response;
	}
	window.onload=init;
</script>

<body>

	<h2>Valores de Session</h2>
	
	<label>usuario: </label> 	<strong><?php   echo $_SESSION["cuser"];  ?>	</strong><br>
	<label>clave: </label> 		<strong>'<?php   echo $_SESSION["ckeyid"];  ?>'	</strong><br>
	<label>empresa: </label> 	<strong><?php   echo $_SESSION["chost"];  ?>	</strong><br>
	<label>host: </label> 		<strong><?php   echo $_SESSION["dbname"];  ?>	</strong><br>
	<label>Empresa:  </label> 	<strong><?php   echo $_SESSION["compdesc"];  ?>	</strong><br>
	<br>
	<label class="labelnormal">Compañia</label>
			<!-- <label class="labeltitle">Compañia de pruebas</label> -->
	<input type="text" id="cia_desc"  readonly value=" <?php ECHO  $_SESSION["compdesc"] ?>">
	
	<script>
		get_btmenu("btcias","Listado de Compañias");
		get_xm_menu();
		get_msg();
	</script>
	
	<br>
	<br>
	<label>Codigo </label>
	<input type="text" id="idd" name="idd"><br><br>
	<input type="button" id="crear"  name="crear" value="Verificar"/>
	<br>
	<br>
	<div id="datos"></div>
	
</body>

</html>