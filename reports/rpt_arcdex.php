<?php

    // ------------------------------------------------------------------------------------------------------------------	
// DESCRIPCION: <RPT_ARADJT>
    // Este escript genera un reporte detallado de las requisas permitiendo salir varias requisas en la misma hoja.
    // ------------------------------------------------------------------------------------------------------------------	

    // ------------------------------------------------------------------------------------------------------------------	
// A)- Coneccion a la base de datos.
	// ------------------------------------------------------------------------------------------------------------------	
	include("../modelo/vc_funciones.php");
	include("../modelo/pdf.php");
	vc_funciones::Star_session();
	// creando la coneccion.
	$oConn = vc_funciones::get_coneccion("CIA");
	// ------------------------------------------------------------------------------------------------------------------	
	// B- Recibiendo parametros de filtros.
	// ------------------------------------------------------------------------------------------------------------------	
// Variables y Parametos recibidos
    $lcrptname   = "rpt_arcdex";
    $lctitle     = "Analisis de Kardex";
	$lcwhere_inv = " arserm.lupdateonhand = 1 and arinvc.lvoid = 0"; // solo facturas
	$lcwhere_adj = " arserm.lupdateonhand = 1 AND aradjm.lvoid = 0 "; // solo ajustes.
    $lnentrada   = 0;
    $lnsalidas   = 0;
    $lcdesc      = "ASDFASD9855";
// Area de Filtros
    // articulo
    $lcservno_1 = mysqli_real_escape_string($oConn,$_POST["cservno_1"]);
	if(!empty($lcservno_1)){
		$lcwhere_adj = $lcwhere_adj . (empty($lcwhere_adj)?"":" and ") . " aradjt.cservno = '". $lcservno_1 ."' ";
		$lcwhere_inv = $lcwhere_inv . (empty($lcwhere_inv)?"":" and ") . " arinvt.cservno = '". $lcservno_1 ."' ";
    
    }    

    $lcwhseno_1 = mysqli_real_escape_string($oConn,$_POST["cwhseno_1"]);
	$lcwhseno_2 = mysqli_real_escape_string($oConn,$_POST["cwhseno_2"]);
    if(!empty($lcwhseno_1)){
		if($lcwhseno_1 == $lcwhseno_2 or empty($lcwhseno_2)) {
            $lcwhere_adj = $lcwhere_adj . (empty($lcwhere_adj)?"":" and ") . " aradjm.cwhseno = '". $lcwhseno_1 ."' ";
            $lcwhere_inv = $lcwhere_inv . (empty($lcwhere_inv)?"":" and ") . " arinvc.cwhseno = '". $lcwhseno_1 ."' ";
    	}else{
            $lcwhere_inv = $lcwhere_inv . (empty($lcwhere_inv)?"":" and ") . " arinvc.cwhseno >= '". $lcwhseno_1 ."' and ".
								  " arinvc.cwhseno <= '". $lcwhseno_2 ."' ";
            $lcwhere_adj = $lcwhere_adj . (empty($lcwhere_adj)?"":" and ") . " aradjm.cwhseno >= '". $lcwhseno_1 ."' and ".
								  " aradjm.cwhseno <= '". $lcwhseno_2 ."' ";
		}
	}
    
    // fecha de emision de recibo.
	$dtrndate_1 = mysqli_real_escape_string($oConn,$_POST["dtrndate_1"]);
	$dtrndate_2 = mysqli_real_escape_string($oConn,$_POST["dtrndate_2"]);
	if (!empty($_POST["dtrndate_1"])){
		if($dtrndate_1 == $dtrndate_2 or empty($dtrndate_2)) {
			$lcwhere_inv = $lcwhere_inv . (empty($lcwhere_inv)?"":" and ") . " arinvc.dstar = '". $dtrndate_1 ."' ";
			$lcwhere_adj = $lcwhere_adj . (empty($lcwhere_adj)?"":" and ") . " aradjm.dtrndate = '". $dtrndate_1 ."' ";
		}else{
			$lcwhere_inv = $lcwhere_inv . (empty($lcwhere_inv)?"":" and ") . " arinvc.dstar >= '". $dtrndate_1 ."' and ".
								  " arinvc.dstar <= '". $dtrndate_2 ."' ";
            $lcwhere_adj = $lcwhere_adj . (empty($lcwhere_adj)?"":" and ") . " aradjm.dtrndate >= '". $dtrndate_1 ."' and ".
								  " aradjm.dtrndate <= '". $dtrndate_2 ."' ";
		}
 	}
	
    // armando filtro final
	if ($lcwhere_adj != ""){
		$lcwhere_adj = " where " . $lcwhere_adj; 
		$lcwhere_inv = " where " . $lcwhere_inv; 
	}
	//--------------------------------------------------------------------------------------------------------

// C- Obteniendo datos segun sea el caso.
	//--------------------------------------------------------------------------------------------------------
	// detalle de los articulos

    $lcsqlcmd = ' SELECT Aradjm.cwhseno,
                "Invent " AS ctype,
                Aradjm.dtrndate,
                Aradjm.crefno,
                Aradjt.cadjno as ctrnno,
                Aradjt.cservno,
                arserm.cdesc,
                if(Aradjt.nqty < 0, Aradjt.nqty ,00000000.00) as nqty_s,
                if(Aradjt.nqty > 0, (Aradjt.nqty),00000000.00) as nqty_e,
                (aradjt.nqty) as nqty,
                aradjm.ccateno as ctyptran,
                arcate.cdesc as cdesctran,
                Aradjt.ncost AS nprice,
                Aradjt.cuid
            FROM aradjm
            left outer join aradjt on aradjm.cadjno  = aradjt.cadjno
            left outer join arserm on arserm.cservno = aradjt.cservno
            left outer join arcate on arcate.ccateno = aradjm.ccateno AND arcate.ctypecate = "A"
            '. $lcwhere_adj .'
            union all 
            SELECT arinvc.cwhseno,
                    "Factura" as ctype,
                    arinvc.dstar as dtrndate,
                    arinvc.crefno,
                    arinvt.cinvno as ctrnno,
                    arinvt.cservno,
                    arserm.cdesc,
                    if((arinvt.nqty * -1) < 0, (arinvt.nqty * -1),00000000.00) as nqty_s,
                    if((arinvt.nqty * -1) > 0, (arinvt.nqty * -1),00000000.00) as nqty_e,
                    (arinvt.nqty * -1) as nqty,
                    arinvc.cpaycode as ctyptran ,
                    artcas.cdesc as cdesctran,
                    arinvt.nprice,
                    arinvt.cuid
            FROM  arinvc 
            LEFT OUTER JOIN arinvt on arinvc.cinvno = arinvt.cinvno
            LEFT OUTER JOIN arserm on arserm.cservno = arinvt.cservno
            left outer join artcas on artcas.cpaycode = arinvc.cpaycode'.
            $lcwhere_inv . ' ORDER BY 6,3';


    $lcresult = mysqli_query($oConn,$lcsqlcmd);	
    // determinando si hay datos o no en la consulta.
	if (mysqli_num_rows($lcresult)== 0){
		echo "<h1>No hay datos para este reporte.</h1>";
		return;
	}
	// ----------------------------------------------------------------------------------------------------------------


    // D- Generando el reporte 
	// ----------------------------------------------------------------------------------------------------------------
	$ofpdf = new PDF();
    $ofpdf->AddPage("p");	
// llenando las lineas del reporte.
	while($row = mysqli_fetch_assoc($lcresult)){
        //-------------------------------------------------------------------------------------------------------------
        // Imprimiendo el cuerpo del reporte
        //-------------------------------------------------------------------------------------------------------------
        // impresion detallada
        $ofpdf->SetFillColor(0,0,0);
        $ofpdf->SetTextColor(0,0,0);

        // grupo o articulo
        if ($lcdesc <> $row["cservno"] ){
            $ofpdf->ln(2);

            $ofpdf->SetTextColor(20,40,100);
		    $ofpdf->cell(150,5,$row["cservno"] ." - " .$row["cdesc"],0,1,"L");  		
            $ofpdf->SetTextColor(0,0,0);
            $lcdesc = $row["cservno"];
            $lnentrada   = 0;
            $lnsalidas   = 0;
      
        }


        // Impresion detalle general de requisas sumarizada
        $ofpdf->cell(20,5,$row["cwhseno"],0,0,"L");  			
        $ofpdf->cell(20,5,$row["ctype"],0,0,"L");  		
        $ofpdf->cell(20,5,$row["dtrndate"],0,0,"L");  					
        $ofpdf->cell(20,5,$row["ctrnno"],0,0,"L");  					
        $ofpdf->cell(50,5,$row["cdesctran"],0,0,"L");  					
        $ofpdf->cell(20,5,$row["nqty_e"],0,0,"R");  					
        $ofpdf->cell(20,5,$row["nqty_s"],0,0,"R");  					
        
        $lnentrada += $row["nqty_e"];
        $lnsalidas += $row["nqty_s"];
        
        $ofpdf->cell(20,5,round($lnentrada + $lnsalidas,2),0,1,"R"); 
    }  //while($lcgrp = mysqli_fetch_assoc($lcrestgrp)){r
	
    
    
    // ----------------------------------------------------------------------------------------------------------------
// Final de Reporte.
	// ----------------------------------------------------------------------------------------------------------------
	$ofpdf->output();

?>		