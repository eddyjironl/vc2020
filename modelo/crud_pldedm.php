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
if (isset($_POST["cdedid"])){
	$lcdedid = $_POST["cdedid"];
}
$lnRowsAfect = 0;
// ------------------------------------------------------------------------------------------------
// DELETE, Borrando los datos.
// ------------------------------------------------------------------------------------------------
if($lcaccion=="DELETE"){
	//$oConn = get_coneccion("CIA");
	$lcsqlcmd = " delete from pldedm where cdedid = '" . $lcdedid . "' ";
	$lresultF = mysqli_query($oConn,$lcsqlcmd);	
}
// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
	// haciendo la coneccion.
	//$oConn = get_coneccion("CIA");
	if (isset($_POST["cdedid"])){
		$lcdesc    = mysqli_real_escape_string($oConn,$_POST["cdesc"]);
		$lcstatus  = mysqli_real_escape_string($oConn,$_POST["cstatus"]);
		$lcdescsh  = mysqli_real_escape_string($oConn,$_POST["cdescsh"]);
		$lnvalue   = ($_POST["nvalue"]=="")? 0:$_POST["nvalue"];
		$lmnotas   = mysqli_real_escape_string($oConn,$_POST["mnotas"]);
		$lcctaid_d = mysqli_real_escape_string($oConn,$_POST["cctaid_d"]);
		$lcctaid_h = mysqli_real_escape_string($oConn,$_POST["cctaid_h"]);
		$lclear    = isset($_POST["lclear"]) ? 1:0;   

		// verificando que el codigo exista o no 
		$lcsql   = " select cdedid from pldedm where cdedid = '$lcdedid' ";
		$lresult = mysqli_query($oConn,$lcsql);	
		$lnCount = mysqli_num_rows($lresult);
		if ($lnCount == 0){
			// este codigo de cliente no existe por tanto lo crea	
			// ejecutando el insert para la tabla de clientes.
			$lcsqlcmd = " insert into pldedm (cdedid,cdesc,cstatus,cdescsh,mnotas,nvalue,cctaid_d,cctaid_h,lclear)
							values('$lcdedid','$lcdesc','$lcstatus','$lcdescsh','$lmnotas',$lnvalue,'$lcctaid_d','$lcctaid_h',$lclear)";
		}else{
			// el codigo existe lo que hace es actualizarlo.	
			$lcsqlcmd = " update pldedm set cdesc = '$lcdesc',cstatus = '$lcstatus',mnotas = '$lmnotas', cdescsh = '$lcdescsh' ,
			              cctaid_d = '$lcctaid_d',cctaid_h = '$lcctaid_h',lclear =$lclear
						  where cdedid = '$lcdedid' ";
		}
		// ------------------------------------------------------------------------------------------------
		// Generando coneccion y procesando el comando.
		// ------------------------------------------------------------------------------------------------
		$lresultF = mysqli_query($oConn,$lcsqlcmd);	
		//mysqli_query($oConn,$lcsqlcmd);
		$lnRowsAfect = mysqli_affected_rows($oConn);
	}  	// if (isset($_POST["ccateno"])){
	header("location:../view/pldedm.php");		
}  		//if($lcaccion=="NEW")
// ------------------------------------------------------------------------------------------------
// JSON, - Informacion detallada de un solo registro.
// ------------------------------------------------------------------------------------------------
if ($lcaccion == "JSON"){
	if (isset($_POST["cdedid"])){
 		// Consulta unitaria
		$lcSqlCmd = " select * from pldedm where cdedid ='". $_POST["cdedid"] ."'";
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
