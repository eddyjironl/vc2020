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
if (isset($_POST["cturno"])){
	$lcturno = $_POST["cturno"];
}
$lnRowsAfect = 0;
// ------------------------------------------------------------------------------------------------
// DELETE, Borrando los datos.
// ------------------------------------------------------------------------------------------------
if($lcaccion=="DELETE"){
	//$oConn = get_coneccion("CIA");
	$lcsqlcmd = " delete from plturm where cturno = '" . $lcturno . "' ";
	$lresultF = mysqli_query($oConn,$lcsqlcmd);	
}
// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
	// haciendo la coneccion.
	//$oConn = get_coneccion("CIA");
	if (isset($_POST["cturno"])){
		$lcdesc  = mysqli_real_escape_string($oConn,$_POST["cdesc"]);
		$lmnotas = mysqli_real_escape_string($oConn,$_POST["mnotas"]);

		// verificando que el codigo exista o no 
		$lcsql   = " select cturno from plturm where cturno = '$lcturno' ";
		$lresult = mysqli_query($oConn,$lcsql);	
		$lnCount = mysqli_num_rows($lresult);
		if ($lnCount == 0){
			// este codigo de cliente no existe por tanto lo crea	
			// ejecutando el insert para la tabla de clientes.
			$lcsqlcmd = " insert into plturm (cturno,cdesc,mnotas)	values('$lcturno','$lcdesc','$lmnotas')";
		}else{
			// el codigo existe lo que hace es actualizarlo.	
			$lcsqlcmd = " update plturm set cdesc = '$lcdesc',mnotas = '$lmnotas' where cturno = '$lcturno' ";
		}
		// ------------------------------------------------------------------------------------------------
		// Generando coneccion y procesando el comando.
		// ------------------------------------------------------------------------------------------------
		$lresultF = mysqli_query($oConn,$lcsqlcmd);	
		//mysqli_query($oConn,$lcsqlcmd);
		$lnRowsAfect = mysqli_affected_rows($oConn);
	}  	// if (isset($_POST["ccateno"])){
	header("location:../view/plturm.php");		
}  		//if($lcaccion=="NEW")
// ------------------------------------------------------------------------------------------------
// JSON, - Informacion detallada de un solo registro.
// ------------------------------------------------------------------------------------------------
if ($lcaccion == "JSON"){
	if (isset($_POST["cturno"])){
 		// Consulta unitaria
		$lcSqlCmd = " select * from plturm where cturno ='". $_POST["cturno"] ."'";
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
//Cerrando la coneccion.
mysqli_close($oConn);
?>
