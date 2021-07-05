<?php
	// ------------------------------------------------------------------------------------------------------------------	
	// A)- Coneccion a la base de datos.
	// ------------------------------------------------------------------------------------------------------------------	
	include("../modelo/vc_funciones.php");
	include("../modelo/pdf.php");
    include("../modelo/armodule.php");
    
	vc_funciones::Star_session();
	// creando la coneccion.
	$oConn = vc_funciones::get_coneccion("CIA");
	// ------------------------------------------------------------------------------------------------------------------	
	// B- Recibiendo parametros de filtros.
	// ------------------------------------------------------------------------------------------------------------------	
	// solo facturas activas por defecto.
	$lcrptname  = "rpt_arserm";
	$lctitle    = "LISTADO DE INVENTARIOS";
	$lcwhere  = "";
	$llcont   = false;
    $lnNewPag = 45;
    $lnveces = 0;
    $lnQty   = 0;
    $lnPrice = 0;
    $lnCost  = 0;

	switch ($_POST["corden"]){
		case "cservno":
			$lcOrderby = " order by cservno ";
			break;
		case "cdesc":
			$lcOrderby = " order by cdesc ";
			break;
		case "ctserno":
			$lcOrderby = " order by ctserno ";
			break;
		case "citemtype":
			$lcOrderby = " order by citemtype ";
			break;
	}
	// proveedor de articulo.
	$crespno_1 = mysqli_real_escape_string($oConn,$_POST["crespno_1"]);
	$crespno_2 = mysqli_real_escape_string($oConn,$_POST["crespno_2"]);
	if(!empty($crespno_1)){
		if($crespno_1 == $crespno_2 or empty($crespno_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arserm.crespno = '". $crespno_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arserm.crespno >= '". $crespno_1 ."' and ".
								  " arserm.crespno <= '". $crespno_2 ."' ";
		}
	}
	// tipo de articulo
	$ctserno_1 = mysqli_real_escape_string($oConn,$_POST["ctserno_1"]);
	$ctserno_2 = mysqli_real_escape_string($oConn,$_POST["ctserno_2"]);
	if(!empty($ctserno_1)){
		if($ctserno_1 == $ctserno_2 or empty($ctserno_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arserm.ctserno = '". $ctserno_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arserm.ctserno >= '". $ctserno_1 ."' and ".
								  " arserm.ctserno <= '". $ctserno_2 ."' ";
		}
	}
	// filtrando el tipo de articulo
	$lctserno = mysqli_real_escape_string($oConn,$_POST["citemtype"]);
	if(!empty($lctserno)){
		$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arserm.citemtype = '". $lctserno ."' ";
	}	
	// filtrando el Estado
	$lcstatus = mysqli_real_escape_string($oConn,$_POST["cstatus"]);
	if(!empty($lcstatus)){
		$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arserm.cstatus = '". $lcstatus ."' ";
	}	
	// desidiendo si imprime el costo o no 
	$lprint_cost = isset($_POST["llshowcost"]) ? true:false; 
	// desidiendo si imprime el costo o no 
	$lprint_onhand = isset($_POST["llshowonhand"]) ? true:false; 

    // armando filtro final
	if ($lcwhere != ""){
		$lcwhere = " where " . $lcwhere;
	}
	//--------------------------------------------------------------------------------------------------------
	// C- Obteniendo datos segun sea el caso.
	//--------------------------------------------------------------------------------------------------------
	// detalle de articulos 
	$lcsqlcmd = " select arserm.cservno, 
					arserm.cdesc,
                    arserm.ncost,
                    arserm.nprice
                    from arserm
					$lcwhere $lcOrderby ";
	
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
	$ofpdf->AddPage();
	// armando encabezado del reporte.
	cabecera($ofpdf,true);
    // llenando las lineas del reporte.
	while($row = mysqli_fetch_assoc($lcresult)){
		$lnveces = 1 + $lnveces;
		if ($lnveces == $lnNewPag){
			cabecera($ofpdf,true);
			$lnveces = 0;
        }
        // detallando cada linea de articulo.
        $ofpdf->SetFillColor(0,0,0);
        $ofpdf->SetTextColor(0,0,0);
        $ofpdf->cell(30,5, $row["cservno"],0,0,"");   	
		$ofpdf->cell(100,5, $row["cdesc"],0,0,"");   	

        // Determinando existencia y si la va a imprimir
        if($lprint_onhand){
			$lnQty = get_inventory_onhand($oConn,$row["cservno"],"R");
			$ofpdf->Cell(20,5, $lnQty,0,0,"R");   	
		}else{
			$ofpdf->Cell(20,5, "",0,0,"R");   		
		}

        $ofpdf->Cell(20,5, $row["nprice"],0,0,"R");   	
		if($lprint_cost){
			$ofpdf->Cell(20,5, $row["ncost"],0,1,"R");   	
		}else{
			$ofpdf->Cell(20,5, "",0,1,"R");   		
		}
        $lnPrice = $lnPrice + ($row["nprice"] * $lnQty);
        $lnCost  = $lnCost + ($row["ncost"] * $lnQty);
	}  //while($lcgrp = mysqli_fetch_assoc($lcrestgrp)){r
	// ----------------------------------------------------------------------------------------------------------------
	// Final de Reporte.
	// ----------------------------------------------------------------------------------------------------------------
	$ofpdf->Ln(15);
	if($lprint_onhand){
    	$ofpdf->cell(50,5,"TOTALES GENERALES",0,1,""); 
		if($lprint_cost){
			$ofpdf->cell(50,5,"Total a Precio Costo ",0,0,""); 
			$ofpdf->cell(10,5,$lnCost,0,1,"L"); 
		}
    	$ofpdf->cell(50,5,"Total a Precio Venta ",0,0,""); 
    	$ofpdf->cell(10,5,$lnPrice,0,1,"L"); 
	}
    // termino el reporte y pone el gran total.
	$ofpdf->output();

function cabecera($ofpdf,$lladdpage){
	/*
	if ($lladdpage){
		$ofpdf->AddPage();	
        $ofpdf->SetFillColor(0,0,0);
        $ofpdf->SetTextColor(0,0,0);
	}
	// c-2 Dibujando el cuerpo de la pagina
	//----------------------------------------------------------
	
	$ofpdf->setfont("arial","B",12);
    $ofpdf->cell(190,5,$_SESSION["compdesc"],0,1,"C");    					
    $ofpdf->setfont("arial","B",9);
    $ofpdf->cell(190,5,"LISTADO DE INVENTARIOS",0,1,"C");  					
    $ofpdf->Ln();

    $ofpdf->setfont("arial","",9);
    $ofpdf->SetFillColor(20,40,100);
    $ofpdf->SetTextColor(255,255,255);
    $ofpdf->cell(30,5,"Articulo",0,0,"",true);   					
	$ofpdf->cell(100,5,"Descripcion",0,0,"",true);   	// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Existencia",0,0,"R",true);   		// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Precio",0,0,"R",true);   	// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Costo",0,1,"R",true);   		// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)

	//$ofpdf->cell(15,5,"",0,1,"");   // cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	*/
}	// function cabecera($ofpdf,$ldstar,$lpname){
// obteniendo el balance inicial del estado de cuenta por rango de fecha.

?>		