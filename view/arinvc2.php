<?php
// iniciando validacion de session
include("../modelo/vc_funciones.php");
$lcStarSession = vc_funciones::Star_session();
//--------------------------------------------------------------------------------------------------------------
if ($lcStarSession == 1){
	return;
}
?>
<html>
	<head>
		<title>Modulo Facturacion</title>
		<link rel="stylesheet" href="../css/arinvc.css?v1">
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/arinvc.js?v1"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

	<body>
	
        <form class="form2" name="arinvc" id="arinvc" method="post" action="../modelo/crud_arinvc.php?accion=SAVE">
			<SCRIPT>get_barraprinc_trn_x("Facturacion","Ayuda del Modulo de Facturacion");</SCRIPT> 
			<section>
				<fieldset id="set1">
					<label class="labelnormal">Cliente </label> 
					<script>get_lista_arcust();</script> 
					<br>
					<label class="labelnormal">Bodega </label>
					<script>get_lista_arwhse();</script>&nbsp &nbsp &nbsp &nbsp
					<br>
					<label class="labelnormal">Condiciones </label> 
					<script>get_lista_artcas();</script>
					<br>
					<label class="labelnormal">Vendedor </label> 
					<script>get_lista_arresp();</script>
					<br>
					<label class="labelnormal">Fecha Emision </label> 
					<input type="date" name="dstardate" id="dstardate" class="textdate">
					<br>
					<label class="labelnormal">Fecha Vencimiento </label>
					<input type="date" name="denddate" id="denddate" class="textdate">
					<br>
					<label class="labelnormal">No. Factura</label> 
					<input type="text" class="textnormal" id="crefno" name="crefno"  >
					<br>
					<label class="labelnormal">Nombre</label> 
					<input type="text" class="textnormal" id="cdesc" name="cdesc"  >
					<br>
					<label class="labelnormal">Telefono</label>
					<input type="text" class="textnormal" id="ctel" name="ctel">
				</fieldset>
				<br>
				<fieldset id="set2">
					<label class="labelnormal">Tipo Cambio </label> 
					<input type="number" class="sayamt" id="ntc" name="ntc" readonly  >
					<br>
					<label class="labelnormal">Limite Credito</label> 
					<input type="number" class="sayamt" id="nlimcrd" name="nlimcrd" readonly  >
					<br>
					<label class="labelnormal">Credito Disponible </label> 
					<input type="number" class="sayamt" id="nsalecust" name="nsalecust" readonly  >
					<br>
					<label class="labelsencilla">Comentarios generales de la factura</label><br>
					<textarea id="mnotas" name="mnotas"  class="mnotas" rows=3 cols=34></textarea>
				</fieldset>
		    </section>
			<fieldset id="set3">
				<label class="labelnormal">Codigo de Articulo </label>
				<input type="text" class="textnormal" id="cservno1" name="cservno1" >
				<script>get_btmenu("btcservno","Listado de articulos");</script>
				<br>
				<br>
			</fieldset>

			<section id="adetalles">
				<table id="tdetalles">
					<thead>
						<tr class="table_det">
							<th width="90px">Codigo</th>
							<th width="220px">Descripcion de Producto</th>
							<th width="75px">Precio</th>
							<th width="75px">Cantidad</th>
							<th width="50px">Descuento</th>
							<th width="50px">IVA %</th>
							<th width="75px">Monto</th>
						</tr>
					</thead>
				<!--		<tbody id="articulos" name="articulos"></tbody>  -->
				</table>
			</section>
			
			<fieldset id="set4">
				<label class="labelnormal">Sub Total</label>
				<input type="text" id="nsubamt" name="nsubamt" class="sayamt" readonly>
				<br>
				<label class="labelnormal">Descuento</label>
				<input type="text" id="ndescamt" name="ndescamt"  class="sayamt" readonly>
				<br>
				<label class="labelnormal">Impuesto</label>
				<input type="text" id="ntaxamt"  name="ntaxamt" class="sayamt" readonly>
				<br>	
				<label class="labelnormal">Total General</label>
				<input type="text" name="ntotamt" id="ntotamt" class="sayamt" readonly >
			</fieldset>
		</form>
		
        <script>
			get_msg();
			get_xm_menu();
		</script>

		<form id="pantalla_pago" target="_blank" name="pantalla_pago" method="post" action="../reports/rpt_arinvc_tiquete.php" >	
				<section id="fpago" class="form2"  name="fpago">
					<div id="div1">
						<h1>Creacion de Factura</h1>
						</div>
					<br>

					<fieldset id="set7">
						<label class="labelnormal">Trans No</label>
						<input type="text" class="saytext" id="ctrnno1" name="ctrnno1" readonly>
						<br>
						<label class="labelnormal">Fecha de recibo</label>
						<input type="date" name="dpay" id="dpay" class="textdate">
						<br>
						<label class="labelnormal">Forma de Pago</label>
						<select id="ctype" name="ctype" class="listas">
							<option value="EF">Efectivo</option>
							<option value="TG">Targeta Credito</option>
							<option value="CK">Cheque </option>
							</select>
						<br>
						<label class="labelnormal">Referencia # </label>
						<input type="text" name="cref" id="cref" class="textnormal">
						<br>
						<label class="labelnormal">Descripcion</label>
						<input type="text" name="cdescpay" id="cdescpay" class="textnormal">
						<br><br>
						<label>Comentarios del recibo</label><br>
						<textarea class="mnotas" id="mnotasr" name="mnotasr"  rows=3 cols=49></textarea>
						<br>
					</fieldset>
					<br>
					<fieldset id="set5">
						<label id="set51">Monto Total</label>
						<input type="text" class="sayamt" id="topay" readonly>
						<br>
						<label id="set52">Abono</label>
						<input type="number" id="efectivo" name="efectivo" class="textqty">
						<br>
						<label id="set53">Cambio</label>
						<input type="number" class="sayamt" id="vuelto" readonly>
						<br>
						<br>
					</fieldset>
					<BR>
					<div id="set6">
						<script>
							get_boton("btsalvar","guardar.ico","Pagado");
							get_boton("btsalir","anular.gif","Volver");
							get_boton("btVer","printer.gif","Factura");
							get_boton("btnuevaf","nueva.ico","Nueva");
						</script>
					</div>
					<br>
				</section>
		</form>	
	
    </body>
</html>