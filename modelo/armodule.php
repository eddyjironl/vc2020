<?php 
	// -----------------------------------------------------------------------------------------------------
	// A) - Llamadas a las funciones desde JavaScript
	// -----------------------------------------------------------------------------------------------------
	if (isset($_POST["program"])){
		include("vc_funciones.php");
		$oConn = vc_funciones::get_coneccion("CIA");
		if ($_POST["program"]== "get_sales_amount"){
			$lccustno = $_POST["ccustno"];
			get_sales_amount($oConn,$lccustno);
		}
		if ($_POST["program"]== "get_buys_amount"){
			get_buys_amount($oConn,$_POST["crespno"]);
		}
		if ($_POST["program"]== "get_tc_rate"){
			get_tc_rate($oConn,$_POST["dtrndate"]);
		}
		if ($_POST["program"]== "get_inventory_onhand"){
			get_inventory_onhand($oConn,$_POST["cservno"]);
		}
	}
	// -----------------------------------------------------------------------------------------------------
	// B) - Funciones especiales del modulo
	// -----------------------------------------------------------------------------------------------------
// obteniendo el numero siguiente de la transaccion en las diferentes tablas.	
function getsetupnumber($poConn, $pctable){
	if ($pctable == "ARINVC"){
		$lcsql = "select ninvno as numero from arsetup ";
	}
	if ($pctable == "ARCASM"){
		$lcsql = "select ncashno as numero from arsetup ";
	}
	if ($pctable == "ARADJM"){
		$lcsql = "select nadjno as numero from arsetup ";
	}
	// obteniendo INFORMACION
	$lcresult = mysqli_query($poConn,$lcsql);
	$ldata    = mysqli_fetch_assoc($lcresult);
	return $ldata["numero"];
}
function GetNewDoc($poConn,$pctable){
	$llcont = true;
	$lnTmpDocno = getsetupnumber($poConn,$pctable);
	while ($llcont){
		// haciendo el sql.	
		if ($pctable == "ARINVC"){
			$lcsql     = " select cinvno from arinvc where cinvno = '$lnTmpDocno'";
			$lcsql_upd = " update arsetup set ninvno = $lnTmpDocno + 1 ";
		}
		if ($pctable == "ARCASM"){
			$lcsql     = " select ccashno from arcasm where ccashno = '$lnTmpDocno'";
			$lcsql_upd = " update arsetup set ncashno = $lnTmpDocno + 1 ";
		}
		if ($pctable == "ARADJM"){
			$lcsql     = " select cadjno from aradjm where cadjno = '$lnTmpDocno'";
			$lcsql_upd = " update arsetup set nadjno = $lnTmpDocno + 1 ";
		}
		$lcresult = mysqli_query($poConn,$lcsql);
		// revisando si el dato del numero no existe
		$lnexist  = mysqli_num_rows($lcresult);
		if ($lnexist == 1){
			// no existe.
			$lnTmpDocno = $lnTmpDocno + 1;
		}else{
			$llcont = false;
		}
	}
	// actualizando la tabla con el nuevo valor 
	mysqli_query($poConn,$lcsql_upd);
	// retornando el numero nuevo de factura.
	return $lnTmpDocno;
}
// obteniendo el tipo de cambio 
function get_tc_rate($poConn,$pdtrndate){
	$lcsql = " select * from armone where dtrndate = '$pdtrndate' ";
	$lcresult = mysqli_query($poConn,$lcsql); 
	// convirtiendo estos datos en un array asociativo
	$ldata = mysqli_fetch_assoc($lcresult);
	// convirtiendo este array en archivo jason.
	$jsondata = json_encode($ldata,true);
	// retornando objeto json
	echo $jsondata;
}
/* obteniendo monto de ventas en la fecha especificada.*/
function get_sales_amount($poConn,$pccustno){
	$lcsqlcmd = " select sum(nsalesamt - ndesamt + ntaxamt) as nsalestot ,
	                     sum(nbalance) as nbalance
				  from arinvc
				  where ccustno = '$pccustno' and
						cstatus = 'OP' ";

	$lcResult =   mysqli_query($poConn,$lcsqlcmd); // $oConn->query($lcSqlCmd);
	// convirtiendo estos datos en un array asociativo
	$ldata = mysqli_fetch_assoc($lcResult);
	// convirtiendo este array en archivo jason.
	$jsondata =json_encode($ldata,true);
	// retornando objeto json
	echo $jsondata;
}
/* existencia de un articulo. */ 
function get_inventory_onhand($poConn,$pcservno){
	$lcsqlcmd = "SELECT aradjt.cservno,
					     sum(aradjt.nqty) as nqty
				 FROM aradjm
				 left outer join aradjt on aradjm.cadjno  = aradjt.cadjno
				 left outer join arserm on arserm.cservno = aradjt.cservno
				 left outer join arcate on arcate.ccateno = aradjm.ccateno AND arcate.ctypecate = 'A'
				 where arserm.lupdateonhand = true AND 
				 	   aradjm.lvoid   = false and 
					   aradjt.cservno = '$pcservno' 
				 group by 1
				 union all 
				 SELECT arinvt.cservno,
						sum(arinvt.nqty * -1) as nqty
				FROM  arinvc
				LEFT OUTER JOIN arinvt on arinvc.cinvno = arinvt.cinvno
				LEFT OUTER JOIN arserm on arserm.cservno = arinvt.cservno
				left outer join artcas on artcas.cpaycode = arinvc.cpaycode
				where arserm.lupdateonhand = true and
					  arinvc.lvoid   = false and 
					  arinvt.cservno = '$pcservno' 
				group by 1
			";	
	// determinando cuanto producto queda segun el caso 
	$lnqty = 0;
	$lcresult = mysqli_query($poConn,$lcsqlcmd);
	while($lnrowqty = mysqli_fetch_assoc($lcresult)){
		$lnqty += $lnrowqty["nqty"];	
	}
	echo $lnqty;
}
?>