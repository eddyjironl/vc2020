<?php
	// iniciando validacion de session
	include("../modelo/vc_funciones.php");
	include("../modelo/cgmodule.php");
	//--------------------------------------------------------------------------------------------------------------
	if (vc_funciones::Star_session() == 1){
		return;
	}
	$oCg = new cgmodule();
	$oCg->init();
	
	//$oConn = vc_funciones::get_coneccion("CIA"); 
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Asientos de Diario</title>
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/cgmast_1.js?v1"></script>
		<script src="../bootstrap-5.2.1-dist/js/bootstrap.js"></script>
		<link rel="stylesheet" href="../bootstrap-5.2.1-dist/css/bootstrap.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<style>
		.colnum{
			text-align:left;
			color:blue;
		}
	</style>
	
	<body class="body_print2" style="background-color: transparent;">
		<form class="form2" id="cgmast_1" name="cgmast_1" method="post" action="../modelo/crud_cgmast_1.php?accion=NEW">
			<script>get_barraprinc_trn_x("Registro de Asientos","Ayuda Registro de Asientos ");</script> 	
			<div class="contenedor_objetos">
				<label class="labelnormal">Modo Pantalla </label>
				<select id="cmodo" name="cmodo" class="listas" >
					<option value="1">Registrar</option>
					<option value="2">Ver Detalles</option>
				</select>
				<label class="labelnormal">Responsable</label>
				<select id="crespno" name="crespno" class="listas">
					<option value="">Elija un Responsable</option>
					<?php
						$oConn    = vc_funciones::get_coneccion("CIA"); 
						$lcsqlcmd = "select crespno, cdesc from cgresp order by cdesc asc ";
						$lcresult = mysqli_query($oConn, $lcsqlcmd);
						// recorriendo todo.
						while ($data = mysqli_fetch_assoc($lcresult)){
							echo "<option value = '".$data['crespno']."' >". $data['cdesc'] ."</option>";
						}
					?>
				</select>
				<label class="labelnormal">P.t.d.a. #</label>
				<input type="text" class="ckey" name="ctrnno" id="ctrnno">
				<script>get_btmenu("btctrnno","Listado de Asientos de Diario");</script>
			</div>
			<div class="contenedor_objetos" style="float:left;">
				<label class="labelnormal">Fecha </label>
				<input type="date" id="dtrndate" name="dtrndate" autocomplete="off">
				<br>
				<label class="labelnormal">Periodo Id</label>
				<select name="cperid" id="cperid" class="listas" style="width:210px;">
					<option value="">Elija periodo</option>
					<?php
						$oConn    = vc_funciones::get_coneccion("CIA"); 
						$lcsqlcmd = " select cperid, cdesc from cgperd where lclose = 0 order by cperid desc ";
						$lcresult = mysqli_query($oConn, $lcsqlcmd);
						// recorriendo todo.
						while ($data = mysqli_fetch_assoc($lcresult)){
							if($data["cperid"]== $_SESSION["cperidw"]){
								echo "<option selected value = '".$data['cperid']."' >". $data['cdesc'] ."</option>";
							}else{
								echo "<option value = '".$data['cperid']."' >". $data['cdesc'] ."</option>";
							}
						}
					?>
				</select>
				<br>
				<label class="labelnormal">Tipo Documento </label>
				<select name="ctype" id="ctype" class="listas"  style="width:210px;">
					<option value="0"> Comprobante Apertura </option>
					<option value="1"> Comprobante Diario </option>
					<option value="2"> Comprobante Compras </option>
					<option value="3"> Comprobante Ingresos </option>
				</select>
				<br>
				<label class="labelnormal">Descripcion</label>
				<input type="text" id="cdesc" name="cdesc" class="textcdesc" autocomplete="off" >
				<br>
				<label class="labelnormal">Tipo Cambio </label>
				<input type="number" id="nrate" name="nrate" class="textkey" autocomplete="off">
				<br>
				<br>
			</div>
			<div class="contenedor_objetos" style="float:left;">
				<label class="labelsencilla">Comentarios Generales</label><br>
				<textarea id="mnotas" name="mnotas" class="mnotas" rows=5 cols=59> </textarea><br>
			</div>
			<br>
			<div class="contenedor_objetos">
					<label class="labelnormal">Cuenta Id </label>
					<input type="text" placeholder="Digite Cuenta" class="textkey" id="cctaid" name="cctaid">		
					<script>get_btmenu("btcctaid","Listado de Cuentas Operativas");</script>
					<br>
			</div>
			<div class="contenedor_objetos grid_area_detalles" style="height: 300px; width:100%;">
                <table class= "table table-hover table-sm mt-1">
                    <theader position="fixed">
                        <tr class="grid_header">
							<th scope="col"> Cuenta Id</th>
							<th scope="col"> Descripcion</th>
                            <th scope="col"> Debe </th>
                            <th scope="col"> Haber</th>
                            <th scope="col"> Acciones</th>
                        </tr>
                    </theader>
						<tbody id="tdetalles" >
							<?php 
								for ($i=0; $i < 15 ; $i++) { 
								ECHO "<tr> ";
								echo '<td scope="col" name="id">250572-01 </td>';
								echo '	<td scope="col" name="cdescd">Cuentas Ejiron </th>';
								echo '	<td scope="col" name="ndebe">1</td>';
								echo '	<td scope="col" name="nhaber">2</td>';
								echo '	<td>';
								echo "		<img src='../photos/escoba.ico' id='btquitar' class='botones_row'  onclick='deleteRow(this)' title='Eliminar Registro'/>";
								echo "		<img src='../photos/write.ico' id='bteditar' class='botones_row'  onclick='editRow(this)' title='Editar Registro'/>";
								echo '	</td>';
								echo '</tr>';
								}
							?>
					   	</tbody>
	    	    </table>
        	</div>    

			<div class="contenedor_objetos">
					<div>			
						<h6><strong>Totales Generales</strong></h6>
					</div>
					<label><strong>Debe</strong></label>
					<input type="text" id="tdebe" readonly class="labelnormal">
					<label><strong>Haber</strong></label>
					<input type="text" id="thaber" readonly class="labelnormal">
					<label ><strong>Diferencia</strong></label>
					<input type="text" id="tdiferencia" readonly class="labelnormal" style="background:red; color:yellow;">
			</div>
		</form>
			<!-- pantalla de edicion de registro 
			<div class="form2" id="form_detelle" style="position:absolute;">
				<div class="barra_info">
					<strong>Informacion de Cuenta</strong>
				</div>
			
				<div class="contenedor_objetos">
					<label class="labelnormal">Id Linea </label>

					<input type="text" placeholder="Creando Registro" readonly class="textkeyreadonly" id="cuid" name="cuid">		
					<br>
					<label class="labelnormal">Cuenta Id </label>
					<input type="text" placeholder="Digite Cuenta" class="textkey" id="cctaid" name="cctaid">		
					<script>get_btmenu("btcctaid","Listado de Cuentas Operativas");</script>
					<br>
					<label class="labelnormal">Debe</label>
					<input type="number" id="ndebe"	name="ndebe" class="textqty">
					<br>
					<label class="labelnormal">haber</label>
					<input type="number" id="nhaber"	name="nhaber" class="textqty">
					<br>
					<label class="labelsencilla">Comentarios Generales</label><br>
					<textarea id="mnotas_d" name="mnotas_d" class="mnotas" rows=5 cols=59> </textarea><br>
					<br>

				</div>
				<div>
					<script>
						get_boton("btsalvard","guardar.ico","Guardar");
						get_boton("btsalird","salir.ico","Volver");
					</script>
				</div>
			</div>
			-->
				
			<!-- pantalla de guardado de registro -->
		<form id="pantalla_guardar" class="form2" target="_blank" name="pantalla_guardar" method="post" action="../reports/rpt_arinvc_tiquete.php" >	
			<div class="barra_info">
				<strong>Creacion de Factura</strong>
			</div>
			<div class="contenedor_objetos">
				<label class="labelnormal">Trans No</label>
				<input type="text" class="textkey" id="ctrnno1" name="ctrnno1" readonly>
			</div>
			<div class="contenedor_objetos">
				<script>
					get_boton("btsalvar","guardar.ico","Guardar");
					get_boton("btsalir","anular.gif","Volver");
					get_boton("btVer","printer.gif","Documento");
					get_boton("btnuevaf","nueva.ico","Nueva");
				</script>
			</div>
		</form>	
		<script>get_msg();</script>
		<div id="showmenulist"></div>
		<input type="hidden" value="14" name="ctrnno1" id="ctrnno1">
	</body>
</html>
