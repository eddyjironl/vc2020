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
		<title>Moneda y Tipo de Cambio</title>
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/cgmonm.js?v1"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<body>
		<form class="form2" id="cgmonm" name="cgmonm" method="post" action="../modelo/crud_cgmonm.php?accion=NEW">
			<script>get_barraprinc_x("Moneda y Tipo de Cambio","Ayuda de Moneda y Tipos de Cambio");</script> 	
			<div class="contenedor_objetos">
				<label class="labelnormal">Moneda Id</label>
				<input type="text" id="cmonid" name="cmonid" class="textkey" autocomplete="off" autofocus>
				<script>get_btmenu("btcmonid","Listado de Monedas y Tipo Cambio");</script>
				<br>
				<label class="labelnormal">Descripcion</label>
				<input type="text" id="cdesc" name="cdesc" class="textcdesc" autocomplete="off">
				<br>
				<label class="labelnormal">Simbolo </label>
				<input type="text" id="csimbolo" name="csimbolo" class="textkey" autocomplete="off">
				<br>
				<label class="labelnormal">Methodo Cal</label>
				<select id="cmetodo" name="cmetodo" class="listas">
					<option value="">Elija un procedimiento</option>
					<option value="D">Divicion</option>
					<option value="M">Multiplicacion</option>
				</select>
				<br>
				<label class="labelsencilla">Comentarios Generales</label><br>
				<textarea id="mnotas" name="mnotas" class="mnotas" rows=4 cols=55> </textarea>
			</div>
            <div class="contenedor_objetos">
                <label class="labelsencilla">Detalle de Fechas T/C</label>
                <table>
                    <theader>
                        <tr class="grid_header">
							<th style="width:60px">Id Linea</th>
							<th style="width:100px"> Fecha </th>
                            <th style="width:60px"> T / C </th>
                            <th style="width:75px"> Acciones </th>
                        </tr>
                    </theader>
                </table>
            </div>
            <div class="contenedor_objetos"> 
	            <div class="grid_area_detalles" style="height: 100px; width:310px;"> 
    	            <table>
        	           <tbody id="tdetalles"></tbody>
            	    </table>
            	</div>    
            </div>

			<div class="contenedor_objetos">
				<script>get_btprinc("btnew","cmdadd");</script>
            </div>
		</form>

		<form class="form3" name="cgmond" id="cgmond" method="post" action ="">
			<div class="barra_info">
				<strong>Registro de Fechas / Moneda</strong>
			</div>
			<div class="contenedor_objetos">
				<label class="labelnormal">Id Linea</label>
				<input type="text" id="cuid" name="cuid" class="textkeyreadonly" autocomplete="off" autofocus>
				<br>
				<label class="labelnormal">Moneda Id</label>
				<input type="text" id="cmonid1" name="cmonid1" class="textkeyreadonly" autocomplete="off" autofocus>
				<br>
				<label class="labelnormal">Descripcion</label>
				<input type="text" id="cdesc1" name="cdesc1" class="textcdescreadonly" autocomplete="off">
				<br>	
				<label class="labelnormal">Fecha </label>
				<input type="date" id="dtrndate" name="dtrndate" class="textdate">
				<br>
				<label class="labelnormal">Tipo Cambio </label>
				<input type="number" id="ntc" name="ntc" class="textdate">
			</div>
			<div class="contenedor_objetos">
				<script>get_btprinc("btquit","cmdquit");</script>
				<script>get_btprinc("btsave","cmdsave");</script>
            </div>

		</form>
		<script>get_msg();</script>
		<div id="showmenulist"></div>

	</body>
</html>