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
		}
		$lcselect = $lcselect . '</select>';
		$lctableheader = $lctableheader . '</tr></table>';
		
		// -----------------------------------------------------------------------------------------------------------------------------------
		// Obteniendo datos del sistema.
		// -----------------------------------------------------------------------------------------------------------------------------------
		// $lctabledetail = getMenuDetail();

		$oConn1 = vc_funciones::get_coneccion("CIA");		
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
// esta funcion devuelve una estructura array con los datos de la estructura del menu.

?>