<?php
//include("vc_funciones.php");
//use vc_funciones;
class cgmodule {

    public static  $ncashamt  = 0;
    
    public static $cctano1 = "";
    public static $cctano2  = "";
    public static $cctano3  = "";
    public static $cctano4  = "";
    public static $cctano5  = "";
    public static $cctano6  = "";
    public static $llogoBC  = 0;
    public static $llogoBG  = 0;
    public static $llogoER  = 0;
    public static $cFirma1  = "";
    public static $cFirma2  = "";
    public static $cFirma3  = "";
    public static $ctitulo1 = "";
    public static $ctitulo2 = "";
    public static $ctitulo3 = "";
    public static $lViewF1  = 0;
    public static $lViewF2  = 0;
    public static $lViewF3  = 0;
    public static $cmonid   = "";
    public static $cperid  = "";
    public static $cperidw = "";
    public static $cyear = "";
    public static $cmic1desc   = "";
    public static $cmic2desc   = "";
    public static $cmic3desc   = "";
    public static $cmic4desc   = "";
    public static $cmic5desc   = "";
    
    public static $lmic1desc   = 0;
    public static  $lmic2desc   = 0;
    public static  $lmic3desc   = 0;
    public static  $lmic4desc   = 0;
    public static  $lmic5desc   = 0;

    public static  $nmic1desc    = 0;
    public static  $nmic2desc    = 0;
    public static  $nmic3desc    = 0;
    public static  $nmic4desc    = 0;
    public static  $nmic5desc    = 0;

    public static  $lmic1desc1   = 0;
    public static  $lmic2desc1   = 0;
    public static  $lmic3desc1   = 0;
    public static  $lmic4desc1   = 0;
    public static  $lmic5desc1   = 0;

    public static  $lmic1desc2   = 0;
    public static  $lmic2desc2   = 0;
    public static  $lmic3desc2   = 0;
    public static  $lmic4desc2   = 0;
    public static  $lmic5desc2   = 0;

    public static  $lmic1desc3   = 0;
    public static  $lmic2desc3   = 0;
    public static  $lmic3desc3   = 0;
    public static  $lmic4desc3   = 0;
    public static  $lmic5desc3   = 0;

    public static  $lmic1desc4   = 0;
    public static  $lmic2desc4   = 0;
    public static  $lmic3desc4   = 0;
    public static  $lmic4desc4   = 0;
    public static  $lmic5desc4   = 0;

    public static $nrentax= 0.00000;
    public static $lnConfRChk   = 0;
    public static $oConn =[] ;


    // inicia la coneccion.
    function __construct()
    {
        self::$oConn = vc_funciones::get_coneccion("CIA");
    }

    public static function init():void {
        /* Haciendo coneccion a la base de datos.*/
        //include("vc_funciones.php");
	    $oConn = vc_funciones::get_coneccion("CIA");
        /* obteniendo informacion de la data cgsetup */
        $lcsqlcmd = " select * from cgsetup ";
        $lcresult = mysqli_query($oConn,$lcsqlcmd);

        if ($lcresult->num_rows > 0){
            // obteniendo cada uno de los valores 
            while($oCurSetup = mysqli_fetch_assoc($lcresult)){
                self::$cctano1  = $oCurSetup["cctano1"];
                self::$cctano2  = $oCurSetup["cctano2"];
                self::$cctano3  = $oCurSetup["cctano3"];
                self::$cctano4  = $oCurSetup["cctano4"];
                self::$cctano5  = $oCurSetup["cctano5"];
                self::$cctano6  = $oCurSetup["cctano6"];
                self::$llogoBC  = $oCurSetup["llogoBC"];
                self::$llogoBG  = $oCurSetup["llogoBG"];
                self::$llogoER  = $oCurSetup["llogoER"];
                self::$cFirma1  = $oCurSetup["cfirma1"]; 
                self::$cFirma2  = $oCurSetup["cfirma2"];
                self::$cFirma3  = $oCurSetup["cfirma3"];
                self::$ctitulo1 = $oCurSetup["ctitulo1"];
                self::$ctitulo2 = $oCurSetup["ctitulo2"];
                self::$ctitulo3 = $oCurSetup["ctitulo3"];
                self::$lViewF1  = $oCurSetup["lviewF1"];
                self::$lViewF2  = $oCurSetup["lviewF2"];
                self::$lViewF3  = $oCurSetup["lviewF3"];
                self::$cmonid   = $oCurSetup["cmonid"];
                self::$cperid   = $oCurSetup["cperid"];
                self::$cperidw  = $_SESSION["cperidw"];
                self::$ncashamt = $oCurSetup["ncashamt"]; 

                self::$cmic1desc   = $oCurSetup["cmic1desc"];
                self::$cmic2desc   = $oCurSetup["cmic2desc"];
                self::$cmic3desc   = $oCurSetup["cmic3desc"];
                self::$cmic4desc   = $oCurSetup["cmic4desc"];
                self::$cmic5desc   = $oCurSetup["cmic5desc"];
                
                self::$lmic1desc   = $oCurSetup["lmic1desc"];
                self::$lmic2desc   = $oCurSetup["lmic2desc"];
                self::$lmic3desc   = $oCurSetup["lmic3desc"];
                self::$lmic4desc   = $oCurSetup["lmic4desc"];
                self::$lmic5desc   = $oCurSetup["lmic5desc"];
                
                self::$nmic1desc    = $oCurSetup["nmic1desc"];
                self::$nmic2desc    = $oCurSetup["nmic2desc"];
                self::$nmic3desc    = $oCurSetup["nmic3desc"];
                self::$nmic4desc    = $oCurSetup["nmic4desc"];
                self::$nmic5desc    = $oCurSetup["nmic5desc"];
                
                self::$lmic1desc1   = $oCurSetup["lmic1desc1"];
                self::$lmic2desc1   = $oCurSetup["lmic2desc1"];
                self::$lmic3desc1   = $oCurSetup["lmic3desc1"];
                self::$lmic4desc1   = $oCurSetup["lmic4desc1"];
                self::$lmic5desc1   = $oCurSetup["lmic5desc1"];

                self::$lmic1desc2   = $oCurSetup["lmic1desc2"];
                self::$lmic2desc2   = $oCurSetup["lmic2desc2"];
                self::$lmic3desc2   = $oCurSetup["lmic3desc2"];
                self::$lmic4desc2   = $oCurSetup["lmic4desc2"];
                self::$lmic5desc2   = $oCurSetup["lmic5desc2"];

                self::$lmic1desc3   = $oCurSetup["lmic1desc3"];
                self::$lmic2desc3   = $oCurSetup["lmic2desc3"];
                self::$lmic3desc3   = $oCurSetup["lmic3desc3"];
                self::$lmic4desc3   = $oCurSetup["lmic4desc3"];
                self::$lmic5desc3   = $oCurSetup["lmic5desc3"];

                self::$lmic1desc4   = $oCurSetup["lmic1desc4"];
                self::$lmic2desc4   = $oCurSetup["lmic2desc4"];
                self::$lmic3desc4   = $oCurSetup["lmic3desc4"];
                self::$lmic4desc4   = $oCurSetup["lmic4desc4"];
                self::$lmic5desc4   = $oCurSetup["lmic5desc4"];

                self::$nrentax      = $oCurSetup["nrentax"];
                self::$lnConfRChk   = $oCurSetup["lnConfRChk"];
            }
        }else{
            echo "Modulo CG no Configurado.";
        }
    }
    // obteniendo listado de anos definidos en tabla de periodos
    public static function get_year_list():void {
        $lcsqlcmd = "SELECT DISTINCT cyear FROM cgperd ORDER BY cyear ASC";
        $oConn = vc_funciones::get_coneccion("CIA");
        $lcresult = mysqli_query($oConn,$lcsqlcmd);
        if($lcresult->num_rows > 0){
            while($odata = mysqli_fetch_assoc($lcresult)){
                $lckq = ($odata["cyear"] == self::$cyear)? "selected":"";

                echo "<option value ='". $odata['cyear']."' $lckq >". $odata['cyear']."</option>";        
            }
        }else{
            echo "<option>Periodos no definidos</option>";        
        }

    }
    // objteniendo lista de periodos segun el ano elegido.
    public static function get_perid_list(string $pcyear = ""):void {
        if ($pcyear == ""){
            $pcyear = self::$cyear;
        }
        $lcsqlcmd = "select * from cgperd where cyear = '". $pcyear ."'";
        $oConn = vc_funciones::get_coneccion("CIA");
        $lcresult = mysqli_query($oConn,$lcsqlcmd);
        if($lcresult->num_rows > 0){
            while($odata = mysqli_fetch_assoc($lcresult)){
                echo "<option value ='". $odata['cperid']."' >". $odata['cdesc']."</option>";        
            }
        }else{
            echo "<option>Periodos no definidos</option>";        
        }
        
    }
    public static function set_change_cperid($pcperid, $pcyear):void {
        session_start();
        $_SESSION["cyearw"]  = $pcyear;
        $_SESSION["cperidw"] = $pcperid;
        self::$cperidw = $pcperid;
        //echo "ano ". $_SESSION["cyear_w"] . " periodo seleccionado ". $_SESSION["cperid_w"];
    }
    public static function getsetupnumber($pctable){
        if ($pctable == "1"){
            // comprobante de diario 
            $lcsql = "select ntrnno1 as numero from cgsetup ";
        }
        if ($pctable == "2"){
            // comprobante de ingresos
            $lcsql = "select ntrnno2 as numero from cgsetup ";
        }
        if ($pctable == "3"){
            // comprobante de cheques
            $lcsql = "select ntrnno3 as numero from cgsetup ";
        }
        if ($pctable == "4"){
            // comprobante de caja chica.
            $lcsql = "select ntrnno4 as numero from cgsetup ";
        }
        // obteniendo INFORMACION
        $lcresult = mysqli_query(self::$oConn,$lcsql);
        $ldata    = mysqli_fetch_assoc($lcresult);
        return $ldata["numero"];
    }
    // obteniendo numeros de comprobantes.
    public static function getnewdoc($pcopc){
        $llcont = true;
        $lnTmpDocno = self::getsetupnumber($pcopc) ;//getsetupnumber($pcopc);
        // $largo = Str::length($$lnTmpDocno);
        while ($llcont){
            // haciendo el sql.	
            $lcsql = " select ctrnno from cgmast_1 where ctrnno = '$lnTmpDocno'";
            if ($pcopc == "1"){
                $lcsql_upd = " update cgsetup set ntrnno1 = $lnTmpDocno + 1 ";
            }
            if ($pcopc == "2"){
                $lcsql_upd = " update cgsetup set ntrnno2 = $lnTmpDocno + 1 ";
            }
            if ($pcopc == "3"){
                $lcsql_upd = " update cgsetup set ntrnno3 = $lnTmpDocno + 1 ";
            }
            if ($pcopc == "4"){
                $lcsql     = "";
                $lcsql_upd = " update cgsetup set ntrnno4 = $lnTmpDocno + 1 ";
            }
            $lcresult = mysqli_query(self::$oConn,$lcsql);
            // revisando si el dato del numero no existe
            $lnexist  = mysqli_num_rows($lcresult);
            if ($lnexist == 1){
                // no existe.
                $lnTmpDocno = $lnTmpDocno + 1;
            }else{
                $llcont = false;
            }
        }
        // actualizando la tabla con el nuevo valor 
        mysqli_query(self::$oConn,$lcsql_upd);
        // retornando el numero nuevo de factura.
        return $lnTmpDocno;
    }
} // class cgmodule

?>