<?php
// ------------------------------------------------------------------------------------------------
// Descripcion.
// 	Definiendo funciones que se realizaran .
//	$lcaccion = isset($_POST["accion"])? $_POST["accion"],$_GET["accion"];
// ------------------------------------------------------------------------------------------------
include("../modelo/vc_funciones.php");
//include("../modelo/coneccion.php");

vc_funciones::Star_session();
$oConn = vc_funciones::get_coneccion("SYS");

if(isset($_POST["accion"])){
	$lcaccion = $_POST["accion"]; 	
}else{
	$lcaccion = $_GET["accion"]; 	
}

// ------------------------------------------------------------------------------------------------
// REFRESH, Recontruyendo segun todos los datos de la tabla.
// ------------------------------------------------------------------------------------------------
if($lcaccion=="REFRESH"){
	$lcgrpid = $_POST["cgrpid"];
	get_detalle($oConn,$lcgrpid);
}
if($lcaccion=="REFRESH_PERMISOS"){
	$lcgrpid = mysqli_real_escape_string($oConn,$_POST["cgrpid"]);
	$lciaid  = mysqli_real_escape_string($oConn,$_POST["ccompid"]);
	get_permisos($oConn,$lcgrpid,$lciaid);
}
// actualizacion de tabla de permisos.
if($lcaccion=="UPD_PERMISOS"){
	$lciaid  = $_POST["ccompid"];
	$lcgrpid = $_POST["cgrpid"];
	$lnveces = 1;
	$lcsql_2 = "";
	$llcont  = false;
	$lcsql_1 = " select * from symenu ";
	// obteniendo datos del menu principla.
	$lcresult = mysqli_query($oConn, $lcsql_1);
	// leyendo menus generales
	while($odata = mysqli_fetch_assoc($lcresult)){
		// buscando este menu id en el detalle de permisos del grupo.
		$lcmenuid = $odata["cmenuid"];
		// cuid cgrpid cmenuid cdesc allow
       	$lcsql_2 = " select * from syperm 
					 where cgrpid = '$lcgrpid' and
					  	   ccompid = '$lciaid' and
					  	   cmenuid = '$lcmenuid' ";
		// ejecutando la consulta.
		$lcresult_2 = mysqli_query($oConn, $lcsql_2);
		$lnrows = mysqli_num_rows($lcresult_2);
		//$llcont = ($lnrows == 1)?"verdadero":"falso";
		// si no trae datos hace un insert de este dato para actualizar la tabla de permisos para este 
		// grupo. 
		if ($lnrows != 1){
			$llcont = true;
			$lcdesc = $odata["cdesc"];
			if ($lnveces == 1){
				$lcslq_upd = "insert into syperm (cgrpid, ccompid, cmenuid, cdesc, allow) 
							   values('$lcgrpid','$lciaid','$lcmenuid','$lcdesc',0)";
				$lnveces = 2;
			}else{
				$lcslq_upd = $lcslq_upd . ",('$lcgrpid','$lciaid','$lcmenuid','$lcdesc',0)";
			}	//if ($lnveces == 1){
		}	//if ($llcont){
	}	// while($odata = $losymenu){
	// REFRESCANDO PERMISOS.
	//echo $lcslq_upd;
	if ($llcont){
		mysqli_multi_query($oConn,$lcslq_upd);	
	}
	get_permisos($oConn,$lcgrpid,$lciaid);
}

if ($lcaccion=="DELETE_USER"){
	$lcuid    = $_POST["cuid"];
	$pcgrupid = $_POST["cgrupid"];
	// validando sentencia de usuario para borrar.
	$lcsqluser_del = "delete from sysuser where cuid  = '$lcuid'";
	mysqli_query($oConn,$lcsqluser_del);
	get_detalle($oConn, $pcgrupid);
}

// Ingresando a un nuevo usuario en el grupo.
if($lcaccion=="NEW_USER"){
	$lcuid      = mysqli_real_escape_string($oConn,$_POST["cuid"]);
	$lcstatus   = mysqli_real_escape_string($oConn,$_POST["cstatus"]);
	$lcgrpid    = mysqli_real_escape_string($oConn,$_POST["cgrpid"]);
	$lcfullname = mysqli_real_escape_string($oConn,$_POST["cfullname"]);
	$lcuserid   = mysqli_real_escape_string($oConn,$_POST["cuserid"]);
	$lcpasword  = mysqli_real_escape_string($oConn,$_POST["cpasword"]);
	$lcwhseno   = mysqli_real_escape_string($oConn,$_POST["cwhseno"]);
	if($lcuid == ""){
		$lcsql = " insert into sysuser (cgrpid, cfullname, cuserid,cpasword,cwhseno)
				   values('$lcgrpid','$lcfullname','$lcuserid','$lcpasword','$lcwhseno')
			 	 ";
	}else{
		$lcsql = " update sysuser set cgrpid = '$lcgrpid', cfullname = '$lcfullname', 
		                              cuserid = '$lcuserid',cpasword = '$lcpasword', cstatus = '$lcstatus' ,
									  cwhseno = '$lcwhseno'
					where cuid = '$lcuid'
			 	 ";
	}		 
	$lcresult = mysqli_query($oConn,$lcsql);
	get_detalle($oConn ,$lcgrpid);
}
if($lcaccion=="JSON"){
	// codigo del grupo 
	$lcgrpid = $_POST["cgrpid"];
	$lcSqlCmd = " select * from sygrup where cgrpid = '$lcgrpid' ";
	// obteniendo datos del servidor
	$lcResult = mysqli_query($oConn,$lcSqlCmd);
	// convirtiendo estos datos en un array asociativo
	$ldata = mysqli_fetch_assoc($lcResult);
	// convirtiendo este array en archivo jason.
	$jsondata = json_encode($ldata,true);
	// retornando objeto json
	echo $jsondata;
}
if($lcaccion=="REFRESH_CIAS"){
    $lcsql = " select *	from syscomp ";	
	$lcresult  = mysqli_query($oConn,$lcsql);
	echo '<tbody>';
	while($row = mysqli_fetch_assoc($lcresult)){
		$lccompid = $row["ccompid"];
		echo '<tr>';
		echo '<td class="saytextd"  width="70px">'. $row["ccompid"] .'</td>';
		echo '<td class="saytextd"  width="200px">' . $row["compdesc"]   .'</td>';
		echo '<td class="saytextd"  width="40px"> ';
		//echo 	'<input type="button" value="Permisos" onclick = "permisos(this)"> ';
		echo '<img src="../photos/permisos.ico" class="btmenu" onclick = "permisos(this)" title ="click para ver permisos de la Compañia"> ';
		
		echo '</td>';
		echo '</tr>';
	}
	echo '</tbody>';
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
	$lcsql    = " select * from sygrup ". $lcwhere . $lcorder;
	//echo $lcsql;
	//return ;
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
		$ojson = $ojson . $lcSpace .'{"cgrpid":"' .$ldata["cgrpid"] .'","cdesc":"'. $ldata["cdesc"] .'","cstatus":"'. $ldata["cstatus"] .'"}';	
	}
	$ojson = $ojson . ']';
	// enviando variable json.
	echo $ojson;		
}
// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW_SYPERM"){
	$lccompid  = $_POST["ccompid"];
	$lcgrpid  = $_POST["cgrpid"];
	// transacciones de los permisos.
	$ojson = json_decode($_POST["json"],true);
	// -------------------------------------------------------------------------------
	// A)- insertando los permisos
	// -------------------------------------------------------------------------------
	foreach ($ojson as $permisos=>$item) {
		$longitud = count($item);
		for($i=0; $i<$longitud; $i++) {
			$lcuid   = $item[$i]["cuid"];
			//$llallow = $item[$i]["allow"];
			$llallow = 0;
			if($item[$i]["allow"] == true){
				$llallow = 1;	
			}
			
			if ($i == 0){
				$lcupd = " update syperm set allow = $llallow where cuid = '$lcuid' ";
			}else{
				$lcupd = $lcupd . "; update syperm set allow = $llallow where cuid = '$lcuid' ";
			}
			// actualizando la linea de permiso por cada uno en el json.
		mysqli_query($oConn,$lcupd);
		}	
	}
	// Ejecutando multi querys 
	mysqli_multi_query($oConn,$lcupd);
}

if($lcaccion=="NEW"){
	$lcgrpid  = mysqli_real_escape_string($oConn,$_POST["cgrpid"]);
	$lcdesc   = mysqli_real_escape_string($oConn,$_POST["cdesc"]);
	$lcstatus = mysqli_real_escape_string($oConn,$_POST["cstatus"]);
	// transacciones de los permisos.
	$ojson = json_decode($_POST["json"],true);
	
	// -------------------------------------------------------------------------------
	// A)- insertando los datos del encabezado del pago
	// -------------------------------------------------------------------------------
	// verificando si existe o no .
	$lcsql_1 = " select cgrpid from sygrup where cgrpid = '$lcgrpid' ";
	$lodata  = mysqli_query($oConn,$lcsql_1);
	$llupd   = mysqli_num_rows($lodata);
	// desidiendo que se hara con el codigo, si crea un regisrto nuevo o actualiza el existente.	
	if ($llupd == 0){
		$lcsql = " insert into sygrup(cgrpid,cdesc,cstatus) values('$lcgrpid','$lcdesc','$lcstatus') ";
	}else{
		$lcsql = " update sygrup set cdesc = '$lcdesc',cstatus = '$lcstatus' where cgrpid = '$lcgrpid' ";
	}
	// actualizando la base de datos.
	$lresult = mysqli_query($oConn,$lcsql);
}

function get_detalle($oConn, $pcgrupid){
    $lcsql     = " select *	from sysuser where cgrpid = '$pcgrupid' ";	
	$lcsql_whs = "select cwhseno , cdesc from arwhse ";
	// configurando las bodegas para cada usuario.
	// Conectando con la base de datos.

	$oConn_cia    = vc_funciones::get_coneccion("CIA");
	$lcresult_whs = mysqli_query($oConn_cia,$lcsql_whs);
	$lcmsg_whs    = "";
	$llCont_whs   = false;
	// existen detalle de bodegas definidos.
	if ($lcresult_whs->num_rows > 0){
		$llCont_whs = True;
	}

	$lcresult    = mysqli_query($oConn,$lcsql);
	echo '<tbody>';
	while($row = mysqli_fetch_assoc($lcresult)){
		echo '<tr>';
		echo '<td class="saytextd"  width="200px">'. $row["cfullname"] .'</td>';
		echo '<td class="saytextd"  width="70px">' . $row["cuserid"]   .'</td>';
		echo '<td class="saytextd"  width="70px">' . $row["cpasword"]  .'</td>';
		echo '<td class="saytextd"  width="70px">' . $row["cstatus"]   .'</td>';
		echo '<td class="saytextd"  width="200px">' ;
		$lcmsg_whs = "Bodega No Especificada";
			if($llCont_whs){
				$lcresult_whs = mysqli_query($oConn_cia,$lcsql_whs);
				while($odata = mysqli_fetch_assoc($lcresult_whs)){
					if($row["cwhseno"] == $odata["cwhseno"]){
						$lcmsg_whs = $odata["cdesc"];			
					}
				}
			}
		echo '<input type="text" class="saytext" value="' .$lcmsg_whs. '" name="cwhseno" id="cwhseno" >';
		echo'</td>';
		echo  "<td><img src='../photos/editar.ico' id='btquitar' class='botones_row'  onclick = 'edit_userid(". $row["cuid"].",this)' title='Editar Registro de Usuario'/></td>";
		echo  "<td><img src='../photos/escoba.ico' id='btquitar' class='botones_row'  onclick = 'delete_user(". $row["cuid"].")' title='Eliminar Registro'/></td>";

	echo '</tr>';
	}
	echo '</tbody>';
}

function get_permisos($oConn, $pcgrupid,$pciaid){
    $lcsql = " select *	from syperm	where cgrpid = '$pcgrupid' and ccompid = '$pciaid' ";	
	
	// cuid	cgrpid cmenuid	cdesc allow
	$lcresult  = mysqli_query($oConn,$lcsql);
	echo '<tbody>';
	while($row = mysqli_fetch_assoc($lcresult)){
		$lcck  = "";
		// desidiendo si marca o no el registro.
		if($row["allow"] == 1){
			$lcck = "checked";
		}
		
		echo '<tr>';
		echo '<td class="saytextd"  width="40px">'  . $row["cuid"] .'</td>';
		echo '<td class="saytextd"  width="70px">'  . $row["cmenuid"] .'</td>';
		echo '<td class="saytextd"  width="250px">' . $row["cdesc"]   .'</td>';
		echo '<td class="saytextd"  width="40px"><input type="checkbox" id="allow" '. $lcck . ' name="allow"></td>';
		//echo '<td class="saytextd"  width="50px"> <input type="button" value="Editar" onclick = "edit_permiso('. $row["cuid"].',this)"> </td>';
	
	//<input type="checkbox" id="allow"  name="allow">Actualizar Existencia</input>
	echo '</tr>';
	}
	echo '</tbody>';
	
}

?>
