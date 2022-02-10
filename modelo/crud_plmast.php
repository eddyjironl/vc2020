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
if (isset($_POST["cplano"])){
	$lcplano = $_POST["cplano"];
}
$lcmsg = "";

// ------------------------------------------------------------------------------------------------
// DELETE, Borrando los datos.
// ------------------------------------------------------------------------------------------------
if($lcaccion=="DELETE"){
	//$oConn = get_coneccion("CIA");
	$lcsqlcmd = " delete from plmast where cplano = '" . $lcplano . "' ";
	$lresultF = mysqli_query($oConn,$lcsqlcmd);	
}
if ($lcaccion == "DELETE_ROW"){
	if($_POST["cuid"] !=""){
		$lcsqlcmd = " delete from pldepd where cuid =" . $_POST["cuid"] ;
		mysqli_query($oConn, $lcsqlcmd);
		$lcaccion = "SHOW_DETAIL_DEPT";
	}
}
// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
	// haciendo la coneccion.
	//$oConn = get_coneccion("CIA");
	if (isset($_POST["cplano"])){
		$lcdesc   = mysqli_real_escape_string($oConn,$_POST["cdesc"]);
		$lcstatus = mysqli_real_escape_string($oConn,$_POST["cstatus"]);
		$lctyppay = mysqli_real_escape_string($oConn,$_POST["ctyppay"]);
		$lctypemp = mysqli_real_escape_string($oConn,$_POST["ctypemp"]);
		$lcmonth  = mysqli_real_escape_string($oConn,$_POST["cmonth"]);
		$ltstar   = (empty($_POST["tstar"]))? '0000-00-00':$_POST["tstar"];
		$ltend    = (empty($_POST["tend"]))?  '0000-00-00':$_POST["tend"];
		$ldpay    = (empty($_POST["dpay"]))?  '0000-00-00':$_POST["dpay"];
		//$lmnotas = $_POST["mnotas"];
		$lcmsg = "guardada la informacion";
		// verificando que el codigo exista o no 
		$lcsql   = " select cplano from plmast where cplano = '$lcplano' ";
		$lresult = mysqli_query($oConn,$lcsql);	
		$lnCount = mysqli_num_rows($lresult);
		if ($lnCount == 0){
			// este codigo de cliente no existe por tanto lo crea	
			// ejecutando el insert para la tabla de clientes.
			
			$lcsqlcmd = " insert into plmast (cplano,cdesc,cstatus,ctyppay,ctypemp,tstar,tend,dpay,cmonth)	
                            values('$lcplano','$lcdesc','$lcstatus','$$lctyppay','$lctypemp','$ltstar','$ltend','$ldpay','$lcmonth')";
		}else{
			// el codigo existe lo que hace es actualizarlo.	
			$lcsqlcmd = " update plmast set cdesc = '$lcdesc',cstatus = '$lcstatus',ctyppay = '$lctyppay',ctypemp = '$lctypemp',
                                            tstar ='$ltstar',tend = '$ltend',dpay = '$ldpay' ,cmonth = '$lcmonth'
                                            where cplano = '$lcplano' ";
		}
		// ------------------------------------------------------------------------------------------------
		// Generando coneccion y procesando el comando.
		// ------------------------------------------------------------------------------------------------
		$lresultF = mysqli_query($oConn,$lcsqlcmd);	
		//mysqli_query($oConn,$lcsqlcmd);
		$lnRowsAfect = mysqli_affected_rows($oConn);
	}  	// if (isset($_POST["ccateno"])){
	header("location:../view/plmast.php?msg=$lcmsg");		
}  		//if($lcaccion=="NEW")
if ($lcaccion=="NEW_DEPT_DETAIL"){
	$lcdeptno = $_POST["cdeptno"];
	if (empty($_POST["cuid"])){
		$lcsqlcmd = " insert into pldepd(cdeptno, cplano) values('". $_POST["cdeptno"] ."','". $_POST["cplano"] ."')";
	}else{
		$lcsqlcmd = " update pldepd set cdeptno = '". $_POST["cdeptno"] ."', cplano = '". $_POST["cplano"] ."' where cuid = '" . $_POST["cuid"] . "'";
	}
	// ejecutando insercion.			  
		mysqli_query($oConn, $lcsqlcmd);
	$lcaccion = "SHOW_DETAIL_DEPT";
}


// ------------------------------------------------------------------------------------------------
// JSON, - Informacion detallada de un solo registro.
// ------------------------------------------------------------------------------------------------
if ($lcaccion == "JSON"){
	if (isset($_POST["cplano"])){
 		// Consulta unitaria
		$lcSqlCmd = " select * from plmast where cplano ='". $_POST["cplano"] ."'";
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
if ($lcaccion == "EDIT_ROW"){
	if (isset($_POST["cuid"])){
 		// Consulta unitaria
		$lcSqlCmd = " select pldepd.* , pldept.cdesc as cdesc1
		              from pldepd 
					  left outer join pldept on pldept.cdeptno = pldepd.cdeptno
					  where cuid ='". $_POST["cuid"] ."'";
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
if ($lcaccion == "SHOW_DETAIL_DEPT"){
	$lcsqlcmd = "select pldepd.cuid, pldepd.cdeptno, pldept.cdesc
				from pldepd
				left outer join pldept on pldept.cdeptno = pldepd.cdeptno
				where pldepd.cplano = '". $_POST["cplano"]."'";

	$lcresult = mysqli_query($oConn, $lcsqlcmd);
	if ($lcresult->num_rows > 0){
		while($odata = mysqli_fetch_assoc($lcresult)){
			echo "<tr>";
				echo "<td width='50px'>"  . $odata["cuid"] . "</td>";
				echo "<td width='80px'>"  . $odata["cdeptno"] . "</td>";
				echo "<td width='150px'>" . $odata["cdesc"]   . "</td>";
				echo "<td width='60px'><img src='../photos/escoba.ico' class='botones_row' onclick='deleteRow(". $odata['cuid'] .")' title='Eliminar Linea'/>";
				echo "<img src='../photos/editar.ico' class='botones_row' onclick='edit_row(". $odata['cuid'] .")' title='Editar Linea de Deduccion'/></td>";
			echo "</tr>";
		}
	}
	
}

//Cerrando la coneccion.
mysqli_close($oConn);
?>
