<?php
// iniciando validacion de session
include("../modelo/vc_funciones.php");
include("../modelo/cgmodule.php");
//--------------------------------------------------------------------------------------------------------------
if (vc_funciones::Star_session() == 1){
	return;
}
cgmodule::init();

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Asientos de Diario</title>
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/cgmast_1.js?v1"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
	</head>
	
	<body>
			<script>mensaje();</script>
		<form class="form2" id="cgmast_1" name="cgmast_1" method="post" action="../modelo/crud_cgmonm.php?accion=NEW">
			<script>get_barraprinc_trn_x("Registro de Asientos","Ayuda Registro de Asientos ");</script> 	
			<div class="contenedor_objetos">
				<label class="labelnormal">Modo Pantalla </label>
				<select id="cmodo" name="cmodo" >
				<option value="1">Registrar</option>
				<option value="2">Ver Detalles</option>
				</select>
				<label class="labelnormal">Responsable</label>
				<select id="crespno" name="crespno" class="listas">
				<option value="">Elija un Responsable</option>
				<option value="1">Eddy jiron Guillen</option>
				</select>
				<label class="labelnormal">P.t.d.a. #</label>
				<input type="text" class="ckey" name="ctrnno" id="ctrnno">
				<script>get_btmenu("btctrnno","Listado de Asientos de Diario");</script>
			</div>
			<div class="contenedor_objetos">

				<label class="labelnormal">Fecha </label>
				<input type="date" id="dtrndate" name="dtrndate" autocomplete="off">
				<br>
				<label class="labelnormal">Descripcion</label>
				<input type="text" id="cdesc" name="cdesc" class="textcdesc" autocomplete="off" value = "<?php echo var_dump($_SESSION); ?>" >
				<br>
				<label class="labelnormal">Tipo Cambio </label>
				<input type="number" id="nrate" name="nrate" class="textkey" autocomplete="off">
				<br>
				<label class="labelnormal">Periodo Id</label>
				<select name="cperid" id="cperid">
					<option value="">Elija periodo</option>
				</select>
				<br>
				<label class="labelnormal">Tipo Documento </label>
				<select name="ctype" id="ctype" class="listas">
					<option value="0"> Comprobante Apertura </option>
					<option value="1"> Comprobante Diario </option>
					<option value="2"> Comprobante Compras </option>
					<option value="3"> Comprobante Ingresos </option>
				</select>
				<br>
				<label class="labelsencilla">Comentarios Generales</label><br>
				<textarea id="mnotas" name="mnotas" class="mnotas" rows=3 cols=95> </textarea>
			</div>
            <div class="contenedor_objetos">
                <table>
                    <theader>
                        <tr class="grid_header">
							<th style="width:60px">Cuenta Id</th>
							<th style="width:100px">Descripcion</th>
                            <th style="width:60px"> Debe </th>
                            <th style="width:60px"> Haber</th>
                            <th style="width:75px"> Acciones</th>
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

		<script>get_msg();</script>
		<div id="showmenulist"></div>

	</body>
</html>