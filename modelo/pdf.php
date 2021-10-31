<?php
include("../fpdf/fpdf.php");
class PDF extends FPDF{
	// estas son las funciones actuales.
	function RPTheader($pcdesc){
		// Logo
		//$this->Image('LOGITO1.jpg',10,8,20);
		// Arial bold 15
		$this->setfont("arial","",10);
		$this->cell(175,1,$_SESSION["compdesc"],0,1,"C");   
		
		$this->SetFont('Arial','B',11);
		// Movernos a la derechaa
		$this->Cell(60);
		// Título
		$this->Cell(60,10,$pcdesc,0,0,'C');
		 // Salto de línea 25
		$this->Ln(12);
	}
	function encabezado_ec($pcname,$pctel){
		// Logo
		//$this->Image('LOGITO1.jpg',10,8,20);
		// Arial bold 15
		$this->setfont("arial","B",10);
		$this->cell(175,1,$_SESSION["compdesc"],0,1,"C");  
		$this->cell(175,10,"ESTADO DE CUENTA",0,1,"C");  

		$this->setfont("arial","",10);
		$this->cell(150,5,"Fecha:",0,0,"R");  
		$this->cell(30,5,date("d") . " del " . date("m") . " de " . date("Y"),0,1,"");  
		$this->cell(150,5,"Pagina:",0,0,"R");  
		$this->cell(30,5,$this->PageNo(),0,1,"");  

		$this->setfont("arial","B",10);
		//$this->SetFont('Arial','B',11);
		$this->Cell(60,5,"",0,1,"");
		$this->cell(35,5,"Nombre del Cliente","LTR",0,"","true");
		$this->setfont("arial","",10);
		$this->cell(75,5,$pcname,"TR",1,"L","true");
		$this->setfont("arial","B",10);
		$this->cell(35,5,"Telefono:","LBR",0,"","true");
		$this->setfont("arial","",10);
		$this->cell(75,5,$pctel,"BR",0,"","true");
		$this->Ln(12);
		/* 
		// Movernos a la derecha
		$this->Cell(60);
		// Título
		$this->Cell(60,10,$pcdesc,0,0,'C');
		 // Salto de línea 25
		$this->Ln(12); */
	}
	function Header(){

		if(!empty($GLOBALS["lctitle"])){
			$this->ln(2);			
			$this->setfont("arial","",10);
			$this->cell(190,5,$_SESSION["compdesc"],0,1,"L");    
			$this->setfont("arial","B",16);
			$this->SetTextColor(0,0,128);
			$this->cell(190,5,$GLOBALS["lctitle"] ,0,1,"L");  		
			$this->ln(2);			
		}
        
		// Configurando el encabezado general.
		$this->setfont("arial","B",9);
		$this->SetFillColor(20,40,100);
		$this->SetTextColor(255,255,255);
		
		switch ($GLOBALS["lcrptname"]) {
			case "rpt_aradjt":
				$this->cell(20,5,"# Requisa",0,0,"L",TRUE);  					
				$this->cell(20,5,"Fecha ",0,0,"L",TRUE);  					
				$this->cell(50,5,"Almacen",0,0,"L",TRUE);  					
				$this->cell(50,5,"Tipo Doc",0,0,"L",TRUE);  					
				$this->cell(50,5,"Referencia",0,0,"L",TRUE);  	
				$this->cell(20,5,"T/C",0,0,"R",TRUE);  	
				$this->cell(20,5,"Total ",0,1,"R",TRUE);  	
				break;
			case "rpt_arinvt1":
				if ($GLOBALS["lopgrup"]=="1"){
					$this->cell(20,5,"# Factura",0,0,"L",TRUE);  					
					$this->cell(20,5,"Referencia ",0,0,"L",TRUE);  					
					$this->cell(20,5,"Codigo",0,0,"L",TRUE);  					
					$this->cell(75,5,"Descripcion",0,0,"L",TRUE);  					
					$this->cell(20,5,"Cantidad",0,0,"R",TRUE);  	
					$this->cell(20,5,"Precio",0,0,"R",TRUE);  	
					$this->cell(20,5,"Costo ",0,0,"R",TRUE);  	
					$this->cell(20,5,"T. Precio",0,0,"R",TRUE);  	
					$this->cell(20,5,"T. Costo ",0,0,"R",TRUE);  	
					$this->cell(20,5,"M.U.B. ",0,1,"R",TRUE);  	
				}else{
					$this->cell(195,5,"Descripcion",0,0,"L",TRUE);  					
					$this->cell(20,5,"T. Precio",0,0,"R",TRUE);  	
					$this->cell(20,5,"T. Costo ",0,0,"R",TRUE);  	
					$this->cell(20,5,"M.U.B. ",0,1,"R",TRUE);  	
				}	
				$this->setfont("arial","",10);
				break;
			case "rpt_arinvt2":
				$this->cell(20,5,"Item No",1,0,"",true);   // cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$this->cell(100,5,"Descripcion",1,0,"",true);   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$this->cell(20,5,"U. Vendido",1,0,"",true);   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$this->cell(20,5,"Efectivo",1,0,"",true);	// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$this->cell(20,5,"Contribucion",1,1,"R",true);   					// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
			
				$this->setfont("arial","",10);
				break;		
			case "rpt_arserm":
				$this->cell(30,5,"Articulo",0,0,"",true);   					
				$this->cell(100,5,"Descripcion",0,0,"",true);   	// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$this->cell(20,5,"Existencia",0,0,"R",true);   		// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$this->cell(20,5,"Precio",0,0,"R",true);   	// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				$this->cell(20,5,"Costo",0,1,"R",true);   		// cell(largo, alto ,"texto a escribir",borde a dibujar o no(1/0),)
				break;		
			case "rpt_arcash2":
				if ($GLOBALS["lopgrup"]=="1"){
					$this->cell(75,5,"Nombre Completo",0,0,"L",TRUE);  					
					$this->cell(20,5,"Factura",0,0,"L",TRUE);  					
					$this->cell(20,5,"Vence ",0,0,"L",TRUE);  					
					$this->cell(10,5,"Dias",0,0,"L",TRUE);  					
					$this->cell(20,5,"Saldo Act",0,0,"R",TRUE);  	
					$this->cell(20,5,"Al dia",0,0,"R",TRUE);  	
					$this->cell(20,5,"a 30 dias",0,0,"R",TRUE);  	
					$this->cell(20,5,"a 60 dias",0,0,"R",TRUE);  	
					$this->cell(20,5,"a 90 dias",0,0,"R",TRUE);  	
					$this->cell(20,5,"a +90 dias",0,1,"R",TRUE);  	
				}else{
					$this->cell(145,5,"Descripcion",0,0,"L",TRUE);  					
					$this->cell(20,5,"Al dia",0,0,"R",TRUE);  	
					$this->cell(20,5,"a 30 dias",0,0,"R",TRUE);  	
					$this->cell(20,5,"a 60 dias",0,0,"R",TRUE);  	
					$this->cell(20,5,"a 90 dias",0,0,"R",TRUE);  	
					$this->cell(20,5,"a +90 dias",0,1,"R",TRUE);  	
				}	
				$this->setfont("arial","",10);
				break;
			case "rpt_arserm1":
				$this->cell(130,5,"Inicial al",0,0,"R",true);   					
				$this->cell(65,5,"saldo Act",0,1,"R",true);   	

				$this->cell(30,5,"Articulo",0,0,"",true);   					
				$this->cell(75,5,"Descripcion",0,0,"",true);   
				$this->cell(25,5,date("Y-m-d",strtotime($GLOBALS["ldstar_1"]."- 1 days")),0,0,"R",true);
				$this->cell(20,5,"Entradas",0,0,"R",true);   	
				$this->cell(20,5,"Salidas",0,0,"R",true);   	
				$this->cell(25,5, $GLOBALS["ldstar_2"],0,1,"R",true);  	
				// doble espacio con color
				break;		
			case "rpt_arserm2":
				$this->cell(30,5,"Articulo",0,0,"L",true);   					
				$this->cell(90,5,"Descripcion",0,0,"L",true);   
				$this->cell(20,5,"Bodega ID",0,0,"L",true);   	
				$this->cell(20,5,"Existencia",0,0,"R",true);   	
				$this->cell(20,5,"Minimo",0,0,"R",true);   
				$this->cell(20,5,"Maximo",0,0,"R",true);   	
				$this->cell(30,5,"Estante",0,0,"L",true);  
				$this->cell(30,5,"Bin",0,1,"L",true);   
				break;		
			default:
				# code...
				break;
		}
		$this->ln(2);	
	}
	function Footer(){
		// Posición: a 1,5 cm del final
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Número de página
		$this->Cell(0,10,'Pagina '.$this->PageNo(),0,0,'C');
	}
}
?>