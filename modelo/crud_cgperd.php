<?php
// ------------------------------------------------------------------------------------------------
// Descripcion.
// 	Definiendo funciones que se realizaran .
//	$lcaccion = isset($_POST["accion"])? $_POST["accion"],$_GET["accion"];
// ------------------------------------------------------------------------------------------------

include("../modelo/vc_funciones.php");
vc_funciones::Star_session();
$oConn = vc_funciones::get_coneccion("CIA");


if(isset($_POST["accion"])){
	$lcaccion = $_POST["accion"]; 	
}else{
	$lcaccion = $_GET["accion"]; 	
}

if (isset($_POST["cyear"])){
	$lcyear = mysqli_real_escape_string($oConn,$_POST["cyear"]);
}
$lnRowsAfect = 0;

// ------------------------------------------------------------------------------------------------
// INSERT / UPDATE, guardando datos existentes o nuevos.
// -----------------------------------------------------------------------------------------------
if($lcaccion=="NEW"){
	// haciendo la coneccion.
	//$oConn = get_coneccion("CIA");
	if (isset($_POST["cyear"])){
		$lcyear  = mysqli_real_escape_string($oConn,$_POST["cyear"]);
        $lnperid = intval($_POST["nperid"]);
        $ldStar  = strtotime($_POST["dtrndate"]);
		// verificando que el codigo exista o no 
		$lcsql   = " select cyear from cgperd where cyear ='$lcyear' ";
		$lresult = mysqli_query($oConn,$lcsql);	
		$lnCount = mysqli_num_rows($lresult);
		if ($lnCount == 0){
            // procesando los periodos.
            for ($i=1; $i <= $lnperid; $i++) { 

                //$ldEnd  = GOMONTH(ldStar,1)-1;
                $lcano  = date("Y",$ldStar);
                $lmonth = date("m",$ldStar);
                $lcmont = date("M",$ldStar);
                $lndays = date("t",$ldStar);
                $ldEnd  = "$lcano-$lmonth-$lndays";
                
                // Determinando el año en que cae el mes
                //$lcYearMont = ALLTRIM(STR(YEAR(ldEnd)));
                // determinando el inicio del periodo
                $numero  = ($i <=9) ? '0' : '';
                $lcperid = $lcyear. "-" .$numero . strval($i);
                $ld1     = date('Y-m-d',$ldStar);

                $lcsqlcmd = "insert into cgperd(cperid,cdesc,cyear,dstarper,dendper)
                                         VALUES('$lcperid', 'Año Fiscal $lcyear Mes $lcmont - $lcano',
                                                '$lcyear', '$ld1','$ldEnd')";
               
                // guardando la informacion segun cada periodo
                mysqli_query($oConn,$lcsqlcmd);
                // recalculando la fecha de inicio
                //$ldStar = $ldEnd + 1;
                $ldStar = strtotime($ldEnd ."+ 1 days");
            }
            echo "Periodos Creados";
            return;
		}else{
			// el codigo existe lo que hace es actualizarlo.	
			echo "El periodo contable a definir ya existe";
            return;
		}
	}  
	//header("location:../view/cgperd.php");		
}  		//if($lcaccion=="NEW")
// ------------------------------------------------------------------------------------------------
// JSON, - Informacion detallada de un solo registro.
// ------------------------------------------------------------------------------------------------
?>
