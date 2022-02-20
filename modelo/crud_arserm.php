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
if (isset($_POST["cservno"])){
	$lcservno = $_POST["cservno"];
	}
$lnRowsAfect = 0;
// ------------------------------------------------------------------------------------------------
// DELETE, Borrando los datos.
// ------------------------------------------------------------------------------------------------
if($lcaccion=="DELETE"){
	//verificando si hay datos historicos para borrar.
	$lcsql = "SELECT aradjm.cwhseno,
			     sum(aradjt.nqty) as nqty
				 FROM aradjm
				 left outer join aradjt on aradjm.cadjno  = aradjt.cadjno
				 where aradjt.cservno = '$lcservno'
				 group by 1
				 union all 
				 SELECT arinvc.cwhseno,
						sum(arinvt.nqty * -1) as nqty
				FROM  arinvc
				LEFT OUTER JOIN arinvt on arinvc.cinvno = arinvt.cinvno
				where arinvt.cservno = '$lcservno'
				group by 1
			";	
	$lcresult = mysqli_query($oConn,$lcsql);
	$lnRecnos = mysqli_num_rows($lcresult);
	
	// si hay registros incluidos no puede borrar
	if ($lnRecnos > 0){
		echo "Hay historial de este producto y no puede ser borrado";
	}else{
		// procediendo a borrar datos ya que no ha sido utilizado el codigo en nada.
		$lcsqlcmd = " delete from arserm where cservno = '" . $lcservno . "'; ";
		$lcsqlcmd =	$lcsqlcmd . " delete from arskit where cservno = '" . $lcservno . "' ";
		$lresultF = mysqli_multi_query($oConn,$lcsqlcmd);	
		
	}
	}
if($lcaccion=="DELETE_CUID"){
	$lcsqlcmd = " delete from arskit where cuid = '" . $_POST["cuid"] . "' ";
	$lresultF = mysqli_query($oConn,$lcsqlcmd);	
	get_detalle($lcservno,$oConn);
	}
if($lcaccion=="DELETE_CUID2"){
	$lcsqlcmd = " delete from arwqty where cuid = '" . $_POST["cuid"] . "' ";
	$lresultF = mysqli_query($oConn,$lcsqlcmd);	
	get_detalle_arwqty($lcservno,$oConn);
	}

// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
	// haciendo la coneccion.
	if (isset($_POST["cservno"])){
		$lcdesc     = mysqli_real_escape_string($oConn,$_POST["cdesc"]);
		$lcdesc2    = mysqli_real_escape_string($oConn,$_POST["cdesc2"]);
		$lcstatus   = mysqli_real_escape_string($oConn,$_POST["cstatus"]);
		$lcrespno   = mysqli_real_escape_string($oConn,$_POST["crespno"]);
		$lmnotas    = mysqli_real_escape_string($oConn,$_POST["mnotas"]);
		$lctserno   = mysqli_real_escape_string($oConn,$_POST["ctserno"]);
		$lncost     = ($_POST["ncost"] == "")?0:$_POST["ncost"];
		$lntax      = ($_POST["ntax"]  == "")?0:$_POST["ntax"];
		$lndesc     = ($_POST["ndesc"] == "")?0:$_POST["ndesc"];
		$lnprice    = ($_POST["nprice"]== "")?0:$_POST["nprice"];
		$lcctaid    = mysqli_real_escape_string($oConn,$_POST["cctaid"]);
		$lcctaid_c  = mysqli_real_escape_string($oConn,$_POST["cctaid_c"]);
		$lcctaid_i  = mysqli_real_escape_string($oConn,$_POST["cctaid_i"]);
		$lcitemtype = mysqli_real_escape_string($oConn,$_POST["citemtype"]);
		$lnminonhand = ($_POST["nminonhand"]== "")?0:$_POST["nminonhand"]; 
		$llallowneg  = isset($_POST["lallowneg"]) ? 1:0; 
		$llupdateonhand = isset($_POST["lupdateonhand"]) ? 1:0; 
		if(!empty($_POST["cfoto"])){
			$lcnamefoto = mysqli_real_escape_string($oConn,$_POST["cfoto"]);
			$lcfoto  = 'cfoto = "../photos/otras/' . $lcnamefoto. '",'; 	
			$lcfotoI = '../photos/otras/' . $lcnamefoto; 	
		}else{
			$lcfoto  = "";
			$lcfotoI = "";
		}	
		// verificando que el codigo exista o no 
		$lcsql   = " select cservno from arserm where cservno ='$lcservno' ";
		$lresult = mysqli_query($oConn,$lcsql);	
		$lnCount = mysqli_num_rows($lresult);
			
		
		
		if ($lnCount == 0){
			// este codigo de cliente no existe por tanto lo crea	
			// ejecutando el insert para la tabla de clientes.
			$lcsqlcmd = " insert into arserm (cservno,cdesc,cdesc2,cstatus,crespno,mnotas,ctserno,ncost,ntax,ndesc,nprice,
												cctaid,cctaid_c,cctaid_i,citemtype,nminonhand,lallowneg,cfoto, lupdateonhand)
						  values('$lcservno','$lcdesc','$lcdesc2','$lcstatus','$lcrespno','$lmnotas','$lctserno',$lncost,$lntax,$lndesc,$lnprice,
								'$lcctaid','$lcctaid_c','$lcctaid_i','$lcitemtype',$lnminonhand,$llallowneg,'$lcfotoI', $llupdateonhand)";
		}else{
			// el codigo existe lo que hace es actualizarlo.	
			//cfoto = '$lcfoto', este campo no se actualizara en el update tendra que ser mediante otra pantalla
			$lcsqlcmd = " update arserm set cdesc = '$lcdesc' ,cdesc2 = '$lcdesc2' ,cstatus = '$lcstatus' ,crespno = '$lcrespno' ,
			                mnotas = '$lmnotas', ctserno = '$lctserno' ,ncost = $lncost ,ntax = $lntax ,ndesc = $lndesc,nprice = $lnprice,
							cctaid = '$lcctaid' ,cctaid_c = '$lcctaid_c' ,cctaid_i = '$lcctaid_i', citemtype = '$lcitemtype' ,nminonhand = $lnminonhand,
							lallowneg = $llallowneg, $lcfoto lupdateonhand = $llupdateonhand
							where cservno = '$lcservno' ";
		}
		// ------------------------------------------------------------------------------------------------
		// Generando coneccion y procesando el comando.
		// ------------------------------------------------------------------------------------------------
		$lresultF = mysqli_query($oConn,$lcsqlcmd);	
		//mysqli_query($oConn,$lcsqlcmd);
		$lnRowsAfect = mysqli_affected_rows($oConn);
	}  	// if (isset($_POST["cservno"])){
	header("location:../view/arserm.php");		
	}  		//if($lcaccion=="NEW")
// ------------------------------------------------------------------------------------------------
// JSON, - Informacion detallada de un solo registro.
// ------------------------------------------------------------------------------------------------
if ($lcaccion == "JSON"){
	if (isset($_POST["cservno"])){
 		// Consulta unitaria
		$lcSqlCmd = " select * from arserm where cservno ='". $_POST["cservno"] ."'";
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

if($lcaccion=="MENU"){
	// el where no siempre viene incluido
	$lcwhere  = "";
	if (!empty($_POST["filtro"])){
		$lcwhere  = " where ". $_POST["orden"]. " like '%". $_POST["filtro"] ."%' ";
	}
	// ordenamiento del reporte siempre debe estar lleno.	
	$lcorder  = " order by ". $_POST["orden"];
	// sentencia sql filtrada.
	$lcsql    = " select * from arserm ". $lcwhere . $lcorder;
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
		// obteniendo la existencia actual.

		$lnonhand = get_inventory_onhand($oConn,$ldata["cservno"],"R");

		$ojson = $ojson . $lcSpace .'{"cservno":"' .$ldata["cservno"] .'","cdesc":"'. $ldata["cdesc"] .'","nprice":"'. $ldata["nprice"] .'","nonhand":'. $lnonhand .',"ndesc":"'. $ldata["ndesc"] .'"}';	
	}
	$ojson = $ojson . ']';
	// enviando variable json.
	echo $ojson;		
}
// LISTA, Genera menu de lista de proveedores.
if ($lcaccion == "LISTA"){
		//$oConn = get_coneccion("CIA");
	    $lcSqlCmd = " select * from arserm order by cdesc ";
		$lcResult = mysqli_query($oConn,$lcSqlCmd);
		echo '<select class="listas" name="cservno" id="cservno" required>';
		echo '<option value="">Elija un Registro </option>';		
		while ($rows = mysqli_fetch_assoc($lcResult)){
			echo "<option value='" . $rows["cservno"] ."'>"  . $rows["cdesc"]  . "</option>";
		}
		echo '</select>';
}
// b)-  inserta una linea en el detalle de factura temporal.
// ------------------------------------------------------------------------------
if($lcaccion == "INSERT"){
	$lcservno1 = $_POST["cservno1"];
	$lcsql     = "select cservno,ncost from arserm where cservno = '$lcservno1'";
	$lcresult  = mysqli_query($oConn,$lcsql);
	$odata     = mysqli_fetch_assoc($lcresult);
	$lnqty     = 1; // $_POST["nqty"];
	$lmnotas   = ""; //$_POST["mnotas"];
	$lcsql     = " insert into arskit(cservno, cservno1,nqty,ncost,	usuario)
   		                       values('$lcservno','$lcservno1',1," . $odata["ncost"] .",'". $_SESSION['cuserid']. "')";	
	// insertando los datos.
	$lcresult = mysqli_query($oConn,$lcsql);
	// Refrescando el detalle de la factura.
	get_detalle($lcservno,$oConn);
}
// ------------------------------------------------------------------------------
// actualiza la linea de detalle.
// ------------------------------------------------------------------------------
if($lcaccion == "UPD_CUID"){
	$lcuid    = $_POST["cuid"];
	$lnqty    = $_POST["nqty"];
	$lmnotas  = $_POST["mnotas"];
	$lcsql    = "update arskit set nqty = $lnqty, mnotas = '$lmnotas' where cuid = '$lcuid' ";
	$lcresult = mysqli_query($oConn,$lcsql);
	// Refrescando el detalle de la factura.
	get_detalle($lcservno,$oConn);
}
// actualizando linea de Arwqty
if($lcaccion == "UPD_CUID2"){
	$lcuid     = mysqli_real_escape_string($oConn,$_POST["cuid"]);
	$lcbinno   = mysqli_real_escape_string($oConn,$_POST["cbinno"]);
	$lcestante = mysqli_real_escape_string($oConn,$_POST["cestante"]);
	$lnqtymin  = mysqli_real_escape_string($oConn,$_POST["nqtymin"]);
	$lnqtymax  = mysqli_real_escape_string($oConn,$_POST["nqtymax"]);
	$lmnotas   = mysqli_real_escape_string($oConn,$_POST["mnotas"]);
	$lcservno  = mysqli_real_escape_string($oConn,$_POST["cservno"]);
	$lcsql     = "update arwqty set nqtymin  = $lnqtymin,    mnotas = '$lmnotas', nqtymax = $lnqtymax, 
	                                cestante = '$lcestante' ,cbinno = '$lcbinno'  where cuid = '$lcuid' 
				 ";
	$lcresult = mysqli_query($oConn,$lcsql);
	// Refrescando el detalle de la factura.
	get_detalle_arwqty($lcservno,$oConn);
}
if($lcaccion == "LIST_CUID"){
	if (isset($_POST["cuid"])){
 		// Consulta unitaria
		$lcSqlCmd = " select arskit.*, arserm.cdesc from arskit 
						left outer join arserm on arserm.cservno = arskit.cservno1
						where arskit.cuid =". $_POST["cuid"] ;
		
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
if($lcaccion == "UPD_ARWQTY"){
	$lcsql = "select cwhseno from arwhse where cstatus = 'OP'";
	$lcresult = mysqli_query($oConn,$lcsql);
	// leyendo bodega por bodega
	while($row = mysqli_fetch_assoc($lcresult)){
		$lcsqlqwhse = "select cuid from arwqty where cservno = '$lcservno' and cwhseno = '". $row["cwhseno"]."' ";
		$lcreswqty  = mysqli_query($oConn,$lcsqlqwhse);
		if ($lcreswqty->num_rows == 0 ){
			$lcinsert_wqty = "insert into arwqty(cservno,cwhseno) values('". $lcservno ."','". $row["cwhseno"] . "')";	
			mysqli_query($oConn,$lcinsert_wqty);
		}
	}
	get_detalle_arwqty($lcservno,$oConn);
  }
if($lcaccion == "REFRESH"){
	get_detalle($lcservno,$oConn);
}
if ($lcaccion == "REFRESH2"){
	get_detalle_arwqty($lcservno,$oConn);
}
if($lcaccion == "KARDEX"){
	$lcservno = $_POST["cservno"];

	$lcsq2= "";		
			
	$lcsql= " SELECT aradjm.cwhseno,";
    $lcsql=	$lcsql . " 'Invent' AS ctype,";
    $lcsql=	$lcsql . " aradjm.dtrndate,";
	$lcsql=	$lcsql . "aradjm.crefno,";
	$lcsql=	$lcsql . "aradjt.cadjno as ctrnno,";
    $lcsql=	$lcsql . "aradjt.cservno,";
  	$lcsql=	$lcsql . "arserm.cdesc,";
	$lcsql=	$lcsql . "(aradjt.nqty) as nqty,";
	$lcsql=	$lcsql . "aradjm.ccateno as ctyptran,";
	$lcsql=	$lcsql . "arcate.cdesc as cdesctran,";
	$lcsql=	$lcsql . "aradjt.ncost AS nprice,";
	$lcsql=	$lcsql . "aradjt.ncost AS ncost,";
	$lcsql=	$lcsql . "aradjt.cuid";
	$lcsql=	$lcsql . " FROM aradjm";
	$lcsql=	$lcsql . " left outer join aradjt on aradjm.cadjno  = aradjt.cadjno";
	$lcsql=	$lcsql . " left outer join arserm on arserm.cservno = aradjt.cservno";
	$lcsql=	$lcsql . " left outer join arcate on arcate.ccateno = aradjm.ccateno AND arcate.ctypecate = 'A'";
	$lcsql=	$lcsql . " where arserm.lupdateonhand = true AND aradjm.lvoid = false and aradjt.cservno ='$lcservno'";
	$lcsql=	$lcsql . " union all ";
	
    $lcsq2= $lcsq2 . " SELECT arinvc.cwhseno,";
	$lcsq2=	$lcsq2 . "'Factura' as ctype,";
	$lcsq2=	$lcsq2 . "arinvc.dstar as dtrndate,";
	$lcsq2=	$lcsq2 . "arinvc.crefno,";
	$lcsq2=	$lcsq2 . "arinvt.cinvno as ctrnno,";
	$lcsq2=	$lcsq2 . "arinvt.cservno,";
	$lcsq2=	$lcsq2 . "arserm.cdesc,";
	$lcsq2=	$lcsq2 . "(arinvt.nqty * -1) as nqty,";
	$lcsq2=	$lcsq2 . "arinvc.cpaycode as ctyptran ,";
	$lcsq2=	$lcsq2 . "artcas.cdesc as cdesctran,";
	$lcsq2=	$lcsq2 . "arinvt.nprice,";
	$lcsq2=	$lcsq2 . "arinvt.ncost,";
	$lcsq2=	$lcsq2 . "arinvt.cuid";
	$lcsq2=	$lcsq2 .  " FROM  arinvc";
	$lcsq2=	$lcsq2 . " LEFT OUTER JOIN arinvt on arinvc.cinvno = arinvt.cinvno";
	$lcsq2=	$lcsq2 . " LEFT OUTER JOIN arserm on arserm.cservno = arinvt.cservno";
	$lcsq2=	$lcsq2 . " left outer join artcas on artcas.cpaycode = arinvc.cpaycode";
	$lcsq2=	$lcsq2 . " where arserm.lupdateonhand = true and";
  	$lcsq2=	$lcsq2 . " arinvc.lvoid   = false and ";
  	$lcsq2=	$lcsq2 . " arinvt.cservno ='$lcservno'";
	$lcsq2=	$lcsq2 . " ORDER BY 3";	
	
	$lcsqlcmd = $lcsql . $lcsq2;
	$lcresult  = mysqli_query($oConn,$lcsqlcmd);
	echo '<tbody>';
	while($row = mysqli_fetch_assoc($lcresult)){
		echo '<tr class= "listados">';
		echo '<td width="72px">'  . $row["cwhseno"]   .'</td>';
		echo '<td width="72px">'  . $row["ctype"]     .'</td>';
		echo '<td width="72px">'  . $row["ctrnno"]    .'</td>';
		echo '<td width="72px">'  . $row["crefno"]    .'</td>';
		echo '<td width="72px">'  . $row["dtrndate"]  .'</td>';
		echo '<td width="182px">' . $row["cdesctran"] .'</td>';
		echo '<td class="sayamtd"  width="70px">'  . $row["nqty"]      .'</td>';
		echo '<td class="sayamtd"  width="70px">'  . $row["ncost"]     .'</td>';
		echo '</tr>';
	}
	echo '</tbody>';
}
if($lcaccion == "KARDEX_WHSENO"){
	$lcservno = $_POST["cservno"];
	// procesando todas las bodegas al mismo tiempo
	$lcsql_whseno  = "select cwhseno, cdesc from arwhse ";
	$lcRest_whseno = mysqli_query($oConn,$lcsql_whseno);
	// por cada bodega obtiene el total de articulos
	echo '<tbody>';
	while($lcbodega = mysqli_fetch_assoc($lcRest_whseno)){
		// por cada bodega buscar transacciones.
		$lcwhseno = $lcbodega["cwhseno"];
		$lcsql = "SELECT aradjm.cwhseno,
					     sum(aradjt.nqty) as nqty
				 FROM aradjm
				 left outer join aradjt on aradjm.cadjno  = aradjt.cadjno
				 left outer join arserm on arserm.cservno = aradjt.cservno
				 left outer join arcate on arcate.ccateno = aradjm.ccateno AND arcate.ctypecate = 'A'
				 where arserm.lupdateonhand = true AND 
				 	   aradjm.lvoid   = false and 
					   aradjt.cservno = '$lcservno' and
					   aradjm.cwhseno = '$lcwhseno'
				 group by 1
				 union all 
				 SELECT arinvc.cwhseno,
						sum(arinvt.nqty * -1) as nqty
				FROM  arinvc
				LEFT OUTER JOIN arinvt on arinvc.cinvno = arinvt.cinvno
				LEFT OUTER JOIN arserm on arserm.cservno = arinvt.cservno
				left outer join artcas on artcas.cpaycode = arinvc.cpaycode
				where arserm.lupdateonhand = true and
					  arinvc.lvoid   = false and 
					  arinvt.cservno = '$lcservno' and 
				   	  arinvc.cwhseno = '$lcwhseno'
				group by 1
		";	
		// sacando el total por cada registros.		
		$lnqty = 0;
		$lcresult  = mysqli_query($oConn,$lcsql);
		while($lnrowqty = mysqli_fetch_assoc($lcresult)){
			$lnqty += $lnrowqty["nqty"];	
		}
		// Generando la primera linaa de la tabla
		echo '<tr  class= "listados">';
		echo '<td width="70px">' . $lcbodega["cwhseno"] .'</td>';
		echo '<td width="200px">'. $lcbodega["cdesc"]   .'</td>';
		echo '<td class="sayamtd"  width="70px">' . $lnqty .'</td>';
		echo '</tr>';
	}	
	echo '</tbody>';
}
function get_detalle($pctrnno,$oConn){
	$lcsql     = " select arskit.cuid, arskit.cservno1,arserm.cdesc, arskit.nqty, arskit.ncost
					from arskit 
					left outer join arserm on arserm.cservno = arskit.cservno1
					where arskit.cservno ='$pctrnno' ";	
					
	$lcresult  = mysqli_query($oConn,$lcsql);
	echo '<tbody>';
	while($row = mysqli_fetch_assoc($lcresult)){
		echo '<tr  class= "listados">';
		echo '<td width="92px">'. $row["cservno1"] .' </td>';
		echo '<td width="272px">'. $row["cdesc"]  .'</td>';
		echo '<td width="77px">'. $row["nqty"]      .'</td>';
		echo '<td width="52px">'. $row["ncost"]     .'</td>';
		echo '<td width="77px">'. ($row["nqty"] * $row["ncost"]) .'</td>';
		echo '<td>';
		echo '	<img src="../photos/escoba.ico" class="botones_row" id="btquitar"  value="Eliminar" onclick="eliminarFila('.$row["cuid"].')" >';
		echo '	<img src="../photos/editar.ico" class="botones_row" id="btupdfild" value="Editar"   onclick="editarFila('.$row["cuid"].')" >';
		echo '</td>';
		echo '</tr>';
	}
	echo '</tbody>';
}
// funcion que llena los datos del arwqty
function get_detalle_arwqty($pctrnno,$oConn){
	$lcsql     = " select arwqty.*, arwhse.cdesc
					from arwqty
					left outer join arwhse on arwqty.cwhseno = arwhse.cwhseno
					where arwqty.cservno ='$pctrnno' ";	
					
	$lcresult  = mysqli_query($oConn,$lcsql);
	echo '<tbody>';
	while($row = mysqli_fetch_assoc($lcresult)){
		echo '<tr  class= "listados" id="'. $row["cuid"] .'">';
		echo '<td width="40px">'. $row["cuid"]  .'</td>';
		echo '<td width="200px">'. $row["cdesc"].'<textarea rows=3 cols=25>'. $row["mnotas"]   .'</textarea></td>';
		echo '<td width="20px"><input type="number" class="textqty"  value='. $row["nqtymin"]   .' ></input></td>';
		echo '<td width="20px"><input type="number" class="textqty"  value='. $row["nqtymax"]   .'></input></td>';
		echo '<td width="80px"><input type="text"  class="textkey"  value=' . $row["cestante"] .'></input></td>';
		echo '<td width="80px"><input type="text"  class="textkey" value='  . $row["cbinno"]   .'></input></td>';
		//echo '<td width="100px"><textarea rows=3 cols=25>'. $row["mnotas"]   .'</textarea></td>';
		echo '<td width="20px">';
		echo '	<img src="../photos/escoba.ico" class="botones_row" id="btquitar"  value="Eliminar" onclick="eliminarFila2('.$row["cuid"].')" >';
		echo '	<img src="../photos/editar.ico" class="botones_row" id="btupdfild" value="Editar"   onclick="editarFila2('.$row["cuid"].')" />';
		echo '</td>';
		echo '</tr>';
	}
	echo '</tbody>';
}

//Cerrando la coneccion.
mysqli_close($oConn);


?>
