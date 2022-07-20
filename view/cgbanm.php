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
		<title>Bancos</title>
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/cgbanm.js?v1"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            #addcta{
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                /*transition: opacity 400ms ease-in;*/
            }
        </style>    

    </head>
	
	<body>
		<form class="form2" id="cgbanm" name="cgbanm" method="post" action="../modelo/crud_cgbanm.php?accion=NEW">
			<script>get_barraprinc_x("Bancos","Ayuda de Bancos");</script> 	
			<div class="contenedor_objetos">
				<label class="labelnormal">Bancos Id</label>
				<input type="text" id="cbanno" name="cbanno" class="textkey" autocomplete="off" autofocus>
				<script>get_btmenu("btcbanno","Listado de Bancos");</script>
				<br>
				<label class="labelnormal">Descripcion</label>
				<input type="text" id="cdesc" name="cdesc" class="textcdesc" autocomplete="off">
				<br>
				<label class="labelnormal">Formato Chk</label>
				<input type="text" id="chk" name="chk" class="textcdesc" autocomplete="off">
				<br>
				<label class="labelsencilla">Comentarios Generales</label><br>
				<textarea id="mnotas" name="mnotas" class="mnotas" rows=6 cols=65> </textarea>
			</div>

            <div class="contenedor_objetos">
                <table>
                    <theader>
                        <tr class="grid_header">
                            <th style="width:150px;">Cuenta Descripcion </th>
                            <th style="width:100px;">Contabilidad</th>
                            <th style="width:100px;">Moneda </th>
                            <th style="width:50px;"># Inical</th>
                            <th style="width:150px;">Comentario </th>
                            <th style="width:50px;">Acciones </th>
                        </tr>
                    </theader>
                </table>
            </div>
            <div class="contenedor_objetos"> 
                <div class="grid_area_detalles" style="height: 100px;"> 
                    <table id="tdetalles">
                       <tbody ></tbody>
                    </table>
                </div>    
            </div>

            <div class="contenedor_objetos">
                <script>get_btprinc("btnew","btnueva1");</script>
            </div>
		</form>

        <!-- Pantalla para agregar uno -->
        <form id="addcta" class="form2" method="post" action="../modelo/crud_cgbanm.php?accion=NEWLINE">
            <div class="barra_info">
                <strong>Creacion / Edicion de Cuentas</strong>
            </div>
            <div class="contenedor_objetos"> 
                <label class="labelnormal">ID</label>
                <input type="text" id="cuid" name="cuid" class="saykey">
                <br>
                <label class="labelnormal">Banco Id</label>
                <input type="text" id="cbanno1" name="cbanno1" class="saykey">
                <br>
                <label class="labelnormal"> Descripcion Cta </label>
                <input type="text" id="cdesc1" name="cdesc1" class="textcdesc">
                <br>
                <label class="labelnormal">Cuenta ID </label>
                <input type="text" id="cctaid" name = "cctaid" class="ckey">
                <script>get_btmenu("btcctaid","Listado de Cuentas operativas");</script>
                <input type="text" class="textcdescreadonly" id="cctaiddesc">
                <br>
                <label class="labelnormal">Moneda </label>
                <input type="text" id = "cmonid" name="cmonid" class="ckey">
                <script>get_btmenu("btcmonid","Listado de Monedas");</script>
                <input type="text" class="textcdescreadonly" id="cmonidcdesc">
                <br>
                <label class="labelnormal">Consecutivo </label>
                <input type="number" name = "cckqno" id="cckqno" class="textdesc">
                <br>
                <label class="labelsencilla">Comentarios Generales</label><br>
                <textarea id="mnotas1" name="mnotas1" id="mnotas1" class="mnotas" rows=6 cols=63> </textarea>
       
                <div class="contenedor_objetos">
                    <script>get_btprinc("btsave","btsave12");</script>
                    <script>get_btprinc("btquit","btclose");</script>
                </div>
            </div>
        </form>

		<script>get_msg();</script>
		<div id="showmenulist"></div>
	</body>
</html>