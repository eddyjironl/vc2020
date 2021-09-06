<?php

// ------------------------------------------------------------------------------------------------
include("../modelo/vc_funciones.php");
include("../modelo/armodule.php");
$oConn = vc_funciones::get_coneccion("CIA");
$lcOpcion = $_POST["accion"];
$fileData = $_FILES['fileContacts']; 
$fileData = file_get_contents($fileData['tmp_name']); 
//$lopcaction   = file_get_contents($fileData['coption']);
$fileData = explode("\n", $fileData);
$fileData = array_filter($fileData); 

// preparar contactos (convertirlos en array)
foreach ($fileData as $xdata) 
{
	$datatList[] = explode(",", $xdata);
}

// insertar contactos
foreach ($datatList as $ydata) 
{
	if($lcOpcion == "htserv"){
		$llCont = true; // CkDobleReg($ydata[0],$oConn);

		if($llCont){
			$lcRow = "INSERT INTO arserm(cservno,cdesc,ncost,ntax,nprice,cstatus,
		    	                           citemtype,lallowneg,lupdateonhand)
					  VALUES ('{$ydata[0]}','{$ydata[1]}', {$ydata[2]},{$ydata[3]},{$ydata[4]},'{$ydata[5]}',
			        	      '{$ydata[6]}',{$ydata[7]}, {$ydata[8]} )";
			$oConn->query($lcRow); 
		}
	}
	
}

function CkDobleReg($pcserno,$poConn){
	$lcsql = "select cservno from arserm where cservno = '{$pcserno}'";
	$lcresult = $poConn->query($lcsql);
	$lnData = $lcresult->num_rows;
	return !($lnData >0);
}

?>