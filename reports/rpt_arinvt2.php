<?php
	// ------------------------------------------------------------------------------------------------------------------	
	// A)- Coneccion a la base de datos.
	// ------------------------------------------------------------------------------------------------------------------	
	include("../modelo/vc_funciones.php");
	include("../modelo/pdf.php");
	vc_funciones::Star_session();
	//session_start();
	// creando la coneccion.
	$oConn = vc_funciones::get_coneccion("CIA");
	// ------------------------------------------------------------------------------------------------------------------	
	// B- Recibiendo parametros de filtros.
	// ------------------------------------------------------------------------------------------------------------------	
	// solo facturas activas por defecto.

	$lcrptname  = "rpt_arinvt2";
	$lctitle    = "Resumen de Ventas (Articulos)";
	
	$lcwhere   = " arinvc.cstatus = 'OP' and arinvc.lvoid = 0 ";
	$lcXsortBy = "";
	$lcDescBy  = "";
	$lcDescOrderby = "";

	// Orden de el reporte.
	switch ($_POST["corden"]){

        case "''":
			$lcXsortBy = "''";
			$lcDescBy  = "''";
			$lcDescOrderby = "";
			break;
		case "ccustno":
			$lcXsortBy = "arinvc.ccustno";
			$lcDescBy  = "arcust.cname";
			$lcDescOrderby = "Cliente: ";
			break;
		case "cpaycode":
			$lcXsortBy = "arinvc.cpaycode";
			$lcDescBy  = "artcas.cdesc ";
			$lcDescOrderby = "Condicion: ";
			break;
		case "dstar":
			$lcXsortBy = "arinvc.dstar";
			$lcDescBy  = "arinvc.dstar";
			$lcDescOrderby = "Fecha: ";
			break;
		case "cwhseno":
			$lcXsortBy = "arinvc.cwhseno";
			$lcDescBy  = "arwhse.cdesc";
			$lcDescOrderby = "Bodega: ";
			break;
		case "crespno":
			$lcXsortBy = "arinvc.crespno";
			$lcDescBy  = "arresp.cfullname";
			$lcDescOrderby = "Vendedor: ";
			break;
		case "crefno":
			$lcXsortBy = "arinvc.crefno";
			$lcDescBy  = "arinvc.crefno";
			$lcDescOrderby = "Referencia Manual: ";
			break;

    }
//--------------------------------------------------------------------------------------------------------
    // filtrando cliente.	
	$lccustno_1 = mysqli_real_escape_string($oConn,$_POST["ccustno_1"]);
	$lccustno_2 = mysqli_real_escape_string($oConn,$_POST["ccustno_2"]);
	if(!empty($lccustno_1)){
		if($lccustno_1 == $lccustno_2 or empty($lccustno_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arcust.ccustno = '". $lccustno_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arcust.ccustno >= '". $lccustno_1 ."' and ".
								  " arcust.ccustno <= '". $lccustno_2 ."' ";
		}
	}

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
	
	$cwhseno_1 = mysqli_real_escape_string($oConn,$_POST["cwhseno_1"]);
	$cwhseno_2 = mysqli_real_escape_string($oConn,$_POST["cwhseno_2"]);
	if(!empty($cwhseno_1)){
		if($cwhseno_1 == $cwhseno_2 or empty($cwhseno_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.cwhseno = '". $cwhseno_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.cwhseno >= '". $cwhseno_1 ."' and ".
								  " arinvc.cwhseno <= '". $cwhseno_2 ."' ";
		}
	}
	
	$crespno_1 = mysqli_real_escape_string($oConn,$_POST["crespno_1"]);
	$crespno_2 = mysqli_real_escape_string($oConn,$_POST["crespno_2"]);
	if(!empty($crespno_1)){
		if($crespno_1 == $crespno_2 or empty($crespno_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.crespno = '". $crespno_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.crespno >= '". $crespno_1 ."' and ".
								  " arinvc.crespno <= '". $crespno_2 ."' ";
		}
	}
	
	// fecha de emision de factura.
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
//--------------------------------------------------------------------------------------------------------
	// armando filtro final
	//--------------------------------------------------------------------------------------------------------
	if ($lcwhere != ""){
		$lcwhere = " where " . $lcwhere;
	}
	$lcwhere_g = "";
	
	// A) Obteniendo agrupacion principal y por cada una generando el dato.
	$lcsqlcmd  = " select  $lcXsortBy as xsortby,
                    $lcDescBy as xdescby,
                    arinvt.cservno,
                    arinvt.cdesc,	
                    arinvt.nprice,
                    arinvt.ndesc,
                    sum(nqty) as nqty,
                    sum(nqty * nprice) as ntotal
                from arinvc 
                join arinvt on arinvc.cinvno = arinvt.cinvno
                left outer join arcust on arcust.ccustno  = arinvc.ccustno
                left outer join artcas on artcas.cpaycode = arinvc.cpaycode
                left outer join arresp on arresp.crespno  = arinvc.crespno 
                left outer join arwhse on arwhse.cwhseno  = arinvc.cwhseno
                $lcwhere  group BY 1,3 order by 1,7 desc ";			
    
    // B) sumarizando venta total
    $lcvtaneta = " select sum(nqty * nprice) as ntotal_final
                    from arinvc 
                    join arinvt on arinvc.cinvno = arinvt.cinvno
                    left outer join arcust on arcust.ccustno  = arinvc.ccustno
                    left outer join artcas on artcas.cpaycode = arinvc.cpaycode
                    left outer join arresp on arresp.crespno  = arinvc.crespno 
                    left outer join arwhse on arwhse.cwhseno  = arinvc.cwhseno
                    $lcwhere ";			


    $lcrestgrp = mysqli_query($oConn,$lcsqlcmd);	

    if (!$lcrestgrp){
        echo NOT_DATA_RPT;
        return ;
    }
    if ($lcrestgrp->num_rows == 0){
        echo NOT_DATA_RPT;
        return ;
    }

    $lnvtatot = mysqli_fetch_assoc(mysqli_query($oConn,$lcvtaneta));


	// determinando si hay datos o no en la consulta.
	// ----------------------------------------------------------------------------------------------------------------
	// INGRESANDO LA PAGINA
	// ----------------------------------------------------------------------------------------------------------------
	$ofpdf = new PDF();
	// cabecera($ofpdf);
	$ofpdf->AddPage();
    $xsortby_1 = "";
    $lnveces = 0;
	// ----------------------------------------------------------------------------------------------------------------
	// B) Generrando el reporte
	// ----------------------------------------------------------------------------------------------------------------

	while($row = mysqli_fetch_assoc($lcrestgrp)){
        $lnveces += 1;
        if ($xsortby_1 != $row["xsortby"]){
            if ($lnveces > 1){
                $ofpdf->Cell(150,5, "",0,1,""); 
            }
            $xsortby_1 = $row["xsortby"];
            $ofpdf->Cell(150,5, $row["xdescby"],0,1,"");   	    
        }
        $lntotalVenta = round((($row["ntotal"]/ $lnvtatot["ntotal_final"])*100),4);
        $ofpdf->Cell(20,5, $row["cservno"],0,0,"");   	
        $ofpdf->cell(100,5, $row["cdesc"],0,0,"");   	
        $ofpdf->cell(20,5, $row["nqty"],0,0,"R");   	
        $ofpdf->cell(20,5, $row["ntotal"],0,0,"R");   
        $ofpdf->cell(20,5,$lntotalVenta ,0,1,"R");   
	}	//while($lcgrp = mysqli_fetch_assoc($lcrestgrp)){

	// ----------------------------------------------------------------------------------------------------------------
	// Final de Reporte.
	// ----------------------------------------------------------------------------------------------------------------
	// termina el reporte y pone el total adecuado de ese reporte
	$ofpdf->output();

?>		