<?php


include("../modelo/vc_funciones.php");
include("../modelo/coneccion.php");
vc_funciones::Star_session();
$oConn = get_coneccion("CIA");
$llcont= false;
//$lccustno = $_POST["ccusno"];


// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Configurando Saldos iniciales en 0 los saldos de los clientes.
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


mysqli_query($oConn," update arcust set nebalance = 0, nbbalance = 0, nbsalestot = 0, nesalestot = 0");
mysqli_query($oConn," update arcasm set namount = 0");
mysqli_query($oConn," update arinvc set nbalance = 0, nsalesamt = 0, ndesamt = 0, ntaxamt = 0");


/*
$varios = mysqli_multi_query($oConn," update arcust set nebalance = 0, nbbalance = 0, nbsalestot = 0, nesalestot = 0;
							update arinvc set nbalance = 0, nsalesamt = 0, ndesamt = 0, ntaxamt = 0;
							update arcasm set namount = 0");
*/
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Paso 1 - Ajustando saldo de facturas.
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$lcresult = mysqli_query($oConn," select cinvno, ccustno, ntc from arinvc where lvoid = 0 ");

if (mysqli_num_rows($lcresult)>0){
	//-----------------------------------------------------------------------
	// 1.1) Configurando la parte de las facturas lo que deben los clientes..
	// ----------------------------------------------------------------------
	while($curinv = mysqli_fetch_assoc($lcresult)){
		// buscando datos de cada factura.
		$lcdetinv = mysqli_query($oConn," select nqty, nprice , ndesc, ntax from arinvt where cinvno = '" . $curinv["cinvno"] . "' ");
		$lnprice_bt = 0;
		$lndesc_bt  = 0; 
		$lntax_bt   = 0;
		while($curdetinv = mysqli_fetch_assoc($lcdetinv)){
			$lnprice_bt = $lnprice_bt + ($curdetinv["nqty"] * $curdetinv["nprice"]);
			$lndesc_bt  = $lndesc_bt  + $curdetinv["ndesc"];
			$lntax_bt   = $lntax_bt   + (($curdetinv["nqty"] * $curdetinv["nprice"]) - $curdetinv["ndesc"]) * ($curdetinv["ntax"]/100);
		}	//while($curdetinv = mysqli_fetch_assoc($lcdetinv)){
				
		// 1)- actualizando la cuenta de la factura.
		mysqli_query($oConn, "update arinvc set nsalesamt = $lnprice_bt , 
		                                          ndesamt = $lndesc_bt,
												  ntaxamt = $lntax_bt,
												  nbalance = ($lnprice_bt + $lntax_bt) - $lndesc_bt													  
												  where cinvno = '". $curinv["cinvno"] ."' ");			
		// 2)- actualizando la cuenta del cliente.
		mysqli_query($oConn, "update arcust set nbbalance  = nbbalance  + ($lnprice_bt + $lntax_bt) - $lndesc_bt,
												nbsalestot = nbsalestot + ($lnprice_bt + $lntax_bt) - $lndesc_bt,
												nebalance  = nebalance  + ((($lnprice_bt + $lntax_bt) - $lndesc_bt) / " . $curinv["ntc"] . "),
												nesalestot = nesalestot + ((($lnprice_bt + $lntax_bt) - $lndesc_bt) / " . $curinv["ntc"] . ")
												  where ccustno = '". $curinv["ccustno"] ."' ");			
		$llcont = true;
	}		//while($curinv = mysqli_fetch_assoc($lcresult)){
	if ($llcont){
		echo "Verificacion de Cartera Primera parte Concluida exitosamente.";
	}
}			//if (mysqli_num_rows($lcresult)){


//-----------------------------------------------------------------------
// 2) Configurando los pagos realizados de los clientes.
// ----------------------------------------------------------------------
$llcont   = false;	
$lcresult = mysqli_query($oConn," select ccashno, ccustno, ntc from arcasm where cstatus = 'OP' ");
if (mysqli_num_rows($lcresult) > 0){
	while ($curcasm = mysqli_fetch_assoc($lcresult)){
		$lcamount_tot = 0;
		$lcrespay = mysqli_query($oConn,"select namount, cinvno from arcash where ccashno = '". $curcasm["ccashno"] ."'");
		// ajustando cada recibo con su detalle de facturas pagadas.
		while ($curcash = mysqli_fetch_assoc($lcrespay)){
			$lcamount_tot = $lcamount_tot + $curcash["namount"]	;
			
			// 2.1 sjustando saldo de factura para este recibo aplicado.
			mysqli_query($oConn, " update arinvc set nbalance = nbalance - " . $curcash["namount"] . " where arinvc.cinvno = '" . $curcash["cinvno"] . "'");
			
			// 2.2 Ajustando el saldo del cliente una vez aplicado el recibo a la factura.
			mysqli_query($oConn, " update arcust set nbbalance = nbbalance - $lcamount_tot,
			                                         nebalance = nebalance - ($lcamount_tot / ". $curcasm["ntc"] .")
        			               where arcust.ccustno = '" . $curcasm["ccustno"] . "'");
		}
		// Actualizando el encabezado del recibo finalmente.
		mysqli_query($oConn,"update arcasm set namount = ". $lcamount_tot ." where arcasm.ccashno = '" . $curcasm["ccashno"] . "'");		
		$llcont = true;
	}	//while ($curcasm = mysqli_fetch_assoc($lcresult)){
	if ($llcont){
		echo "<br> Verificacion de Cartera Segunda Parte Concluida Exitosamente.";
	}
	
}	//if (mysqli_num_rows($lcresult) > 0){



?>

