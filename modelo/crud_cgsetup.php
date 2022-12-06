<?php
// ------------------------------------------------------------------------------------------------
// Descripcion.
// 	Definiendo funciones que se realizaran .
//	$lcaccion = isset($_POST["accion"])? $_POST["accion"],$_GET["accion"];
// ------------------------------------------------------------------------------------------------

include("../modelo/cgmodule.php");
include("../modelo/vc_funciones.php");
vc_funciones::Star_session();
$oConn = vc_funciones::get_coneccion("CIA");
if(isset($_POST["accion"])){
	$lcaccion = $_POST["accion"]; 	
}else{
	$lcaccion = $_GET["accion"]; 	
}

// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
		$lntrnno1  = mysqli_real_escape_string($oConn,$_POST["ntrnno1"]);
		$lntrnno2  = mysqli_real_escape_string($oConn,$_POST["ntrnno2"]);
        $lntrnno3  = mysqli_real_escape_string($oConn,$_POST["ntrnno3"]);     
        $lntrnno4  = mysqli_real_escape_string($oConn,$_POST["ntrnno4"]);
        $lcperid   = mysqli_real_escape_string($oConn,$_POST["cperid"]);
        $lcctano1  = mysqli_real_escape_string($oConn,$_POST["cctano1"]);
        $lcctano2  = mysqli_real_escape_string($oConn,$_POST["cctano2"]);
        $lcctano3  = mysqli_real_escape_string($oConn,$_POST["cctano3"]);
        $lcctano4  = mysqli_real_escape_string($oConn,$_POST["cctano4"]);
        $lcctano5  = ''; //  mysqli_real_escape_string($oConn,$_POST["cctano5"]);
        $lcctano6  = ''; //  mysqli_real_escape_string($oConn,$_POST["cctano6"]);
        $lcmonid   = mysqli_real_escape_string($oConn,$_POST["cmonid"]);
        $lcfirma1  = mysqli_real_escape_string($oConn,$_POST["cfirma1"]);
        $lcfirma2  = mysqli_real_escape_string($oConn,$_POST["cfirma2"]);
        $lcfirma3  = mysqli_real_escape_string($oConn,$_POST["cfirma3"]);
        $lctitulo1 = mysqli_real_escape_string($oConn,$_POST["ctitulo1"]);
        $lctitulo2 = mysqli_real_escape_string($oConn,$_POST["ctitulo2"]);
        $lctitulo3 = mysqli_real_escape_string($oConn,$_POST["ctitulo3"]);
        $lviewF1   = isset($_POST["lviewf1"]) ? 1:0;  
        $lviewF2   = isset($_POST["lviewf2"]) ? 1:0;  
        $lviewF3   = isset($_POST["lviewf3"]) ? 1:0;  
        $llogoBC   = 0; // isset($_POST["llogoBC"]) ? 1:0;  
        $llogoBG   = 0; // isset($_POST["llogoBG"]) ? 1:0;  
        $llogoER   = 0; // isset($_POST["llogoER"]) ? 1:0;  
        $lnrentax  = (mysqli_real_escape_string($oConn,$_POST["nrentax"]) == "")? 0 : mysqli_real_escape_string($oConn,$_POST["nrentax"]);
        $ngrupid   = (mysqli_real_escape_string($oConn,$_POST["ngrupid"]) == "")? 0 : mysqli_real_escape_string($oConn,$_POST["ngrupid"]);
        $lncashamt = (mysqli_real_escape_string($oConn,$_POST["ncashamt"]) == "")? 0 : mysqli_real_escape_string($oConn,$_POST["ncashamt"]);
        $lnConfRChk= mysqli_real_escape_string($oConn,$_POST["lnConfRChk"]) ;     //isset($_POST["lnConfRChk"]) ? 1:0;
        /* descripcion de grupo  */
        $lcmic1desc  = mysqli_real_escape_string($oConn,$_POST["cmic1desc"]);
        $lcmic2desc  = mysqli_real_escape_string($oConn,$_POST["cmic2desc"]);
        $lcmic3desc  = mysqli_real_escape_string($oConn,$_POST["cmic3desc"]);
        $lcmic4desc  = mysqli_real_escape_string($oConn,$_POST["cmic4desc"]);
        $lcmic5desc  = mysqli_real_escape_string($oConn,$_POST["cmic5desc"]);
        /* habilitar descripcion de grupo */
		$llmic1desc= isset($_POST["lmic1desc"]) ? 1:0;   
		$llmic2desc= isset($_POST["lmic2desc"]) ? 1:0;   
		$llmic3desc= isset($_POST["lmic3desc"]) ? 1:0;   
		$llmic4desc= isset($_POST["lmic4desc"]) ? 1:0;   
		$llmic5desc= isset($_POST["lmic5desc"]) ? 1:0;   
        /* Sangria de grupos */
        $lnmic1desc = (mysqli_real_escape_string($oConn,$_POST["nmic1desc"]) == "")? 0:mysqli_real_escape_string($oConn,$_POST["nmic1desc"]);
        $lnmic2desc = (mysqli_real_escape_string($oConn,$_POST["nmic2desc"]) == "")? 0:mysqli_real_escape_string($oConn,$_POST["nmic2desc"]);
        $lnmic3desc = (mysqli_real_escape_string($oConn,$_POST["nmic3desc"]) == "")? 0:mysqli_real_escape_string($oConn,$_POST["nmic3desc"]);
        $lnmic4desc = (mysqli_real_escape_string($oConn,$_POST["nmic4desc"]) == "")? 0:mysqli_real_escape_string($oConn,$_POST["nmic4desc"]);
        $lnmic5desc = (mysqli_real_escape_string($oConn,$_POST["nmic5desc"]) == "")? 0:mysqli_real_escape_string($oConn,$_POST["nmic5desc"]);

        /** Presentar titulo en reporte BG Detallado */
        $lmic1desc1= isset($_POST["lmic1desc1"]) ? 1:0;   
		$lmic2desc1= isset($_POST["lmic2desc1"]) ? 1:0;   
		$lmic3desc1= isset($_POST["lmic3desc1"]) ? 1:0;   
		$lmic4desc1= isset($_POST["lmic4desc1"]) ? 1:0;   
		$lmic5desc1= isset($_POST["lmic5desc1"]) ? 1:0;   
        /** Presentar suma en reporte BG Detallado */
        $lmic1desc2= isset($_POST["lmic1desc2"]) ? 1:0;   
		$lmic2desc2= isset($_POST["lmic2desc2"]) ? 1:0;   
		$lmic3desc2= isset($_POST["lmic3desc2"]) ? 1:0;   
		$lmic4desc2= isset($_POST["lmic4desc2"]) ? 1:0;   
		$lmic5desc2= isset($_POST["lmic5desc2"]) ? 1:0;   
        /** Presentar titulo en reporte BG sumarizado */
        $lmic1desc3= isset($_POST["lmic1desc3"]) ? 1:0;   
		$lmic2desc3= isset($_POST["lmic2desc3"]) ? 1:0;   
		$lmic3desc3= isset($_POST["lmic3desc3"]) ? 1:0;   
		$lmic4desc3= isset($_POST["lmic4desc3"]) ? 1:0;   
		$lmic5desc3= isset($_POST["lmic5desc3"]) ? 1:0;   
        /** Presentar suma en reporte BG sumarizado */
        $lmic1desc4= isset($_POST["lmic1desc4"]) ? 1:0;   
		$lmic2desc4= isset($_POST["lmic2desc4"]) ? 1:0;   
		$lmic3desc4= isset($_POST["lmic3desc4"]) ? 1:0;   
		$lmic4desc4= isset($_POST["lmic4desc4"]) ? 1:0;   
		$lmic5desc4= isset($_POST["lmic5desc4"]) ? 1:0;   

        // verificando que el codigo exista o no 
		$lcsql   = " select * from cgsetup ";
		$lresult = mysqli_query($oConn,$lcsql);	
		$lnCount = mysqli_num_rows($lresult);
		if ($lnCount == 0){
			// este codigo de cliente no existe por tanto lo crea	
			// ejecutando el insert para la tabla de clientes.
			$lcsqlcmd = " insert into cgsetup (cperid,cmonid,nrentax,ngrupid,lnConfRChk,ncashamt,
                                                ntrnno1, ntrnno2,ntrnno3,ntrnno4,
                                                 cctano1,cctano2,cctano3,cctano4,cctano5,cctano6, 
                                                  cfirma1, ctitulo1, lviewf1, 
                                                   cfirma2, ctitulo2, lviewf2,
                                                    cfirma3, ctitulo3, lviewf3,  
                                                     llogobc,llogobg,llogoer,
                                                                 cmic1desc,cmic2desc,cmic3desc,cmic4desc,cmic5desc,
                                                       lmic1desc,lmic2desc,lmic3desc,lmic4desc,lmic5desc,
                                                        nmic1desc,nmic2desc,nmic3desc,nmic4desc,nmic5desc,
                                                            lmic1desc1,lmic2desc1,lmic3desc1,lmic4desc1,lmic5desc1,
                                                            lmic1desc2,lmic2desc2,lmic3desc2,lmic4desc2,lmic5desc2,
                                                            lmic1desc3,lmic2desc3,lmic3desc3,lmic4desc3,lmic5desc3,
                                                            lmic1desc4,lmic2desc4,lmic3desc4,lmic4desc4,lmic5desc4
                                                        )
						 values('$lcperid','$lcmonid',$lnrentax,$ngrupid,$lnConfRChk,$lncashamt,
                                     $lntrnno1,$lntrnno2,$lntrnno3,$lntrnno4,
                                      '$lcctano1','$lcctano2','$lcctano3','$lcctano4','$lcctano5','$lcctano6',
                                       '$lcfirma1','$lctitulo1',$lviewF1,
                                        '$lcfirma2','$lctitulo2',$lviewF2,
                                         '$lcfirma3','$lctitulo3',$lviewF3,
                                           $llogoBC, $llogoBG, $llogoER,
                                           '$lcmic1desc','$lcmic2desc','$lcmic3desc','$lcmic4desc','$lcmic5desc',
                                             $llmic1desc,$llmic2desc,$llmic3desc,$llmic4desc,$llmic5desc,
                                              $lnmic1desc,$lnmic2desc,$lnmic3desc,$lnmic4desc,$lnmic5desc,
                                                    $lmic1desc1,$lmic2desc1,$lmic3desc1,$lmic4desc1,$lmic5desc1,
                                                    $lmic1desc2,$lmic2desc2,$lmic3desc2,$lmic4desc2,$lmic5desc2,
                                                    $lmic1desc3,$lmic2desc3,$lmic3desc3,$lmic4desc3,$lmic5desc3,
                                                    $lmic1desc4,$lmic2desc4,$lmic3desc4,$lmic4desc4,$lmic5desc4)";
		}else{
			// el codigo existe lo que hace es actualizarlo.	
			$lcsqlcmd = " update cgsetup set cperid='$lcperid',cmonid = '$lcmonid',nrentax = $lnrentax,ngrupid = $ngrupid, lnconfrchk = $lnConfRChk, ncashamt = $lncashamt,
                                              ntrnno1 = $lntrnno1, ntrnno2 = $lntrnno2, ntrnno3 = $lntrnno3, ntrnno4 = $lntrnno4,
                                               cctano1 = '$lcctano1',cctano2 = '$lcctano2',cctano3 = '$lcctano3',cctano4 = '$lcctano4',cctano5 = '$lcctano5',cctano6 ='$lcctano6',
                                                cfirma1 ='$lcfirma1',ctitulo1 = '$lctitulo1',lviewf1 = $lviewF1,
                                                 cfirma2 ='$lcfirma2',ctitulo2 = '$lctitulo2',lviewf2 = $lviewF2,
                                                  cfirma3 ='$lcfirma3',ctitulo3 = '$lctitulo3',lviewf3 = $lviewF3,
                                                   llogobc = $llogoBC, llogobg = $llogoBG, llogoer = $llogoER,
                                                    cmic1desc = '$lcmic1desc',cmic2desc = '$lcmic2desc',cmic3desc = '$lcmic3desc',cmic4desc = '$lcmic4desc',cmic5desc = '$lcmic5desc',
                                                     lmic1desc = $llmic1desc,lmic2desc =$llmic2desc,lmic3desc = $llmic3desc,lmic4desc = $llmic4desc,lmic5desc = $llmic5desc,
                                                       nmic1desc = $lnmic1desc,nmic2desc = $lnmic2desc, nmic3desc = $lnmic3desc, nmic4desc = $lnmic4desc, nmic5desc = $lnmic5desc,
                                                        lmic1desc1 = $lmic1desc1,lmic2desc1 =$lmic2desc1,lmic3desc1 = $lmic3desc1,lmic4desc1 = $lmic4desc1,lmic5desc1 = $lmic5desc1,
                                                        lmic1desc2 = $lmic1desc2,lmic2desc2 =$lmic2desc2,lmic3desc2 = $lmic3desc2,lmic4desc2 = $lmic4desc2,lmic5desc2 = $lmic5desc2,
                                                        lmic1desc3 = $lmic1desc3,lmic2desc3 =$lmic2desc3,lmic3desc3 = $lmic3desc3,lmic4desc3 = $lmic4desc3,lmic5desc3 = $lmic5desc3,
                                                        lmic1desc4 = $lmic1desc4,lmic2desc4 =$lmic2desc4,lmic3desc4 = $lmic3desc4,lmic4desc4 = $lmic4desc4,lmic5desc4 = $lmic5desc4 ";
		}
		// ------------------------------------------------------------------------------------------------
		// Generando coneccion y procesando el comando.
		// ------------------------------------------------------------------------------------------------
		$lresultF = mysqli_query($oConn,$lcsqlcmd);	
		//mysqli_query($oConn,$lcsqlcmd);
		$lnRowsAfect = mysqli_affected_rows($oConn);
	
	header("location:../view/cgsetup.php");		
}  		//if($lcaccion=="NEW")
// ------------------------------------------------------------------------------------------------
// JSON, - Informacion detallada de un solo registro.
// ------------------------------------------------------------------------------------------------
if ($lcaccion == "JSON"){
	// Consulta unitaria
	$lcSqlCmd = " select cgsetup.*, '" . $_SESSION['cperidw'] ."' as cperidw from cgsetup ";
	// obteniendo datos del servidor
	$lcResult = mysqli_query($oConn,$lcSqlCmd);
    // convirtiendo estos datos en un array asociativo
    $ldata = mysqli_fetch_assoc($lcResult);
    // convirtiendo este array en archivo jason.
    $jsondata = json_encode($ldata,true);
    // retornando objeto json
    echo $jsondata;
}

//Cerrando la coneccion.
mysqli_close($oConn);
?>
