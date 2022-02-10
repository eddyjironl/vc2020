<?php 
	// -----------------------------------------------------------------------------------------------------
	// A) - Llamadas a las funciones desde JavaScript
	// -----------------------------------------------------------------------------------------------------
	if (isset($_POST["program"])){
		include("vc_funciones.php");
		$oConn = vc_funciones::get_coneccion("CIA");
		if ($_POST["program"]== "get_sales_amount"){
			//$lccustno = $_POST["ccustno"];
			$lccustno = mysqli_real_escape_string($oConn,$_POST["ccustno"]);
			get_sales_amount($oConn,$lccustno);
		}
		if ($_POST["program"]== "get_buys_amount"){
			$lcrespno = mysqli_real_escape_string($oConn,$_POST["crespno"]);
			get_buys_amount($oConn,$lcrespno);
		}
		if ($_POST["program"]== "get_tc_rate"){
			$ldtrndate = mysqli_real_escape_string($oConn,$_POST["dtrndate"]);
			get_tc_rate($oConn,$ldtrndate);
		}
		if ($_POST["program"]== "get_inventory_onhand"){
			$lcservno    = mysqli_real_escape_string($oConn,$_POST["cservno"]);
			$lcrespuesta = mysqli_real_escape_string($oConn,$_POST["respuesta"]);
			get_inventory_onhand($oConn,$_POST["cservno"],$_POST["respuesta"]);
		}
		if ($_POST["program"]== "conf_cxc"){
			$lccustno = mysqli_real_escape_string($oConn,$_POST["ccustno"]);
			conf_cxc($oConn,$lccustno);
		}
		// descuento maximo del articulo
		if ($_POST["program"]== "get_item_desc"){
			$lcservno = mysqli_real_escape_string($oConn,$_POST["cservno"]);
			get_item_desc($oConn,$lcservno);
		}

		// llamando el menu desde algo que no es una clase
		if ($_POST["program"]== "get_menu_list"){
			$lcmenu = mysqli_real_escape_string($oConn,$_POST["menu"]);
			$lcwindow = mysqli_real_escape_string($oConn,$_POST["window"]);
			
			//get_item_desc($oConn,$_POST["menu"],$_POST["menu"]);
			get_menu_list($lcmenu,$lcwindow);
		}
	}
	// -----------------------------------------------------------------------------------------------------
	// B) - Funciones especiales del modulo
	// -----------------------------------------------------------------------------------------------------
function get_item_desc($poConn,$pcitem){
	$lcsqlcmd = "select ndesc from arserm where cservno = '". $pcitem ."'";
	$lcresult = mysqli_query($poConn,$lcsqlcmd);
	$lnreturn = 0;

	if ($lcresult->num_rows>0){
		$lodata = mysqli_fetch_assoc($lcresult);
		$lnreturn = $lodata["ndesc"];
	}
	// devolviendo el descuento.
	echo $lnreturn;
}

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
	if ($pctable == "ARPEDM"){
		$lcsql = "select npedno as numero from arsetup ";
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
		if ($pctable == "ARPEDM"){
			$lcsql     = " select cpedno from arpedm where cpedno = '$lnTmpDocno'";
			$lcsql_upd = " update arsetup set npedno = $lnTmpDocno + 1 ";
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
	// verificando si tiene algo 
	
	if(mysqli_num_rows($lcresult)>0){
		// convirtiendo estos datos en un array asociativo
		$ldata = mysqli_fetch_assoc($lcresult);
		//convirtiendo este array en archivo jason.
		$jsondata = json_encode($ldata,true);
		// retornando objeto json
		echo $jsondata;
	}
	else{
		// convirtiendo estos datos en un array asociativo
		$ldata = array("ntc"=>1);
		//convirtiendo este array en archivo jason.
		$jsondata = json_encode($ldata,true);
		// retornando objeto json
		echo $jsondata;
	}
}
/* obteniendo monto de ventas en la fecha especificada.*/
function get_sales_amount($poConn,$pccustno){
	$lcsqlcmd = " select sum(nsalesamt - ndesamt + ntaxamt) as nsalestot ,
	                     sum(nbalance) as nbalance
				  from arinvc
				  where ccustno = '$pccustno' and
						cstatus = 'OP' and lvoid = 0 ";

	$lcResult =   mysqli_query($poConn,$lcsqlcmd); // $oConn->query($lcSqlCmd);
	// convirtiendo estos datos en un array asociativo
	$ldata = mysqli_fetch_assoc($lcResult);
	// convirtiendo este array en archivo jason.
	$jsondata =json_encode($ldata,true);
	// retornando objeto json
	echo $jsondata;
}
/* existencia de un articulo. */ 
function get_inventory_onhand($poConn,$pcservno,$prespt){
	// Parametros de la funcion
	// poConn = Coneccion a la base de datos
	// pcservno = articulo a analizar
	// prespt = Respuesta a retornar sea R = con return para funciones php E= con la impresion de un valor eco para funciones javascrip
	$lcsqlcmd = "SELECT aradjt.cservno,
					     sum(aradjt.nqty) as nqty
				 FROM aradjm
				 left outer join aradjt on aradjm.cadjno  = aradjt.cadjno
				 left outer join arserm on arserm.cservno = aradjt.cservno
				 left outer join arcate on arcate.ccateno = aradjm.ccateno AND arcate.ctypecate = 'A'
				 where arserm.lupdateonhand = true AND 
				 	   aradjm.lvoid   = false and 
					   aradjm.cstatus = 'OP' and 
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
					  arinvc.cstatus = 'OP' and
					  arinvt.cservno = '$pcservno' 
				group by 1
			";	
	// determinando cuanto producto queda segun el caso 
	$lnqty = 0;
	$lcresult = mysqli_query($poConn,$lcsqlcmd);
	while($lnrowqty = mysqli_fetch_assoc($lcresult)){
		$lnqty += $lnrowqty["nqty"];	
	}
	// desidiendo como sera la respuesta.
	if ($prespt == "R"){
		return $lnqty;
	}else{
		echo $lnqty;
	}
}
function conf_cxc($poConn,$pccustno){
	// se ajustara  el saldo de cartera. para uno o para todos los clientes.
	//. poniendo en cero el saldo de los Clientes
	$lcmsg ="Proceso concluido";
	$lcwhere_cus = "";
	$lcwhere_inv = " where arinvc.cstatus = 'OP' and lvoid = 0 ";
	if (!empty($pccustno)){
		$lcwhere_cus = " where arcust.ccustno = '". $pccustno . "' ";
		$lcwhere_inv = " where arinvc.cstatus = 'OP' and lvoid = 0 and   arinvc.ccustno = '". $pccustno . "' ";
	}
	$lcmsg = "puso en cero el saldo";
	
	try{
		// ------------------------------------------------------------------------------------------------------
		// 1- Poniendo en 0 saldos de cliente y factuas.
		// ------------------------------------------------------------------------------------------------------
		// poniendo el saldo de los clientes en 0,
		mysqli_query($poConn," update arcust set nbbalance = 0, nbsalestot = 0 ".$lcwhere_cus);
		// poniendo saldo de facturas en 0
		$lcupd_1 = " update arinvc set nsalesamt = 0, ntaxamt = 0 , ndesamt = 0, nbalance = 0 ". $lcwhere_inv ;
		mysqli_query($poConn,$lcupd_1);

		// ------------------------------------------------------------------------------------------------------
		// 2- Recalculado encabezado de Facturas.
		// ------------------------------------------------------------------------------------------------------
		$lcresult = mysqli_query($poConn," select cinvno from arinvc ". $lcwhere_inv );
		// si hay facturas continua haciendo si no no hay nada que hacer.
		if ($lcresult->num_rows > 0){
			while( $data = mysqli_fetch_assoc($lcresult)){
				$lcdet_inv  = " select nqty , nprice , ntax , ndesc from arinvt where cinvno = '" . $data["cinvno"] . "' ";
				$lcresult2   = mysqli_query($poConn,$lcdet_inv);
				$lnsalesamt = 0;
				$lndesamt   = 0;
				$lntaxamt   = 0;
				$lnbalance  = 0;
				$lncashamt  = 0;
				$lncashamt  = 0;
				// procesand detalle de facturas.
				if ($lcresult2->num_rows > 0){
					echo "Procesando facturas...";
					while ($data_inv = mysqli_fetch_assoc($lcresult2)){
						// Venta bruta.
						// nivel unitario 
						$lnsalesamt_u = $data_inv["nqty"] * $data_inv["nprice"];
						$lnsalesamt   = $lnsalesamt + $lnsalesamt_u;
						// descuento % 
						$lndesamt_u   = $lnsalesamt_u * ($data_inv["ndesc"]/100);  
						$lndesamt     = $lndesamt + $lndesamt_u ;  
						// Impuesto
						$lntaxamt_u   = ($lnsalesamt_u - $lndesamt_u) * ($data_inv["ntax"]/100);  
						$lntaxamt     = $lntaxamt + $lntaxamt_u ;  
					}
					
					// total de la factura.
					// buscando todos los abonos para esta persona.
					$lccash_amt = " select sum(arcash.namount) as ncashamt from arcash 
					                join arcasm on arcasm.ccashno = arcash.ccashno
									where arcasm.cstatus = 'OP' and arcash.cinvno = '". $data['cinvno'] . "' ";

					$lcresult2   = mysqli_query($poConn,$lccash_amt);
					if ($lcresult2->num_rows > 0){
						$ldata_cash = mysqli_fetch_assoc($lcresult2);
						$lncashamt  = $ldata_cash["ncashamt"];
					}
					// calculando el balance de la factura.
					$lnbalance  = ($lnsalesamt + $lntaxamt) - ($lndesamt + $lncashamt);
					// actualizando encabezado de la factura a como debio ser sin ningun abono.
					$lcupd_invno = " update arinvc set nsalesamt = $lnsalesamt , ntaxamt = $lntaxamt, ndesamt = $lndesamt, nbalance = $lnbalance 
					                 where arinvc.cinvno = '" . $data['cinvno'] . "' ";
					// actualizando el encabezado de factura. 
					mysqli_query($poConn,$lcupd_invno);
				}	//if ($lcresult->num_rows > 0){
				
			}
		
			// ------------------------------------------------------------------------------------------------------
			// 3- Calculando saldo de clientes.
			// ------------------------------------------------------------------------------------------------------
			// poniendo venta bruta y saldo de cuentas por cobrar de cada cliente.
			$lcsqlcmd = " select ccustno ,  sum(nsalesamt + ntaxamt - ndesamt) as nsalesamt,
						sum(nbalance) as nbalance from arinvc ". $lcwhere_inv . " group by ccustno ";
			// obteniendo venta total y saldos de facturas.				
			$lcresult = mysqli_query($poConn,$lcsqlcmd);

			if ($lcresult->num_rows > 0){
				while ($lcdata = mysqli_fetch_assoc($lcresult)){
					$lnvtatotal   = $lcdata["nsalesamt"]; 
					$lncxctotal   = $lcdata["nbalance"];
					$lcupd_custno = " update arcust set nbsalestot= $lnvtatotal, nbbalance = $lncxctotal where ccustno = '" .$lcdata["ccustno"] . "' ";
					mysqli_query($poConn,$lcupd_custno);
				}	// while ($lcdata = mysqli_fetch_assoc($lcresult)){
			}
			$lcmsg = "Proceso Concluido";
		}else{
			$lcmsg = "No hay facturas que procesar";
		}	//if ($lcresult->num_rows > 0)
	}

	catch(Exception $ex){
		$lcmsg="ocurrio un error " .$ex->getCode(). " al intentar procesar ".  $ex->getMessage();
		echo $lcmsg;
	}
	header("Location: ../view/arclear.php?msg=$lcmsg");
}

function get_menu_list_backup($pcmenu, $pcShowIn){
	// definiendo las variables.
	$oConn     = vc_funciones::get_coneccion("SYS");		
	$lcsqlcmd  = "select * from ksschgrd where calias= '$pcmenu' ";
	$lcresult  = mysqli_query($oConn,$lcsqlcmd);
	$oFormMenu = "";
	$lcTitle   = "";
	$lcBtQuit  = "";
	//configuracion del boton de salida del menu
	$lcid        = "bt_menu_salir";
	$pcpicture   = "../photos/salir.ico";
	$pcDescShort = "cerrar";

	$lcbt = '<button class="btbarra" 
				style="width:60px; height:60px" 
				type="button" 
				name="' . $lcid . '" id="' . $lcid . '" 
				title="" 
				accesskey="g"> 
					<img style="width:30px; height:30px" src="' . $pcpicture . '" alt="x" /> 
					<br>' . $pcDescShort .
			'</button>';

	if($lcresult->num_rows> 0){

		// creando lista de menu ordemnamientos y encabezados de tabla.
		$lcselect = '<select class="listas" id="mx_opc_order">';
		// creando encabezado de la tabla.
		$lctableheader = '<table id="mx_head" class="mx_formato_datos"> <tr>';
		// hacemos un lup buscando los datos necesarios.
		$lnveces = 1;
		while($oHtml = mysqli_fetch_assoc($lcresult)){
			if ($lnveces == 1){
				// primera ves obteniendo el SQL para listar datos.
				$lnveces  = 2;
				// obteniendo el select de la lista de datos del menu
				$lcsqlcmd = $oHtml["mcolvalue"];
				$lcTitle  = $oHtml["cheader"];
			}else{
				// guardando estructura de tabla que se presentara.
				$afields[]=$oHtml["mcolvalue"];
				$afieldsLength[]=$oHtml["ncolwidth"];
				$lnveces ++;
				// cargando la lista y encabezado de tabla.
				$lcselect = $lcselect. '<option value = "'. $oHtml["mcolvalue"] .'"> '. $oHtml["cheader"].' </option>';
				// caargando las columnas del encabezado.
				$lctableheader = $lctableheader . '<th width='.$oHtml["ncolwidth"].'> '. $oHtml["cheader"] .'</th>';		
			}
		}
		$lcselect = $lcselect . '</select>';
		$lctableheader = $lctableheader . '</tr></table>';
		
		// -----------------------------------------------------------------------------------------------------------------------------------
		// Obteniendo datos del sistema.
		// -----------------------------------------------------------------------------------------------------------------------------------
		$oConn1 = vc_funciones::get_coneccion("CIA");		
		$lctabledetail = '<table id="mx_detalle" class="mx_formato_datos">';
		$lcresult = mysqli_query($oConn1, $lcsqlcmd);
		// numero de registros a presentar en la tabla de detalles.
		$lnReccnos = count($afields);

		if($lcresult->num_rows > 0){
			// debera haber un array para los nombres de los campos que se usaran en este caso.
			// Cargando datos de la tabla en cuestion
			// antes de esto hay que cargar en un arreglo los titulos.
			while($oData = mysqli_fetch_assoc($lcresult)){
				// dentro del bucle for i debera recorrer orizontalmente el arreglo para vertir los encabezados de la tabla.
				$lctabledetail = $lctabledetail  .'<tr>';
				for ($i=0; $i<$lnReccnos; ++$i){
					$lctabledetail = $lctabledetail  . "<td width=". $afieldsLength[$i] ."px>".$oData[$afields[$i]] ." </td>";  
				}
				$lctabledetail = $lctabledetail  .'</tr>';
			}
			$lctabledetail = $lctabledetail . "</table";

		}else{
			$lctabledetail = "Tabla ". $lcTitle . "Se encuentra Vacia";
		}
		// pintando la pantalla
		$oFormMenu = '	<section class="mx_area_bloqueo" id="xm_area_menu">
						<section class="form2" id="form_menu">
							<div class="mx_barra_sencilla" id="mx_barra_sencilla">
								<strong id="mx_titulo">'. $lcTitle.'</strong>
								<br>
								<label class="labelnormal">Ordenado por </label>
									'.$lcselect.'
								<br>				
								<label class="labelnormal">Buscar</label>
								<input type="text" id="mx_cbuscar" name="mx_cbuscar" class="textnormal">
							</div>
							<br>
							<div= class="mx_area_encabezado">'
								.$lctableheader. '
							</div=>
							<br>
							<div class="mx_area_detalles">
								'.$lctabledetail.'
							</div>
							<div class= "mx_area_encabezado">
								'.$lcbt.'
							</div>
						</section>
					</section>';

		echo $oFormMenu;
		
	}else{
		echo "Menu no configurado";
	}
}
?>