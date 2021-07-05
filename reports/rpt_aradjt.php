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
    $lcrptname  = "rpt_aradjt";
    $lctitle    = "";
    $lcsubtitle = "";
	$lcwhere    = " aradjm.cmodule = '1' "; // solo requisas no compras.
	$llcont     = false;
    $lnNewPag   = 58;
    $llfirttime = true;
    $lnveces    = 0;
    $lnQtyRow   = 0;
    $lnCost_det = 0;
    $lnNunRec   = 0;
    $lcgrupid   = "!@#$!@";
    $llpritsub  = false;
    $lopgrup    = mysqli_real_escape_string($oConn,$_POST["cgrupo"]);  
    $lngrpamt   = 0;
    $lctitle    = "";
    $lnCost     = 0;
 
    // ordenamiento del reporte
    $lcorder = mysqli_real_escape_string($oConn,$_POST["corden"]); 
    $lcxsortby = "' '";
    $lcxdescby = "' ' ";
// generando ordenamiento.
    switch ($lcorder) {
        case 'crespno':
    		$lcxsortby = "aradjm.crespno";
			$lcxdescby = "arresp.cfullname";
            $lcsubtitle   = "Agrupado por Proveedor";
	        break;
        case 'ccateno':
    		$lcxsortby = "aradjm.ccateno";
			$lcxdescby = "arcate.cdesc";
	        $lcsubtitle   = "Agrupado por Tipo de Requisa";
	        break;
        case 'cwhseno':
            $lcxsortby = "aradjm.cwhseno";
            $lcxdescby = "arwhse.cdesc";
            $lcsubtitle   = "Agrupado por Bodega";
        break;
        case 'dtrndate':
            $lcxsortby = "aradjm.dtrndate";
            $lcxdescby = "aradjm.dtrndate";
            $lcsubtitle   = "Agrupado por Fecha de Registro";
        break;
        
        default:
            $lcxsortby = "''";
            $lcxdescby  = "''";
        break;
    }
    // Configurando titulo del reporte. 
    $lctitle = "Resumen de Requisas ".$lcsubtitle;

    define('CORDOBA',"C$");
// Area de Filtros

    $lcrespno_1 = mysqli_real_escape_string($oConn,$_POST["crespno_1"]);
	$lcrespno_2 = mysqli_real_escape_string($oConn,$_POST["crespno_2"]);
	if(!empty($lcrespno_1)){
		if($lcrespno_1 == $lcrespno_2 or empty($lcrespno_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " aradjm.crespno = '". $lcrespno_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " aradjm.crespno >= '". $lcrespno_1 ."' and ".
								  " aradjm.crespno <= '". $lcrespno_2 ."' ";
		}
	}
    $lcwhseno_1 = mysqli_real_escape_string($oConn,$_POST["cwhseno_1"]);
	$lcwhseno_2 = mysqli_real_escape_string($oConn,$_POST["cwhseno_2"]);
    if(!empty($lcwhseno_1)){
		if($lcwhseno_1 == $lcwhseno_2 or empty($lcwhseno_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " aradjm.cwhseno = '". $lcwhseno_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " aradjm.cwhseno >= '". $lcwhseno_1 ."' and ".
								  " aradjm.cwhseno <= '". $lcwhseno_2 ."' ";
		}
	}
    $lccateno_1 = mysqli_real_escape_string($oConn,$_POST["ccateno_1"]);
	$lccateno_2 = mysqli_real_escape_string($oConn,$_POST["ccateno_2"]);
	if(!empty($lccateno_1)){
		if($lccateno_1 == $lccateno_2 or empty($lccateno_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " aradjm.ccateno = '". $lccateno_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " aradjm.ccateno >= '". $lccateno_1 ."' and ".
								  " aradjm.ccateno <= '". $lccateno_2 ."' ";
		}
	}
    // fecha de emision de recibo.
	$dtrndate_1 = mysqli_real_escape_string($oConn,$_POST["dtrndate_1"]);
	$dtrndate_2 = mysqli_real_escape_string($oConn,$_POST["dtrndate_2"]);
	if (!empty($_POST["dtrndate_1"])){
		if($dtrndate_1 == $dtrndate_2 or empty($dtrndate_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " aradjm.dtrndate = '". $dtrndate_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " aradjm.dtrndate >= '". $dtrndate_1 ."' and ".
								  " aradjm.dtrndate <= '". $dtrndate_2 ."' ";
		}
 	}
	// referencia manual de factura.
	$crefno = mysqli_real_escape_string($oConn,$_POST["crefno"]);
	if(!empty($crefno)){
		$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " aradjm.crefno = '". $crefno ."' ";
	}
    // armando filtro final
	if ($lcwhere != ""){
		$lcwhere = " where " . $lcwhere; 
	}
	//--------------------------------------------------------------------------------------------------------

// C- Obteniendo datos segun sea el caso.
	//--------------------------------------------------------------------------------------------------------
	// detalle de los articulos
    $lcsqlcmd = " select $lcxsortby as xsortby, 
        aradjm.cadjno as ckey,
        $lcxdescby as xdescby,
        aradjm.*,
        sum(aradjt.nqty * aradjt.ncost) as ntotal,
        arcate.cdesc as cdesccateno,
        arwhse.cdesc as cdescwhseno,
        arresp.cfullname
    from aradjm
    join aradjt on aradjm.cadjno = aradjt.cadjno
    left outer join arwhse on aradjm.cwhseno = arwhse.cwhseno
    left outer join arcate on arcate.ccateno = aradjm.ccateno
    left outer join arresp on arresp.crespno = aradjm.crespno
    $lcwhere group by 1,2 ";

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


    // D- Generando el reporte 
	// ----------------------------------------------------------------------------------------------------------------
	$ofpdf = new PDF();
    $ofpdf->AddPage("L");	
// llenando las lineas del reporte.
	while($row = mysqli_fetch_assoc($lcresult)){
        // contador de registros procesados
        $lnNunRec = 1 + $lnNunRec;
         // entrando por primera vez
        //-------------------------------------------------------------------------------------------------------------
    // controlando las agrupaciones.
        if ($lcgrupid != $row["xsortby"] and !empty($row["xdescby"])){
            $ofpdf->SetTextColor(0,0,128);
            // ------------------------------------------------------------------
            // A)- iniciando con la impresion del total del grupo anterior.
            // ------------------------------------------------------------------
            if ($llpritsub){
                //$lnveces = 1 + $lnveces;
                $ofpdf->cell(210,5,"Total  ".utf8_decode($lcodldesc),0,0,"R"); 
                $ofpdf->cell(20,5,$lngrpamt,"TB",1,"R"); 
                $lngrpamt = 0;
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
        }  //if ($lcgrupid != $row["xsortby"]){
        $lngrpamt  = $lngrpamt + round($row["ntotal"],2);
        
        //-------------------------------------------------------------------------------------------------------------
    // Imprimiendo el cuerpo del reporte
        //-------------------------------------------------------------------------------------------------------------
        // impresion detallada
        $ofpdf->SetFillColor(0,0,0);
        $ofpdf->SetTextColor(0,0,0);

        // Impresion detalle general de requisas sumarizada
        $ofpdf->cell(20,5,$row["cadjno"],0,0,"L");  			
        $ofpdf->cell(20,5,$row["dtrndate"],0,0,"L");  		
        $ofpdf->cell(50,5,$row["cdescwhseno"],0,0,"L");  					
        $ofpdf->cell(50,5,$row["cdesccateno"],0,0,"L");  					
        $ofpdf->cell(50,5,$row["crefno"],0,0,"L");  					
        $ofpdf->cell(20,5,$row["ntc"],0,0,"R");  					
        $ofpdf->cell(20,5,round($row["ntotal"],2),0,1,"R"); 
         //$ofpdf->cell(30,5,round(number_format(round($row["nqty"]*$row["ncost"],2), 2, ',', ' '),2),0,1,"R"); 
        $lnCost  = $lnCost + round($row["ntotal"],2);
    
        // Detalle de articulos los busca. por cada requisa.    
        if ($lopgrup == 1){
            // buscando el detalle de articulos por cada uno
            $lcsqlcmd2 = " select 
                aradjt.cservno,
                aradjt.cdesc,
                aradjt.nqty,
                (aradjt.nqty * aradjt.ncost) as ntotal,
                aradjt.ncost,
                aradjt.ncostu,
                aradjt.ndesc,
                aradjt.ntax
            from aradjt
            where cadjno = '". $row["cadjno"] ."' ";
            // obteniendo datos de la consulta de detalle.
            $lcresult2 = mysqli_query($oConn,$lcsqlcmd2);
            // si la consulta devuelve algo valido
            if (gettype($lcresult2)=="object"){
                // si la consulta tiene registros
                if ($lcresult2->num_rows > 0){
                    // dibujando el encabezado de los detalles de existir algun detalle
                    $lnCost_det = 0;
                    $ofpdf->Ln();
                    $ofpdf->setfont("arial","B",9);
                    $ofpdf->SetFillColor(20,40,100);
                    $ofpdf->SetTextColor(255,255,255);

                    $ofpdf->cell(30);   					
                    $ofpdf->cell(20,5,"Codigo",0,0,"",true);   					
                    $ofpdf->cell(90,5,"Descripcion de producto",0,0,"",true); 
                    $ofpdf->cell(20,5,"Cantidad",0,0,"R",true);   	
                    $ofpdf->cell(20,5,"Precio",0,0,"R",true);   	
                    $ofpdf->cell(20,5,"Monto",0,1,"R",true);   		
                    // cargando los detalles de la consulta
                    while($row_det = mysqli_fetch_assoc($lcresult2)){
                        $ofpdf->SetFillColor(0,0,0);
                        $ofpdf->SetTextColor(0,0,0);
                        $ofpdf->cell(30);   					
                        $ofpdf->cell(20,5, $row_det["cservno"],0,0,"");   	
                        $ofpdf->cell(90,5, $row_det["cdesc"],0,0,"");   	
                        //$ofpdf->MultiCell(90,5, $row_det["cdesc"],0,"L","");   	
                        //$ofpdf->cell(110,5, "",0,0,"");   	
                        $ofpdf->Cell(20,5, $row_det["nqty"],0,0,"R");   	
                        $ofpdf->Cell(20,5, $row_det["ncost"],0,0,"R");   	
                        $ofpdf->Cell(20,5, round($row_det["ntotal"],2),0,1,"R");   
                        $lnCost_det  = $lnCost_det + round($row_det["ntotal"],2);
                    }
                    $ofpdf->Ln();
                }    // if ($lcresult2->num_rows > 0){
            }
        }//if ($lopgrup == 1){
        // finalizando el total del grupo 
        if (($lnNunRec == $lnQtyRow) and !empty($row["xdescby"])) {
            $ofpdf->SetTextColor(0,0,128);
            //$ofpdf->cell(($lopgrup == 1)?150:210,5,"Total  ".utf8_decode($lcodldesc),0,0,"R"); 
            $ofpdf->cell(210,5,"Total  ".utf8_decode($lcodldesc),0,0,"R"); 
            $ofpdf->cell(20,5,$lngrpamt,"TB",1,"R"); 
            $lngrpamt = 0;
            $ofpdf->SetTextColor(0,0,0);
        }

    }  //while($lcgrp = mysqli_fetch_assoc($lcrestgrp)){r
	
    
    
    // ----------------------------------------------------------------------------------------------------------------
// Final de Reporte.
	// ----------------------------------------------------------------------------------------------------------------
	$ofpdf->Ln(15);
    $ofpdf->cell(210,5,"Total general ",0,0,"R"); 
    $ofpdf->cell(20,5,$lnCost,"TB",1,"R"); 
    // termino el reporte y pone el gran total.
	$ofpdf->output();

?>		