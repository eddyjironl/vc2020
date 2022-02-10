<?php
// ------------------------------------------------------------------------------------------------
// Descripcion.
// 	Definiendo funciones que se realizaran .
//	$lcaccion = isset($_POST["accion"])? $_POST["accion"],$_GET["accion"];
// ------------------------------------------------------------------------------------------------
include("../modelo/vc_funciones.php");
include("../modelo/armodule.php");
$oConn = vc_funciones::get_coneccion("CIA");


if(isset($_POST["accion"])){
	$lcaccion = $_POST["accion"]; 	
}else{
	$lcaccion = $_GET["accion"]; 	
}

if (isset($_POST["cwhseno"])){
	$lcwhseno = mysqli_real_escape_string($oConn, $_POST["cwhseno"]);
}
$lnRowsAfect = 0;

// ------------------------------------------------------------------------------------------------
// REFRESH, Recontruyendo segun todos los datos de la tabla.
// ------------------------------------------------------------------------------------------------
if($lcaccion=="REFRESH"){
	get_detalle($oConn,$lcwhseno);
}

// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
	$json = $_POST["json"];
	$oAjt = json_decode($json,true);
	$lntc = 1;
	//obteniendo el numero de factura.
	$lcpedno   = GetNewDoc($oConn,"ARPEDM");
	$ldtrndate = date("Y-m-d");

	// obteniendo tipo de cambio $lntc = get_tc_rate($oConn,date("Y-m-d"));
	$lcsqltcmd = "select ntc from armone where dtrndate = '$ldtrndate' ";
	$lresultc  = mysqli_query($oConn,$lcsqltcmd);
	if (mysqli_num_rows($lresultc) > 0 ){
		$lxrow = mysqli_fetch_assoc($lresultc);
		if ($lxrow["ntc"] != null){
			$lntc = $lxrow["ntc"];
		}
	}
    // -------------------------------------------------------------------------------
	// A)- insertando los datos del encabezado del pedido
	// -------------------------------------------------------------------------------
	$lcsql = "insert into arpedm(cpedno,ccustno,cpaycode, dtrndate,mnotas, ntc, cuserid,fecha,hora)
			  values('$lcpedno','" . $oAjt['ccustno'] ."','" .$oAjt['cpaycode']."','".$ldtrndate.
					"','".$oAjt['mnotas'].$oAjt['mnotash']."',". $lntc .",'" 
					.$_SESSION["cuserid"]."','".$ldtrndate."','". date("h:i:s a")."')";
	// -------------------------------------------------------------------------------
    // B)- insertando los detalles
	// -------------------------------------------------------------------------------
	$lnveces = 1;
	$lcsql_d  = "";
	foreach ($oAjt as $a=>$b) {
		if($a == "articulos"){
			$longitud = count($b);
			for($i=0; $i<$longitud; $i++) {
				$lcservno  = $b[$i]["cservno"];
				//$lnpayamt = $b[$i]["ncost"];
				$lcsql_ser = "select cdesc , ncost ,ntax from arserm where cservno = '". $lcservno ."'";
				$lcresult  = mysqli_query($oConn,$lcsql_ser);
				$ldata     = mysqli_fetch_assoc($lcresult);
				if ($lnveces == 1){
					$lcsql_d = "insert into arpedt(cpedno,cservno,cdesc, nprice,ntax,nqty,cuserid,fecha,hora)
					            values ('$lcpedno','". $b[$i]["cservno"] ."','". $ldata["cdesc"] ."',"
								        . $b[$i]["nprice"] .",". $ldata["ntax"] .",". $b[$i]["nqty"] .",'"
										.$_SESSION["cuserid"]."','".$ldtrndate."','". date("h:i:s a")."')";
					$lnveces = 2;
				}else{
					$lcsql_d = $lcsql_d . " ,('$lcpedno','". $b[$i]["cservno"] ."','". $ldata["cdesc"] ."',"
					                           . $b[$i]["nprice"] .",". $ldata["ntax"] .",". $b[$i]["nqty"] .",'"
					                           .$_SESSION["cuserid"]."','".$ldtrndate."','". date("h:i:s a")."')";
				}
    		}	
		}  //if($a == "pagos"){
	}
    // instrucciones para crear el encabezado y detalle del pago.
	mysqli_query($oConn,$lcsql);
	mysqli_query($oConn,$lcsql_d);	
	// Actualizando el saldo de facturas..
	echo "Pedido #" . $lcpedno;	
} //if($lcaccion=="NEW")
// obteniendo lista de clientes filtrada
function get_list_ccustno($pcubino){
	$oConn = vc_funciones::get_coneccion("CIA");
	$lccustno = "";
	echo "<select id='ccustno' name='ccustno'>";
	if($pccustno == ""){
		echo "<option value=''>Clientes Indefinidos</option>";
	}else{
		$lcSqlCmd = " select ccustno, cname from arcust where cubino='$pcubino'";
		$lcresult = mysqli_query($oConn,$lcSqlCmd);
		while ($rows = mysqli_fetch_assoc($lcresult)){
			echo "<option value ='". $rows["ccustno"] ."'>". $rows["cname"] ."</option>";
		}
	}
	echo "</select>";
}

function get_list_arubim(){
	$oConn = vc_funciones::get_coneccion("CIA");
	echo "<select id='cubino' name='cubino'>";
	echo "<option value=''>Seleccine Ruta</option>";
	$lcSqlCmd = " select cubino, cdesc from arubim";
	$lcresult = mysqli_query($oConn,$lcSqlCmd);
	while ($rows = mysqli_fetch_assoc($lcresult)){
		echo "<option value ='". $rows["cubino"] ."'>". $rows["cdesc"] ."</option>";
	}
	echo "</select>";
}

//Cerrando la coneccion.
mysqli_close($oConn);
?>
