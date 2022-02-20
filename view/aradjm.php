<?php
// iniciando validacion de session
include("../modelo/vc_funciones.php");
//--------------------------------------------------------------------------------------------------------------
$lcStarSession = vc_funciones::Star_session();
//--------------------------------------------------------------------------------------------------------------
if ($lcStarSession == 1){
	return;
}
?>
<html>
	<head>
		<title>Entradas y Salidas de Inventario</title>
		<link rel="stylesheet" href="../css/aradjm.css?v1">
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/aradjm.js?v1"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<body>
		<form class="form2" name="aradjm" id="aradjm" method="post" action="../modelo/crud_aradjm.php?accion=SAVE">
			<SCRIPT>get_barraprinc_trn_x("Entradas y Salidas","Ayuda del Modulo de Entradas y Salidas");</SCRIPT> 
			
			<br>
			<label class="labelnormal">Bodega Origen</label>
			<script>get_lista_arwhse("");</script>&nbsp &nbsp &nbsp &nbsp
			<br>
			<label class="labelnormal">Tipo de Requisicion </label> 
			<script>get_lista_arcate("A");</script>

			<div class="tab">
				<button  class="tablinks" id="tbinfo1" >Informacion General</button>
				<button  class="tablinks" id="tbinfo2" >Detalle de Traslado</button>
				<button  class="tablinks" id="tbinfo3" >Comentarios Generales </button>
			</div>		
			
			<div id="finfo1" class="tabcontent">

				<fieldset class="fieldset">
					<label class="labelnormal">Proveedor Id </label> 
					<script>get_lista_arresp();</script>
					<label class="labelnormal">Tipo Cambio </label> 
					<input type="number" class="sayamt" id="ntc" name="ntc" readonly  >
					<br>
					<label class="labelnormal">Fecha Requisicion </label> 
					<input type="date" name="dtrndate" id="dtrndate" class="textdate">
					<br>
					<label class="labelnormal">No. Factura / Ref</label> 
					<input type="text" class="textnormal" id="crefno" name="crefno"  >
					<br>
					<label class="labelnormal">Crodigo de Articulo </label>
					<input type="text" class="textkey" id="cservno1" name="cservno1" >
					<script>get_btmenu("btcservno11","Listado de articulos");</script>
			</div>

			<div id="finfo2" class="tabcontent">
				<fieldset class="fieldset">
					<label class="labelnormal">Bodega Destino </label>
					<script>get_lista_arwhse("cwhseno1");</script>&nbsp &nbsp &nbsp &nbsp
					<br>
					<label class="labelnormal">Tipo de Requisicion </label> 
					<script>get_lista_arcate("A","ccateno1");</script>
				</fieldset>
			</div>

			<div id="finfo3" class="tabcontent">
				<textarea id="mnotas" name="mnotas" class="mnotas" rows=6 cols=72></textarea>
			</div>			
			
			<fieldset class="fieldset" id="aencabezado">
				<table id="tencabezado">
					<thead>
						<tr class="table_det">
							<th width="92px">Codigo</th>
							<th width="223px">Descripcion de Producto</th>
							<th width="100px">Costo</th>
							<th width="100px">Cantidad</th>
						</tr>
					</thead>
				</table>
			</fieldset>
			<br>
			<fieldset class="fieldset" id="adetalles">
					<table id="tdetalles">
						<tbody id="articulos"></tbody>
					</table>
				</fieldset>
				<br><br><br>
			<fieldset class="fieldset">
					<label class="labelnormal">Total General</label>
					<input type="text" name="ntotamt" id="ntotamt" class="sayamt" readonly >
				</fieldset>


		</form>

		<section id="area_bloqueo"> 
			<form class="form2"  id="pantalla" target="_blank" name="pantalla" method="post" action="../reports/rpt_aradjm.php" >	
					<div id="barra_sencilla">
						<h1>Guardar Requisa</h1>
					</div>
					<br>
					<fieldset class="fieldset" id="area_info">
						<label class="labelnormal">Requisa No</label>
						<input  type="number" class="sayamt" id="cadjno" name="cadjno" readonly>
					</fieldset>
					<BR>
					<div id="btopciones">
						<script>
							get_boton("btsalvar","guardar.ico","Guardar");
							get_boton("btsalir","anular.gif","Cancelar");
						</script>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<script>
							get_boton("btVer","printer.gif","Imprimir");
							get_boton("btnuevaf","nueva.ico","Nueva");
						</script>
					</div>
			</form>
		</section>
		<div id="showmenulist"></div>			
		<script>get_msg();</script>
	</body>
</html>