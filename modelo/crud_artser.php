<?php
// ------------------------------------------------------------------------------------------------
// Descripcion.
// 	Definiendo funciones que se realizaran .
//	$lcaccion = isset($_POST["accion"])? $_POST["accion"],$_GET["accion"];
// ------------------------------------------------------------------------------------------------

include("../modelo/armodule.php");
include("../modelo/vc_funciones.php");
vc_funciones::Star_session();
$oConn = vc_funciones::get_coneccion("CIA");


if(isset($_POST["accion"])){
	$lcaccion = $_POST["accion"]; 	
}else{
	$lcaccion = $_GET["accion"]; 	
}

if (isset($_POST["ctserno"])){
	$lctserno = $_POST["ctserno"];
}
$lnRowsAfect = 0;

// ------------------------------------------------------------------------------------------------
// DELETE, Borrando los datos.
// ------------------------------------------------------------------------------------------------
if($lcaccion=="DELETE"){
	//$oConn = get_coneccion("CIA");
	$lcsqlcmd = " delete from artser where ctserno = '" . $lctserno . "' ";
	$lresultF = mysqli_query($oConn,$lcsqlcmd);	
}

if($lcaccion=="MENU"){
	// el where no siempre viene incluido
	$lcwhere  = "";
	if (!empty($_POST["filtro"])){
		$lcwhere  = " where ". $_POST["orden"]. " like '%". $_POST["filtro"] ."%' ";
	}
	// ordenamiento del reporte siempre debe estar lleno.	
	$lcorder  = " order by ". $_POST["orden"];
	// sentencia sql filtrada.
	$lcsql    = " select * from artser ". $lcwhere . $lcorder;
	$lcresult = mysqli_query($oConn,$lcsql);
	$ojson    = '[';
	$lnveces  = 1;
	$lcSpace  = "";
	while ($ldata = mysqli_fetch_assoc($lcresult)){
		if ($lnveces == 1){
			$lnveces = 2;
		}else{
			$lcSpace = ",";			
		}
		$ojson = $ojson . $lcSpace .'{"ctserno":"' .$ldata["ctserno"] .'","cdesc":"'. $ldata["cdesc"] .'"}';	
	}
	$ojson = $ojson . ']';
	// enviando variable json.
	echo $ojson;		
}
// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
	// haciendo la coneccion.
	//$oConn = get_coneccion("CIA");
	if (isset($_POST["ctserno"])){
		$lcdesc     = mysqli_real_escape_string($oConn,$_POST["cdesc"]);
		$lcstatus   = mysqli_real_escape_string($oConn,$_POST["cstatus"]);
		$lmnotas    = mysqli_real_escape_string($oConn, $_POST["mnotas"]);
		// verificando que el codigo exista o no 
		$lcsql   = " select ctserno from artser where ctserno ='$lctserno' ";
		$lresult = mysqli_query($oConn,$lcsql);	
		$lnCount = mysqli_num_rows($lresult);
		if ($lnCount == 0){
			// este codigo de cliente no existe por tanto lo crea	
			// ejecutando el insert para la tabla de clientes.
			$lcsqlcmd = " insert into artser (ctserno,cdesc,cstatus,mnotas)
							values('$lctserno','$lcdesc','$lcstatus','$lmnotas')";
		}else{
			// el codigo existe lo que hace es actualizarlo.	
			$lcsqlcmd = " update artser set cdesc = '$lcdesc',cstatus = '$lcstatus',mnotas = '$lmnotas' where ctserno = '$lctserno' ";
		}
		// ------------------------------------------------------------------------------------------------
		// Generando coneccion y procesando el comando.
		// ------------------------------------------------------------------------------------------------
		$lresultF = mysqli_query($oConn,$lcsqlcmd);	
		//mysqli_query($oConn,$lcsqlcmd);
		$lnRowsAfect = mysqli_affected_rows($oConn);
	}  	// if (isset($_POST["ctserno"])){
	header("location:../view/artser.php");		
}  		//if($lcaccion=="NEW")

// ------------------------------------------------------------------------------------------------
// JSON, - Informacion detallada de un solo registro.
// ------------------------------------------------------------------------------------------------
if ($lcaccion == "JSON"){
	if (isset($_POST["ctserno"])){
 		// Consulta unitaria
		$lcSqlCmd = " select * from artser where ctserno ='". $_POST["ctserno"] ."'";
		// obteniendo datos del servidor
		$lcResult = mysqli_query($oConn,$lcSqlCmd);
		// convirtiendo estos datos en un array asociativo
		$ldata = mysqli_fetch_assoc($lcResult);
		// convirtiendo este array en archivo jason.
		$jsondata = json_encode($ldata,true);
		// retornando objeto json
		echo $jsondata;
	}	
}

if ($lcaccion == "PANTALLA_MENU"){
	if (isset($_POST["opcion"])){
		echo "<table>
			<tr id='th_menu'>
				<th style='width:100px;'>Codigo</th>
				<th style='width:200px;'>Descripcion</th>
				<th style='width:100px;'>Accion</th>
			</tr>	
		</table>";
	}else{
		// Menu completo de lista de clie,$lcSqlCmdn;tes
		$lcSqlCmd = " select * from artser order by cdesc ";
		$lcResult = mysqli_query($oConn,$lcSqlCmd); 
		// devolvera una tabla
		echo "<table>";
		while ($rows = mysqli_fetch_assoc($lcResult)){
			$lctserno   ='"'. $rows["ctserno"] .'"';
			$lcfullname ='"btctserno"';
			$lcnombre   = " '".$rows["cdesc"] ."' ";
			echo	"<tr>".
					"<td style='width:100px;'>". $rows["ctserno"] ."</td>".
					"<td style='width:200px;'>". $rows["cdesc"]   ."</td>".
					"<td>".
						"<input type='button' value='Seleccionar' id='btmenu_list' name='btmenu_list' ".
						"title=" . $lcnombre . " onclick='refres_window(btmenu_list[0].id,$lctserno,$lcfullname)'>".
					"</td>".
				"</tr>";
		}
		echo '</table>';
	}
}

// LISTA, Genera menu de lista de proveedores.
if ($lcaccion == "LISTA"){
		//$oConn = get_coneccion("CIA");
	    $lcSqlCmd = " select * from artser order by cdesc ";
		$lcResult = mysqli_query($oConn,$lcSqlCmd);
		echo '<select class="listas" name="ctserno" id="ctserno" required>';
		echo '<option value="">Elija un Registro </option>';		
		while ($rows = mysqli_fetch_assoc($lcResult)){
			echo "<option value='" . $rows["ctserno"] ."'>"  . $rows["cdesc"]  . "</option>";
		}
		echo '</select>';
}

//Cerrando la coneccion.
mysqli_close($oConn);
?>
