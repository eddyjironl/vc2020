<?php
// ------------------------------------------------------------------------------------------------
// Descripcion.
// 	Definiendo funciones que se realizaran .
//	$lcaccion = isset($_POST["accion"])? $_POST["accion"],$_GET["accion"];
// ------------------------------------------------------------------------------------------------

include("../modelo/vc_funciones.php");
include("../modelo/cgmodule.php");
vc_funciones::Star_session();
$oConn = vc_funciones::get_coneccion("CIA");
$oCg = new cgmodule();

if(isset($_POST["accion"])){
	$lcaccion = $_POST["accion"]; 	
}else{
	$lcaccion = $_GET["accion"]; 	
}

// ------------------------------------------------------------------------------------------------
// DELETE, Borrando los datos.
// ------------------------------------------------------------------------------------------------
if($lcaccion=="DELETE"){
	//$oConn = get_coneccion("CIA");
	$lcsqlcmd = " delete from cgmonm where cmonid = '" . $lcmonid . "' ";
	$lresulte = mysqli_query($oConn,$lcsqlcmd);	
	$lcsqlcmd = " delete from cgmond where cmonid = '" . $lcmonid . "' ";
	$lresultf = mysqli_query($oConn,$lcsqlcmd);	
}
if($lcaccion=="DELETEROW"){
	$lcsqlcmd = " delete from cgmond where cuid = " . $_POST["cuid"] ;
	$lresultf = mysqli_query($oConn,$lcsqlcmd);	
}
// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
        $json      = $_POST["json"];
		$odata     = json_decode($json,true);
		$lcmodo    = mysqli_real_escape_string($oConn,$odata["cmodo"]);
		$lmnotas   = mysqli_real_escape_string($oConn, $odata["mnotas"]);
		$lcrespno  = mysqli_real_escape_string($oConn, $odata["crespno"]);
		$lctrnno   = mysqli_real_escape_string($oConn, $odata["ctrnno"]);
        $ldtrndate = mysqli_real_escape_string($oConn, $odata["dtrndate"]);
		$lcdesc    = mysqli_real_escape_string($oConn, $odata["cdesc"]);
		$lcperid   = mysqli_real_escape_string($oConn, $odata["cperid"]);
		$lctype    = mysqli_real_escape_string($oConn, $odata["ctype"]);
		$lnrate    = mysqli_real_escape_string($oConn, $odata["nrate"]);

	//	return true;
        // obteniendo el numero siguiente en la partida.
        if (empty($lctrnno)){
            $lctrnno = $oCg::getnewdoc($lctype); 
        }
        // -------------------------------------------------------------------------------------------------------
		// A)- Cargando el detalle de factura.
		// -------------------------------------------------------------------------------------------------------
        $lcsqlcmd = " insert into cgmast_1(ctrnno, cperid, dtrndate, mnotas, cdesc, crespno, ctype, nrate, cstatus) 
                       values('$lctrnno', '$lcperid', '$ldtrndate', '$lmnotas', '$lcdesc', '$lcrespno', '$lctype', $lnrate,'OP')";
		// -------------------------------------------------------------------------------------------------------
		// B)- Cargando el detalle de factura.
		// -------------------------------------------------------------------------------------------------------
		$lnveces = 1;
		$lcsql_d  = "";
		foreach ($odata as $a=>$b) {
			if($a == "xdetail"){
				$longitud = count($b);
				for($i=0; $i<$longitud; $i++) {
					$lcctaid  = mysqli_real_escape_string($oConn,$b[$i]["cctaid"]);
					//$lnpayamt = $b[$i]["ncost"];
					$lcsql_ser = "select cdesc from cgctas where cctaid  = '". $lcctaid ."'";
					$lcresult  = mysqli_query($oConn,$lcsql_ser);
					$ldata     = mysqli_fetch_assoc($lcresult);
                    $lndebe    = ($b[$i]['ndebe'] == "")? 0:$b[$i]['ndebe'];
					$lnhaber   = ($b[$i]['nhaber'] == "")? 0:$b[$i]['nhaber'];
					if ($lnveces == 1){
						$lcsql_d = " insert into cgmasd_1(ctrnno,ccodno,cdesc,ndebe,nhaber,cperid,usuario,fecha)
									values('$lctrnno','". $b[$i]['cctaid']."','". $ldata['cdesc'] ."',".
											$lndebe .",". $lnhaber . ",'" .$lcperid. ",'" .$_SESSION["cuserid"]."','".$ldtrndate."')";
  						$lnveces = 2;
					}else{
						$lcsql_d = $lcsql_d . " ,('$lctrnno','". $b[$i]['cctaid']."','". $ldata['cdesc'] ."',".
                                    $lndebe .",". $lnhaber . ",'" .$lcperid. ",'" .$_SESSION["cuserid"]."','".$ldtrndate."')";
					}  //if ($lnveces == 1)
				}	//for($i=0; $i<$longitud; $i++) 
			}  //if($a == "pagos"){
		}  //foreach ($oAjt as $a=>$b)

		// ------------------------------------------------------------------------------------------------
		// Generando coneccion y procesando el comando.
		// ------------------------------------------------------------------------------------------------
		$lresultF1 = mysqli_query($oConn,$lcsqlcmd);	
		$lresultF2 = mysqli_multi_query($oConn,$lcsql_d);
		$lnRowsAfect = mysqli_affected_rows($oConn);
	header("location:../view/cgmast_1.php");		
}  		//if($lcaccion=="NEW")
// ------------------------------------------------------------------------------------------------
// JSON, - Informacion detallada de un solo registro.
// ------------------------------------------------------------------------------------------------
if ($lcaccion == "JSON"){
	if (isset($_POST["cmonid"])){
 		// Consulta unitaria
		$lcSqlCmd = " select * from cgmonm
                       where cgmonm.cmonid ='". $_POST["cmonid"] ."'";
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
if ($lcaccion == "JSON_ID"){
	if (isset($_POST["cuid"])){
 		// Consulta unitaria
		$lcSqlCmd = " select cgmond.cuid,
                             cgmond.cmonid,
                             cgmond.dtrndate, cgmond.ntc
                       from cgmond 
                       where cgmond.cuid ='". $_POST["cuid"] ."'";
		
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
if ($lcaccion == "DETALLE_BAND"){
	if (isset($_POST["cmonid"])){
 		// Consulta unitaria
         $lcSqlCmd = " select cgmond.cuid , 
                              cgmond.dtrndate,
                              cgmond.ntc
                       from cgmond
                       where cgmond.cmonid ='". $_POST["cmonid"] ."'";

   // obteniendo datos del servidor
		$lcResult = mysqli_query($oConn,$lcSqlCmd);
        while ($ldata = mysqli_fetch_assoc($lcResult)){
            echo "<tr class='grid_detail'>"; 
            echo "    <td style='width:60px'>" . $ldata["cuid"]     . "</td>";
            echo "    <td style='width:100px'>". $ldata["dtrndate"] . "</td>";
            echo "    <td style='width:60px'>" . $ldata["ntc"]      . "</td>";
            echo "    <td style='width:75px'> ";
            echo "        <img src='../photos/write.ico' id='bteditar' class='botones_row'  onclick='editRow("    .$ldata["cuid"] . ")' title='Editar Registro'/> ";
            echo "        <img src='../photos/escoba.ico' id='btquitar' class='botones_row'  onclick='deleteRow(" .$ldata["cuid"] . ")' title='Eliminar Registro'/> ";
            echo "    </td> ";
            echo "</tr>";

        }
	}               
}
if ($lcaccion == "NEWLINE"){
    $lcuid   = mysqli_real_escape_string($oConn,$_POST["cuid"]);
    $lcmonid = mysqli_real_escape_string($oConn,$_POST["cmonid"]);
    $ldtrndate = mysqli_real_escape_string($oConn,$_POST["dtrndate"]);
    $lntc = mysqli_real_escape_string($oConn, $_POST["ntc"]);
    // verificando que el codigo exista o no 
    if (empty($lcuid)){
        $lnCount = 0;
    }else{
        $lcsql   = " select cuid from cgmond where cuid = $lcuid ";
        $lresult = mysqli_query($oConn,$lcsql);	
        $lnCount = mysqli_num_rows($lresult);
    }
    if ($lnCount == 0){
        // este codigo de cliente no existe por tanto lo crea	
        // ejecutando el insert para la tabla de clientes.
        $lcsqlcmd = " insert into cgmond (cmonid, dtrndate, ntc)  
                      values('$lcmonid','$ldtrndate',$lntc)";
    }else{
        // el codigo existe lo que hace es actualizarlo.	
        $lcsqlcmd = " update cgmond set dtrndate = '$ldtrndate', ntc = $lntc where cuid = $lcuid ";
    }
    // ------------------------------------------------------------------------------------------------
    // Generando coneccion y procesando el comando.
    // ------------------------------------------------------------------------------------------------
    $lresultF = mysqli_query($oConn,$lcsqlcmd);	
    //mysqli_query($oConn,$lcsqlcmd);
    $lnRowsAfect = mysqli_affected_rows($oConn);
    //header("location:../view/cgbanm.php");	

}
//Cerrando la coneccion.
mysqli_close($oConn);
	?>
