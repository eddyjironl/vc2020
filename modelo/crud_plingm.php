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

if (isset($_POST["cingid"])){
	$lcingid = $_POST["cingid"];
}
$lnRowsAfect = 0;

// ------------------------------------------------------------------------------------------------
// DELETE, Borrando los datos.
// ------------------------------------------------------------------------------------------------
if($lcaccion=="DELETE"){
	//$oConn = get_coneccion("CIA");
	$lcsqlcmd = " delete from plingm where cingid = '" . $lcingid . "' ";
	$lresultF = mysqli_query($oConn,$lcsqlcmd);	
}

// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
	// haciendo la coneccion.
	//$oConn = get_coneccion("CIA");
	if (isset($_POST["cingid"])){
		$lcdesc   = $_POST["cdesc"];
		$lcstatus = $_POST["cstatus"];
		$lcdescsh = $_POST["cdescsh"];
		$lcctaid  = $_POST["cctaid"];
		$lnvalue  = $_POST["nvalue"];
		$lvac     = isset($_POST["lvac"]) ? 1:0;   
		$lIhsApl  = isset($_POST["lIhsApl"]) ? 1:0;
		$lvecinal = isset($_POST["lvecinal"]) ? 1:0; 
		$l1314avo = isset($_POST["l1314avo"]) ? 1:0; 
		$lprest   = isset($_POST["lprest"]) ? 1:0; 
		$lclear   = isset($_POST["lclear"]) ? 1:0; 
		
		// verificando que el codigo exista o no 
		$lcsql   = " select cingid from plingm where cingid = '$lcingid' ";
		$lresult = mysqli_query($oConn,$lcsql);	
		$lnCount = mysqli_num_rows($lresult);
		if ($lnCount == 0){
			// este codigo de cliente no existe por tanto lo crea	
			// ejecutando el insert para la tabla de clientes.
			$lcsqlcmd = " insert into plingm (cingid,cdesc,cstatus,cdescsh,cctaid,nvalue,lvac,lIhsApl,lvecinal,l1314avo,lprest,lclear )
							values('$lcingid','$lcdesc','$lcstatus','$lcdescsh','$lcctaid',$lnvalue,$lvac,$lIhsApl,$lvecinal,$l1314avo,$lprest,$lclear)";
		}else{
			// el codigo existe lo que hace es actualizarlo.	
			$lcsqlcmd = " update plingm set  cdesc = '$lcdesc', cstatus = '$lcstatus', cdescsh = '$lcdescsh', cctaid = '$lcctaid' ,
			              nvalue = $lnvalue,lvac = $lvac,lIhsApl =$lIhsApl ,lvecinal =$lvecinal,l1314avo =$l1314avo,lprest = $lprest,lclear = $lclear
						  where cingid = '$lcingid' ";
		}
		// ------------------------------------------------------------------------------------------------
		// Generando coneccion y procesando el comando.
		// ------------------------------------------------------------------------------------------------
		$lresultF = mysqli_query($oConn,$lcsqlcmd);	
		//mysqli_query($oConn,$lcsqlcmd);
		$lnRowsAfect = mysqli_affected_rows($oConn);
	}  	// if (isset($_POST["ccateno"])){
	header("location:../view/plingm.php");		
}  		//if($lcaccion=="NEW")

// ------------------------------------------------------------------------------------------------
// JSON, - Informacion detallada de un solo registro.
// ------------------------------------------------------------------------------------------------
if ($lcaccion == "JSON"){
	if (isset($_POST["cingid"])){
 		// Consulta unitaria
		$lcSqlCmd = " select * from plingm where cingid ='". $_POST["cingid"] ."'";
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
