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
    $lcrptname  = "rpt_arserm2";
    $lctitle    = "Maximos y Minimos";
    $lcsubtitle = "";
	$lcwhere    = ""; // solo requisas no compras.
    $llfirttime = true;
    $lnQtyRow   = 0;
    $lnNunRec   = 0;
    $lcgrupid   = "!@#$!@";
    $lopgrup    = "1";  //mysqli_real_escape_string($oConn,$_POST["cgrupo"])  
    // ordenamiento del reporte
    $lcorder = mysqli_real_escape_string($oConn,$_POST["corden"]); 
    $lcxsortby = "' '";
    $lcxdescby = "' ' ";
    $lcver     = $_POST["cver"]; 
    $llprint   = true;
    
// C)- generando ordenamiento.
    switch ($lcorder) {
        case 'crespno':
            $lcxsortby  = "arserm.crespno";
            $lcxdescby  = "arresp.cfullname";
            $lcsubtitle = " Por Proveedor";
        break;
        case 'ctserno':
            $lcxsortby  = "arserm.ctserno";
            $lcxdescby  = "artser.cdesc ";
            $lcsubtitle = " Por Tipo de Articulo";
        break;

        default:
            $lcxsortby  = "arwqty.cwhseno";
            $lcxdescby  = "arwhse.cdesc ";
            $lcsubtitle = " Por Bodega";
    break;
    }
    // Configurando titulo del reporte. 
    $lctitle = $lctitle.$lcsubtitle;

// D)- Area de Filtros
    $lcrespno_1 = mysqli_real_escape_string($oConn,$_POST["crespno_1"]);
	$lcrespno_2 = mysqli_real_escape_string($oConn,$_POST["crespno_2"]);
	if(!empty($lcrespno_1)){
		if($lcrespno_1 == $lcrespno_2 or empty($lcrespno_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arserm.crespno = '". $lcrespno_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arserm.crespno >= '". $lcrespno_1 ."' and ".
								  " arserm.crespno <= '". $lcrespno_2 ."' ";
		}
	}
    $lctserno_1 = mysqli_real_escape_string($oConn,$_POST["ctserno_1"]);
	$lctserno_2 = mysqli_real_escape_string($oConn,$_POST["ctserno_2"]);
    if(!empty($lctserno_1)){
		if($lctserno_1 == $lctserno_2 or empty($lctserno_2)) {
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arserm.ctserno = '". $lctserno_1 ."' ";
		}else{
			$lcwhere = $lcwhere . (empty($lcwhere)?"":" and ") . " arserm.ctserno >= '". $lctserno_1 ."' and ".
								  " arserm.ctserno <= '". $lctserno_2 ."' ";
		}
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
        arwqty.cwhseno as ckey,
        $lcxdescby as xdescby,
        arserm.cdesc ,
        arwqty.*
    from arwqty
    left outer join arserm on arserm.cservno = arwqty.cservno
    left outer join arwhse on arwhse.cwhseno = arwqty.cwhseno
    left outer join artser on artser.ctserno = arserm.ctserno
    left outer join arresp on arresp.crespno = arserm.crespno
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


// F)- Generando el reporte 
	// ----------------------------------------------------------------------------------------------------------------
    if($lcver == "1"){
        $lctitle = $lctitle . " debajo del minimo";
    }else if ($lcver == "2"){
        $lctitle = $lctitle . " arriba del maximo";
    }else{
        $lctitle = "Resumen de Maximos y Minimos";
    }

    $ofpdf = new PDF();
    $ofpdf->AddPage("L","Letter");	
    // llenando las lineas del reporte.
	while($row = mysqli_fetch_assoc($lcresult)){
       // controlando las agrupaciones.
        if ($lcgrupid != $row["xsortby"] and !empty($row["xdescby"]) and $lopgrup == 1 ){
            $ofpdf->SetTextColor(0,0,128);
            $lcDescGrp = "GRUPO :".$row["ckey"]." - ".utf8_decode($row["xdescby"]);
            $ofpdf->cell(190,5,$lcDescGrp,0,1,"L");  					
            // configurando las variables necesarias
            $lcgrupid  = $row["xsortby"];
            $llpritsub = true;
            $lcodldesc = $row["xdescby"];    
        } 
        //-------------------------------------------------------------------------------------------------------------
        // Imprimiendo el cuerpo del reporte
        //-------------------------------------------------------------------------------------------------------------
        // impresion detallada
        $ofpdf->SetFillColor(0,0,0);
        $ofpdf->SetTextColor(0,0,0);
        $ofpdf->setfont("arial","",9);
        // Impresion detalle general de requisas sumarizada
        // determinando cantidades.
        $lnQtyInic  = get_qty_inventory_star($oConn,$row["cservno"],$row["ckey"]);
        // Condicion los menores del Minimo 
        if($lcver == "1"){
            $llprint = $lnQtyInic < $row["nqtymin"];
        }
        // Condicion los mayores al Maximo 
        if($lcver == "2"){
            $llprint = $lnQtyInic > $row["nqtymax"];
        }
        // imprimiendo detalle segun codiciones.
        if ($llprint){
            $ofpdf->cell(30,5, $row["cservno"],0,0,"L");  			
            $ofpdf->cell(90,5, $row["cdesc"],0,0,"L");  		
            $ofpdf->cell(20,5, $row["cwhseno"],0,0,"L");  			
            $ofpdf->cell(20,5, $lnQtyInic,0,0,"R");  					
            $ofpdf->cell(20,5, $row["nqtymin"],0,0,"R");  		
            $ofpdf->cell(20,5, $row["nqtymax"],0,0,"R");  		
            $ofpdf->cell(30,5, $row["cestante"],0,0,"L");
            $ofpdf->cell(30,5, $row["cbinno"],0,1,"L");  	
        }
        $llprint = true;	
    }  //while($lcgrp = mysqli_fetch_assoc($lcrestgrp)){r
  
// G)- Final de Reporte.
	// ----------------------------------------------------------------------------------------------------------------
	$ofpdf->Ln(5);
	$ofpdf->output();
// H)- Funciones varias del reporte.
    function get_qty_inventory_star($poConn,$pcservno,$pcwhseno){
        // ----------------------------------------------------------------------------------------------------------------------------
        // Descripcion del procedimiento
        // ----------------------------------------------------------------------------------------------------------------------------
        // poConn = Coneccion a la base de datos.
        // pcserno = Articulo que se quiere evaluar
        // este procedimiento muestra la cantidad de existencia a un dia antes de la fecha de corte.
        // ----------------------------------------------------------------------------------------------------------------------------
       
        // ----------------------------------------------------------------------------------------------------------------------------
        // A)- configurando fecha de inicio y final 
        // ----------------------------------------------------------------------------------------------------------------------------
        //sumo 1 día
        //date("d-m-Y",strtotime($fecha_actual."+ 1 days")); 
        //resto 1 día3
        
        $ldstar_qty = date("Y-m-d"); 
        // ---------------------------------------------------------------------------------------------------------------------- 
        $lcsql1 = "SELECT aradjt.cservno,
                             sum(aradjt.nqty) as nqty
                     FROM aradjm
                     left outer join aradjt on aradjm.cadjno  = aradjt.cadjno
                     left outer join arserm on arserm.cservno = aradjt.cservno
                     left outer join arcate on arcate.ccateno = aradjm.ccateno AND arcate.ctypecate = 'A'
                     where arserm.lupdateonhand = true AND 
                            aradjm.lvoid   = false and 
                            aradjm.cwhseno = '$pcwhseno' and 
                           aradjt.cservno  = '$pcservno' and 
                           aradjm.dtrndate <= '$ldstar_qty' 
                     group by 1";
                     
        $lnqty = 0;
        $lcresult = mysqli_query($poConn,$lcsql1);
        while($lnrowqty = mysqli_fetch_assoc($lcresult)){
            $lnqty += $lnrowqty["nqty"];	
        }
        // sacando movimientos de las facturas.    
        $lcsql2 = " SELECT arinvt.cservno,
                            sum(arinvt.nqty *-1) as nqty
                    FROM  arinvc
                    LEFT OUTER JOIN arinvt on arinvc.cinvno = arinvt.cinvno
                    LEFT OUTER JOIN arserm on arserm.cservno = arinvt.cservno
                    left outer join artcas on artcas.cpaycode = arinvc.cpaycode
                    where arserm.lupdateonhand = true and
                          arinvc.lvoid   = false and 
                          arinvc.cwhseno = '$pcwhseno' and 
                          arinvt.cservno = '$pcservno' and 
                          arinvc.dstar  <= '$ldstar_qty' 
                    group by 1";	
        
        // determinando cuanto producto queda segun el caso 
        $lcresult = mysqli_query($poConn,$lcsql2);
        while($lnrowqty = mysqli_fetch_assoc($lcresult)){
            $lnqty += $lnrowqty["nqty"];	
        }
        // desidiendo como sera la respuesta.
        return $lnqty;
    }
?>		