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

if (isset($_POST["cwhseno"])){
	$lcwhseno = mysqli_real_escape_string($oConn,$_POST["cwhseno"]);
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
	$lcmnotas = $_POST["mnotas"];
	$oAjt = json_decode($json,true);
	//obteniendo el numero de factura.
	$lcadjno   = GetNewDoc($oConn,"ARADJM");
	$lcadjno1  = GetNewDoc($oConn,"ARADJM");
	$lcwhseno  = mysqli_real_escape_string($oConn,$oAjt['cwhseno']);
	$lnfactor  = 1;
	$lnfactor1 = 1;
	$llcont    = true;
	$llupdcost = false;
	$llupdcost1 = false;
	$llCont_traslado = false;
	// Determinando el factor de movimiento en la requisa.
	$lcsql_factor = " select ctypeadj , lupdcost from arcate where ccateno = '". $oAjt['ccateno'] ."' ";
	$lcresult = mysqli_query($oConn,$lcsql_factor);
	$ofactor  = mysqli_fetch_assoc($lcresult);
	if ($ofactor["ctypeadj"] == "S"){
		$lnfactor = -1;
	}
	$llupdcost = $ofactor["lupdcost"];

	// ----------------------------------------------------
	// existen datos para ejecutar un trasaldo automatico.
	// ----------------------------------------------------
	if ($oAjt['cwhseno1'] != ""){
		$lcwhseno1 = $oAjt['cwhseno1'];
		// verificando el tipo de ajuste a considerar.
		if ($oAjt['ccateno1'] != ""){
			
			$lccateno1 = $oAjt['ccateno1'];
			$lcsql_factor1 = " select ctypeadj , lupdcost from arcate where ccateno = '". $oAjt['ccateno1'] ."' ";
			$lcresult1 = mysqli_query($oConn,$lcsql_factor1);
			$ofactor1  = mysqli_fetch_assoc($lcresult1);
			
			if ($ofactor1["ctypeadj"] == "S"){
				$lnfactor1 = -1;
			}
			$llCont_traslado = true;
		} //if ($oAjt['ccateno1'] != ""){
		$llupdcost1 = $ofactor1["lupdcost"];
	} // if ($oAjt['cwhseno1'] != ""){
	// ----------------------------------------------------

	// -------------------------------------------------------------------------------
	// A)- insertando los datos del encabezado del requisa
	// -------------------------------------------------------------------------------
	$lcsql = "insert into aradjm(cadjno,crefno, ccateno, crespno, dtrndate,mnotas,cwhseno, ntc, usuario)
			  values('$lcadjno','" . $oAjt['crefno'] . "','". $oAjt['ccateno'] ."','" .$oAjt['crespno']."','".$oAjt['dtrndate'].
					"','".$lcmnotas."','".$oAjt['cwhseno']."',".$oAjt['ntc'].",'" . $_SESSION["cuserid"]. "')";
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
				$lcsql_ser = "select cdesc , ncost from arserm where cservno = '". $lcservno ."'";

				$lcresult  = mysqli_query($oConn,$lcsql_ser);
				$ldata     = mysqli_fetch_assoc($lcresult);
				if ($lnveces == 1){
					$lcsql_d = "insert into aradjt(cadjno,cservno,cdesc, ncost,ncostu,nqty,usuario)
					            values ('$lcadjno','". $b[$i]["cservno"] ."','". $ldata["cdesc"] ."',". $b[$i]["ncost"] .",". $ldata["ncost"] .",$lnfactor * ". $b[$i]["nqty"] .",'".$_SESSION["cuserid"]."')";
					$lnveces = 2;
				}else{
					$lcsql_d = $lcsql_d . " ,('$lcadjno','". $b[$i]["cservno"] ."','". $ldata["cdesc"] ."',". $b[$i]["ncost"] .",". $ldata["ncost"] .",$lnfactor * ". $b[$i]["nqty"] .",'".$_SESSION["cuserid"]."')";
				}
			 	// ----------------------------------------------------------------------------------------------------------------
				// determinando costo promedio en el maestro de inventarios segun configuracion del modulo o ultimo costo recibido.
				// ----------------------------------------------------------------------------------------------------------------
				//  A) Determinando metodo de Costeo Elegido por el usuario.
				if($llupdcost){
					//	B) Determinando las cantidades existentes si es costo promedio.
					$lnonhand = get_inventory_onhand($oConn,$lcservno,"R");
					//  C) Determinando costo promedio para cargarlo en la linea del articulo.
					$lnCost_master = $ldata["ncost"];	
					// determinando costo promedio.
					$lnExist_amt_act   = $lnonhand * $lnCost_master;
					// costo actual de la compra.
					$lnExist_amt_buy   = $b[$i]["nqty"] * $b[$i]["ncost"] ;
					// costo promedio
					$lnCostPromd       = ($lnExist_amt_act + $lnExist_amt_buy) / ($lnonhand + $b[$i]["nqty"] );
					$lnlast_price_buy  =  $b[$i]["ncost"];
					$lcsqlserupd = " update arserm set  nlastcost = ".  $lnlast_price_buy. ", ncost = ".$lnCostPromd . " where arserm.cservno = '". $lcservno."'";
					$llcont = $llcont and mysqli_query($oConn,$lcsqlserupd);
				}
				// ----------------------------------------------------------------------------------------------------------------

			}	//codigo ejecutado por cada una de las facturas pagadas.
		}  //if($a == "pagos"){
	}
	// instrucciones para crear el encabezado y detalle del pago.
	if ($llcont){
		mysqli_query($oConn,$lcsql);
		mysqli_query($oConn,$lcsql_d);	
		echo $lcadjno;
	}else{
		echo "Requisa no guardada";
	}
	
	if ($llCont_traslado){
		$llcont = true;
		// -------------------------------------------------------------------------------
		// C)- insertando los datos del encabezado del requisa
		// -------------------------------------------------------------------------------
		$lcsql1 = "insert into aradjm(cadjno,crefno, ccateno, crespno, dtrndate,mnotas,cwhseno, ntc, usuario)
				values('$lcadjno1','" . $oAjt['crefno'] . "','". $oAjt['ccateno1'] ."','" .$oAjt['crespno']."','".$oAjt['dtrndate'].
						"','".$lcmnotas."','".$oAjt['cwhseno1']."',".$oAjt['ntc'].",'" . $_SESSION["cuserid"]. "')";
		// -------------------------------------------------------------------------------
		// D)- insertando los detalles
		// -------------------------------------------------------------------------------
		$lnveces = 1;
		$lcsql_d1  = "";
		foreach ($oAjt as $a=>$b) {
			if($a == "articulos"){
				$longitud = count($b);
				for($i=0; $i<$longitud; $i++) {
					$lcservno  = $b[$i]["cservno"];
					//$lnpayamt = $b[$i]["ncost"];
					$lcsql_ser = "select cdesc , ncost from arserm where cservno = '". $lcservno ."'";

					$lcresult  = mysqli_query($oConn,$lcsql_ser);
					$ldata     = mysqli_fetch_assoc($lcresult);
					if ($lnveces == 1){
						$lcsql_d1 = "insert into aradjt(cadjno,cservno,cdesc, ncost,ncostu,nqty,usuario)
									values ('$lcadjno1','". $b[$i]["cservno"] ."','". $ldata["cdesc"] ."',". $b[$i]["ncost"] .",". $ldata["ncost"] .",$lnfactor1 * ". $b[$i]["nqty"] .",'".$_SESSION["cuserid"]."')";
						$lnveces = 2;
					}else{
						$lcsql_d1 = $lcsql_d1 . " ,('$lcadjno1','". $b[$i]["cservno"] ."','". $ldata["cdesc"] ."',". $b[$i]["ncost"] .",". $ldata["ncost"] .",$lnfactor1 * ". $b[$i]["nqty"] .",'".$_SESSION["cuserid"]."')";
					}
					// ----------------------------------------------------------------------------------------------------------------
					// determinando costo promedio en el maestro de inventarios segun configuracion del modulo o ultimo costo recibido.
					// ----------------------------------------------------------------------------------------------------------------
					//  A) Determinando metodo de Costeo Elegido por el usuario.
					if($llupdcost1){
						//	B) Determinando las cantidades existentes si es costo promedio.
						$lnonhand = get_inventory_onhand($oConn,$lcservno,"R");
						//  C) Determinando costo promedio para cargarlo en la linea del articulo.
						$lnCost_master = $ldata["ncost"];	
						// determinando costo promedio.
						$lnExist_amt_act   = $lnonhand * $lnCost_master;
						// costo actual de la compra.
						$lnExist_amt_buy   = $b[$i]["nqty"] * $b[$i]["ncost"] ;
						// costo promedio
						$lnCostPromd       = ($lnExist_amt_act + $lnExist_amt_buy) / ($lnonhand + $b[$i]["nqty"] );
						$lnlast_price_buy  =  $b[$i]["ncost"];
						$lcsqlserupd = " update arserm set  nlastcost = ".  $lnlast_price_buy. ", ncost = ".$lnCostPromd . " where arserm.cservno = '". $lcservno."'";
						$llcont = $llcont and mysqli_query($oConn,$lcsqlserupd);
					}
					// ----------------------------------------------------------------------------------------------------------------

				}	//codigo ejecutado por cada una de las facturas pagadas.
			}  //if($a == "pagos"){
		}
		// actualizando requisas de traslado automatico
		if ($llcont){
			mysqli_query($oConn,$lcsql1);
			mysqli_query($oConn,$lcsql_d1);	
		}else{
			echo "Requisa de transaldo no guardada";
		}
		
	} // if ($llCont_traslado){
    
}  		//if($lcaccion=="NEW")

if($lcaccion=="MENU"){
	// el where no siempre viene incluido
	$lcwhere  = "";
	if (!empty($_POST["filtro"])){
		$lcwhere  = " where ". $_POST["orden"]. " like '%". $_POST["filtro"] ."%' ";
	}
	// ordenamiento del reporte siempre debe estar lleno.	
	$lcorder  = " order by ". $_POST["orden"];
	// sentencia sql filtrada.
	$lcsql    = " select aradjm.*, arcate.cdesc as cdesccate, arresp.cfullname  from aradjm 
				left outer join arcate on arcate.ccateno = aradjm.ccateno
				left outer join arresp on arresp.crespno = aradjm.crespno
				". $lcwhere . $lcorder;
	
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
		$ojson = $ojson . $lcSpace .'{"cadjno":"' .$ldata["cadjno"] .'","cdesccate":"'. $ldata["cdesccate"] .'","dtrndate":"'. $ldata["dtrndate"] .'","crefno":"'. $ldata["crefno"] .'"}';	
	}
	$ojson = $ojson . ']';
	// enviando variable json.
	echo $ojson;		
}

if ($lcaccion=="ANULAR"){
	$lcadjno = $_POST["cadjno"];
	if (empty($lcadjno)){
		$lcmsg = "Requisa vacia";
		//header('Location:' . getenv('HTTP_REFERER'));
		header("Location: ../view/arvadj.php?msg=$lcmsg");
		return; 
	}
	void_adj($oConn,$lcadjno);
}

function get_detalle($oConn,$pcwhseno){
	// --------------------------------------------------------------------
	// lista de facturas de un cliente.
	// 1 Con Saldo , 2 Estado Activa.
	// --------------------------------------------------------------------
	$lcsql = " select arinvc.cinvno,
						artcas.cdesc,
						arinvc.dend,
						arinvc.nbalance,
						arinvc.crefno
 				from arinvc 
				left outer join artcas on artcas.cpaycode = arinvc.cpaycode
				where arinvc.nbalance > 0 and 
				arinvc.cstatus = 'OP' and 
				arinvc.cwhseno = '$pcwhseno'
			 ";	
	$lcresult  = mysqli_query($oConn,$lcsql);
	echo '<tbody>';
	while($row = mysqli_fetch_assoc($lcresult)){
		echo '<tr>';
		echo '<td class="saytextd"  width="70px">'. $row["cinvno"]   .'</td>';
		echo '<td class="saytextd"  width="200px">'.$row["cdesc"]   .'</td>';
		echo '<td class="saytextd"  width="75px">'. $row["crefno"]   .'</td>';
		echo '<td class="saytextd"  width="75px">'. $row["dend"]     .'</td>';
		echo '<td class="sayamtd"   width="90px">'. $row["nbalance"] .'</td>';
		echo '<td class="sayamtd"   width="70px"> <input type="number" id="saldo" name="saldo" class="textkey"> </td>';
	echo '</tr>';
	}
	echo '</tbody>';
}


function void_adj($oConn,$pcadjno){
	$lcmsg="Anulacion requisa ". $pcadjno ." Completada..!! ";

	$lcsqlcmd = " select cadjno , lvoid from aradjm where cadjno = '". $pcadjno ."' ";
	
	try{
		$lcresult = mysqli_query($oConn,$lcsqlcmd);
		$lvoid    = mysqli_fetch_assoc($lcresult);
	
	}
	
	catch(Exception $ex){
		$lcmsg="ocurrio un error " .$ex->getCode(). " al intentar procesar ".  $ex->getMessage();
		echo $lcmsg;
	}



	if (is_null($lvoid) ){
		$lcmsg = "La Requisa ". $pcadjno. " No Existe";
	}
	elseif ($lvoid["lvoid"] == True){
		$lcmsg = "La Requisa ". $pcadjno . " Se encuentra Anulada";
	}else{
		$lcsqlcmd = " update aradjm set lvoid = 1, cstatus='NL' where cadjno = '" . $pcadjno . "' ";
		// Para efectos de inventarios esto es todo. pero de haber cuentas por pagar
		// habria que reversar pagos realizados, tambien balance del proveedor.

		mysqli_query($oConn,$lcsqlcmd);
	}
	header("Location: ../view/arvadj.php?msg=$lcmsg");


}



//Cerrando la coneccion.
mysqli_close($oConn);
?>
