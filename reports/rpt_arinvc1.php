<?php
	// ------------------------------------------------------------------------------------------------------------------	
	// A)- Coneccion a la base de datos.
	// ------------------------------------------------------------------------------------------------------------------	

		
	include("../modelo/coneccion.php");
	include("../modelo/vc_funciones.php");
	include("../modelo/pdf.php");
	vc_funciones::Star_session();
	$oConn = get_coneccion("CIA");
	
	// filtrando cliente.	
	$lcinvno  = mysqli_real_escape_string($oConn,$_POST["ctrnno1"]);
	//$lcinvno  = "58";
	$lcsqlcmd = " select * from arinvc where cinvno ='" . $lcinvno ."' ";
	$lnInoices = mysqli_num_rows(mysqli_query($oConn,$lcsqlcmd));
	if ($lnInoices == 0){
		echo "<H1>No hay datos que coincidan con estos criterios.</H>";
		return ;
	}
	// ----------------------------------------------------------------------------------------------------------------
	// INGRESANDO LA PAGINA
	// ----------------------------------------------------------------------------------------------------------------
	$ofpdf = new PDF();
	
	// c-1 Encabezado de la pagina.
	//----------------------------------------------------------
	// c-2 Dibujando el cuerpo de la pagina
	$lnVeces  = 0;
	$llFirst  = true;
	$lnNewPag = 32;
	// total de ventas general de todo el reporte
	$lnsalesgeneral = 0;
	$lnefectivo = 0;
	// ----------------------------------------------------------------------------------------------------------------
	// B) Generrando el reporte
	// ----------------------------------------------------------------------------------------------------------------
	$lcsqlcmd2 = " select arinvc.cinvno, 
						arinvc.dstar,
						arinvc.dend,
						arinvc.crefno,
						arinvc.cdesc as cdescname,
						arinvc.mnotas , 
						arinvc.nsalesamt,
						arinvc.ntaxamt,
						arinvc.ndesamt,
						arinvc.nefectivo,
						arcust.cname,
						arcust.ctel, arcust.mdirecc,
						arresp.cfullname,
						artcas.cdesc,
						arinvt.cservno,
						arinvt.cdesc as cdescservno,
						arinvt.nqty,
						arinvt.nprice,
						arinvt.ndesc,
						arinvt.ntax,
						arinvt.mnotas as mnotas1
				from arinvc
				left outer join arinvt on arinvc.cinvno = arinvt.cinvno
				left outer join arcust on arcust.ccustno = arinvc.ccustno
				left outer join arresp on arresp.crespno = arinvc.crespno
				left outer join artcas on artcas.cpaycode = arinvc.cpaycode	
				where arinvc.cinvno = '" . $lcinvno . "' ";
	
	$lcresultinvoice = mysqli_query($oConn,$lcsqlcmd2);


	while($row = mysqli_fetch_assoc($lcresultinvoice)){
		$lnVeces ++;
		if ($lnVeces == $lnNewPag){ 	
			$lnVeces = 1;
			cabecera($ofpdf,$row);
		}
		// primera vez y adiciona el encabezado con todo lo necesario.
		if ($llFirst){
			$llFirst = false;
			cabecera($ofpdf,$row);
		}
		
		$ofpdf->cell(10,5,"",0,0,""); 
		$ofpdf->cell(25,5,$row["cservno"],0,0,"","");  
		$ofpdf->cell(90,5,$row["cdescservno"],0,0,"","");   					
		$ofpdf->cell(25,5,$row["nqty"],0,0,"C","");   					
		$ofpdf->cell(25,5,$row["nprice"],0,1,"C","");	
		$lcmnotas   = $row["mnotas"];
		// cargamdp valores de la factura.
		$lnsalesamt = $row["nsalesamt"];
		$lntaxamt   = $row["ntaxamt"];
		$lndesamt   = $row["ndesamt"];
		$lnefectivo = $row["nefectivo"];
	}	//while($inv_row = mysqli_fetch_assoc($lcrestgrp)){
	
	// ----------------------------------------------------------------------------------------------------------------
	// Final de Reporte.
	// ----------------------------------------------------------------------------------------------------------------
	put_footer($ofpdf,$lnsalesamt,$lntaxamt,$lndesamt,$lnVeces,$lnNewPag,$lcmnotas,$lnefectivo);
	//$ofpdf->output("F","../FACTURA# " . $lcinvno . ".pdf");
	$ofpdf->output();
	
// dibuja el pie de pagina de la factura	
function put_footer(&$pofpdf,$pnsalesamt,$plntaxamt,$plndesamt,$pnveces,$pnpagline,$pcmnotas,$pnefectivo){
	$lnSpaces = $pnpagline - $pnveces;
	for ($i=0; $i <= $lnSpaces; $i++){
		$pofpdf->cell(25,5,"",0,1,"C","");	
	}
	$pofpdf->Ln(2);
	$pofpdf->setfont("arial","B",10);
	$pofpdf->cell(10,0,'',0,0,"");  
	$pofpdf->cell(165,1,'',"T",1,"C");  
	$pofpdf->Ln(0);

	$pofpdf->cell(125,5,'',0,0,"C");  
	$pofpdf->cell(25,5,'Subtotal',0,0,"","true");  
	$pofpdf->setfont("arial","",10);
	$pofpdf->cell(25,5,$pnsalesamt,0,1,"R","true");  

	$pofpdf->setfont("arial","B",10);
	$pofpdf->cell(125,5,'',0,0,"C");  
	$pofpdf->cell(25,5,'Descuento',0,0,"","true");  
	$pofpdf->setfont("arial","",10);

	$pofpdf->cell(25,5,$plndesamt,0,1,"R","true");  
	
	/*$pofpdf->cell(125,5,'',0,0,"C");  
	$pofpdf->cell(25,5,"Descuento",0,0,"","true");  
	$pofpdf->cell(25,5,$plndesamt,0,1,"R","true");  
	*/
	$pofpdf->setfont("arial","B",10);
	$pofpdf->cell(125,5,'',0,0,"C");  
	$pofpdf->cell(25,5,"Impuesto",0,0,"","true");  
	$pofpdf->setfont("arial","",10);
	$pofpdf->cell(25,5,$plntaxamt,0,1,"R","true");  
	
	$lntotal  = $pnsalesamt + $plntaxamt - $plndesamt;
	// -----------------------------------------------------------
	// determinando el cambio
	// -----------------------------------------------------------
	//$lnVuelto = $lntotal - $pnefectivo;
	
	//switch ($pnefectivo){
	switch (true){
		case $pnefectivo == $lntotal:
			$lnVuelto = 0.00;
			break;
		case $pnefectivo > $lntotal:
			$lnVuelto = $pnefectivo - $lntotal;
			break;	
		case $pnefectivo < $lntotal:
			$lnVuelto = 0.00;
			break;	
	}
		
	
	// -----------------------------------------------------------
	
	$pofpdf->setfont("arial","B",10);
	$pofpdf->cell(125,5,'',0,0,"C");  
	$pofpdf->cell(25,5,'Total Neto',0,0,"","true");  
	$pofpdf->setfont("arial","",10);
	$pofpdf->cell(25,5,$lntotal,0,1,"R","true");  
	
	$pofpdf->setfont("arial","B",10);
	$pofpdf->cell(125,5,'',0,0,"C");  
	$pofpdf->cell(25,5,'Efectivo',0,0,"","true");  
	$pofpdf->setfont("arial","",10);
	$pofpdf->cell(25,5,$pnefectivo,0,1,"R","true");  

	$pofpdf->setfont("arial","B",10);
	$pofpdf->cell(125,5,'',0,0,"C");  
	$pofpdf->cell(25,5,'Cambio',0,0,"","true");  
	$pofpdf->setfont("arial","",10);
	$pofpdf->cell(25,5,$lnVuelto,0,1,"R","true");  
	
}

function cabecera(&$pofpdf,$porow){
	$pofpdf->AddPage();
	//----------------------------------------------------------
	// c-1 Encabezado de la pagina.
	//----------------------------------------------------------
	$pofpdf->setfont("arial","B",16);
	$pofpdf->cell(175,10,$_SESSION["compdesc"],0,1,"C");  
	$pofpdf->Ln(5);

	//$pofpdf->setfont("arial","B",16);
	$pofpdf->cell(80,10,"FACTURA No ".$porow["cinvno"],0,0,"L");  

	$pofpdf->setfont("arial","B",10);
	$pofpdf->cell(60,5,"Fecha:",0,0,"R");  
	$pofpdf->setfont("arial","",10);
	$pofpdf->cell(30,5,date("d") . " del " . date("m") . " de " . date("Y"),0,1,"");  
	$pofpdf->setfont("arial","B",10);
	$pofpdf->cell(140,5,"Pagina:",0,0,"R");  
	$pofpdf->setfont("arial","",10);
	$pofpdf->cell(30,5,$pofpdf->PageNo(),0,1,"");  

	$pofpdf->Ln(5);	// c-2 Dibujando el cuerpo de la pagina

	$pofpdf->setfont("arial","B",10);
	$pofpdf->SetFillColor(0,255,255);

	$pofpdf->cell(20,5,"Cliente:","",0,"","");
	$pofpdf->setfont("arial","",10);
	$pofpdf->cell(75,5,($porow["cdescname"] =="")?$porow["cname"]:$porow["cdescname"],"",0,"L","");
	
	$pofpdf->setfont("arial","B",10);
	$pofpdf->cell(40,5,"Vendedor:",0,0,"R","");
	$pofpdf->setfont("arial","",10);
	$pofpdf->cell(75,5,$porow["cfullname"],0,1,"L","");

	$pofpdf->setfont("arial","B",10);
	$pofpdf->cell(20,5,"Direccion:","",0,"","");
	$pofpdf->setfont("arial","",10);
	$pofpdf->cell(75,5, $porow["mdirecc"] ,"",0,"","");

	$pofpdf->setfont("arial","B",10);
	$pofpdf->cell(40,5,"Condicion:",0,0,"R","");
	$pofpdf->setfont("arial","",10);
	$pofpdf->cell(75,5,$porow["cdesc"],0,1,"L","");

	$pofpdf->setfont("arial","B",10);
	$pofpdf->cell(20,5,"Telefono:","",0,"","");
	$pofpdf->setfont("arial","",10);
	$pofpdf->cell(75,5,$porow["ctel"],"",0,"","");

	$pofpdf->setfont("arial","B",10);
	$pofpdf->cell(40,5,"Emitida:",0,0,"R","");
	$pofpdf->setfont("arial","",10);
	$pofpdf->cell(75,5,$porow["dstar"],0,1,"L","");

	$pofpdf->Ln(12);	// c-2 Dibujando el cuerpo de la pagina
	//----------------------------------------------------------
	$pofpdf->setfont("arial","B",10);
	$pofpdf->cell(10,5,"",0,0,""); 
	$pofpdf->cell(25,5,"Codigo",1,0,"","true");  
	$pofpdf->cell(90,5,"Descripcion",1,0,"","true");   					
	$pofpdf->cell(25,5,"Cantidad",1,0,"C","true");   					
	$pofpdf->cell(25,5,"Precio",1,1,"C","true");	
	$pofpdf->Ln(2);	// c-2 Dibujando el cuerpo de la pagina
	

	$pofpdf->setfont("arial","",10);
}	// function cabecera($ofpdf,$ldstar,$lpname){

?>		