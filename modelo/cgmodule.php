<?php
class cgmodule 
{
    public $ncashamt  = 0;
    public $cctano1  = "";
    public $cctano2  = "";
    public $cctano3  = "";
    public $cctano4  = "";
    public $cctano5  = "";
    public $cctano6  = "";
    public $llogoBC  = 0;
    public $llogoBG  = 0;
    public $llogoER  = 0;
    public $cFirma1  = "";
    public $cFirma2  = "";
    public $cFirma3  = "";
    public $ctitulo1 = "";
    public $ctitulo2 = "";
    public $ctitulo3 = "";
    public $lViewF1  = 0;
    public $lViewF2  = 0;
    public $lViewF3  = 0;
    public $cperid   = "";
    public $cmonid   = "";
    public $cperIdw  = "";
    
    public $cmic1desc   = "";
    public $cmic2desc   = "";
    public $cmic3desc   = "";
    public $cmic4desc   = "";
    public $cmic5desc   = "";
    
    public $lmic1desc   = 0;
    public $lmic2desc   = 0;
    public $lmic3desc   = 0;
    public $lmic4desc   = 0;
    public $lmic5desc   = 0;

    public $nmic1desc    = 0;
    public $nmic2desc    = 0;
    public $nmic3desc    = 0;
    public $nmic4desc    = 0;
    public $nmic5desc    = 0;

    /* balance general */
    public $lmic1desc1   = 0;
    public $lmic2desc1   = 0;
    public $lmic3desc1   = 0;
    public $lmic4desc1   = 0;
    public $lmic5desc1   = 0;
    /* Estado de resultados */
    public $lmic1desc2   = 0;
    public $lmic2desc2   = 0;
    public $lmic3desc2   = 0;
    public $lmic4desc2   = 0;
    public $lmic5desc2   = 0;

    public $lmic1desc3   = 0;
    public $lmic2desc3   = 0;
    public $lmic3desc3   = 0;
    public $lmic4desc3   = 0;
    public $lmic5desc3   = 0;

    public $lmic1desc4   = 0;
    public $lmic2desc4   = 0;
    public $lmic3desc4   = 0;
    public $lmic4desc4   = 0;
    public $lmic5desc4   = 0;

    public $nrentax      = 00000000.00;
    public $lnConfRChk   = 0;
   
    public function init() {
        /* Haciendo coneccion a la base de datos.*/
        include("vc_funciones.php");
	    $oConn = vc_funciones::get_coneccion("CIA");
        /* obteniendo informacion de la data cgsetup */
        $lcsqlcmd = " select * from cgsetup ";
        $lcresult = mysqli_execute($oConn,$lcsqlcmd);

        if ($lcresult->num_rows > 0){
            // obteniendo cada uno de los valores 
            while($oCurSetup = mysqli_fetch_assoc($lcresult)){
                $this->$ncashamt = $oCurSetup.ncashamt; 
                $this->$cctano1  = $oCurSetup.cctano1;
                $this->$cctano2  = $oCurSetup.cctano2;
                $this->$cctano3  = $oCurSetup.cctano3;
                $this->$cctano4  = $oCurSetup.cctano4;
                $this->$cctano5  = $oCurSetup.cctano5;
                $this->$cctano6  = $oCurSetup.cctano6;
                $this->$llogoBC  = $oCurSetup.llogoBC;
                $this->$llogoBG  = $oCurSetup.llogoBG;
                $this->$llogoER  = $oCurSetup.llogoER;
                $this->$cFirma1  = $oCurSetup.cFirma1;
                $this->$cFirma2  = $oCurSetup.cFirma2;
                $this->$cFirma3  = $oCurSetup.cFirma3;
                $this->$ctitulo1 = $oCurSetup.ctitulo1;
                $this->$ctitulo2 = $oCurSetup.ctitulo2;
                $this->$ctitulo3 = $oCurSetup.ctitulo3;
                $this->$lViewF1  = $oCurSetup.lViewF1;
                $this->$lViewF2  = $oCurSetup.lViewF2;
                $this->$lViewF3  = $oCurSetup.lViewF3;
                $this->$cperid   = $oCurSetup.cperid;
                $this->$cmonid   = $oCurSetup.cmonid;
                $this->$cperIdw  = $oCurSetup.cperIdw;
                /* vinculacion del sistema de inventarios  */
                /* agrupaciones del sistema de cuentas contables. */
                
                $this->$cmic1desc   = $oCurSetup.cmic1desc;
                $this->$cmic2desc   = $oCurSetup.cmic2desc;
                $this->$cmic3desc   = $oCurSetup.cmic3desc;
                $this->$cmic4desc   = $oCurSetup.cmic4desc;
                $this->$cmic5desc   = $oCurSetup.cmic5desc;
                
                $this->$lmic1desc   = $oCurSetup.lmic1desc;
                $this->$lmic2desc   = $oCurSetup.lmic2desc;
                $this->$lmic3desc   = $oCurSetup.lmic3desc;
                $this->$lmic4desc   = $oCurSetup.lmic4desc;
                $this->$lmic5desc   = $oCurSetup.lmic5desc;
                
                $this->$nmic1desc    = $oCurSetup.nmic1desc;
                $this->$nmic2desc    = $oCurSetup.nmic2desc;
                $this->$nmic3desc    = $oCurSetup.nmic3desc;
                $this->$nmic4desc    = $oCurSetup.nmic4desc;
                $this->$nmic5desc    = $oCurSetup.nmic5desc;
                
                /* balance general */
                $this->$lmic1desc1   = $oCurSetup.lmic1desc1;
                $this->$lmic2desc1   = $oCurSetup.lmic2desc1;
                $this->$lmic3desc1   = $oCurSetup.lmic3desc1;
                $this->$lmic4desc1   = $oCurSetup.lmic4desc1;
                $this->$lmic5desc1   = $oCurSetup.lmic5desc1;

                /* Estado de resultados */
                $this->$lmic1desc2   = $oCurSetup.lmic1desc2;
                $this->$lmic2desc2   = $oCurSetup.lmic2desc2;
                $this->$lmic3desc2   = $oCurSetup.lmic3desc2;
                $this->$lmic4desc2   = $oCurSetup.lmic4desc2;
                $this->$lmic5desc2   = $oCurSetup.lmic5desc2;

                $this->$lmic1desc3   = $oCurSetup.lmic1desc3;
                $this->$lmic2desc3   = $oCurSetup.lmic2desc3;
                $this->$lmic3desc3   = $oCurSetup.lmic3desc3;
                $this->$lmic4desc3   = $oCurSetup.lmic4desc3;
                $this->$lmic5desc3   = $oCurSetup.lmic5desc3;

                $this->$lmic1desc4   = $oCurSetup.lmic1desc4;
                $this->$lmic2desc4   = $oCurSetup.lmic2desc4;
                $this->$lmic3desc4   = $oCurSetup.lmic3desc4;
                $this->$lmic4desc4   = $oCurSetup.lmic4desc4;
                $this->$lmic5desc4   = $oCurSetup.lmic5desc4;

                $this->$nrentax      = $oCurSetup.nrentax;
                $this->$lnConfRChk   = $oCurSetup.lnConfRChk;

            }
        }else{
            echo "Modulo CG no Configurado.";
        }
    }
  
} // class cgmodule

?>