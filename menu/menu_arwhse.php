<?php

	// incluyendo la clase de coneccion
	//include("../modelo/coneccion.php");
  	// creando la coneccion.
	//$oConn = get_coneccion("CIA");
	include("../modelo/vc_funciones.php");
	session_start();
	// creando la coneccion.
	$oConn = vc_funciones::get_coneccion("CIA");

	if (isset($_POST["cwhseno"])){
 		// Consulta unitaria
		$lcSqlCmd = " select * from arwhse where arwhse.cwhseno ='". $_POST["cwhseno"] ."'";
								
		// obteniendo datos del servidor
		//$lcResult = $oConn->query($lcSqlCmd);
		$lcResult =   mysqli_query($oConn,$lcSqlCmd); // $oConn->query($lcSqlCmd);
		// convirtiendo estos datos en un array asociativo
		$ldata = mysqli_fetch_assoc($lcResult);
		// convirtiendo este array en archivo jason.
		$jsondata =json_encode($ldata,true);
		// retornando objeto json
		echo $jsondata;

	}else{
		// nombre por defecto del objeto.
		$lcname = "cwhseno";
		// nombre del objeto
		if (isset($_POST["cname"])){
			$lcname = $_POST["cname"];
		}
		

		$lcSqlCmd = " select * from arwhse order by cwhseno ";

		$lcResult = $oConn->query($lcSqlCmd);

		echo '<select class="listas" name="'. $lcname .'" id="'. $lcname .'" required>';
		echo '<option value="">Elija un Registro </option>';		
		
		while ($rows = mysqli_fetch_assoc($lcResult)){
			echo "<option value='" . $rows["cwhseno"] ."'>"  . $rows["cdesc"]  . "</option>";
		}
		echo '</select>';
	}
	
	
	
?>