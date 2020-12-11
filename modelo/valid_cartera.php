<?php


include("../modelo/vc_funciones.php");
include("../modelo/coneccion.php");
vc_funciones::Star_session();
$oConn = get_coneccion("CIA");

//$lccustno = $_POST["ccusno"];


// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Configurando Saldos iniciales en 0 los saldos de los clientes.
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
mysqli_query($oConn," update arcust set nebalance = 0, nbbalance = 0, nbsalestot = 0, nesalestot = 0");


// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
// Paso 1 - Ajustando saldo de facturas.
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$lcresult = mysqli_query($oConn," select cinvno, ccustno, ntc from arinvc where lvoid = 0 ");

if (mysqli_num_rows($lcresult)){
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

	//-----------------------------------------------------------------------
	// 1.2) Configurando los pagos realizados de los clientes.
	// ----------------------------------------------------------------------
	
	}		//while($curinv = mysqli_fetch_assoc($lcresult)){
}			//if (mysqli_num_rows($lcresult)){



?>