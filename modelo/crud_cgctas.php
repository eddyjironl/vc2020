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
if (isset($_POST["cctaid"])){
	$lcctaid = $_POST["cctaid"];
}
$lnRowsAfect = 0;
// ------------------------------------------------------------------------------------------------
// DELETE, Borrando los datos.
// ------------------------------------------------------------------------------------------------
if($lcaccion=="DELETE"){
	//$oConn = get_coneccion("CIA");
	$lcsqlcmd = " delete from cgctas where cctaid = '" . $lcctaid . "' ";
	$lresultF = mysqli_query($oConn,$lcsqlcmd);	
}
// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
	// haciendo la coneccion.
	//$oConn = get_coneccion("CIA");
	if (isset($_POST["cctaid"])){
		$lcdesc    = mysqli_real_escape_string($oConn,$_POST["cdesc"]);
		$lmnotas   = mysqli_real_escape_string($oConn,$_POST["mnotas"]);
		$lpost     = isset($_POST["lpost"]) ? 1:0;   
		$lapplyir  = isset($_POST["lapplyir"]) ? 1:0;   
        $lcgrupid  = mysqli_real_escape_string($oConn,$_POST["cgrupid"]);     
        $lctype    = mysqli_real_escape_string($oConn,$_POST["ctype"]);
        $lcmic1no  = mysqli_real_escape_string($oConn,$_POST["cmic1no"]);
        $lcmic2no  = mysqli_real_escape_string($oConn,$_POST["cmic2no"]);
        $lcmic3no  = mysqli_real_escape_string($oConn,$_POST["cmic3no"]);
        $lcmic4no  = mysqli_real_escape_string($oConn,$_POST["cmic4no"]);
        $lcmic5no  = mysqli_real_escape_string($oConn,$_POST["cmic5no"]);
		// verificando que el codigo exista o no 
		$lcsql   = " select cctaid from cgctas where cctaid = '$lcctaid' ";
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
			$lcsqlcmd = " insert into cgctas (cctaid,cdesc,mnotas,lpost,lapplyir,ctype,cgrupid, cmic1no,cmic2no,cmic3no,cmic4no,cmic5no)
							values('$lcctaid','$lcdesc','$lmnotas',$lpost,$lapplyir,'$lctype','$lcgrupid','$lcmic1no','$lcmic2no','$lcmic3no','$lcmic4no','$lcmic5no')";
		}else{
			// el codigo existe lo que hace es actualizarlo.	
			$lcsqlcmd = " update cgctas set cdesc = '$lcdesc',mnotas = '$lmnotas', ctype = '$lctype' ,lapplyir = $lapplyir,
			              cmic1no = '$lcmic1no',cmic2no = '$lcmic2no',cmic3no = '$lcmic3no',cmic4no = '$lcmic4no',
						  cmic5no = '$lcmic5no',cgrupid = '$lcgrupid', lpost = $lpost
						  where cctaid = '$lcctaid' ";
		}
		// ------------------------------------------------------------------------------------------------
		// Generando coneccion y procesando el comando.
		// ------------------------------------------------------------------------------------------------
		$lresultF = mysqli_query($oConn,$lcsqlcmd);	
		//mysqli_query($oConn,$lcsqlcmd);
		$lnRowsAfect = mysqli_affected_rows($oConn);
	}  	// if (isset($_POST["ccateno"])){
	header("location:../view/cgctas.php");		
}  		//if($lcaccion=="NEW")
// ------------------------------------------------------------------------------------------------
// JSON, - Informacion detallada de un solo registro.
// ------------------------------------------------------------------------------------------------
if ($lcaccion == "JSON"){
	// Consulta unitaria
	$lcSqlCmd = " select cgctas.*,
					cgmic1.cdesc as cdesc1,
					cgmic2.cdesc as cdesc2,
					cgmic3.cdesc as cdesc3,
					cgmic4.cdesc as cdesc4,
					cgmic5.cdesc as cdesc5
				from cgctas
				left outer join cgmic1 on cgmic1.cmic1no = cgctas.cmic1no
				left outer join cgmic2 on cgmic2.cmic2no = cgctas.cmic2no
				left outer join cgmic3 on cgmic3.cmic3no = cgctas.cmic3no
				left outer join cgmic4 on cgmic4.cmic4no = cgctas.cmic4no
				left outer join cgmic5 on cgmic5.cmic5no = cgctas.cmic5no
				where cgctas.cctaid ='$lcctaid'";
	// obteniendo datos del servidor
	$lcResult = mysqli_query($oConn,$lcSqlCmd);
	//if (gettype($lcResult)== "object"){ 
    	// convirtiendo estos datos en un array asociativo
    	$ldata = mysqli_fetch_assoc($lcResult);
    	// convirtiendo este array en archivo jason.
    	$jsondata = json_encode($ldata,true);
    	// retornando objeto json
		echo $jsondata;
}

if($lcaccion == "CMICXNO"){
	$lcuid    = $_POST["pcuid"];
	$lcmicxno = $_POST["pcvalue"];
	$lcalias  = "cgmic".$lcuid;
	$lcsqlcmd = " select * from $lcalias where cmic".$lcuid."no = '". $lcmicxno ."' ";
	$lcResult = mysqli_query($oConn,$lcsqlcmd);
	$ldata    = mysqli_fetch_assoc($lcResult);
	// convirtiendo este array en archivo jason.
	$jsondata = json_encode($ldata,true);
	// retornando objeto json
	echo $jsondata;
}
//Cerrando la coneccion.
mysqli_close($oConn);
?>
