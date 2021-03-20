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
        <title>Preventa</title>
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<link rel="stylesheet" href="../css/arpodvm.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/arpodvm.js?v1"></script>
		<link rel="shortcut icon" type="image/x-icon" href="../photos/vc2009.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <form id="arpodvm">
        <h2 id="tscreen">Modulo Preventa</h2>
        <br>
        <br>
        <div>
            <img class="botones" src="../photos/save.ico" id="guardar" name="guardar" title="guardar el pedido" placeholder="guardar el pedido">
            <img class="botones"  src="../photos/Write.ico" id="btmnotas" name="mnotas">
            <img class="botones"  src="../photos/salir.ico" id="salir" name="salir">
        </div>
        
        <label class="labelminscreen">Ruta</label>
        <select id="crutno" name="crutno">
            <option value="managua">Ruta Managua</option>
            <option value="Rivas">Ruta Rivas</option>
            <option value="chinandega">Ruta Chinandega</option>
            <option value="corinto">Ruta Corinto</option>
        </select>
        <br>
        <label class="labelminscreen">Cliente</label>
        <script> get_lista_arcust();</script>
        <br>
        <label class="labelminscreen">Condicion</label>
        <script> get_lista_artcas();</script>
        <br>
        <label class="labelminscreen">Articulo</label>
        <input type="text" class="textnormal" id="cservno1" name="cservno1" >
	    <script>get_btmenu("btcservno","Listado de articulos");</script>
        <br><br>
        <fieldset class="fieldset" id="aencabezado">
				<table id="tencabezado">
					<thead>
						<tr class="table_det">
                            <th id="thcservno">Producto</th>
				            <th class="input_min" id="thnqty">Und</th>
				            <th class="input_min" id="thnprice">Precio</th>
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
<!--    
        <table id="tdetalles">
			<thead>
			<tr class="table_det">
				<th id="thcservno">Producto</th>
				<th class="input_min" id="thnqty">Und</th>
				<th class="input_min" id="thnprice">Precio</th>
                <td class="input_min" id="thnsalesamt">Total</td>
			</tr>
			</thead>
			<tbody id="articulos"></tbody>
		</table>
-->
        <div id="footer">
            <P ID="ntotal"> <STRONG>TOTAL A PAGAR:</STRONG>
                <input type="text" id="ntotamt" readonly>
            </P>
        </div>
    </form>

    <script>
		get_msg();
		get_xm_menu();
	</script>

</html>
