<?php
// iniciando validacion de session
include("../modelo/vc_funciones.php");
//--------------------------------------------------------------------------------------------------------------
if (vc_funciones::Star_session() == 1){
	return;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Responsables</title>
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/cgresp.js?v1"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<body>
		<form class="form2" id="cgresp" name="cgresp" method="post" action="../modelo/crud_cgresp.php?accion=NEW">
			<script>get_barraprinc_x("Responsables","Ayuda de Responsables");</script> 	
			<fieldset class="fieldset">
				<label class="labelnormal">Responsable Id</label>
				<input type="text" id="crespno" name="crespno" class="textkey" autocomplete="off" autofocus>
				<script>get_btmenu("btcrespno","Listado de responsables");</script>
				<br>
				<label class="labelnormal">Nombre</label>
				<input type="text" id="cdesc" name="cdesc" class="textcdesc" autocomplete="off">
				<br>
				<label class="labelsencilla">Comentarios Generales</label><br>
				<textarea id="mnotas" name="mnotas" class="mnotas" rows=9 cols=55> </textarea>
			</fieldset>
		</form>
		<script>get_msg();</script>
		<div id="showmenulist"></div>

	</body>
</html>