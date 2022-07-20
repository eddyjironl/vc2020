<?php
// ------------------------------------------------------------------------------------------------
// Descripcion.
// 	Definiendo funciones que se realizaran .
//	$lcaccion = isset($_POST["accion"])? $_POST["accion"],$_GET["accion"];
// ------------------------------------------------------------------------------------------------

include("../modelo/vc_funciones.php");
vc_funciones::Star_session();
$oConn = vc_funciones::get_coneccion("CIA");
if(isset($_POST["accion"])){
	$lcaccion = $_POST["accion"]; 	
}else{
	$lcaccion = $_GET["accion"]; 	
}

if (isset($_POST["cmicxno"])){
	$lcmicxno = $_POST["cmicxno"];
}

// id del maestro.
if(isset($_POST["cid"])){
    $lcid = $_POST["cid"];
}else{
    $lcid = $_GET["cid"];
}

$lnRowsAfect = 0;
// ------------------------------------------------------------------------------------------------
// DELETE, Borrando los datos.
// ------------------------------------------------------------------------------------------------
if($lcaccion=="DELETE"){
	//$oConn = get_coneccion("CIA");
	$lcsqlcmd = " delete from cgmic". $lcid ." where cmic". $lcid ."no = '" . $lcmicxno . "' ";
	$lresultF = mysqli_query($oConn,$lcsqlcmd);	
}
// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
	// haciendo la coneccion.
	//$oConn = get_coneccion("CIA");
	if (isset($_POST["cmicxno"])){
		$lcdesc    = mysqli_real_escape_string($oConn,$_POST["cdesc"]);
		$lmnotas   = mysqli_real_escape_string($oConn,$_POST["mnotas"]);
        $lcmicxno  = mysqli_real_escape_string($oConn,$_POST["cmicxno"]);
		// verificando que el codigo exista o no 
		$lcsql   = " select cdesc from cgmic". $lcid ." where cmic". $lcid ."no = '$lcmicxno' ";
		$lnCount = 0;
		$lresult = mysqli_query($oConn,$lcsql);	
		if (gettype($lresult) !="object"){
			$lnCount = 0;
		}else{
			$lnCount = mysqli_num_rows($lresult);
		}

		if ($lnCount == 0){
			// este codigo de cliente no existe por tanto lo crea	
			// ejecutando el insert para la tabla de clientes.
			$lcsqlcmd = " insert into cgmic". $lcid ." (cmic". $lcid ."no,cdesc,mnotas)	values('$lcmicxno','$lcdesc','$lmnotas')";
		}else{
			// el codigo existe lo que hace es actualizarlo.	
			$lcsqlcmd = " update cgmic". $lcid ." set cdesc = '$lcdesc',mnotas = '$lmnotas' where cmic". $lcid ."no = '$lcmicxno' ";
		}
		// ------------------------------------------------------------------------------------------------
		// Generando coneccion y procesando el comando.
		// ------------------------------------------------------------------------------------------------
		$lresultF = mysqli_query($oConn,$lcsqlcmd);	
		//mysqli_query($oConn,$lcsqlcmd);
		$lnRowsAfect = mysqli_affected_rows($oConn);
	}  	// if (isset($_POST["ccateno"])){
	header("location:../view/cgmicx.php?cid=".$lcid);		
}  		//if($lcaccion=="NEW")
// ------------------------------------------------------------------------------------------------
// JSON, - Informacion detallada de un solo registro.
// ------------------------------------------------------------------------------------------------
if ($lcaccion == "JSON"){
	// Consulta unitaria
	$lcSqlCmd = "select cgmic". $lcid .".*, cmic". $lcid ."no as cmicxno from cgmic". $lcid ." where cmic". $lcid ."no ='$lcmicxno'";
	// obteniendo datos del servidor
	$lcResult = mysqli_query($oConn,$lcSqlCmd);
	//if (gettype($lcResult)== "object"){ 
    	// convirtiendo estos datos en un array asociativo
    	$ldata = mysqli_fetch_assoc($lcResult);
    	// convirtiendo este array en archivo jason.
    	$jsondata = json_encode($ldata,true);
    	// retornando objeto json
		echo $jsondata;
	/*}else{
		echo null;
	}
	*/	
}

//Cerrando la coneccion.
mysqli_close($oConn);
?>
