<?php 
// iniciando validacion de session
include("../modelo/vc_funciones.php");
//--------------------------------------------------------------------------------------------------------------
if (vc_funciones::Star_session() == 1){
	return;
}
?>
<!DOCTYPEHTML>
<html>
	<head>
		<title>Sistema Visual Control v2020</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">		
		<link   rel="stylesheet" href="../css/escritorio.css?v1"> 
		<link   rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/escritorio.js?v1" ></script>
		<link rel="shortcut icon" type="image/x-icon" href="../photos/vc2009.ico" />
	</head>
	
	<body id="espacio" background="../photos/fondo3.png">
		
		<iframe id="ventana"> </iframe>
	
		<div id="barra1"> 
			<div id="divlogo">
				<img id="logovc" src="../photos/LOGITO11.jpg" id="icono">
			</div>
			<div id="barra1-a">
				Autorizado a: <strong>Modulo de Evaluacion</strong>
			</div>
			<br>
			<div id="area_menu">
				<nav id="bmenu"></nav>
			</div>
		</div>
		
		<footer> 
			<label class="labelnormal">Compañia</label>
			<!-- <label class="labeltitle">Compañia de pruebas</label> -->
			<input type="text" id="cia_desc"  readonly value=" <?php ECHO  $_SESSION["compdesc"] ?>">
			<script>get_btmenu("btcias","Listado de Compañias");</script>
			<br>
			<label class="labelnormal">Usuario</label>
			<!-- <label class="labeltitle">Compañia de pruebas</label> -->
			<input type="text" id="cfullname"  readonly value=" <?php ECHO  $_SESSION["cfullname"] ?>">
			<br>
			<label class="labelnormal">Modulos del Sistema</label>
			<select class="listas" id="cmodule_select">
					<option value=""> Elija un Modulo de trabajo</option>
					<option value="SY"> Administracion</option>
					<option value="AR"> Facturacion y Cuentas por cobrar</option>
					<option value="IN"> Control de inventario y Cuentas por pagar</option>
					<option value="CT"> Contabilidad General</option>
				</select>
		</footer>
		<script>
			get_xm_menu();
			get_msg();

		</script>
	</body>
</html>