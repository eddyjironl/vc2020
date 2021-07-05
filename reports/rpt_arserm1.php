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
    $lcrptname  = "rpt_arserm1";
    $lctitle    = "Movimientos de Inventario Valorizados (AD)";
    $lcsubtitle = "";
	$lcwhere    = ""; // solo requisas no compras.
    $llfirttime = true;
    $llpritsub  = false;
    $lnQtyRow   = 0;
    $lnNunRec   = 0;
    $lcgrupid   = "!@#$!@";
    $lopgrup    = "1";  //mysqli_real_escape_string($oConn,$_POST["cgrupo"])  
    // totales segun grupo de deuda.
    $lnEntry_tot = 0;
    $lnExit_tot  = 0;
    // totales segun el grupo 
    $lnEntry_grp_tot = 0;
    $lnExit_grp_tot  = 0;
    // acumula el valor linea por linea.
    $lnQtyInic  = 0;
    $lnQtyEntry = 0;
    $lnQtyExit  = 0;
    // ordenamiento del reporte
    $lcorder = mysqli_real_escape_string($oConn,$_POST["corden"]); 
    $lcxsortby = "' '";
    $lcxdescby = "' ' ";
    $ldstar_1 = "";
    $ldstar_2 = "";
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
    // fecha de emision de recibo.
	$ldstar_1 = mysqli_real_escape_string($oConn,$_POST["dstar_1"]);
	$ldstar_2 = mysqli_real_escape_string($oConn,$_POST["dstar_2"]);
    // armando filtro final
	if ($lcwhere != ""){
		$lcwhere = " where " . $lcwhere; 
	}
	//--------------------------------------------------------------------------------------------------------

// E)- Obteniendo datos segun sea el caso.
	//--------------------------------------------------------------------------------------------------------
	// detalle de los articulos
    $lcsqlcmd = " select $lcxsortby as xsortby, 
        arserm.cservno as ckey,
        $lcxdescby as xdescby,
        arserm.*
    from arserm
    left outer join arresp on arresp.crespno = arserm.crespno
    left outer join artser on artser.ctserno = arserm.ctserno
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
	$ofpdf = new PDF();
    $ofpdf->AddPage("P","Letter");	
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
                $ofpdf->cell(130,5,"Totales  ".utf8_decode($lcodldesc),0,0,"R"); 
                $ofpdf->cell(20,5,$lnEntry_grp_tot,"TB",0,"R"); 
                $ofpdf->cell(20,5,$lnExit_grp_tot,"TB",1,"R"); 
                $lnEntry_grp_tot = 0;
                $lnExit_grp_tot  = 0;

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
        //-------------------------------------------------------------------------------------------------------------
        // Imprimiendo el cuerpo del reporte
        //-------------------------------------------------------------------------------------------------------------
        // impresion detallada
        $ofpdf->SetFillColor(0,0,0);
        $ofpdf->SetTextColor(0,0,0);
        $ofpdf->setfont("arial","",9);
        // Impresion detalle general de requisas sumarizada
        $ofpdf->cell(30,5, $row["cservno"],0,0,"L");  			
        $ofpdf->cell(75,5, $row["cdesc"],0,0,"L");  		
        // determinando cantidades.
        $lnQtyInic  = get_qty_inventory_star($oConn,$row["cservno"]);
        $lnQtyEntry = get_qty_between($oConn,$row["cservno"],$ldstar_1,$ldstar_2,"E");
        $lnQtyExit  = get_qty_between($oConn,$row["cservno"],$ldstar_1,$ldstar_2,"S");

        $ofpdf->cell(25,5, $lnQtyInic,0,0,"R");  					
        $ofpdf->cell(20,5, $lnQtyEntry,0,0,"R");  					
        $ofpdf->cell(20,5, $lnQtyExit,0,0,"R");  					
        $ofpdf->cell(25,5, $lnQtyInic + $lnQtyEntry + $lnQtyExit,0,1,"R");  	
        // totales segun el grupo 
        $lnEntry_grp_tot = $lnEntry_grp_tot + $lnQtyEntry;
        $lnExit_grp_tot  = $lnExit_grp_tot  + $lnQtyExit;
        // cargando el total del reporte en general.
        $lnEntry_tot = $lnQtyEntry + $lnEntry_tot;
        $lnExit_tot  = $lnQtyExit  + $lnExit_tot;
        
        // finalizando el total del grupo 
        if(($lnNunRec == $lnQtyRow) and !empty($row["xdescby"]) and $lopgrup == 1){
            $ofpdf->SetTextColor(0,0,128);
            $ofpdf->cell(130,5,"Totales  ".utf8_decode($lcodldesc),0,0,"R"); 
            $ofpdf->cell(20,5,$lnEntry_grp_tot,"TB",0,"R"); 
            $ofpdf->cell(20,5,$lnExit_grp_tot,"TB",1,"R"); 
            $lnEntry_grp_tot = 0;
            $lnExit_grp_tot  = 0;
            $ofpdf->SetTextColor(0,0,0);
        }
    }  //while($lcgrp = mysqli_fetch_assoc($lcrestgrp)){r
    // ----------------------------------------------------------------------------------------------------------------

// G)- Final de Reporte.
	// ----------------------------------------------------------------------------------------------------------------
	$ofpdf->Ln(10);
    $ofpdf->cell(130,5,"Totales generales ",0,0,"R"); 
    $ofpdf->cell(20,5,$lnEntry_tot,"TB",0,"R"); 
    $ofpdf->cell(20,5,$lnExit_tot,"TB",0,"R"); 
    // termino el reporte y pone el gran total.
	$ofpdf->output();
// H)- Funciones varias del reporte.
    function get_qty_inventory_star($poConn,$pcservno){
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
        
        $ldstar_qty = date("Y-m-d",strtotime($GLOBALS["ldstar_1"]."- 1 days")); 
        // ---------------------------------------------------------------------------------------------------------------------- 
        $lcsql1 = "SELECT aradjt.cservno,
                             sum(aradjt.nqty) as nqty
                     FROM aradjm
                     left outer join aradjt on aradjm.cadjno  = aradjt.cadjno
                     left outer join arserm on arserm.cservno = aradjt.cservno
                     left outer join arcate on arcate.ccateno = aradjm.ccateno AND arcate.ctypecate = 'A'
                     where arserm.lupdateonhand = true AND 
                            aradjm.lvoid   = false and 
                           aradjt.cservno = '$pcservno' and 
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
                          arinvt.cservno = '$pcservno' and 
                          arinvc.dstar <= '$ldstar_qty' 
                    group by 1";	
        
        // determinando cuanto producto queda segun el caso 
        $lcresult = mysqli_query($poConn,$lcsql2);
        while($lnrowqty = mysqli_fetch_assoc($lcresult)){
            $lnqty += $lnrowqty["nqty"];	
        }
        // desidiendo como sera la respuesta.
        return $lnqty;
    }
    function get_qty_between($poConn,$pcservno,$pdate1,$pdate2,$pnopc){
        // ---------------------------------------------------------------------------------------------------------------------- 
        $lnqty = 0;
        // A)- Solo Entradas.
        if ($pnopc == "E"){
            // calculando las entradas desde las requisas.    
            $lcsql1 = "SELECT aradjt.cservno,
                             sum(aradjt.nqty) as nqty
                     FROM aradjm
                     join aradjt on aradjm.cadjno  = aradjt.cadjno
                     join arserm on arserm.cservno = aradjt.cservno
                     join arcate on arcate.ccateno = aradjm.ccateno AND arcate.ctypecate = 'A'
                     where arserm.lupdateonhand = true AND 
                           aradjm.lvoid    = false and 
                           aradjt.cservno  = '$pcservno' and 
                           arcate.ctypeadj = 'E' and 
                           aradjm.dtrndate >= '$pdate1' and aradjm.dtrndate <= '$pdate2' 
                     group by 1";
                     
            $lcresult = mysqli_query($poConn,$lcsql1);
            while($lnrowqty = mysqli_fetch_assoc($lcresult)){
                $lnqty += $lnrowqty["nqty"];	
            }
       
        } else {
            // calculando las salidas desde las facturas..    
            $lcsql2 = " SELECT arinvt.cservno,
                    sum(arinvt.nqty * -1) as nqty
                    FROM  arinvc
                    JOIN arinvt on arinvc.cinvno   = arinvt.cinvno
                    JOIN arserm on arserm.cservno  = arinvt.cservno
                    join artcas on artcas.cpaycode = arinvc.cpaycode
                    where arserm.lupdateonhand = true and
                        arinvc.lvoid   = false and 
                        arinvt.cservno = '$pcservno' and 
                        arinvc.dstar >= '$pdate1' and arinvc.dstar <= '$pdate2'
                    group by 1";	
            
            // determinando cuanto producto queda segun el caso 
            $lcresult = mysqli_query($poConn,$lcsql2);
            while($lnrowqty = mysqli_fetch_assoc($lcresult)){
                $lnqty += $lnrowqty["nqty"];	
            }

            // calculando las entradas desde las requisas.    
            $lcsql1 = "SELECT aradjt.cservno,
                             sum(aradjt.nqty) as nqty
                     FROM aradjm
                     join aradjt on aradjm.cadjno  = aradjt.cadjno
                     join arserm on arserm.cservno = aradjt.cservno
                     join arcate on arcate.ccateno = aradjm.ccateno AND arcate.ctypecate = 'A'
                     where arserm.lupdateonhand = true AND 
                           aradjm.lvoid    = false and 
                           aradjt.cservno  = '$pcservno' and 
                           arcate.ctypeadj = 'S' and 
                           aradjm.dtrndate >= '$pdate1' and aradjm.dtrndate <= '$pdate2' 
                     group by 1";
            $lcresult = mysqli_query($poConn,$lcsql1);
            while($lnrowqty = mysqli_fetch_assoc($lcresult)){
                $lnqty += $lnrowqty["nqty"];	
            }
        }    
        // retornando el valor de la cantidad.    
        return $lnqty;      
    }   //function get_qty_between($poConn,$pcserno,$pdate1,$pdate2,$pnopc){

?>		