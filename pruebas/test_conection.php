<?php
	// incluyendo parametros de coneccion.
	//include("coneccion.php");
	$gUserId  ="root";
	$gPasWord ="";
	$gHostId  ="localhost";
	$oPCia    ="ksisdbc";
	$oPSys    ="systdbc";
	echo "Iniciando Verificacion de datos<br>";

	$oConn = mysqli_connect($gHostId,$gUserId,$gPasWord,"systdbc");

	//if($this->oConn->errno){
	if(!mysqli_connect_errno($oConn)){
		mysqli_set_charset($oConn,"utf8");
	}else{
		echo "Coneccion NO Establecida.";
	}
return ;

	$lcsql = " select * from sysuser ";
	$lcresult = mysqli_query($oConn,$lcsql);
	echo "Lista de usuarios <br>";
	while ($lcrow = mysqli_fetch_assoc($lcresult)){
		echo "Nombre :". $lcrow["cfullname"] . " - Userid:" . $lcrow["cuserid"] . " - clave: " . $lcrow["cpasword"] ."<br>";
	}
	echo "Proceso concluido";
?>