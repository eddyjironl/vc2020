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

if (isset($_POST["cbanno"])){
	$lcbanno = $_POST["cbanno"];
}
$lnRowsAfect = 0;

// ------------------------------------------------------------------------------------------------
// DELETE, Borrando los datos.
// ------------------------------------------------------------------------------------------------
if($lcaccion=="DELETE"){
	//$oConn = get_coneccion("CIA");
	$lcsqlcmd = " delete from cgbanm where cbanno = '" . $lcbanno . "' ";
	$lresulte = mysqli_query($oConn,$lcsqlcmd);	
	$lcsqlcmd = " delete from cgband where cbanno = '" . $lcbanno . "' ";
	$lresultf = mysqli_query($oConn,$lcsqlcmd);	
}

if($lcaccion=="DELETEROW"){
	$lcsqlcmd = " delete from cgband where cuid = " . $_POST["cuid"] ;
	$lresultf = mysqli_query($oConn,$lcsqlcmd);	
}

// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
	// haciendo la coneccion.
	//$oConn = get_coneccion("CIA");
	if (isset($_POST["cbanno"])){
		$lcdesc  = mysqli_real_escape_string($oConn,$_POST["cdesc"]);
		$lmnotas = mysqli_real_escape_string($oConn, $_POST["mnotas"]);
		$lchk    = mysqli_real_escape_string($oConn, $_POST["chk"]);
		// verificando que el codigo exista o no 
		$lcsql   = " select cbanno from cgbanm where cbanno ='$lcbanno' ";
		$lresult = mysqli_query($oConn,$lcsql);	
		$lnCount = mysqli_num_rows($lresult);
		if ($lnCount == 0){
			// este codigo de cliente no existe por tanto lo crea	
			// ejecutando el insert para la tabla de clientes.
			$lcsqlcmd = " insert into cgbanm (cbanno,cdesc,mnotas, chk)	values('$lcbanno','$lcdesc','$lmnotas','$lchk')";
		}else{
			// el codigo existe lo que hace es actualizarlo.	
			$lcsqlcmd = " update cgbanm set cdesc = '$lcdesc',mnotas = '$lmnotas', chk = '$lchk' where cbanno = '$lcbanno' ";
		}
		// ------------------------------------------------------------------------------------------------
		// Generando coneccion y procesando el comando.
		// ------------------------------------------------------------------------------------------------
		$lresultF = mysqli_query($oConn,$lcsqlcmd);	
		//mysqli_query($oConn,$lcsqlcmd);
		$lnRowsAfect = mysqli_affected_rows($oConn);
	}  
	header("location:../view/cgbanm.php");		
}  		//if($lcaccion=="NEW")
// ------------------------------------------------------------------------------------------------
// JSON, - Informacion detallada de un solo registro.
// ------------------------------------------------------------------------------------------------
if ($lcaccion == "JSON"){
	if (isset($_POST["cbanno"])){
 		// Consulta unitaria
		$lcSqlCmd = " select cgbanm.*
                       from cgbanm 
                       where cgbanm.cbanno ='". $_POST["cbanno"] ."'";
		
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
		$lcSqlCmd = " select cgband.cuid , 
                             cgband.cbanno,
                             cgband.cdesc as cdesc1,
                             cgband.cmonid,
                             cgmonm.cdesc as cmonidcdesc,
                             cgband.cckqno,
                             cgband.cctaid, 
                             cgctas.cdesc as cctaidcdesc,
                             cgband.mnotas as mnotas1 
                       from cgband 
                       left outer join cgctas on cgctas.cctaid = cgband.cctaid
                       left outer join cgmonm on cgmonm.cmonid = cgband.cmonid
                       where cgband.cuid ='". $_POST["cuid"] ."'";
		
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
	if (isset($_POST["cbanno"])){
 		// Consulta unitaria
		$lcSqlCmd = " select cgband.cuid , 
                             cgband.cdesc as cdesc1,
                             cgband.cmonid,
                             cgband.cckqno,
                             cgband.cctaid, 
                             cgband.mnotas as mnotas1 
                       from cgband 
                       where cgband.cbanno ='". $_POST["cbanno"] ."'";
		
                       // obteniendo datos del servidor
		$lcResult = mysqli_query($oConn,$lcSqlCmd);
        while ($ldata = mysqli_fetch_assoc($lcResult)){
            echo "<tr class='grid_detail'>"; 
            echo "    <td style='width:150px'>" .$ldata["cdesc1"] . "</td>";
            echo "    <td style='width:100px'>" .$ldata["cctaid"]  . "</td>";
            echo "    <td style='width:100px'>" .$ldata["cmonid"]  . "</td>";
            echo "    <td style='width:50px'>"  .$ldata["cckqno"]  . "</td>";
            echo "    <td style='width:150px'>" .$ldata["mnotas1"] . "</td>";
            echo "    <td style='width:50px'> ";
            echo "        <img src='../photos/write.ico' id='bteditar' class='botones_row'  onclick='editRow("    .$ldata["cuid"] . ")' title='Editar Registro'/> ";
            echo "        <img src='../photos/escoba.ico' id='btquitar' class='botones_row'  onclick='deleteRow(" .$ldata["cuid"] . ")' title='Eliminar Registro'/> ";
            echo "    </td> ";
            echo "</tr>";

        }
	}               
}	

if ($lcaccion == "JSON_DET"){
    if (isset($_POST["cbanno"])){
             // Consulta unitaria
            $lcSqlCmd = " select cgband.cuid , 
                                 cgband.cdesc as cdesc1,
                                 cgband.cmonid,
                                 cgband.cckqno,
                                 cgband.cctaid, 
                                 cgband.mnotas as mnotas1 
                           from cgband 
                           where cgband.cbanno ='". $_POST["cbanno"] ."'";
            
                           // obteniendo datos del servidor
            $lcResult = mysqli_query($oConn,$lcSqlCmd);
            // procesando el array
            $lnveces = 0;
            $jsondata = '{"detalles":[';
            while ($ldata = mysqli_fetch_assoc($lcResult)){
    
                if ($lnveces > 0){
                    $jsondata = $jsondata . ",";    
                }
                $lnveces += 1;
                $jsondata = $jsondata .'{"cuid":"'   .$ldata["cuid"]    .'",';
                $jsondata = $jsondata .'"cdesc1":"'  .$ldata["cdesc1"]  .'",';
                $jsondata = $jsondata .'"cmonid":"'  .$ldata["cmonid"]  .'",';
                $jsondata = $jsondata .'"cckqno":"'  .$ldata["cckqno"]  .'",';
                $jsondata = $jsondata .'"cctaid":"'  .$ldata["cctaid"]  .'",';
                $jsondata = $jsondata .'"mnotas1":"' .$ldata["mnotas1"] .'"}';
            }
            $jsondata = $jsondata. ']}';
            echo $jsondata;
    }	
    
}
if ($lcaccion == "NEWLINE"){
    $lcbanno = mysqli_real_escape_string($oConn,$_POST["cbanno"]);
    $lcuid   = mysqli_real_escape_string($oConn,$_POST["cuid"]);
    $lcdesc  = mysqli_real_escape_string($oConn,$_POST["cdesc1"]);
    $lmnotas = mysqli_real_escape_string($oConn, $_POST["mnotas1"]);
    $lcmonid = mysqli_real_escape_string($oConn, $_POST["cmonid"]);
    $lcctaid = mysqli_real_escape_string($oConn, $_POST["cctaid"]);
    $lcckqno = mysqli_real_escape_string($oConn, $_POST["cckqno"]);
    // verificando que el codigo exista o no 
    if (empty($lcuid)){
        $lnCount = 0;
    }else{
        $lcsql   = " select cuid from cgband where cuid = $lcuid ";
        $lresult = mysqli_query($oConn,$lcsql);	
        $lnCount = mysqli_num_rows($lresult);
    }
    if ($lnCount == 0){
        // este codigo de cliente no existe por tanto lo crea	
        // ejecutando el insert para la tabla de clientes.
        $lcsqlcmd = " insert into cgband (cbanno, cdesc,cmonid,cctaid,cckqno,mnotas)  
                      values('$lcbanno','$lcdesc','$lcmonid','$lcctaid','$lcckqno','$lmnotas')";
    }else{
        // el codigo existe lo que hace es actualizarlo.	
        $lcsqlcmd = " update cgband set cdesc = '$lcdesc',mnotas = '$lmnotas', cmonid = '$lcmonid', cctaid ='$lcctaid' , cckqno='$lcckqno' where cuid = $lcuid ";
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
