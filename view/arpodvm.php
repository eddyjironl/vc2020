<?php
// iniciando validacion de session
include("../modelo/vc_funciones.php");
include("../modelo/esp_arpodvm.php");

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
    <form id="arpodvm" name="arpodvm" class="form_change" >
    <script>get_barraprinc_trn_x("Formulario de pedidos de clientes","Ayuda formulario de pedidos");</script> 	

        <h2 id="tscreen">Modulo Preventa</h2>
        <div>
            <img class="botones" src="../photos/save.ico" id="guardar" name="guardar" title="guardar el pedido" placeholder="guardar el pedido">
            <img class="botones"  src="../photos/Write.ico" id="btmnotas" name="btmnotas" title="Ingresar un comentario al pedido" placeholder="Ingresar un comentario al pedido">
           <!-- <a href="https://www.google.com"> </a>-->
                <img class="botones"  src="../photos/salir.ico" id="salir" name="salir"  title="Salir del Modulo" placeholder="Salir del Modulo">    
            
        </div>
        <label class="labelminscreen">Ruta</label>
         <?php get_list_arubim(); ?>
        <br>
        <label class="labelminscreen">Cliente</label>
        <div id="dlcliente"><?php get_list_ccustno(""); ?></div>
        <br>
        <label class="labelminscreen">Condicion</label>
        <script> get_lista_artcas();</script>
        <br>
        <div id="dmnotash">
            <label>Comentarios del Pedido</label>
            <br>
            <textarea id="mnotash" name="mnotash" ></textarea>
        </div>
        <br id="separa">

        <label class="labelminscreen">Articulo</label>
        <input type="text" class="textnormal" id="cservno1" name="cservno1" >
	    <script>get_btmenu("btcservno","Listado de articulos");</script>
        <br><br>
        <fieldset class="fieldset" id="aencabezado">
				<table id="tencabezado">
					<thead>
						<tr class="table_det">
                            <th id="thcservno">Producto</th>
				            <th id="thnqty">Und</th>
				            <th id="thnprice">Precio</th>
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
        <div id="footer">
            <P ID="ntotal"> <STRONG>TOTAL A PAGAR:</STRONG>
                <input type="text" id="ntotamt" readonly>
            </P>
        </div>
    </form>
    <div id="dmnotas">
            <h2 id="tscreen2">Comentarios sobre el pedido</h2>
            <br>
            <br>
            <div>
                <img class="botones" src="../photos/save.ico"  id="guardar_mnotas" name="guardar_mnotas" title="Guarda comentario y Cierra pantalla de comentario">
                <img class="botones" src="../photos/salir.ico" id="salir_mnotas"   name="salir_mnotas"   title="Borra comentario y Cierra pantalla de comentario">
            </div>
            <textarea id="mnotas"></textarea>
        </div>

    <script>
		get_msg();
		get_xm_menu();
	</script>

</html>
