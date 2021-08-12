<?php
	include("../modelo/armodule.php");
	include("../modelo/vc_funciones.php");
	$oConn = vc_funciones::get_coneccion("CIA");
	$lcaccion = $_POST["accion"];
	$lcinvno  = "";
	// e)-  Guarda la factura en forma definitiva.
	// ------------------------------------------------------------------------------
	if($lcaccion == "SAVE"){
		// recibiendo el JSON
		$json = $_POST["json"];
		$oAjt = json_decode($json,true);
		$lccustno   = $oAjt["ccustno"];
		$lcwhseno   = $oAjt["cwhseno"];
		$lcpaycode  = $oAjt["cpaycode"];
		$lcrespno   = $oAjt["crespno"];
		$ldstardate = $oAjt["dstardate"];
		$ldenddate  = $oAjt["denddate"];
		$lmnotas    = $oAjt["mnotas"];
		$lcrefno    = $oAjt["crefno"];
		$lcdesc     = $oAjt["cdesc"];
		$lntc       = $oAjt["ntc"];
		$lnefectivo = $oAjt["efectivo"];
		$ldpay      = $oAjt["dpay"];
		$lmnotasr   = $oAjt["mnotasr"];
		// configuracion de los saldos de factura.
		$lnsalesamt = 0;
		$lntaxamt   = 0;
		$lndesamt   = 0;
		$lnbalance  = 0;
		$lnSaldo    = 0;
		$lnpayamt   = 0;
		$lcNewCashno = 0;
		//obteniendo el numero de factura.
		$lcNewInvno = GetNewDoc($oConn,"ARINVC");
		// -------------------------------------------------------------------------------------------------------
		// A)- Cargando el detalle de factura.
		// -------------------------------------------------------------------------------------------------------
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
						$lcsql_d = " insert into arinvt(cinvno,cservno,cdesc,nqty,nprice,ncost,ntax, ndesc, mnotas,cuserid,fecha,hora)
									values('$lcNewInvno','". $b[$i]['cservno']."','". $ldata['cdesc'] ."',".
											$b[$i]['nqty'] .",". $b[$i]['nprice'] .",". $ldata['ncost'] .",". $b[$i]['ntax'] .",".$b[$i]['ndesc'] .",'".$b[$i]['mnotas'].
											"','" .$_SESSION["cuserid"]."','".$ldtrndate."','". date("h:i:s a")."')";
  						$lnveces = 2;
					}else{
						$lcsql_d = $lcsql_d . " ,('$lcNewInvno','". $b[$i]["cservno"] ."','". $ldata["cdesc"] ."',".
												$b[$i]['nqty'] .",". $b[$i]['nprice'] .",". $ldata['ncost'] .",". $b[$i]['ntax'] .",".$b[$i]['ndesc'] .",'".$b[$i]['mnotas'].
												"','" .$_SESSION["cuserid"]."','".$ldtrndate."','". date("h:i:s a")."')";
					}  //if ($lnveces == 1)
					$lnsalesamt += $b[$i]['nqty'] * $b[$i]['nprice'] ;
					$lndesamt   += $b[$i]['ndesc'];
					$lntaxamt   += (($b[$i]['nqty'] * $b[$i]['nprice']) -$b[$i]['ndesc']) * ($b[$i]['ntax']/100);
				}	//for($i=0; $i<$longitud; $i++) 
			}  //if($a == "pagos"){
		}  //foreach ($oAjt as $a=>$b)
		//total monto de la factura.
		$lnbalance = ($lnsalesamt + $lntaxamt) - $lndesamt;
		// -------------------------------------------------------------------------------------------------------
		// B)- Generando registro del pago
		// -------------------------------------------------------------------------------------------------------
		// si registra algun pago genera el registro del escapeshellcmd
		if ($lnefectivo !=""){
			// viene un valor negativo en el pago lo cual no es posible
			if ($lnefectivo < 0){
				return ;
			}
			// paga menos de lo que debe.
			if ($lnbalance >= $lnefectivo){
				$lnpayamt = $lnefectivo;
			}
			// si paga mas de lo que debe
			if ($lnefectivo > $lnbalance){
				$lnpayamt = $lnbalance;
			}
			// obteniendo el numero del recibo de caja.
			$lcNewCashno = GetNewDoc($oConn,"ARCASM");
			// inserta el encabezado del pago.
			$ldpay   = $_POST["dpay"];
			$mnotasr = $_POST["mnotasr"];
			// encabezado del pago.
			$lcsql_h = "insert into arcasm (ccashno, dtrndate, ccustno, mnotas,ntc,namount, cuserid,fecha,hora)
					   values('$lcNewCashno','$ldpay','$lccustno','$mnotasr',$lntc,$lnpayamt,'".$_SESSION['cuserid']."','','')";
			// detalle de facturas que paga en el encabezado del pago 
			$lcsql_d = "insert into arcash (ccashno, cinvno, namount, cuserid,fecha,hora)
					   values('$lcNewCashno','$lcNewInvno', $lnpayamt,'".$_SESSION['cuserid']."','','')";
			// ejecutando las instrucciones de insercion.	
			mysqli_query($oConn,$lcsql_h);
			mysqli_query($oConn,$lcsql_d);
		}  // if ($lnefectivo !=""){
		// -------------------------------------------------------------------------------------------------------
		// C)- Cargando el encabezado.
		// -------------------------------------------------------------------------------------------------------
		// saldo de la factura.
		$lnSaldo = $lnbalance - $lnpayamt;
		$lcsql   = "insert into arinvc(cinvno, ccustno, cwhseno, crespno, cpaycode, dstar, dend, mnotas,
                                      nsalesamt, ntaxamt, ndesamt, nbalance,ntc,cdesc, crefno, cuserid, fecha, hora)
							values('$lcNewInvno', '$lccustno', '$lcwhseno', '$lcrespno', '$lcpaycode', '$ldstardate', '$ldenddate', '$lmnotas',
							        $lnsalesamt, $lntaxamt, $lndesamt, $lnSaldo ,$lntc, '$lcdesc','$lcrefno','". $_SESSION['cuserid']. "','','')";
		mysqli_query($oConn,$lcsql);
		mysqli_query($oConn,$lcsql_d);	
		// -------------------------------------------------------------------------------------------------------
		// D)- Actualizando saldo de cliente
		// -------------------------------------------------------------------------------------------------------
		// si registra algun pago genera el registro del saldo de factura.
		$lcsql = " update arcust set nbbalance = nbbalance + $lnSaldo, nbsalestot = nbsalestot + $lnbalance where ccustno = '$lccustno' ";
		mysqli_query($oConn,$lcsql);	
		// -------------------------------------------------------------------------------------------------------
		// E)- Cerrando las transaciones del temporal 
		// -------------------------------------------------------------------------------------------------------
		echo $lcNewInvno;
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
		$lcsql    = " select arinvc.* ,
					arcust.cname as cfullname,
					artcas.cdesc as cdescpay
					from arinvc
					join arcust on arcust.ccustno  = arinvc.ccustno 
					join artcas on artcas.cpaycode = arinvc.cpaycode ". $lcwhere . $lcorder;
			
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
			$ojson = $ojson . $lcSpace .'{"cinvno":"' .$ldata["cinvno"] .'","cfullname":"'. $ldata["cfullname"] .'","cdescpay":"'. $ldata["cdescpay"] .'","crefno":"'. $ldata["crefno"] .'"}';	
		}
		$ojson = $ojson . ']';
		// enviando variable json.
		echo $ojson;		
		}


	
	// muestra todos los contenidos de la tabla.
	// cerrando la coneccion.
mysqli_close($oConn);
?>	