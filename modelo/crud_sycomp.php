<?php
// ------------------------------------------------------------------------------------------------
// Descripcion.
// 	Definiendo funciones que se realizaran .
//	$lcaccion = isset($_POST["accion"])? $_POST["accion"],$_GET["accion"];
// ------------------------------------------------------------------------------------------------
include("../modelo/vc_funciones.php");
//include("../modelo/coneccion.php");

vc_funciones::Star_session();
$oConn = vc_funciones::get_coneccion("SYS");

if(isset($_POST["accion"])){
	$lcaccion = $_POST["accion"]; 	
}else{
	$lcaccion = $_GET["accion"];
}

if($lcaccion=="JSON"){
	// codigo del grupo 
	$lccompid = $_POST["ccompid"];
	$lcSqlCmd = " select * from syscomp where ccompid = '$lccompid' ";
	// obteniendo datos del servidor
	$lcResult = mysqli_query($oConn,$lcSqlCmd);
	// convirtiendo estos datos en un array asociativo
	$ldata = mysqli_fetch_assoc($lcResult);
	// convirtiendo este array en archivo jason.
	$jsondata = json_encode($ldata,true);
	// retornando objeto json
	echo $jsondata;
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
	$lcsql    = " select * from syscomp ". $lcwhere . $lcorder;
	//echo $lcsql;
	//return ;
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
		$ojson = $ojson . $lcSpace .'{"ccompid":"' .$ldata["ccompid"] .'","compdesc":"'. $ldata["compdesc"] .'"}';	
	}
	$ojson = $ojson . ']';
	// enviando variable json.
	echo $ojson;		
}

if($lcaccion=="NEW"){
	$lccompid  = mysqli_real_escape_string($oConn,$_POST["ccompid"]);
	$lcompdesc = mysqli_real_escape_string($oConn,$_POST["compdesc"]);
	$lcstatus  = mysqli_real_escape_string($oConn,$_POST["cstatus"]);
	$lctel     = mysqli_real_escape_string($oConn,$_POST["ctel"]);
	$lcfax     = mysqli_real_escape_string($oConn,$_POST["cfax"]);
	$lmdirecc  = mysqli_real_escape_string($oConn,$_POST["mdirecc"]);
	$lcciudad  = mysqli_real_escape_string($oConn,$_POST["cciudad"]);
	$lcpais    = mysqli_real_escape_string($oConn,$_POST["cpais"]);
	$lnanofisc = mysqli_real_escape_string($oConn,$_POST["nanofisc"]);
	$lcuserid  = mysqli_real_escape_string($oConn,$_POST["cuser"]);
	$lcpasword = mysqli_real_escape_string($oConn,$_POST["ckeyid"]);
	$lchost    = mysqli_real_escape_string($oConn,$_POST["chost"]);
	$ldbname   = mysqli_real_escape_string($oConn,$_POST["dbname"]);
	$lunicontdat =($_POST["lunicontdat"] == "true" )? 1:0; 

	if(!empty($_POST["cfoto"])){
		$lcfoto  = ',cfoto = "../photos/' . $_POST["cfoto"]. '"'; 	
		$lcfotoI = '../photos/' . $_POST["cfoto"]; 	
	}else{
		$lcfoto  = "";
		$lcfotoI = "";
	}	
	// verificando si existe o no .
	$lcsql_1 = " select ccompid from syscomp where ccompid = '$lccompid' ";
	//echo $lcsql_1;
	//return;
	$lodata  = mysqli_query($oConn,$lcsql_1);
	$llupd   = mysqli_num_rows($lodata);
	// desidiendo que se hara con el codigo, si crea un regisrto nuevo o actualiza el existente.	
	if ($llupd == 0){
		$lcsql = " insert into syscomp(ccompid,compdesc,cstatus,ctel,cfax,cciudad,cpais,mdirecc,
		                               nanofisc,cuser,ckeyid,chost,dbname,lunicontdat,cfoto) 
							   values('$lccompid','$lcompdesc','$lcstatus','$lctel' ,'$lcfax' ,'$lcciudad','$lcpais','$lmdirecc',
							   			$lnanofisc,'$lcuserid','$lcpasword','$lchost','$ldbname',$lunicontdat,'$lcfotoI') ";
	}else{
		$lcsql = " update syscomp set ccompid = '$lccompid',compdesc = '$lcompdesc',cstatus = '$lcstatus',ctel = '$lctel',
					   cfax = '$lcfax' ,cciudad = '$lcciudad',cpais = '$lcpais',mdirecc = '$lmdirecc',
					   nanofisc = $lnanofisc,cuser = '$lcuserid',ckeyid = '$lcpasword' ,chost = '$lchost' ,dbname = '$ldbname',lunicontdat = $lunicontdat $lcfoto  
				where ccompid = '$lccompid' ";
	}
	
	echo $lcsql;
	// actualizando la base de datos.
	$lresult = mysqli_query($oConn,$lcsql);
}

?>
