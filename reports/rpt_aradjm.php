<?php
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
	// solo facturas activas por defecto.
    $lcrptname  = "rpt_aradjm";
    $lctitle    = "";

	$lcwhere  = "";
	$llcont   = false;
    $lnNewPag = 45;
    $llfirttime = true;
    $lnveces = 0;
    $lnQty   = 0.00;
    $lnPrice = 0.00;
    $lnCost  = 0.00;

    if(isset($_GET["cadjno"])){
        $lcadjno = mysqli_real_escape_string($oConn,$_GET["cadjno"]); 
    }else{
        $lcadjno = mysqli_real_escape_string($oConn,$_POST["cadjno"]);
    }
	// filtrando cliente.	

	if(!empty($lcadjno)){
		$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " aradjm.cadjno = '". $lcadjno ."' ";
	}
    
	
    // armando filtro final
	if ($lcwhere != ""){
		$lcwhere = " where " . $lcwhere; 
	}else{
        echo "Indique un numero de Requisa";
        return ;
    }
	//--------------------------------------------------------------------------------------------------------
	// C- Obteniendo datos segun sea el caso.
	//--------------------------------------------------------------------------------------------------------
	// detalle de los articulos
    $lcsqlcmd = " select aradjm.*,
                    aradjt.cservno,
                    aradjt.cdesc,
                    aradjt.nqty,
                    aradjt.ncost,
                    aradjt.ncostu,
                    aradjt.ndesc,
                    aradjt.ntax,
                    arcate.cdesc as cdesccateno,
                    arwhse.cdesc as cdescwhseno,
                    arresp.cfullname,
                    aradjt.cuid
                    from aradjm
                    join aradjt on aradjm.cadjno = aradjt.cadjno
                    left outer join arwhse on aradjm.cwhseno = arwhse.cwhseno
                    left outer join arcate on arcate.ccateno = aradjm.ccateno
                    left outer join arresp on arresp.crespno = aradjm.crespno
					$lcwhere ";

                   
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
    // llenando las lineas del reporte.
	while($row = mysqli_fetch_assoc($lcresult)){
		$lnveces = 1 + $lnveces;
        // entrando por primera vez
        if ($llfirttime){
            $llfirttime = false;
            cabecera($ofpdf,true,$row);
        }
		if ($lnveces == $lnNewPag){
            cabecera($ofpdf,true,$row);
			$lnveces = 0;
        }
        // detallando cada linea de articulo.
        $ofpdf->SetFillColor(0,0,0);
        $ofpdf->SetTextColor(0,0,0);
        $ofpdf->cell(20,5, $row["cservno"],0,0,"");   	
    	$ofpdf->MultiCell(90,5, $row["cdesc"],0,"L","");   	
        $ofpdf->cell(110,5, "",0,0,"");   	
        $ofpdf->Cell(20,-5, $row["nqty"],0,0,"R");   	
		$ofpdf->Cell(20,-5, $row["ncost"],0,0,"R");   	
        $ofpdf->Cell(20,-5, round($row["ncost"] * $row["nqty"],2),0,1,"R");   
        $ofpdf->Cell(2,5, "",0,1,"R");   	
        //$ofpdf->Ln();    
        $lnCost  = $lnCost + round($row["ncost"] * $row["nqty"],2);
    }  //while($lcgrp = mysqli_fetch_assoc($lcrestgrp)){r
	// ----------------------------------------------------------------------------------------------------------------
	// Final de Reporte.
	// ----------------------------------------------------------------------------------------------------------------
	$ofpdf->Ln(15);
    $ofpdf->cell(150,5,"Total general ",0,0,"R"); 
    $ofpdf->cell(20,5,$lnCost,"TB",1,"R"); 
    
    // termino el reporte y pone el gran total.
	$ofpdf->output();

//function cabecera($ofpdf,$lladdpage,$pccateno,$pcwhseno,$pcname,$pcrefno,$pmnotas,$pcadjno,$pdtrndate){
function cabecera($ofpdf,$lladdpage,$porow){
    if ($lladdpage){
		$ofpdf->AddPage();	
        $ofpdf->SetFillColor(0,0,0);
        $ofpdf->SetTextColor(0,0,0);
	}
	// c-2 Dibujando el cuerpo de la pagina
	//----------------------------------------------------------
	$ofpdf->setfont("arial","B",12);
    $ofpdf->cell(190,5,$_SESSION["compdesc"],0,1,"C");    					

    $ofpdf->setfont("arial","B",16);
    $ofpdf->SetTextColor(0,0,128);
    $ofpdf->cell(190,5,"REQUISICION",0,1,"L");  					
    
    $ofpdf->Ln();
    $ofpdf->setfont("arial","B",9);
    $ofpdf->SetTextColor(0,0,8);  
    
    $ofpdf->cell(20,5,"Doc No.",0,0,"L");  					
    $ofpdf->cell(90,5,": ".$porow["cadjno"],0,0,"L");  					
    $ofpdf->cell(20,5,"Fecha ",0,0,"L");  					
    $ofpdf->cell(90,5,": ".$porow["dtrndate"],0,1,"L");  					

    $ofpdf->cell(20,5,"Almacen",0,0,"L");  					
    $ofpdf->cell(90,5,": ".$porow["cdescwhseno"],0,0,"L");  					
    $ofpdf->cell(20,5,"Tipo Doc",0,0,"L");  					
    $ofpdf->cell(90,5,": ".$porow["cdesccateno"],0,1,"L");  					

    $ofpdf->cell(20,5,"Referencia",0,0,"L");  					
    $ofpdf->cell(90,5,": ".$porow["crefno"],0,0,"L");  					
    $ofpdf->cell(20,5,"Proveedor",0,0,"L");  					
    $ofpdf->cell(90,5,": ".$porow["cfullname"],0,1,"L");  	

    $ofpdf->cell(20,5,"Asiento No",0,0,"L");  					
    $ofpdf->cell(90,5,": ".$porow["ctrnno"],0,0,"L");  					
    $ofpdf->cell(20,5,"Tipo Cambio",0,0,"L");  					
    $ofpdf->cell(90,5,": ".$porow["ntc"],0,1,"L");  	

    if($porow["mnotas"]!= ""){
        $ofpdf->cell(20,5,"Comentarios",0,1,"L");  	
        $ofpdf->MultiCell(150,5, $porow["mnotas"],0,"L","");  				
    }
    $ofpdf->Ln();
    
  
    $ofpdf->setfont("arial","B",9);
    $ofpdf->SetFillColor(20,40,100);
    $ofpdf->SetTextColor(255,255,255);

    $ofpdf->cell(20,5,"Codigo",0,0,"",true);   					
	$ofpdf->cell(90,5,"Descripcion de producto",0,0,"",true); 
	$ofpdf->cell(20,5,"Cantidad",0,0,"R",true);   	
	$ofpdf->cell(20,5,"Precio",0,0,"R",true);   	
	$ofpdf->cell(20,5,"Monto",0,1,"R",true);   		

}	// function cabecera($ofpdf,$ldstar,$lpname){
// obteniendo el balance inicial del estado de cuenta por rango de fecha.

?>		