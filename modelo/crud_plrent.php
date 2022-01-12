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
if (isset($_POST["cuid"])){
	$lcuid = $_POST["cuid"];
}
$lnRowsAfect = 0;
// ------------------------------------------------------------------------------------------------
// DELETE, Borrando los datos.
// ------------------------------------------------------------------------------------------------
if($lcaccion=="DELETE"){
	//$oConn = get_coneccion("CIA");
	$lcsqlcmd = " delete from plimpm where cuid = '" . $lcuid . "' ";
	$lresultF = mysqli_query($oConn,$lcsqlcmd);	
}
// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
	// haciendo la coneccion.
	$lcuid    = $_POST["cuid"];
	$lnstar   = $_POST["nstar"];
	$lnend    = $_POST["nend"];
	$lnrate   = $_POST["nrate"];
	$lnpayamt = $_POST["npayamt"];
	if ($lcuid == ""){
		$lcsqlcmd = " insert into plimpm (nstar,nend,nrate,npayamt)	values($lnstar,$lnend,$lnrate,$lnpayamt)";
	}else{
		// el codigo existe lo que hace es actualizarlo.	
		$lcsqlcmd = " update plimpm set nstar = $lnstar, nend = $lnend, nrate = $lnrate, npayamt = $lnpayamt where cuid = '$lcuid' ";
	}
	// ------------------------------------------------------------------------------------------------
	// Generando coneccion y procesando el comando.
	// ------------------------------------------------------------------------------------------------
	$lresultF = mysqli_query($oConn,$lcsqlcmd);	
    $lcaccion = "SHOW_DATA";
}  		//if($lcaccion=="NEW")
// ------------------------------------------------------------------------------------------------
// JSON, - Informacion detallada de un solo registro.
// ------------------------------------------------------------------------------------------------
if ($lcaccion == "JSON"){
	if (isset($_POST["cuid"])){
 		// Consulta unitaria
		$lcSqlCmd = " select * from plimpm where cuid ='". $_POST["cuid"] ."'";
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
// borrando una linea.
if ($lcaccion == "DELETEROW"){
	if($_POST["cuid"] !=""){
		$lcsqlcmd = " delete from plimpm where cuid ='" . $_POST["cuid"] . "'";
		mysqli_query($oConn, $lcsqlcmd);
		$lcaccion = "SHOW_DATA";
	}
}

if($lcaccion == "SHOW_DATA"){
    $lcsqlcmd = " select * from plimpm order by nstar asc";
    $lcResult = mysqli_query($oConn,$lcsqlcmd);
    // obteniendo lista de todos los datos.
    if ($lcResult->num_rows > 0){
        while($odata = mysqli_fetch_assoc($lcResult)){
            echo "<tr>";
            echo "<td width=100px> ". $odata["cuid"]    . " </td>";
            echo "<td width=100px> ". $odata["nstar"]   . " </td>";
            echo "<td width=100px> ". $odata["nend"]    . " </td>";
            echo "<td width=100px> ". $odata["nrate"]   . " </td>";
            echo "<td width=100px> ". $odata["npayamt"] . " </td>";
            echo "<td width='50px'><img src='../photos/escoba.ico' class='botones_row' onclick='deleteRow(". $odata['cuid'] .")' title='Eliminar Linea'/>";
			echo "<img src='../photos/editar.ico' class='botones_row' onclick='edit_row(". $odata['cuid'] .")' title='Editar Linea de Deduccion'/></td>";
            echo "</tr>";
        }    
		//echo "<td width='20px'><img src='../photos/escoba.ico' class='botones_row' onclick='deleteRow(this)' title='Eliminar Linea'/></td>";
		//echo "<td width='30px'><img src='../photos/editar.ico' class='botones_row' onclick='edit_deduction(". $odata['cuid'] .")' title='Editar Linea de Deduccion'/></td>";
    }
}


//Cerrando la coneccion.
mysqli_close($oConn);
?>
