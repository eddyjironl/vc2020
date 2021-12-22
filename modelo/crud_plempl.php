<?php
// ------------------------------------------------------------------------------------------------
// Descripcion.
// 	Definiendo funciones que se realizaran .
//	$lcaccion = isset($_POST["accion"])? $_POST["accion"],$_GET["accion"];
// ------------------------------------------------------------------------------------------------
include("../modelo/armodule.php");
include("../modelo/vc_funciones.php");
$oConn = vc_funciones::get_coneccion("CIA");

if(isset($_POST["accion"])){
	$lcaccion = $_POST["accion"]; 	
}else{
	$lcaccion = $_GET["accion"]; 	
}

// ------------------------------------------------------------------------------------------------
// CREATE / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
	$lcempno    = $_POST["cempno"];
    $lnotausent = (isset($_POST["lnotausent"]))? 1 : 0;
    $lnsetpay   = (empty($_POST["nsetpay"]))   ? 0 : $_POST["nsetpay"];
    $lnhratext  = (empty($_POST["nhratext"])) ?0:$_POST["nhratext"];       // 0;
    $lnhrate    =  (empty($_POST["nhrate"])) ?0:$_POST["nhrate"];
    $lnsalary   = (empty($_POST["nsalary"])) ?0:$_POST["nsalary"];

    if (empty($lcempno)){
        echo "no ha indicado un Codigo de Empleado";
        return ;
    }

    // verificando si existe o no.
    $lcsqlcmd = " select cempno from plempl where cempno = '". $lcempno ."' ";
    $lcresult = mysqli_query($oConn,$lcsqlcmd);
    if ($lcresult->num_rows == 0){
        // crea un registro de empleado nuevo.
        $lcsql_insert = " insert into plempl(cempno,cfullname,ccedid,dnacday,cmarital,csexo,
                                              mdirecc,mtels, mnotas,dstar,dend,cstatus,
                                               cdescmot,cworkid,cdeptno,cturno,nsalary,nhrate,
                                               nhratext, ctypemp, ctyppay, ctyppay2, nsetpay, cins, lnotausent )
                           values('".$_POST["cempno"]."','".$_POST["cfullname"]."','".$_POST["ccedid"]."','".$_POST["dnacday"]."','".$_POST["cmarital"]."','".$_POST["csexo"].
                           "','". $_POST["mdirecc"] ."','". $_POST["mtels"] ."','". $_POST["mnotas"] ."','". $_POST["dstar"] ."','". $_POST["dend"] ."','". $_POST["cstatus"] .
                           "','". $_POST["cdescmot"] ."','". $_POST["cworkid"] ."','". $_POST["cdeptno"] ."','". $_POST["cturno"] ."',". $lnsalary .",". $lnhrate .
                           ",". $lnhratext .",'". $_POST["ctypemp"] ."','". $_POST["ctyppay"] ."','". $_POST["ctyppay2"] ."',". $lnsetpay .",'". $_POST["cins"] ."',".$lnotausent.")";
    }else{
        // actualiza un empleado existente.
        $lcsql_insert = " update plempl set cfullname = '".$_POST["cfullname"]."',ccedid= '". $_POST["ccedid"] ."',dnacday ='".$_POST["dnacday"]."',cmarital = '".$_POST["cmarital"]."',csexo='".$_POST["csexo"]."',
                                            mdirecc='".$_POST["mdirecc"]."',mtels='".$_POST["mtels"]."', mnotas='".$_POST["mnotas"]."',dstar='".$_POST["dstar"]."',dend='".$_POST["dend"]."',cstatus='".$_POST["cstatus"]."',
                                            cdescmot='".$_POST["cdescmot"]."',cworkid='".$_POST["cworkid"]."',cdeptno='".$_POST["cdeptno"]."',cturno='".$_POST["cturno"]."',nsalary=".$lnsalary.",nhrate=".$lnhrate.",
                                            nhratext=".$lnhratext .", ctypemp='".$_POST["ctypemp"]."', ctyppay='".$_POST["ctyppay"]."', ctyppay2='".$_POST["ctyppay2"]."', nsetpay=".$lnsetpay.", cins='".$_POST["cins"]."', lnotausent =".$lnotausent.
                        " where cempno = '". $_POST["cempno"] . "' ";
                           
    }
    
    mysqli_query($oConn,$lcsql_insert);
    header("location:../view/plempl.php");		

}  		//if($lcaccion=="NEW")
if($lcaccion == "ADD_DEDT"){
    // cargando los datos.
    // --------------------------------------------------------------------------------------------
    $lcuid    = $_POST["cuid"];
    $lcempno  = $_POST["cempno"];
    $lcdedid  = $_POST["cdedid"];
    $lnvalue  = $_POST["nvalue"];
    $lcdesc   = $_POST["cdesc"];
    $lnpayamt = $_POST["npayamt"];
    $lcrefno  = $_POST["crefno"];
    $llapply  = $_POST["lapply"];
    // obteniendo configuracion del registro de deduccion.
    $lclear   = 0;
    $llupdded = false;
    // verificaciones previas a guardar.
    // --------------------------------------------------------------------------------------------
    if (empty($lcempno)){
        echo "codigo de empleado no especificado";
        return ;
    }
    if(empty($lnvalue)){
        echo "valor de la deduccion no indicada";
        return ;
    } 
    if(empty($lnpayamt)){
        echo "Monto de la cuota no indicada";
        return ;
    } 


    // definiendo si crea una deduccion o actualiza una deduccion.
    if(!empty($lcuid)){
        $lcsql    = "select cuid from pldedt where cuid = ". $lcuid;
        $lcresult = mysqli_query($oConn,$lcsql);
        $llupdded = ($lcresult->num_rows > 0);
    }

    if($llupdded){
        $lcsqlcmd = " update pldedt set cdedid = '$lcdedid', cdesc = '$lcdesc', nvalue = $lnvalue, npayamt = $lnpayamt, crefno = '$lcrefno',
                                               lapply = $llapply, lclear = $lclear where cuid = $lcuid ";
    }else{
        // haciendo la insercion.
        // --------------------------------------------------------------------------------------------
        $lcsqlcmd = " insert into pldedt( cempno, cdedid, cdesc, nvalue , nsaldo, npayamt, crefno, lapply, lclear) 
                    values('$lcempno','$lcdedid','$lcdesc', $lnvalue, $lnvalue, $lnpayamt,'$lcrefno',$llapply, $lclear) ";
    }
    $lcresult = mysqli_query($oConn, $lcsqlcmd);
    // actualizando el saldo de las deducciones existentes.
    upd_dedt_balance($oConn);
    $lcaccion = "deductions"; 
}

if($lcaccion == "ADD_INGRESOS"){
    // cargando los datos.
    // --------------------------------------------------------------------------------------------
    $lcuid    = $_POST["cuid"];
    $lcempno  = $_POST["cempno"];
    $lcingid  = $_POST["cingid"];
    $lnvalue  = $_POST["nvalue"];
    $lcdesc   = $_POST["cdesc"];
    $llapply  = $_POST["lapply"];
    // obteniendo configuracion del registro de deduccion.
    $lclear   = 0;
    $llupdded = false;
    // verificaciones previas a guardar.
    // --------------------------------------------------------------------------------------------
    if (empty($lcempno)){
        echo "codigo de empleado no especificado";
        return ;
    }
    if(empty($lnvalue)){
        echo "valor del ingreso no indicado";
        return ;
    } 
   
    // definiendo si crea una deduccion o actualiza una deduccion.
    if(!empty($lcuid)){
        $lcsql    = "select cuid from plingt where cuid = ". $lcuid;
        $lcresult = mysqli_query($oConn,$lcsql);
        $llupdded = ($lcresult->num_rows > 0);
    }

    if($llupdded){
        $lcsqlcmd = " update plingt set cingid = '$lcingid', cdesc = '$lcdesc', nvalue = $lnvalue,  lapply = $llapply, lclear = $lclear where cuid = $lcuid ";
    }else{
        // haciendo la insercion.
        // --------------------------------------------------------------------------------------------
        $lcsqlcmd = " insert into plingt( cempno, cingid, cdesc, nvalue , lapply, lclear) 
                      values('$lcempno','$lcingid','$lcdesc', $lnvalue, $llapply, $lclear) ";
    }
    $lcresult = mysqli_query($oConn, $lcsqlcmd);
    $lcaccion = "ingresos"; 
}

// ------------------------------------------------------------------------------------------------
// DELETE
// -----------------------------------------------------------------------------------------------
if($lcaccion=="DELETE"){
    if (empty($_POST["cempno"])){
        return;
    }
	//$oConn = get_coneccion("CIA");
	$lcsqlcmd = " delete from plempl where cempno = '" . $_POST["cempno"] . "' ";
	$lresultF = mysqli_query($oConn,$lcsqlcmd);	
}
if ($lcaccion=="DELETE_DED_LIST"){
    $lcuid = $_POST["cuid"];
    $lcsqlcmd = " delete from pldedt where cuid = '$lcuid' " ;
    $lcresult = mysqli_query($oConn,$lcsqlcmd);
    // cambiando las deducciones si fue bien procesado.
    if ($lcresult == true){
        $lcaccion = "deductions";
    }
}

if ($lcaccion=="DELETE_ING_LIST"){
    $lcuid = $_POST["cuid"];
    $lcsqlcmd = " delete from plingt where cuid = '$lcuid' " ;
    $lcresult = mysqli_query($oConn,$lcsqlcmd);
    // cambiando las deducciones si fue bien procesado.
    if ($lcresult == true){
        $lcaccion = "ingresos";
    }
}
// ------------------------------------------------------------------------------------------------
// READ, LIST.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="LIST2eee"){
    $lcwhere = "";
    if(!empty($_POST["cempno"])){
        $lcwhere = " where cempno ='".$_POST["cempno"]."'";
    }
    $lcsqlcmd = " select * from plempl ". $lcwhere;
    $lresult  = mysqli_query($oConn,$lcsqlcmd);
    $lcSpace  = "";	
    $lnveces  = 0;
    $lnotausent = (isset($_POST["lnotausent"]))? 1 : 0;
    $ojson    = "[";
    // generando 
    while($ldata = mysqli_fetch_assoc($lresult) ){
        if ($lnveces == 0){
            $lnveces = 1;
        }else{
            $lcSpace = ",";
        }
        $ojson = $ojson . $lcSpace .'{"cempno":"' .$ldata["cempno"] .'","cfullname":"'. $ldata["cfullname"] .
                                    '","ccedid":"' .$ldata["ccedid"] .'","dnacday":"'. $ldata["dnacday"] .
                                    '","cmarital":"' .$ldata["cmarital"] .'","csexo":"'. $ldata["csexo"] .
                                    '","mdirecc":"' .$ldata["mdirecc"] .'","mtels":"'. $ldata["mtels"] .
                                    '","mnotas":"' .$ldata["mnotas"] .'","dstar":"'. $ldata["dstar"] .
                                    '","dend":"' .$ldata["dend"] .'","cstatus":"'. $ldata["cstatus"] .
                                    '","cdescmot":"' .$ldata["cdescmot"] .'","cworkid":"'. $ldata["cworkid"] .
                                    '","cdeptno":"' .$ldata["cdeptno"] .'","cturno":"'. $ldata["cturno"] .
                                    '","nsalary":' .$ldata["nsalary"] .',"nhrate":'. $ldata["nhrate"] .
                                    ',"nhratext":' .$ldata["nhratext"] .',"ctypemp":"'. $ldata["ctypemp"] .
                                    '","ctyppay":"' .$ldata["ctyppay"] .'","ctyppay2":"'. $ldata["ctyppay2"] .
                                    '","nsetpay":' .$ldata["nsetpay"] .',"cins":"'. $ldata["cins"] .
                                    '","notausent":'. $lnotausent .'}';	
    }
    $ojson = $ojson . ']';
    //$lsenddata = json_encode($ojson,true);
    echo $ojson;    
}

if($lcaccion=="LIST"){
    $lcwhere = "";
    if(!empty($_POST["cempno"])){
        $lcwhere = " where cempno ='".$_POST["cempno"]."'";
    }else{
        echo "formato no soportado falta el codigo del empleado";
        return ;
    }
    $lcsqlcmd = " select * from plempl ". $lcwhere;

	$lcresult = mysqli_query($oConn,$lcsqlcmd);
    if ($lcresult->num_rows>0){
    	$ldata    = mysqli_fetch_assoc($lcresult);
	    // enviando en formato json.	
	    $jsondata = json_encode($ldata,true);
    }else{
        $jsondata = NULL;
    }
	// retornando objeto json
	echo $jsondata;		
}
// deplegando informacion de una linea de detalle de deduccion en pldedt
if($lcaccion == "GET_INFO_DEDUCTION"){
    $lcuid = $_POST["cuid"];
    if (empty($lcuid)){
        echo "Identificador no disponible";
        return ;
    }

    $lcsqlcmd = "select * from pldedt where cuid =".$lcuid;
    $lcresult = mysqli_query($oConn,$lcsqlcmd);
    if ($lcresult->num_rows>0){
        $odata = json_encode(mysqli_fetch_assoc($lcresult),true);
    }else{
        $odata = NULL;
    }
    echo $odata;
}

if($lcaccion == "GET_INFO_INGRESOS"){
    $lcuid = $_POST["cuid"];
    if (empty($lcuid)){
        echo "Identificador no disponible";
        return ;
    }

    $lcsqlcmd = "select * from plingt where cuid =".$lcuid;
    $lcresult = mysqli_query($oConn,$lcsqlcmd);
    if ($lcresult->num_rows>0){
        $odata = json_encode(mysqli_fetch_assoc($lcresult),true);
    }else{
        $odata = NULL;
    }
    echo $odata;
}

if($lcaccion == "deductions"){
    $lcempno = $_POST["cempno"];
    if(empty($lcempno)){
        echo "Codigo de empleado no indicado";
        return ;
    }

    $lcsqlcmd = "select * from pldedt where cempno = '$lcempno' and cstatus = 'OP' ";
    $lcresult = mysqli_query($oConn, $lcsqlcmd);

    if ($lcresult->num_rows>0){
        // procediendo a construir detalle de deducciones en una tabla.
        while($odata = mysqli_fetch_assoc($lcresult)){
            $llcheck1 = ($odata['lclear']==0)? "NO":"Si";
            $llcheck2 = ($odata['lapply']==0)? "NO":"Si";
            echo "<tr>";
                echo " <td width='70px'> <input type='text' class='textkeyreadonly' value='". $odata['cdedid']."'> </td>";
                echo " <td width='200px' class='textcdescreadonly' >". $odata['cdesc']. " </td>";
                echo " <td width='75px'> <input type='number' class='sayamt' readonly value= ". $odata['nvalue'].  " >    </td>";
                echo " <td width='70px'> <input type='number' class='sayamt' readonly value= ". $odata['npayamt']. " '>  </td>";
                echo " <td width='70px'> <input type='number' class='sayamt' readonly value= ". $odata['nsaldo'].  " >  </td>";
                echo " <td width='20px'> <input type='text' readonly value='" .$llcheck2 . "' id='lapply_ded'  class='textkeyreadonly' > </td>";
                echo " <td width='20px'> <input type='text' readonly value='" .$llcheck1 . "' id='lclear_ded'  class='textkeyreadonly'> </td>";
                echo " <td width='50px'> <input type='text' class='textkeyreadonly' readonly value= '". $odata['crefno']. "' >  </td>";
                echo "<td width='20px'><img src='../photos/escoba.ico' class='botones_row' onclick='delete_deduction(". $odata['cuid'] .")' title='Eliminar Linea de Deduccion'/></td>";
                echo "<td width='20px'><img src='../photos/editar.ico' class='botones_row' onclick='edit_deduction(". $odata['cuid'] .")' title='Editar Linea de Deduccion'/></td>";
            echo "</tr>";
        }

    }else{
        echo "";
    }
}

if($lcaccion == "ingresos"){
    $lcempno = $_POST["cempno"];
    if(empty($lcempno)){
        echo "Codigo de empleado no indicado";
        return ;
    }

    $lcsqlcmd = "select * from plingt where cempno = '$lcempno' and cstatus = 'OP' ";
    $lcresult = mysqli_query($oConn, $lcsqlcmd);

    if ($lcresult->num_rows>0){
        // procediendo a construir detalle de deducciones en una tabla.
        while($odata = mysqli_fetch_assoc($lcresult)){
            $llcheck1 = ($odata['lapply']==0)? "NO":"SI";
            $llcheck2 = ($odata['lclear']==0)? "NO":"SI";
            echo "<tr>";
                echo " <td width='50px' > <input type='text'  class='textkeyreadonly' value='". $odata['cingid']."' > </td>";
                echo " <td width='200px' class='textcdescreadonly' >". $odata['cdesc']. " </td>";
                echo " <td width='75px'> <input type='number' class='sayamt' readonly value= ". $odata['nvalue'].  ">    </td>";
                echo " <td width='20px'> <input type='text' readonly value='" .$llcheck1 . "' class='textkeyreadonly'> </td>";
                echo " <td width='20px'> <input type='text' readonly value='" .$llcheck2 . "' class='textkeyreadonly'> </td>";
                echo "<td width='20px'><img src='../photos/escoba.ico' class='botones_row' onclick='delete_ingreso(". $odata['cuid'] .")' title='Eliminar Linea de Ingreso'/></td>";
                echo "<td width='20px'><img src='../photos/editar.ico' class='botones_row' onclick='edit_ingresos(". $odata['cuid'] .")' title='Editar Linea de Ingreso'/></td>";
            echo "</tr>";
        }
    } else{
        echo "";
    }   
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
	$lcsql    = " select plempl.* ,plworm.cdesc as cworkdesc from plempl 
                  left outer join plworm on plworm.cworkno = plempl.cworkid ". $lcwhere . $lcorder;
	
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
		$ojson = $ojson . $lcSpace .'{"cempno":"' .$ldata["cempno"] .'","cfullname":"'. $ldata["cfullname"] .'","cwhorkdesc":"'. $ldata["cworkdesc"] .'"}';	
	}
	$ojson = $ojson . ']';
	// enviando variable json.
	echo $ojson;		
}
// con esta rutina se actualizara el saldo de cada deduccion segun si historico
function upd_dedt_balance($poConn){
    // seleccionando todas las deducciones que entraran en la cuenta.
    $lcsqlcmd = " select cuid from pldedt ";
    $lcresult = mysqli_query($poConn,$lcsqlcmd);
    // procesando cada una de las deducciones.
    while($oDedt = mysqli_fetch_assoc($lcresult)){
        // obteniendo los otros abonos.
        $lcuid =  $oDedt["cuid"];

        /* 
        NOTA:

        se necesita hacer rutina de busqueda en el historico.

        */
        $lcsqlcmd = " update pldedt set nsaldo = nvalue where cuid = $lcuid ";
        mysqli_query($poConn,$lcsqlcmd);
    }
}

//Cerrando la coneccion.
mysqli_close($oConn);


?>
