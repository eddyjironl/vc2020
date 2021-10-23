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
// B)- Variables y Parametos recibidos
    $lcrptname  = "rpt_arinvt1";
    $lctitle    = "Resumen de Utilidades y Costos ";
    $lcsubtitle = "";
	$lcwhere    = " arinvc.cstatus = 'OP' and arinvc.lvoid = 0 "; // solo requisas no compras.
    $llfirttime = true;
    $llpritsub  = false;
    $lnQtyRow   = 0;
    $lnNunRec   = 0;
    $lnCost     = 0;
    $lntCost    = 0;
    $lntprice   = 0;
    $lngrpamt   = 0;
    $lngrpamt_cost = 0;
    $lngrpamt_mub  = 0;
    $lcgrupid   = "!@#$!@";
    $lopgrup    = mysqli_real_escape_string($oConn,$_POST["cgrupo"]);  
 
    // ordenamiento del reporte
    $lcorder = mysqli_real_escape_string($oConn,$_POST["corden"]); 
    $lcxsortby = "' '";
    $lcxdescby = "' ' ";
// C)- generando ordenamiento.
    switch ($lcorder) {
        case 'cinvno':
    		$lcxsortby  = "arinvc.cinvno";
			$lcxdescby  = "arinvc.cinvno";
            $lcsubtitle = "Agrupado por Factura";
	    break;
        case 'crespno':
            $lcxsortby  = "arinvc.crespno";
            $lcxdescby  = "arresp.cfullname";
            $lcsubtitle = "Agrupado por Vendedor";
        break;
        case 'dstar':
    		$lcxsortby  = "arinvc.dstar";
			$lcxdescby  = "arinvc.dstar";
	        $lcsubtitle = "Agrupado por Fecha de Emicion";
	    break;
        case 'cwhseno':
            $lcxsortby  = "arinvc.cwhseno";
            $lcxdescby  = "arwhse.cdesc";
            $lcsubtitle = "Agrupado por Bodega";
        break;
        case 'cpaycode':
            $lcxsortby  = "arinvc.cpaycode";
            $lcxdescby  = "artcas.cdesc ";
            $lcsubtitle = "Agrupado por condiciones";
        break;
        
        default:
            $lcxsortby = "''";
            $lcxdescby  = "''";
        break;
    }
    // Configurando titulo del reporte. 
    $lctitle = $lctitle.$lcsubtitle;

// D)- Area de Filtros

    $lcrespno_1 = mysqli_real_escape_string($oConn,$_POST["crespno_1"]);
	$lcrespno_2 = mysqli_real_escape_string($oConn,$_POST["crespno_2"]);
	if(!empty($lcrespno_1)){
		if($lcrespno_1 == $lcrespno_2 or empty($lcrespno_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.crespno = '". $lcrespno_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.crespno >= '". $lcrespno_1 ."' and ".
								  " arinvc.crespno <= '". $lcrespno_2 ."' ";
		}
	}
    $lcwhseno_1 = mysqli_real_escape_string($oConn,$_POST["cwhseno_1"]);
	$lcwhseno_2 = mysqli_real_escape_string($oConn,$_POST["cwhseno_2"]);
    if(!empty($lcwhseno_1)){
		if($lcwhseno_1 == $lcwhseno_2 or empty($lcwhseno_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.cwhseno = '". $lcwhseno_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.cwhseno >= '". $lcwhseno_1 ."' and ".
								  " arinvc.cwhseno <= '". $lcwhseno_2 ."' ";
		}
	}
    // cliente
    $lccustno_1 = mysqli_real_escape_string($oConn,$_POST["ccustno_1"]);
	$lccustno_2 = mysqli_real_escape_string($oConn,$_POST["ccustno_2"]);
    if(!empty($lccustno_1)){
		if($lccustno_1 == $lccustno_2 or empty($lccustno_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.ccustno = '". $lccustno_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.ccustno >= '". $lccustno_1 ."' and ".
								  " arinvc.ccustno <= '". $lccustno_2 ."' ";
		}
	}
    // condicioens de pago 
    $lcpaycode_1 = mysqli_real_escape_string($oConn,$_POST["cpaycode_1"]);
	$lcpaycode_2 = mysqli_real_escape_string($oConn,$_POST["cpaycode_2"]);
    if(!empty($lcpaycode_1)){
		if($lcpaycode_1 == $lcpaycode_2 or empty($lcpaycode_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.cpaycode = '". $lcpaycode_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.cpaycode >= '". $lcpaycode_1 ."' and ".
								  " arinvc.cpaycode <= '". $lcpaycode_2 ."' ";
		}
	}
     // factura.
    $lcinvno_1 = mysqli_real_escape_string($oConn,$_POST["cinvno_1"]);
    $lcinvno_2 = mysqli_real_escape_string($oConn,$_POST["cinvno_2"]);
    if(!empty($lcinvno_1)){
         if($lcinvno_1 == $lcinvno_2 or empty($lcinvno_2)) {
             $lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.cinvno = '". $lcinvno_1 ."' ";
        }else{
            $lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.cinvno >= '". $lcinvno_1 ."' and ".
                               " arinvc.cinvno <= '". $lcinvno_2 ."' ";
        }
    }
    // servicio.
    $lcservno_1 = mysqli_real_escape_string($oConn,$_POST["cservno_1"]);
    $lcservno_2 = mysqli_real_escape_string($oConn,$_POST["cservno_2"]);
    if(!empty($lcservno_1)){
        if($lcservno_1 == $lcservno_2 or empty($lcservno_2)) {
            $lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvt.cservno = '". $lcservno_1 ."' ";
        }else{
            $lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvt.cservno >= '". $lcservno_1 ."' and ".
                            " arinvt.cservno <= '". $lcservno_2 ."' ";
        }
    }
    // fecha de emision de recibo.
	$dstar_1 = mysqli_real_escape_string($oConn,$_POST["dstar_1"]);
	$dstar_2 = mysqli_real_escape_string($oConn,$_POST["dstar_2"]);
	if (!empty($_POST["dstar_1"])){
		if($dstar_1 == $dstar_2 or empty($dstar_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.dstar = '". $dstar_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.dstar >= '". $dstar_1 ."' and ".
								  " arinvc.dstar <= '". $dstar_2 ."' ";
		}
 	}
	// referencia manual de factura.
	$crefno = mysqli_real_escape_string($oConn,$_POST["crefno"]);
	if(!empty($crefno)){
		$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.crefno = '". $crefno ."' ";
	}
    // armando filtro final
	if ($lcwhere != ""){
		$lcwhere = " where " . $lcwhere; 
	}
	//--------------------------------------------------------------------------------------------------------

// E)- Obteniendo datos segun sea el caso.
	//--------------------------------------------------------------------------------------------------------
	// detalle de los articulos
    $lcsqlcmd = " select $lcxsortby as xsortby, 
        arinvc.cinvno as ckey,
        $lcxdescby as xdescby,
        arinvc.*,arinvt.cservno, arinvt.cdesc as cdescitem,
        arinvt.nqty, arinvt.nprice, arinvt.ncost, arinvt.ndesc,
        arinvt.nqty * arinvt.ncost  as ntcost,
        arinvt.nqty * arinvt.nprice as ntprice,
        arwhse.cdesc as cdescwhseno,
        arresp.cfullname
    from arinvc
    join arinvt on arinvc.cinvno = arinvt.cinvno
    left outer join arwhse on arinvc.cwhseno = arwhse.cwhseno
    left outer join arresp on arresp.crespno = arinvc.crespno
    left outer join artcas on artcas.cpaycode = arinvc.cpaycode
    $lcwhere order by 1,2 ";

    $lcresult = mysqli_query($oConn,$lcsqlcmd);	
    // numero de registros que tiene el conjunto de datos
    if (gettype($lcresult) == "object"){
        $lnQtyRow = $lcresult->num_rows;
    }
    // determinando si hay datos o no en la consulta.
	if (mysqli_num_rows($lcresult)== 0){
		echo "<h1>No hay datos para este reporte.</h1>";
		return;
	}
	// ----------------------------------------------------------------------------------------------------------------


// D)- Generando el reporte 
	// ----------------------------------------------------------------------------------------------------------------
	$ofpdf = new PDF();
    $ofpdf->AddPage("L","Letter");	
    // llenando las lineas del reporte.
	while($row = mysqli_fetch_assoc($lcresult)){
        // contador de registros procesados
        $lnNunRec = 1 + $lnNunRec;
        // entrando por primera vez
        //-------------------------------------------------------------------------------------------------------------
        // controlando las agrupaciones.
        if ($lcgrupid != $row["xsortby"] and !empty($row["xdescby"]) and $lopgrup == 1 ){
            $ofpdf->SetTextColor(0,0,128);
            // ------------------------------------------------------------------
            // A)- iniciando con la impresion del total del grupo anterior.
            // ------------------------------------------------------------------
            if ($llpritsub){
                //$lnveces = 1 + $lnveces;
                $ofpdf->cell(195,5,"Totales  ".utf8_decode($lcodldesc),0,0,"R"); 
                $ofpdf->cell(20,5,$lngrpamt,"TB",0,"R"); 
                $ofpdf->cell(20,5,$lngrpamt_cost,"TB",0,"R"); 
                $ofpdf->cell(20,5,$lngrpamt_mub,"TB",1,"R"); 
                $lngrpamt = 0;
                $lngrpamt_cost = 0;
                $lngrpamt_mub  = 0;
            }
            // pasando la primera vez puedce imprimirse en la segunda vuelta.
            // ------------------------------------------------------------------
            // Poniendo Titulo.
            // ------------------------------------------------------------------
            $lcDescGrp = "GRUPO :".utf8_decode($row["xdescby"]);
            $ofpdf->cell(190,5,$lcDescGrp,0,1,"L");  					
            // configurando las variables necesarias
            $lcgrupid  = $row["xsortby"];
            $llpritsub = true;
            $lcodldesc = $row["xdescby"];    
        } 
        // si el cliente solicita un resumen

        if ($lcgrupid != $row["xsortby"] and !empty($row["xdescby"]) and $lopgrup == 2 ){
            $ofpdf->SetTextColor(0,0,128);
            if ($llpritsub){
                $lcDescGrp = "GRUPO :".utf8_decode($lcodldesc);
                $ofpdf->cell(195,5,$lcDescGrp,0,0,"L");  					
                $ofpdf->cell(20,5,$lngrpamt,"0",0,"R"); 
                $ofpdf->cell(20,5,$lngrpamt_cost,"0",0,"R"); 
                $ofpdf->cell(20,5,$lngrpamt_mub,"0",1,"R"); 
                $lngrpamt = 0;
                $lngrpamt_cost = 0;
                $lngrpamt_mub  = 0;
            }    
            $lcgrupid  = $row["xsortby"];
            $llpritsub = true;
            $lcodldesc = $row["xdescby"];    
        }  //if ($lcgrupid != $row["xsortby"]){

        $lngrpamt      = $lngrpamt + round($row["ntprice"],2);
        $lngrpamt_cost = $lngrpamt_cost + round($row["ntcost"],2);
        $lngrpamt_mub  = $lngrpamt_mub + round($row["ntprice"]-$row["ntcost"],2);
        
        //-------------------------------------------------------------------------------------------------------------
        // Imprimiendo el cuerpo del reporte
        //-------------------------------------------------------------------------------------------------------------
        // impresion detallada
        if ($lopgrup == 1){
            $ofpdf->SetFillColor(0,0,0);
            $ofpdf->SetTextColor(0,0,0);
            $ofpdf->setfont("arial","",9);
            // Impresion detalle general de requisas sumarizada
            $ofpdf->cell(20,5, $row["cinvno"],0,0,"L");  			
            $ofpdf->cell(20,5, $row["crefno"],0,0,"L");  		
            $ofpdf->cell(20,5, $row["cservno"],0,0,"L");  					
            $ofpdf->cell(75,5,$row["cdescitem"],0,0,"L");  					
            $ofpdf->cell(20,5, $row["nqty"],0,0,"R");  					
            $ofpdf->cell(20,5,round($row["nprice"],2),0,0,"R");  					
            $ofpdf->cell(20,5,round($row["ncost"],2),0,0,"R");  					
            $ofpdf->cell(20,5,round($row["ntprice"],2),0,0,"R");  					
            $ofpdf->cell(20,5,round($row["ntcost"],2),0,0,"R");  					
            $ofpdf->cell(20,5,round($row["ntprice"] - $row["ntcost"],2),0,1,"R");  	
            // totales del reporte.
        }
        // totalizando el gran total de reporte.
        $lntCost  = $lntCost  + round($row["ntcost"],2);
        $lntprice = $lntprice + round($row["ntprice"],2);
        $lnCost   = $lnCost   + round($row["ntprice"] - $row["ntcost"],2);

        // finalizando el total del grupo 
        if (($lnNunRec == $lnQtyRow) and !empty($row["xdescby"]) and $lopgrup == 1) {
            $ofpdf->SetTextColor(0,0,128);
            $ofpdf->cell(195,5,"Totales  ".utf8_decode($lcodldesc),0,0,"R"); 
            $ofpdf->cell(20,5,$lngrpamt,"TB",0,"R"); 
            $ofpdf->cell(20,5,$lngrpamt_cost,"TB",0,"R"); 
            $ofpdf->cell(20,5,$lngrpamt_mub,"TB",1,"R"); 
            $lngrpamt = 0;
            $lngrpamt_cost = 0;
            $lngrpamt_mub  = 0;
            $ofpdf->SetTextColor(0,0,0);
        }
        if(($lnNunRec == $lnQtyRow) and !empty($row["xdescby"]) and $lopgrup == 2){
            $lcDescGrp = "GRUPO :".utf8_decode($lcodldesc);
            $ofpdf->cell(195,5,$lcDescGrp,0,0,"L");  					
            $ofpdf->cell(20,5,$lngrpamt,"0",0,"R"); 
            $ofpdf->cell(20,5,$lngrpamt_cost,"0",0,"R"); 
            $ofpdf->cell(20,5,$lngrpamt_mub,"0",1,"R"); 
            $lngrpamt = 0;
            $lngrpamt_cost = 0;
            $lngrpamt_mub  = 0;
        }
    }  //while($lcgrp = mysqli_fetch_assoc($lcrestgrp)){r
    // ----------------------------------------------------------------------------------------------------------------
// Final de Reporte.
	// ----------------------------------------------------------------------------------------------------------------
	$ofpdf->Ln(15);
    $ofpdf->cell(195,5,"Totales generales ",0,0,"R"); 
    $ofpdf->cell(20,5,$lntprice,"TB",0,"R"); 
    $ofpdf->cell(20,5,$lntCost,"TB",0,"R"); 
    $ofpdf->cell(20,5,$lnCost,"TB",0,"R"); 
    // termino el reporte y pone el gran total.
	$ofpdf->output();

?>		