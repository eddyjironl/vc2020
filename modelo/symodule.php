<?php
/*
----------------------------------------------------------------------------------
INFORMACION GENERAL.
---------------------
hecho: Eddy Jiron guillen
fecha: 22/07/2020 9:40 am

DESCRIPCION.
---------------------
Este programa engloba las funciones propias del sistema de administracion.
----------------------------------------------------------------------------------
*/
//include("coneccion.php");
include("../modelo/vc_funciones.php");
//--------------------------------------------------------------------------------------------------------------
if (vc_funciones::Star_session() == 1){
	return;
}
// VERFICANDO PARAMETRO
if (!isset($_POST["program"])){
	return ;
}
// estableciendo coneccion.
$oConn = vc_funciones::get_coneccion("SYS");
// --------------------------------------------------------------------------------------------------------------
// MENUS DE VISUAL CONTROL WEB 
// hecho por Eddy Jiron 4/enero/2022 
// --------------------------------------------------------------------------------------------------------------
// funcion de mostrar pantalla de menu al precionar el boton de menu en la vista
if($_POST["program"]== "get_menu_list"){

	$pcmenu   = $_POST["menu"];
	$pcShowIn = $_POST["window"];
	$lcmodule = "";
	// definiendo las variables.
	$oConn     = vc_funciones::get_coneccion("SYS");		
	$lcsqlcmd  = "select * from ksschgrd where calias= '$pcmenu' ";
	$lcresult  = mysqli_query($oConn,$lcsqlcmd);
	$oFormMenu = "";
	$lcTitle   = "";
	$lcBtQuit  = "";
	//configuracion del boton de salida del menu
	$lcid        = "bt_menu_salir2";
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
		$lcselect = '<select class="listas" id="mx_opc_order2">';
		// creando encabezado de la tabla.
		$lctableheader = '<table class="menu_encabezado"> <tr>';
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
				$lctableheader = $lctableheader . '<th width="'.$oHtml["ncolwidth"].'"> '. $oHtml["cheader"] .'</th>';		
			}
			$lcmodule = $oHtml["cmodule"];
		}
		$lcselect = $lcselect . '</select>';
		$lctableheader = $lctableheader . '</tr></table>';
		
		// -----------------------------------------------------------------------------------------------------------------------------------
		// Obteniendo datos del sistema.
		// -----------------------------------------------------------------------------------------------------------------------------------
		// $lctabledetail = getMenuDetail();
		if ($lcmodule == "SY"){
			$oConn1 = vc_funciones::get_coneccion("SYS");		
		}else{
			$oConn1 = vc_funciones::get_coneccion("CIA");		
		}
		$lctabledetail = '<table class="menu_detalles" id="menu_detalles">';
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
			$lctabledetail = $lctabledetail . "</table>";

		}else{
			$lctabledetail = " <br><br><strong> Tabla ". $lcTitle . " <br> Se Encuentra Vacia </strong>";
		}
		// pintando la pantalla
	
      echo'	<div class="menu_area_bloqueo" id="menu_area_bloqueo"> ';
      echo'	<div class="form_menu"> ';
      echo'		<div class="menu_barra" id="mx_barra_sencilla"> ';
      echo'			<strong id="mx_titulo">'. $lcTitle.'</strong> ';
      echo'			<br> ';
      echo'			<label class="labelnormal">Ordenado por </label> ';
      echo 		    $lcselect;
      echo'			<br>				 ';
      echo'            <label class="labelnormal">Buscar</label> ';
      echo'			<input type="text" id="mx_cbuscar2" name="mx_cbuscar2" class="textnormal"> ';
      echo'		</div> ';
      echo'        <br> ';
      echo'        <div> ';
      echo 		   $lctableheader ;
      echo'		</div> ';
      echo'		<div class="menu_area_detalles"> ';
      echo 			$lctabledetail;
      echo'		</div> ';
      echo'        <div class="contenedor_objetos">     ';
      echo            $lcbt;
      echo'        </div> ';
      echo'	</div> ';
      echo' </div> ';
	
		
	}else{
		echo "Menu no configurado";
	}
}
// funcion que refresca el detalle del menu al seleccionar orden o filtro.
if($_POST["program"]=="get_mx_detalle"){
	// el where no siempre viene incluido
	$oConn1 = vc_funciones::get_coneccion("CIA");		
	$lctabledetail = '<table class="menu_detalles">';
	$tabla   = $_POST["tabla"];
	$lcwhere = "";
	// ordenamiento del reporte siempre debe estar lleno.	
	$lcorder = " order by ". $_POST["orden"];
	// sentencia sql filtrada.
	if (!empty($_POST["filtro"])){
		$lcwhere  = " where ". $_POST["orden"]. " like '%". $_POST["filtro"] ."%' ";
	}
	$lcsql   = " select * from ". $tabla . $lcwhere . $lcorder;
	
	$lcresult = mysqli_query($oConn1,$lcsql);
	
	// numero de registros a presentar en la tabla de detalles.
	// -------------------------------------------------------------------------------------------------------
	$oConn = vc_funciones::get_coneccion("SYS");		
	$lcsqlcmd = "select * from ksschgrd where calias= '$tabla' ";
	$lcresult2 = mysqli_query($oConn,$lcsqlcmd);
	$lnVeces   = 0;
	if ($lcresult2->num_rows > 0){
		while($oHtml = mysqli_fetch_assoc($lcresult2)){
			if ($lnVeces > 0){
				$afields[]=$oHtml["mcolvalue"];
				$afieldsLength[]=$oHtml["ncolwidth"];
			}
			$lnVeces += 1; 
		}
	}
	// -------------------------------------------------------------------------------------------------------

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
	// refrescando los resultaqdos.
	echo $lctabledetail;
}
// --------------------------------------------------------------------------------------------------------------
// Verificando si un usuario tiene derecho de acceso o no.
if ($_POST["program"]== "permiso_de_acceso"){
	$lcmenuid = $_POST["cmenuid"];
	$lcuserid = $_SESSION["cuserid"];
	$lcCompId = $_SESSION["ccompid"];
	// buscando informacion del usuario actual
	$lcsql_1  = " select * from sysuser where cuserid = '$lcuserid' ";

	$otabla   = mysqli_query($oConn,$lcsql_1);
	$opersona = mysqli_fetch_assoc($otabla); 
	// grupo al que pertenece este usuario.
	$lcgrpid  = $opersona["cgrpid"]; 
	// buscando informacion de los permisos de esa persona.
	$lcsql_2  = " select allow from syperm 
				  where cgrpid = '$lcgrpid'  and
					    ccompid = '$lcCompId' and 
						cmenuid = '$lcmenuid' ";
	
	$otabla   = mysqli_query($oConn,$lcsql_2);

	if ($otabla->num_rows > 0){
		$opermiso = mysqli_fetch_assoc($otabla); 
		echo $opermiso["allow"];
	}else{
		echo false;
	}
	
}
if ($_POST["program"]== "entry_cia_work"){
	$lccompid = $_POST["ccompid"];
	// ubicando datos de la compañia
	$lcsql  = "select * from syscomp where ccompid = '$lccompid' ";
	$otabla = mysqli_query($oConn,$lcsql);
	// si algo viene mal no deja actualizar la session y no ejecutara nada.
	if (mysqli_num_rows($otabla) == 0){
		$oCia = '{"compdesc":""}';
		echo $oCia; 
	}else{
		$oCia = mysqli_fetch_assoc($otabla); 
		// actualizando la session de datos.
		$_SESSION["ccompid"]  = $oCia["ccompid"];
		$_SESSION["compdesc"] = $oCia["compdesc"];
		// Parametros de coneccion a la base de datos.
		$_SESSION["cuser"]  = $oCia["cuser"];
		$_SESSION["ckeyid"] = $oCia["ckeyid"];
		$_SESSION["dbname"] = $oCia["dbname"];
		$_SESSION["chost"]  = $oCia["chost"];
		echo json_encode($oCia); 
	}

}
// Funcion que devuelve los menus del sistema en el escritorio.
if($_POST["program"]== "get_module_menu"){
	$lcmodule = $_POST["cmodule"];
	// obteniendo los detalles del SYMENH
	$lcsqlcmd   = " select cmenhid, cdesc from symenh where cmodule = '". $lcmodule ."' and cstatus = 'OP' ";
	$lcres_menh = mysqli_query($oConn,$lcsqlcmd);
	if($lcres_menh->num_rows > 0){
		// recorriendo cada item del encabezado para motar el header
		echo '<ul id="menu"> ';
		while($row_header = mysqli_fetch_assoc($lcres_menh)){
			$lcmenhid = $row_header["cmenhid"];
			echo '<li><a>'. $row_header["cdesc"] .'</a>';
			// leyendo los detalles de cada header
			$lcsql = " select cmenuid, cdesc,cview from symenu where cmenhid = '". $lcmenhid  ."' and cstatus = 'OP' ";
			$lcres_menu = mysqli_query($oConn,$lcsql);
			if($lcres_menu->num_rows > 0){
				echo '<ul>';
				while($row_menu = mysqli_fetch_assoc($lcres_menu)){
					// echo '<li><a id="'. $row_menu["cmenuid"] .'" onclick="ckviewallow("'. $row_menu['cmenuid'] .'","'. $row_menu['cview'] .'")">'. $row_menu['cdesc'] .'</a></li>';
					//echo '<li><a id="'. $row_menu["cmenuid"] .'" onclick="ckviewallow('. $row_menu['cmenuid'] .','. $row_menu['cview'] .')">'. $row_menu['cdesc'] .'</a></li>';
					echo '<li><a id="'. $row_menu["cmenuid"] .'" >'. $row_menu['cdesc'] .'</a></li>';
				}
				echo "</ul>";	
			}		
			// cerrando linea del header correspondiente.
			echo '</li>';
		}
		echo '</ul>';
	}else{
		echo "Encabezados no definidos para este modulo";
	}
}
// obteniendo todos los IDS de los menus registrados y poniendo sus pantallas a la escucha.
if($_POST["program"]== "get_menu_id"){
	$lcmenu   = [];
	$lcmodule = $_POST["cmodule"];
	$lcsqlcmd = "select symenu.cmenuid , symenu.cview from symenu 
	             left outer join symenh on symenh.cmenhid = symenu.cmenhid 
				 where symenu.cstatus = 'OP' and symenh.cmodule = '". $lcmodule ."' ";
	$lcresult = mysqli_query($oConn,$lcsqlcmd);

	for($i=0;$i < $lcresult->num_rows; $i++){
		$lcmenu[$i] = mysqli_fetch_assoc($lcresult);
	}
	echo json_encode($lcmenu); 
}
?>