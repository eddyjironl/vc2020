<?php

include("../modelo/vc_funciones.php");
vc_funciones::Star_session();
$oConn = vc_funciones::get_coneccion("CIA");

$lcaccion = $_GET["accion"];



if ($lcaccion == "JSON"){
	if (isset($_POST["cservno"])){
 		// Consulta unitaria
		$lcSqlCmd = " select * from arsetup ";
		// obteniendo datos del servidor
		$lcResult = mysqli_query($oConn,$lcSqlCmd);
		// convirtiendo estos datos en un array asociativo
		$ldata = mysqli_fetch_assoc($lcResult);
		// convirtiendo este array en archivo jason.
		$jsondata = json_encode($ldata,true);
		// cargando valores de setup en variables globales del php
		$_ARSETUP["minvno"]     = mysqli_real_escape_string($oConn,$ldata["minvno"]);
		$_ARSETUP["mestados"]   = mysqli_real_escape_string($oConn,$ldata["mestados"]);
		$_ARSETUP["mcoti"]      = mysqli_real_escape_string($oConn,$ldata["mcoti"]);
		$_ARSETUP["linvno"]     = $ldata["linvno"];
		$_ARSETUP["lestados"]   = $ldata["lestados"];
		$_ARSETUP["lcoti"]      = $ldata["lcoti"];
		$_ARSETUP["ninvlinmax"] = $ldata["ninvlinmax"];
		$_ARSETUP["cwhseno"]    = mysqli_real_escape_string($oConn,$ldata["cwhseno"]);
		// retornando objeto json
		echo $jsondata;
	}	

}
// ------------------------------------------------------------------------------------------------
// Desidiendo que hara si UPDATE o INSERT
// ------------------------------------------------------------------------------------------------
if ($lcaccion == "SAVE"){
	$lcsqlcmd  = " select * from arsetup ";
	$lresult_t = mysqli_query($oConn,$lcsqlcmd);
	$lnupd     = mysqli_num_rows($lresult_t);
	// ------------------------------------------------------------------------------------------------
	// campos necesarios del formulario.
	//  $ldtrndate = mysqli_real_escape_string($oConn,$_POST["dtrndate"]);
	// ------------------------------------------------------------------------------------------------
	$lninvno   = $_POST["ninvno"]  == ""? 1:$_POST["ninvno"];
	$lncashno  = $_POST["ncashno"] == ""? 1:$_POST["ncashno"];
	$lnadjno   = $_POST["nadjno"]  == ""? 1:$_POST["nadjno"];
	$lnncno    = $_POST["nncno"]   == ""? 1:$_POST["nncno"];
	$lnndno    = $_POST["nndno"]   == ""? 1:$_POST["nndno"];
	$lncotno   = $_POST["ncotno"]  == ""? 1:$_POST["ncotno"];
	$lccustno  = mysqli_real_escape_string($oConn,$_POST["ccustno"]) ;
	$lcwhseno  = mysqli_real_escape_string($oConn,$_POST["cwhseno"]);
	$lcpaycode = mysqli_real_escape_string($oConn,$_POST["cpaycode"]);
	$lccateno  = mysqli_real_escape_string($oConn,$_POST["ccateno"]);
	$lctypcost = mysqli_real_escape_string($oConn,$_POST["ctypcost"]);
	$lctaxproc = mysqli_real_escape_string($oConn,$_POST["ctaxproc"]);
	$llinvno   = isset($_POST["linvno"])  ? 1:0;
	$llestados = isset($_POST["lestados"])? 1:0;
	$llcoti    = isset($_POST["lcoti"])   ? 1:0;
	$lminvno   = mysqli_real_escape_string($oConn,$_POST["minvno"]);
	$lmestados = mysqli_real_escape_string($oConn,$_POST["mestados"]);
	$lmcoti    = mysqli_real_escape_string($oConn,$_POST["mcoti"]);
	$lncashamt = mysqli_real_escape_string($oConn,$_POST["ncashamt"]);
	$lninvlinmax = $_POST["ninvlinmax"] ==""? 20:$_POST["ninvlinmax"];
	// ------------------------------------------------------------------------------------------------
	// armando la sentencia adecuada.
	// ------------------------------------------------------------------------------------------------

	if($lnupd == 0){
	$lcsql = " insert into arsetup(ninvno,ncashno,nadjno,nncno,nndno,ncotno,ninvlinmax,
									ccustno,cpaycode,cwhseno,ccateno,carsetup,ctypcost,ctaxproc,
									linvno,lestados,lcoti,minvno,mestados,mcoti,ncashamt)
							values($lninvno,$lncashno,$lnadjno,$lnncno,$lnndno,$lncotno,$lninvlinmax,
									'$lccustno','$lcpaycode','$lcwhseno','$lccateno','C','$lctypcost','$lctaxproc',
									$llinvno,$llestados,$llcoti,'$lminvno','$lmestados','$lmcoti',$lncashamt)";
	}else{
	$lcsql = " update arsetup set ninvno = $lninvno,ncashno=$lncashno, nadjno=$lnadjno,
									nncno=$lnncno, nndno=$lnndno, ncotno=$lncotno,
										ninvlinmax=$lninvlinmax, ccustno='$lccustno',cpaycode='$lcpaycode',
									cwhseno='$lcwhseno', ccateno='$lccateno', 
										ctypcost='$lctypcost', ctaxproc='$lctaxproc', linvno=$llinvno,
									lestados=$llestados, lcoti=$llcoti, minvno='$lminvno',
										mestados='$lmestados', mcoti= '$lmcoti', ncashamt = $lncashamt ";
	}

	// ------------------------------------------------------------------------------------------------
	// Generando coneccion.
	// ------------------------------------------------------------------------------------------------
	mysqli_query($oConn,$lcsql);
	mysqli_close($oConn);
	header("location:../view/arsetup.php");
}
?>
