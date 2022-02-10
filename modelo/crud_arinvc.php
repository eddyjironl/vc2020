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
		$lccustno   = mysqli_real_escape_string($oConn,$oAjt["ccustno"]);
		$lcwhseno   = mysqli_real_escape_string($oConn,$oAjt["cwhseno"]);
		$lcpaycode  = mysqli_real_escape_string($oConn,$oAjt["cpaycode"]);
		$lcrespno   = mysqli_real_escape_string($oConn,$oAjt["crespno"]);
		$ldstardate = (empty($oAjt["dstardate"]))?"0000-00-00":$oAjt["dstardate"];
		$ldenddate  = (empty($oAjt["denddate"]))?"0000-00-00":$oAjt["denddate"];
		$lmnotas    = mysqli_real_escape_string($oConn,$oAjt["mnotas"]);
		$lcrefno    = mysqli_real_escape_string($oConn,$oAjt["crefno"]);
		$lcdesc     = mysqli_real_escape_string($oConn,$oAjt["cdesc"]);
		$lctel      = mysqli_real_escape_string($oConn,$oAjt["ctel"]);
		$lntc       = mysqli_real_escape_string($oConn,$oAjt["ntc"]);
		$lnefectivo = mysqli_real_escape_string($oConn,$oAjt["efectivo"]);
		$ldpay      = (empty($oAjt["dpay"]))?"0000-00-00":$oAjt["dpay"];
		$lmnotasr   = mysqli_real_escape_string($oConn,$oAjt["mnotasr"]);
		$ldtrndate  = date("Y-m-d");
		// configuracion de los saldos de factura.
		$lnsalesamt   = 0;
		$lntaxamt     = 0;
		$lndesamt     = 0;
		$lnbalance    = 0;
		$lnsalesamt_u = 0;
		$lndesamt_u   = 0;
		$lntaxamt_u   = 0;
		$lnSaldo      = 0;
		$lnpayamt     = 0;
		$lcNewCashno  = 0;
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
					$lcservno  = mysqli_real_escape_string($oConn,$b[$i]["cservno"]);
					//$lnpayamt = $b[$i]["ncost"];
					$lcsql_ser = "select cdesc , ncost ,ntax from arserm where cservno = '". $lcservno ."'";
					$lcresult  = mysqli_query($oConn,$lcsql_ser);
					$ldata     = mysqli_fetch_assoc($lcresult);
					if ($lnveces == 1){
						$lcsql_di = " insert into arinvt(cinvno,cservno,cdesc,nqty,nprice,ncost,ntax, ndesc, mnotas,cuserid,fecha,hora)
									values('$lcNewInvno','". $b[$i]['cservno']."','". $ldata['cdesc'] ."',".
											$b[$i]['nqty'] .",". $b[$i]['nprice'] .",". $ldata['ncost'] .",". $b[$i]['ntax'] .",".$b[$i]['ndesc'] .",'".
											"','" .$_SESSION["cuserid"]."','".$ldtrndate."','". date("h:i:s a")."')";
  						$lnveces = 2;
					}else{
						$lcsql_di = $lcsql_di . " ,('$lcNewInvno','". $b[$i]["cservno"] ."','". $ldata["cdesc"] ."',".
												$b[$i]['nqty'] .",". $b[$i]['nprice'] .",". $ldata['ncost'] .",". $b[$i]['ntax'] .",".$b[$i]['ndesc'] .",'".
												"','" .$_SESSION["cuserid"]."','".$ldtrndate."','". date("h:i:s a")."')";
					}  //if ($lnveces == 1)

					// cantidad bruta por linea.
					$lnsalesamt_u = $b[$i]['nqty'] * $b[$i]['nprice'] ;
					// aplicando el descuento porcentual
					$lndesamt_u   = $lnsalesamt_u * ($b[$i]['ndesc']/100);
					// impuesto de venta porcentual.
					$lntaxamt_u   = ($lnsalesamt_u - $lndesamt_u) * ($b[$i]['ntax']/100);
					// llevando los valores acumulados.
					$lnsalesamt  += $lnsalesamt_u ;
					$lndesamt    += $lndesamt_u;
					$lntaxamt    += $lntaxamt_u;
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
			// encabezado del pago.
			$lcsql_h = "insert into arcasm (ccashno, dtrndate, ccustno, mnotas,ntc,namount, cuserid,fecha,hora)
					   values('$lcNewCashno','$ldpay','$lccustno','$lmnotasr',$lntc,$lnpayamt,'".$_SESSION['cuserid']."','".$ldtrndate."','". date("h:i:s a")."')";
			// detalle de facturas que paga en el encabezado del pago 
			$lcsql_d = "insert into arcash (ccashno, cinvno, namount, cuserid,fecha,hora)
					   values('$lcNewCashno','$lcNewInvno', $lnpayamt,'".$_SESSION['cuserid']."','".$ldtrndate."','". date("h:i:s a")."')";
			// ejecutando las instrucciones de insercion.	
			mysqli_query($oConn,$lcsql_h);
			mysqli_query($oConn,$lcsql_d);
		}  // if ($lnefectivo !=""){
		// -------------------------------------------------------------------------------------------------------
		// C)- Cargando el encabezado.
		// -------------------------------------------------------------------------------------------------------
		// saldo de la factura.
		$lnSaldo = $lnbalance - $lnpayamt;
		$lcsql   = "insert into arinvc(cinvno, ccustno, ctel, cwhseno, crespno, cpaycode, dstar, dend, mnotas,
                                      nsalesamt, ntaxamt, ndesamt, nbalance,ntc,cdesc, crefno, cuserid, fecha, hora)
							values('$lcNewInvno', '$lccustno', '$lctel', '$lcwhseno', '$lcrespno', '$lcpaycode', '$ldstardate', '$ldenddate', '$lmnotas',
							        $lnsalesamt, $lntaxamt, $lndesamt, $lnSaldo ,$lntc, '$lcdesc','$lcrefno','".$_SESSION['cuserid']."','".$ldtrndate."','". date("h:i:s a")."')";
		mysqli_query($oConn,$lcsql_di);	
		mysqli_query($oConn,$lcsql);
		
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

	if ($lcaccion=="ANULAR"){
			$lcinvno = $_POST["cinvno"];
			if (empty($lcinvno)){
				$lcmsg = "# Factura vacia";
				//header('Location:' . getenv('HTTP_REFERER'));
				header("Location: ../view/arvinv.php?msg=$lcmsg");
				return; 
			}
			void_invoice($oConn,$lcinvno);
		}
	
	function void_invoice($oConn,$pcinvno){
			try{
				$lcmsg    = " Anulacion de Factura ". $pcinvno ." Completada..!! ";
				$llcont   = True;
				$lcsqlcmd = " select cinvno, ctrnno, ccustno , lvoid, nsalesamt, ntaxamt, ndesamt, nbalance  from arinvc where cinvno = '". $pcinvno ."' ";
				// determinando los datos relacionados a la Facturacion
				$lcresult = mysqli_query($oConn,$lcsqlcmd);
				$oInvno   = mysqli_fetch_assoc($lcresult);
				// de no ocurrir  error cierra la ejecucion con este codigo.
				if (is_null($oInvno) ){
					$lcmsg = "La Factura ". $pcinvno. " No Existe";
				}
				elseif ($oInvno["lvoid"] == True){
					$lcmsg = "La Factura ". $pcinvno . " Se encuentra Anulada";
				}
				elseif (!empty($oInvno["ctrnno"])){
						// 1- previo a la anulacion verificar si tiene asientos contables para no anular la factura si tiene asientos contables.
						$lcmsg = "La factura no puede ser anulada <br> porque esta procesada en Contabilidad";
				}
				else{
						// 2- tiene recibos .. hay que anularlos.			
						// Verificando si hay algun recibo pasado a contabilidad.
						// si lo hay no se puede anular la factura. ya que no se puede anular el recibo.
						$lcsqlcmd = " select arcasm.ctrnno, arcasm.ccashno 
										from arcash 
										left outer join arcasm on arcasm.ccashno = arcash.ccashno 
										where arcash.cinvno = '$pcinvno' and arcasm.cstatus = 'OP' and arcasm.ctrnno !='' "; 
						
						$lcresult = mysqli_query($oConn,$lcsqlcmd);

						if($lcresult->num_rows > 0){
							$llcont = False;
							$lcmsg  = "Existen Recibos pasados a Contabilidad No puede anular la factura";
						}else{
							// No tiene recibos en contabilidad, por lo tanto procede a anular recibos que existan en relacion a la factura.
							$lcsqlcmd = " select arcasm.ccashno , arcash.cinvno, arcash.namount 
							from arcash 
							left outer join arcasm on arcasm.ccashno = arcash.ccashno 
							where arcash.cinvno = '$pcinvno' and arcasm.cstatus = 'OP'  "; 
							
							// Procesando Recibos.
							$lcresult = mysqli_query($oConn, $lcsqlcmd);
							if ($lcresult->num_rows>0){
								$lccashno_x = "DASF";
								while ($ldata = mysqli_fetch_assoc($lcresult)){
									if($lccashno_x  != $ldata["ccashno"]){
										$lccashno_x =  $ldata["ccashno"];
										$lcsqlcmd   =  " update arcasm set cstatus = 'NL' where ccashno = '" . $ldata["ccashno"] . "' "; 
										mysqli_query($oConn,$lcsqlcmd);
									}
									// ajustando saldo de factura que tiene el recibo anulado. PERO que no es la factura que vamos a anular.
									if ($ldata["cinvno"] != $pcinvno){
										$lcupdate     = " update arinvc set nbalance  = nbalance +  " .$ldata["ncashamt"];
										$lcupd_arcust = " update arcust set nbbalance = nbbalance + " .$ldata["ncashamt"] ;
										mysqli_query($oConn,$lcupdate);
										mysqli_query($oConn,$lcupd_arcust);
									}	//if ($ldata["cinvno"] != $pcinvno){
								}		//while ($ldata = mysqli_fetch_assoc($lcresult)){
							}			//if ($lcresult->num_rows>0){
						}

						if ($llcont){

							// 3- ajustar el saldo del cliente segun sea el caso rebajando facturas anuladas de su saldo en ventas y 
							//    cuentas por cobrar en el maestro de clientes.
							// Anulando Factura.
							$lcupd_1 = " update arinvc set lvoid = 1 , cstatus = 'NL' where cinvno = '" . $pcinvno . "' ";
							// Ajustando saldo de cliente.
							$lcupd_2 = " update arcust set nbbalance = nbbalance - ". $oInvno["nbalance"]. 
							            ", nbsalestot = nbsalestot - ". ( ($oInvno["nsalesamt"] + $oInvno["ntaxamt"]) - $oInvno["ndesamt"] ).	
										" where arcust.ccustno = ' ". $oInvno["ccustno"] ."' " ;
							mysqli_query($oConn,$lcupd_1);
							mysqli_query($oConn,$lcupd_2);
						}
					
					// Para efectos de inventarios esto es todo. pero de haber cuentas por pagar   nsalesamt, ntaxamt, ndescamt
					// habria que reversar pagos realizados, tambien balance del proveedor.
				}
				header("Location: ../view/arvinv.php?msg=$lcmsg");
			}
			catch(Exception $ex){
				$lcmsg="ocurrio un error " .$ex->getCode(). " al intentar procesar ".  $ex->getMessage();
				echo $lcmsg;
			}

		}
		// muestra todos los contenidos de la tabla.

		// cerrando la coneccion.
	mysqli_close($oConn);
?>	