<?php
	// ------------------------------------------------------------------------------------------------------------------	
	// A)- Coneccion a la base de datos.
	// ------------------------------------------------------------------------------------------------------------------	
	include("../modelo/coneccion.php");
	include("../modelo/vc_funciones.php");
	include("../modelo/pdf.php");
	vc_funciones::Star_session();
	$oConn = get_coneccion("CIA");
	// ------------------------------------------------------------------------------------------------------------------	
	// B- Recibiendo parametros de filtros.
	// ------------------------------------------------------------------------------------------------------------------	
	// solo facturas activas por defecto.
	$lcwhere       = " arinvc.lvoid = 0 ";
	$lcXsortBy     = "";
	$lcDescBy      = "";
	$lcDescOrderby = "";
	$lctype_stado  = $_POST["cformato"];
	$llcont        = false;
	// filtrando cliente.	
	$lccustno_1 = mysqli_real_escape_string($oConn,$_POST["ccustno_1"]);
	if(!empty($lccustno_1)){
		$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.ccustno = '". $lccustno_1 ."' ";
	}
	if($lctype_stado == "rango"){
		// por formato de rango solo ejecuta los objetos rango	
		$dtrndate_1 = mysqli_real_escape_string($oConn,$_POST["dstar_1"]);
		$dtrndate_2 = mysqli_real_escape_string($oConn,$_POST["dstar_2"]);
		if (!empty($_POST["dstar_1"])){
			if($dtrndate_1 == $dtrndate_2 or empty($dtrndate_2)) {
				// filtrando los registros de factura segun la fecha.					  
				$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.dstar = '". $dtrndate_1 ."' ";
			}else{
				// filtrando los registros de factura segun la fecha.					  
				$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " (arinvc.dstar >= '". $dtrndate_1 ."' and ".
									  " arinvc.dstar <= '". $dtrndate_2 ."' )";
			}
		}
	}else{
		$dtrndate_3 = mysqli_real_escape_string($oConn,$_POST["dstar_3"]);
		// por formato fecha al corte solo los objetos de ese tipo.
		if (!empty($_POST["dstar_3"])){
				$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arinvc.dstar <= '". $dtrndate_3 ."' ";
			}
	}

	// armando filtro final
	if ($lcwhere != ""){
		$lcwhere = " where " . $lcwhere;
	}
	//--------------------------------------------------------------------------------------------------------
	// C- Obteniendo datos segun sea el caso.
	//--------------------------------------------------------------------------------------------------------
	// Cursor del total de facturas que integran el rango de fechas o fecha de corte.
	$lcsqlcmd = " select arinvc.ccustno, 
					arcust.cname,
					arcust.ctel,
					arinvc.cinvno,  
					arinvc.crefno,
					arinvc.dstar, 
					arinvc.dend,
					datediff(arinvc.dend,now()) as nmora,
					0000000000.00 as nbalance ,
					0000000000.00 as npayamt ,
					(arinvc.nsalesamt + arinvc.ntaxamt - arinvc.ndesamt ) AS nsaldo
					from arinvc 
					left outer join arcust on arcust.ccustno  = arinvc.ccustno 
					left outer join arresp on arresp.crespno  = arcust.crespno 
					left outer join artcas on artcas.cpaycode = arinvc.cpaycode 
					$lcwhere ";
	
	$lcgrp_g = mysqli_query($oConn,$lcsqlcmd);	
	$lcinf_c = mysqli_query($oConn,$lcsqlcmd);	
	// determinando si hay datos o no en la consulta.
	if (mysqli_num_rows($lcgrp_g)== 0){
		echo "<h1>No hay datos para este reporte.</h1>";
		return;
	}
	// ----------------------------------------------------------------------------------------------------------------
	// D- Generando el reporte 
	// ----------------------------------------------------------------------------------------------------------------
	$ofpdf = new PDF();
	// colores 
	$ofpdf->SetFillColor(0,255,255);
	$llfirstime = true;
	$lcpdate_1 = ($lctype_stado == "rango")?$dtrndate_1:$dtrndate_3;
	$lcpdate_2 = ($lctype_stado == "rango")?$dtrndate_2:"";
	$lncargo   = 0;
	$lncredito = 0;
	$lnsaldo   = 0;
	$lnpagado  = 0;
	// c-2 Dibujando el cuerpo de la pagina
	$lnveces   = 0;
	$lnNewPag  = 45;
	// total de ventas general de todo el reporte
	$lnsalesgeneral = 0;
	// poniendo la cabecera.
	$nombre = mysqli_fetch_assoc($lcinf_c);
	
	// armando encabezado del reporte.
	cabecera($ofpdf,$nombre["cname"],$nombre["ctel"],$lcpdate_1,$lcpdate_2,$lctype_stado,$llfirstime);
	// poniendo el saldo inicial.
	if($lctype_stado == "rango"){
		get_balance_inicial($lccustno_1,$dtrndate_1,$oConn,$ofpdf,$lncargo,$lncredito);
	}

	while($row = mysqli_fetch_assoc($lcgrp_g)){
		
		
		$lnveces = 1 + $lnveces;
		if ($lnveces == $lnNewPag){
			cabecera($ofpdf,$row["cname"],$row["ctel"],$lcpdate_1,$lcpdate_2,$lctype_stado,true);
			$lnveces = 0;
		}

		// a)- Obteniendo los pagos totales de cada factura.
		if ($lctype_stado == "rango"){
			// armando estado con rango de fechas.

			$lcsql  = " SELECT arcash.cinvno, arcasm.ccashno,
						arcasm.crefno,
						arcasm.cdesc,
						arcasm.dtrndate,
						arcash.namount AS npayamt 
						FROM arcasm  
						join arcash on arcasm.ccashno = arcash.ccashno
						WHERE arcasm.cstatus  = 'OP' AND
						      (arcasm.dtrndate >= '". $dtrndate_1 ."'  and arcasm.dtrndate <= '". $dtrndate_2 ."' ) and
						       arcash.cinvno = " . $row["cinvno"] . " GROUP BY 4 ";
						
			// oteniendo los resultados.			
			$lcresult = mysqli_query($oConn,$lcsql);
			$llcont   = mysqli_num_rows($lcresult) <> 0;		
			
		}else{
			// armando estado al corte.
			$lnpagado = 0;
			$lcsql  = " SELECT arcash.cinvno,
						SUM(arcash.namount) AS npayamt 
						FROM arcasm  
						join arcash on arcasm.ccashno = arcash.ccashno
						WHERE arcasm.dtrndate <= '". $dtrndate_3 ."' and
						arcasm.cstatus  = 'OP' AND
						arcash.cinvno = " . $row["cinvno"] . " GROUP BY 1";
		
			// obteniendo cursor de pagos.			
			$lcpays = mysqli_query($oConn,$lcsql);				
			if (mysqli_num_rows($lcpays)<> 0){
				$lcurpago = mysqli_fetch_assoc($lcpays);
				$lnpagado = $lcurpago{"npayamt"};
			}
		}
		// cargando datos informacion de la factura 
		// poniendo de color azul la letra de la factura para que se distinga
		$ofpdf->SetTextColor(0,0,128);
		$ofpdf->cell(10,8, "Fact",0,0,"");   	
		$ofpdf->cell(20,8, $row["cinvno"],0,0,"");   	
		$ofpdf->cell(20,8, $row["crefno"],0,0,"");   	
		$ofpdf->Cell(20,8, $row["dstar"],0,0,"");   	
		$ofpdf->Cell(20,8, $row["dend"],0,0,"");   	
		$ofpdf->Cell(20,8, $row["nmora"],0,0,"C");   	
		$ofpdf->Cell(25,8, $row["nsaldo"],0,0,"R");   	
		$ofpdf->Cell(25,8, ($lnpagado == 0)?"":$lnpagado,0,0,"R");   	
		$ofpdf->cell(25,8, $row["nsaldo"] - $lnpagado,0,1,"R");   
		// cargando los totales del reporte a nivel general 
		$lncargo   = $lncargo + $row["nsaldo"];
		$lncredito = $lncredito + $lnpagado;
		$lnsaldo   = $lnsaldo + $row["nsaldo"] - $lnpagado;
		$ofpdf->SetTextColor(0,0,0);
		
		// armando el detalle de los pagos para esa linea de factura.
		if ($llcont){
			$lnpayamt_2 = 0;
			$lnsaldo_l  = 0;
			while ($lnrow_2 = mysqli_fetch_assoc($lcresult)){
				// generando detalle de pago
				$ofpdf->cell(10,5, "Rec",0,0,"");   	
				$ofpdf->cell(20,5, $lnrow_2["ccashno"],0,0,"");   	
				$ofpdf->cell(20,5, $lnrow_2["crefno"],0,0,"");   	
				$ofpdf->Cell(20,5, $lnrow_2["dtrndate"],0,0,"");   	
				$ofpdf->Cell(65,5, $lnrow_2["cdesc"],0,0,"");   	
				$ofpdf->Cell(25,5, $lnrow_2["npayamt"],0,0,"R");   	
				$lnpayamt_2 = $lnpayamt_2 + $lnrow_2["npayamt"];
				$lnsaldo_l  = $row["nsaldo"] - $lnpayamt_2;
				$ofpdf->cell(25,5, $lnsaldo_l,0,1,"R");   
				$lncredito  = $lncredito + $lnrow_2["npayamt"] ;
			}  	// while ($lnrow_2 = mysqli_fetch_assoc($lcresult)){
		}		// if ($llcont){
	}			//while($lcgrp = mysqli_fetch_assoc($lcrestgrp)){

	// ----------------------------------------------------------------------------------------------------------------
	// Final de Reporte.
	// ----------------------------------------------------------------------------------------------------------------
	// termino el reporte y pone el gran total.
	$ofpdf->cell(15,5,"",0,1,"");
	$ofpdf->Cell(60,10,"",0,0,"");   	
	$ofpdf->Cell(50,10,"Total General del Reporte","LTB",0,"R",true);   	
	$ofpdf->Cell(25,10,$lncargo,"TB",0,"R",true);   	
	$ofpdf->Cell(25,10,$lncredito ,"TB",0,"R",true);   	
	//$ofpdf->cell(25,10, $lnsaldo ,"TBR",1,"R",true);   
	$ofpdf->cell(25,10, $lncargo - $lncredito ,"TBR",1,"R",true);   
	$ofpdf->output();

function cabecera($ofpdf,$pcname,$pctel,$pcdate1,$pcdate2,$pctype,$lladdpage){
	if ($lladdpage){
		$ofpdf->AddPage();	
		// c-1 Encabezado de la pagina.
		//----------------------------------------------------------
		$ofpdf->encabezado_ec($pcname,$pctel);
	}
	// c-2 Dibujando el cuerpo de la pagina
	//----------------------------------------------------------
	$ofpdf->setfont("arial","B",10);
	// poniendo descripcion del estado financiero segun el caso.
	if ($pctype=="corte"){
		$ofpdf->cell(190,5,"Fecha de Corte al " . $pcdate1,0,1,"C");   					
	}else{
		$ofpdf->cell(200,5,"Del " . $pcdate1 ." al ".$pcdate2 ,0,1,"C");   					
	}
	
	$ofpdf->cell(10,5,"Tipo",1,0,"",true);   					
	$ofpdf->cell(20,5,"Doc Sist #",1,0,"",true);   	// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Ref No",1,0,"",true);   		// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Emision",1,0,"",true);   	// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Vence",1,0,"",true);   		// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(20,5,"Mora",1,0,"C",true);   		// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(25,5,"Cargo",1,0,"R",true);   		// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(25,5,"Credito",1,0,"R",true);   	// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->cell(25,5,"Saldo",1,1,"R",true);   		// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)

	//$ofpdf->cell(15,5,"",0,1,"");   // cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
	$ofpdf->setfont("arial","",10);
}	// function cabecera($ofpdf,$ldstar,$lpname){
// obteniendo el balance inicial del estado de cuenta por rango de fecha.
function get_balance_inicial($pccustno,$pdate,$poConn,$pofpdf,&$plncargo,&$plncredito){

// cursor de facturas.
$lcsql_inv = "select sum(arinvc.nsalesamt + arinvc.ntaxamt - arinvc.ndesamt ) AS nsaldo 
				from arinvc 
				where arinvc.lvoid = 0 and 
	  				  arinvc.ccustno = '$pccustno' and 
      				  arinvc.dstar < '$pdate' ";
      
// cursor de pagos.      
$lcsql_rec = " SELECT sum(arcash.namount) AS npayamt 
				FROM arcasm  
				join arcash on arcasm.ccashno = arcash.ccashno
				WHERE arcasm.dtrndate  < '$pdate' and
					  arcasm.ccustno = '$pccustno' and
					  arcasm.cstatus  = 'OP' ";
					  
// obteniendo el saldo del estado					
$lcresult_inv = mysqli_query($poConn, $lcsql_inv);

$lcrow_inv    = mysqli_fetch_assoc($lcresult_inv);
$lnsaldo      = (is_null($lcrow_inv["nsaldo"]))? 0:$lcrow_inv["nsaldo"];

// obteniendo el monto total pagado a la fecha
$lcresult_rec = mysqli_query($poConn, $lcsql_rec);
$lcrow_rec    = mysqli_fetch_assoc($lcresult_rec);
$lnpayamt     = (is_null($lcrow_rec["npayamt"]))? 0:$lcrow_rec["npayamt"];

// cargando variables global de movimientos.
$plncargo     = $lnsaldo;
$plncredito   = $lnpayamt;

// escribiendo registro.
$pofpdf->cell(50,8, "Inicial",0,0,"");   	
$pofpdf->cell(60,8, "Saldo Inicial para el ".$pdate,0,0,"");   	
$pofpdf->Cell(25,8, $lnsaldo ,0,0,"R");   	
$pofpdf->Cell(25,8, $lnpayamt,0,0,"R");   	
$pofpdf->cell(25,8, $lnsaldo - $lnpayamt,0,1,"R");   

//return 	($lnsaldo - $lnpayamt);
}

?>		