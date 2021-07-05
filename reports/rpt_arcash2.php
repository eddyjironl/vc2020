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
    $lcrptname  = "rpt_arcash2";
    $lctitle    = "Vencimiento de Cartera ";
    $lcsubtitle = "";
	$lcwhere    = ""; // solo requisas no compras.
    $llfirttime = true;
    $llpritsub  = false;
    $lnQtyRow   = 0;
    $lnNunRec   = 0;
    $lcgrupid   = "!@#$!@";
    $lopgrup    = mysqli_real_escape_string($oConn,$_POST["cgrupo"]);  
    // totales segun grupo de deuda.
    $lntot_00 = 0;
    $lntot_30 = 0;
    $lntot_60 = 0;
    $lntot_90 = 0;
    $lntot_91 = 0;
    // totales segun el grupo 
    $lngrp_00 = 0;
    $lngrp_30 = 0;
    $lngrp_60 = 0;
    $lngrp_90 = 0;
    $lngrp_91 = 0;

    // ordenamiento del reporte
    $lcorder = mysqli_real_escape_string($oConn,$_POST["corden"]); 
    $lcxsortby = "' '";
    $lcxdescby = "' ' ";
// C)- generando ordenamiento.
    switch ($lcorder) {
        case 'crespno':
            $lcxsortby  = "arinvc.crespno";
            $lcxdescby  = "arresp.cfullname";
            $lcsubtitle = "Agrupado por Vendedor";
        break;
        case 'ccustno':
            $lcxsortby  = "arinvc.ccustno";
            $lcxdescby  = "arcust.cname ";
            $lcsubtitle = "Agrupado por Cliente";
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
        arinvc.*,
        0 as nqty,
        datediff(arinvc.dend,now()) as nmora,
        arwhse.cdesc as cdescwhseno,
        arcust.cname ,
        arresp.cfullname
    from arinvc
    left outer join arcust on arinvc.ccustno = arcust.ccustno
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
                $ofpdf->cell(145,5,"Totales  ".utf8_decode($lcodldesc),0,0,"R"); 
                $ofpdf->cell(20,5,$lngrp_00,"TB",0,"R"); 
                $ofpdf->cell(20,5,$lngrp_30,"TB",0,"R"); 
                $ofpdf->cell(20,5,$lngrp_60,"TB",0,"R"); 
                $ofpdf->cell(20,5,$lngrp_90,"TB",0,"R"); 
                $ofpdf->cell(20,5,$lngrp_91,"TB",1,"R"); 
                $lngrp_00 = 0;
                $lngrp_30 = 0;
                $lngrp_60 = 0;
                $lngrp_90 = 0;
                $lngrp_91 = 0;
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
                $ofpdf->cell(145,5,$lcDescGrp,0,0,"L");  					
                $ofpdf->cell(20,5,$lngrp_00,0,0,"R"); 
                $ofpdf->cell(20,5,$lngrp_30,0,0,"R"); 
                $ofpdf->cell(20,5,$lngrp_60,0,0,"R"); 
                $ofpdf->cell(20,5,$lngrp_90,0,0,"R"); 
                $ofpdf->cell(20,5,$lngrp_91,0,1,"R"); 
                $lngrp_00 = 0;
                $lngrp_30 = 0;
                $lngrp_60 = 0;
                $lngrp_90 = 0;
                $lngrp_91 = 0;
            }    
            $lcgrupid  = $row["xsortby"];
            $llpritsub = true;
            $lcodldesc = $row["xdescby"];    
        }  //if ($lcgrupid != $row["xsortby"]){

        $lnDays = $row["nmora"];
        // 1)- saldo corriente.
        if($lnDays >= 0){
            $lntot_00 = $lntot_00 + $row["nbalance"];
            $lngrp_00 = $lngrp_00 + round($row["nbalance"],2);
        }
        if ($lnDays < 0){$lnDays = $lnDays *-1;}
           // 2)- Saldo de 30 dias
        if($lnDays >=1 and $lnDays <= 30){
            $lntot_30 = $lntot_30 + $row["nbalance"];
            $lngrp_30 = $lngrp_30 + round($row["nbalance"],2);
        }
        // 3)- Saldo de 60 dias
        if($lnDays >= 31 and $lnDays <= 60){
            $lntot_60 = $lntot_60 + $row["nbalance"];
            $lngrp_60 = $lngrp_60 + round($row["nbalance"],2);
        }
        // 4)- Saldo de 90 dias
        if($lnDays >= 61 and $lnDays <= 90){
            $lntot_90 = $lntot_90 + $row["nbalance"];
            $lngrp_90 = $lngrp_90 + round($row["nbalance"],2);
        }
        // 5)- Saldo de +90 dias
        if($lnDays >= 91){
            $lntot_91 = $lntot_91 + $row["nbalance"];
            $lngrp_91 = $lngrp_91 + round($row["nbalance"],2);
        }
        //-------------------------------------------------------------------------------------------------------------
        // Imprimiendo el cuerpo del reporte
        //-------------------------------------------------------------------------------------------------------------
        // impresion detallada
        if ($lopgrup == 1){
            $ofpdf->SetFillColor(0,0,0);
            $ofpdf->SetTextColor(0,0,0);
            $ofpdf->setfont("arial","",9);
            // Impresion detalle general de requisas sumarizada
            $ofpdf->cell(75,5, $row["cname"],0,0,"L");  			
            $ofpdf->cell(20,5, $row["cinvno"],0,0,"L");  		
            $ofpdf->cell(20,5, $row["dend"],0,0,"L");  					
            $ofpdf->cell(10,5,$row["nmora"],0,0,"R");  					
            $ofpdf->cell(20,5, $row["nbalance"],0,0,"R");  	
            
            // decidiendo donde lo pone
            //------------------------------------------------------------------------------------------------------------------
            $lnDays = $row["nmora"];
            // 1)- saldo corriente.
            if($lnDays >= 0){
                $ofpdf->cell(20,5,round($row["nbalance"],2),0,1,"R"); 
            }
            if ($lnDays < 0){$lnDays = $lnDays *-1;}
            // 2)- Saldo de 30 dias
            if($lnDays >=1 and $lnDays <= 30){
                $ofpdf->cell(40,5,round($row["nbalance"],2),0,1,"R"); 
            }
            // 3)- Saldo de 60 dias
            if($lnDays >= 31 and $lnDays <= 60){
                $ofpdf->cell(60,5,round($row["nbalance"],2),0,1,"R"); 
            }
            // 4)- Saldo de 90 dias
            if($lnDays >= 61 and $lnDays <= 90){
                $ofpdf->cell(80,5,round($row["nbalance"],2),0,1,"R"); 
            }
            // 5)- Saldo de +90 dias
            if($lnDays >= 91){
                $ofpdf->cell(100,5,round($row["nbalance"],2),0,1,"R"); 
            }
        } // if ($lopgrup == 1){
     
        // finalizando el total del grupo 
        if(($lnNunRec == $lnQtyRow) and !empty($row["xdescby"]) and $lopgrup == 1){
            $ofpdf->SetTextColor(0,0,128);
            $ofpdf->cell(145,5,"Totales  ".utf8_decode($lcodldesc),0,0,"R"); 
            $ofpdf->cell(20,5,$lngrp_00,"TB",0,"R"); 
            $ofpdf->cell(20,5,$lngrp_30,"TB",0,"R"); 
            $ofpdf->cell(20,5,$lngrp_60,"TB",0,"R"); 
            $ofpdf->cell(20,5,$lngrp_90,"TB",0,"R"); 
            $ofpdf->cell(20,5,$lngrp_91,"TB",1,"R"); 
            $lngrp_00 = 0;
            $lngrp_30 = 0;
            $lngrp_60 = 0;
            $lngrp_90 = 0;
            $lngrp_91 = 0;
            $ofpdf->SetTextColor(0,0,0);
        }
        if(($lnNunRec == $lnQtyRow) and !empty($row["xdescby"]) and $lopgrup == 2){
            $lcDescGrp = "GRUPO :".utf8_decode($lcodldesc);
            $ofpdf->cell(145,5,$lcDescGrp,0,0,"L");  					
            $ofpdf->cell(20,5,$lngrp_00,0,0,"R"); 
            $ofpdf->cell(20,5,$lngrp_30,0,0,"R"); 
            $ofpdf->cell(20,5,$lngrp_60,0,0,"R"); 
            $ofpdf->cell(20,5,$lngrp_90,0,0,"R"); 
            $ofpdf->cell(20,5,$lngrp_91,0,1,"R"); 
            $lngrp_00 = 0;
            $lngrp_30 = 0;
            $lngrp_60 = 0;
            $lngrp_90 = 0;
            $lngrp_91 = 0;
    }
    }  //while($lcgrp = mysqli_fetch_assoc($lcrestgrp)){r
    // ----------------------------------------------------------------------------------------------------------------
// Final de Reporte.
	// ----------------------------------------------------------------------------------------------------------------
	$ofpdf->Ln(10);
    $ofpdf->cell(145,5,"Totales generales ",0,0,"R"); 
    $ofpdf->cell(20,5,$lntot_00,"TB",0,"R"); 
    $ofpdf->cell(20,5,$lntot_30,"TB",0,"R"); 
    $ofpdf->cell(20,5,$lntot_60,"TB",0,"R"); 
    $ofpdf->cell(20,5,$lntot_90,"TB",0,"R"); 
    $ofpdf->cell(20,5,$lntot_91,"TB",0,"R"); 
    // termino el reporte y pone el gran total.
	$ofpdf->output();

?>		