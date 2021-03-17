<?php


if ($_POST["ctrnno1"]){
    $lcinvno = $_POST["ctrnno1"];
}else{return ;}
$lcsqlcmd = "select arinvc.cinvno,
                    arinvc.cdesc as cdesccustno, 
                    arinvc.ccustno, 
                    arcust.cname,
                    arinvc.dstar,
                    arinvc.cpaycode,
                    artcas.cdesc as cdescpay, 
                    arresp.crespno,
                    arresp.cfullname, 
                    arinvt.cservno,
                    arinvt.cdesc as cdescservno,
                    arinvt.nqty,
                    arinvt.nprice,
                    arinvt.ntax,
                    arinvt.ndesc,
                    arinvc.nsalesamt,
                    arinvc.ndesamt,
                    arinvc.ntaxamt,
                    arinvc.nefectivo,
                    arinvc.nbalance
            from arinvc
            left outer join arinvt on arinvc.cinvno = arinvt.cinvno
            left outer join arcust on arcust.ccustno = arinvc.ccustno
            left outer join arresp on arinvc.crespno = arresp.crespno
            left outer join artcas on arinvc.cpaycode = artcas.cpaycode where arinvc.cinvno = '". $lcinvno ."' ";

// CONFIGURACIÓN PREVIA
include("../modelo/vc_funciones.php");
include("../modelo/pdf.php");
$oConn    = vc_funciones::get_coneccion("CIA");
$oArSetup = vc_funciones::arsetup_init();
$lcresult = mysqli_query($oConn,$lcsqlcmd);
$oInvoice = mysqli_fetch_assoc($lcresult);


define('EURO',chr(128));
define('CORDOBA',"C$");
$pdf = new FPDF('P','mm',array(80,150));
//$pdf = new FPDF('P','mm',array(25,50));
$pdf->AddPage();
 
// CABECERA
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(60,4,$_SESSION["compdesc"],0,1,'C');
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(60,4,'Telefono: '.$_SESSION["ctel"],0,1,'C');
 
// DATOS FACTURA        
$pdf->Ln(5);
$pdf->Cell(60,4,'Factura: '.$oInvoice["cinvno"]. " - ".$oInvoice["cdescpay"] ,0,1,'');
$pdf->Cell(60,4,'Fecha: ' .$oInvoice["dstar"] ,0,1,'');
$pdf->Cell(60,4,'Vendedor: '  .$oInvoice["cfullname"],0,1,'');
 
// COLUMNAS
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Cell(30, 10, 'Articulo', 0);
$pdf->Cell(5, 10, 'Ud',0,0,'R');
$pdf->Cell(10, 10, 'Precio',0,0,'R');
$pdf->Cell(15, 10, 'Total',0,0,'R');
$pdf->Ln(8);
$pdf->Cell(60,0,'','T');
$pdf->Ln(0);
$lcresult_d = mysqli_query($oConn,$lcsqlcmd);
// PRODUCTOS
while($row = mysqli_fetch_assoc($lcresult_d)){
    $pdf->SetFont('Helvetica', '', 7);
    $pdf->MultiCell(30,4,$row["cdescservno"],0,'L'); 
    $pdf->Cell(35, -5, $row["nqty"],0,0,'R');
    $pdf->Cell(10, -5, number_format(round($row["nprice"],2), 2, ',', ' ').CORDOBA,0,0,'R');
    $pdf->Cell(15, -5, number_format(round($row["nqty"]*$row["nprice"],2), 2, ',', ' ').CORDOBA,0,0,'R');
    $pdf->Ln(3);
} 
// SUMATORIO DE LOS PRODUCTOS Y EL IVA
$pdf->Ln(6);
$pdf->Cell(60,0,'','T');
$pdf->Ln(2);    
$pdf->Cell(25, 10, 'TOTAL SIN I.V.A.:', 0);    
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(15, 10, number_format(round($oInvoice["nsalesamt"],2), 2, ',', ' ').CORDOBA,0,0,'R');
$pdf->Ln(3);    
$pdf->Cell(25, 10, 'Descuento:', 0);    
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(15, 10, number_format(round($oInvoice["ndesamt"],2), 2, ',', ' ').CORDOBA,0,0,'R');
$pdf->Ln(3);    
$pdf->Cell(25, 10, 'I.V.A.:', 0);    
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(15, 10, number_format(round($oInvoice["ntaxamt"],2), 2, ',', ' ').CORDOBA,0,0,'R');
$pdf->Ln(3);    
$pdf->Cell(25, 10, 'TOTAL:', 0);    
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(15, 10, number_format(round($oInvoice["nsalesamt"]-$oInvoice["ndesamt"]+$oInvoice["ntaxamt"], 2),2, ',', ' ').CORDOBA,0,0,'R');
 
// PIE DE PAGINA
$pdf->Ln(10);
//$lcmsg = ($oArSetup["linvno"]):$oArSetup["linvno"],"";
$pdf->Cell(60,0,($oArSetup["linvno"])?$oArSetup["minvno"]:"",0,1,'C');
$pdf->Ln(3);
 
$pdf->Output('ticket.pdf','i');
?>
