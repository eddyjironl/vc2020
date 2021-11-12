<?php
	include("vc_funciones.php");
	// VALIDACIONES PREVIAS CAMPOS VACIOS 
	if (empty($_POST["cuserid"])){
		// iniciando session
		session_start();
		// cerrando sesion.
		session_destroy();
		header("location:../index.php?opcmsj=2");
		RETURN ;
	}
	if (empty($_POST["cpasword"])){
		// iniciando session
		session_start();
		// cerrando sesion.
		session_destroy();
		header("location:../index.php?opcmsj=3");
		RETURN ;
	}
	if (empty($_POST["ccompid"])){
		// iniciando session
		session_start();
		// cerrando sesion.
		session_destroy();
		header("location:../index.php?opcmsj=4");
		RETURN ;
	}
	$oConn      = vc_funciones::get_coneccion("SYS");
	$lcUserID 	= $_POST["cuserid"];
	$lcPasword 	= $_POST["cpasword"];
	$lcCompid 	= $_POST["ccompid"];
	$lcSqlCmd 	= "select * from sysuser where cstatus ='OP' and cuserid = '" . strtoupper($_POST["cuserid"]). 
				  "' and cpasword = '" . strtoupper($_POST["cpasword"]) ."'";
	$lcResult 	= mysqli_query($oConn,$lcSqlCmd); //$oConn->query($lcSqlCmd);
	$lnRecno 	= mysqli_num_rows($lcResult); //$lcResult->num_rows;
	if($lnRecno == 0){
		// iniciando session
		session_start();
		// cerrando sesion.
		session_destroy();
		header("location:../index.php?opcmsj=1");
	}else{
		session_start();
		$lcLine = mysqli_fetch_assoc($lcResult);
		$_SESSION["cuserid"]   = $_POST["cuserid"];
		$_SESSION["cpasword"]  = $_POST["cpasword"]; 
		$_SESSION["cfullname"] = $lcLine["cfullname"]; 
		$_SESSION["cinvno"]    = "";
		// bodega unica para procesar con este usuario
		$_SESSION["cwhseno"]   = $lcLine["cwhseno"];
		
		// verificando cadena de coneccion para la empresa si esta vacia no entra.
		// ************************************************************************************************
		$lcsqlcia  = " select * from syscomp where ccompid = '" . $_POST["ccompid"] ."' ";
		$lcrescia  = mysqli_query($oConn,$lcsqlcia);
		if(mysqli_num_rows($lcrescia)!= 0 ){
			$lcinfocia = mysqli_fetch_assoc($lcrescia);
			$_SESSION["ccompid"]  = $_POST["ccompid"]; 
			$_SESSION["compdesc"] = $lcinfocia["compdesc"]; 
			$_SESSION["ctel"] 	  = $lcinfocia["ctel"]; 
			$_SESSION["dbname"]   = $lcinfocia["dbname"];
			$_SESSION["chost"]    = $lcinfocia["chost"];
			$_SESSION["ckeyid"]   = $lcinfocia["ckeyid"];
			$_SESSION["cuser"]    = $lcinfocia["cuser"];
			header("location:../view/escritorio.php");	
		}else{
			session_start();
			// cerrando sesion.
			session_destroy();
			header("location:../index.php?opcmsj=5");
		}
	}
	//}	
?>