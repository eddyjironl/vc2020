<?php
// iniciando validacion de session
include("../modelo/vc_funciones.php");
//--------------------------------------------------------------------------------------------------------------
$lcStarSession = vc_funciones::Star_session();
//--------------------------------------------------------------------------------------------------------------
if ($lcStarSession == 1){
	return;
}
?>
<!doctype html>
<html lang="en">

    <head>
    	<title>Configuracion Contable</title>
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
        <script src="../js/cgsetup.js?v1"></script>
		<!--
		 Required meta tags 

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        -->
        <!-- Bootstrap CSS 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        -->
    </head>
    <style>
        .labellarge{
            display: inline-block;
            padding:1px;
            width:250px;
            background:yellow;

        }
    </style>    
    <body>
        <form name="cgsetup" id="cgsetup" class="form2" method="post" action="../modelo/crud_cgsetup?accion=NEW">
            <div class="barra-standar"> 
                <p> Configuracion del Modulo Contable</p>
            </div>
            <br><br>
            <div class="tab">
				<button  class="tablinks" id="tbinfo1" >Informacion General</button>
				<button  class="tablinks" id="tbinfo2" >Configuracion de Niveles Catalogo Contable y Apariencia de Estados Financieros</button>
			</div>		
            <div id="finfo1" class="tabcontent">
                <div class="contenedor_objetos">
                    <label class="labelsencilla">Configuracion de Formatos y Numeracion de comprobantes</label>
                    <br>
                    <label class="labellarge">Comprobante de Diario No 1MMYYYY   </label>
                    <input type="number" class="textkey" id="ntrnno1" name="ntrnno1">
                    <br>
                    <label class="labellarge">Comprobante de Ingresos No 2MMYYYY   </label>
                    <input type="number" class="textkey" id="ntrnno2" name="ntrnno2">
                    <br>
                    <label class="labellarge">Comrabante de Cheques No 3MMYYYY     </label>
                    <input type="number" class="textkey" id="ntrnno3" name="ntrnno3">
                    <br>
                    <label class="labellarge">Consecutivos Comprobante de Caja chica </label>
                    <input type="number" class="textkey" id="ntrnno4" name="ntrnno4">

                    <br>
                    <label class="labellarge">Monto Autorizado de Caja Chica  </label>
                    <input type="number" class="textkey" id="ncashamt" name="ncashamt">
                    <br>
                    <label class="labellarge">Porcentaje del Impuesto sbre la renta </label>
                    <input type="number" class="textkey" id="nrentax" name="nrentax">
                    <br>
                    <label class="labelsencilla">Configuracion de Moneda y Periodo de Trabajo</label>
                    <br>
                    <label class="labellarge">Moneda Base</label>
                    <input type="text" class="textkey" id="cmonid" name="cmonid">
                    <script>get_btmenu("btcmonid","Listado de Cuentas operativas");</script>
                    <br>
                    <label class="labellarge">Periodo</label>
                    <input type="texxt" class="textkey" id="cperid" name="cperid">
                    <script>get_btmenu("btcperid","Listado de Cuentas operativas");</script>
                    <br>

                    <label class="labelsencilla">Configuracion de Cuentas de cierre Mensual y Anual </label>
                    <br>
                    <label class="labellarge">Utilidad del Periodo </label>
                    <input type="texxt" class="textkey" id="cctano1" name="cctano1">
                    <script>get_btmenu("btcctano1","Listado de Cuentas operativas");</script>
                    <br>
                    <label class="labellarge">Cta Utilidad del Mes (NP) </label>
                    <input type="texxt" class="textkey" id="cctano2" name="cctano2">
                    <script>get_btmenu("btcctano2","Listado de Cuentas operativas");</script>
                    <br>
                    <label class="labellarge">Gasto IR </label>
                    <input type="texxt" class="textkey" id="cctano3" name="cctano3">
                    <script>get_btmenu("btcctano3","Listado de Cuentas operativas");</script>
                    <br>
                    <label class="labellarge">Cuenta por Pagar IR </label>
                    <input type="texxt" class="textkey" id="cctano4" name="cctano4">
                    <script>get_btmenu("btcctano4","Listado de Cuentas operativas");</script>
                    <br>
                    <label class="labelsencilla">Configuracion del Formato de cheques</label>
                    <br>
                    <select id="lnConfRChk" name="lnConfRChk" class="listas">
                        <option value=1>Usar Formato Standar del Sistema</option>
                        <option value=2>Usar Formato Standar Sin Impresion de area de cheque</option>
                        <option value=3>Usar Formato Personalizado del Cliente a</option>
                    </select>    
                </div>
            </div>
            <div id="finfo2" class="tabcontent">
                <div class="contenedor_objetos">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="labelsencilla">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;
                        
                        
                        Balance General Detallado
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Estado de Resultado Sumarizado
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
                    </label>
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="labelsencilla">Descripcion de Agrupaciones Contables 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Activar
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Sangria
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Desc/Grupo
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Suma/Grupo 

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Desc/Grupo
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Suma/Grupo 

                    </label>
                    <br>
                    <label class="labelnormal">Agrupacion  # 1</label>
                    <input type="text" class="textcdesc" name="cmic1desc" id="cmic1desc">
                    &nbsp;
                    <input type="checkbox" id="lmic1desc" name="lmic1desc"></input>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="number" class="textkey" name="nmic1desc" id="nmic1desc">

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic1desc1" name="lmic1desc1"></input>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic1desc2" name="lmic1desc2"></input>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic1desc3" name="lmic1desc3"></input>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic1desc4" name="lmic1desc4"></input>

                    <br>

                    <label class="labelnormal">Agrupacion  # 2</label>
                    <input type="text" class="textcdesc" name="cmic2desc" id="cmic2desc">
                    &nbsp;
                    <input type="checkbox" id="lmic1desc" name="lmic2desc"></input>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="number" class="textkey" name="nmic2desc" id="nmic2desc">

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic2desc1" name="lmic2desc1"></input>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic2desc2" name="lmic2desc2"></input>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic2desc3" name="lmic2desc3"></input>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic2desc4" name="lmic2desc4"></input>

                    <br>

                    <label class="labelnormal">Agrupacion  # 3</label>
                    <input type="text" class="textcdesc" name="cmic3desc" id="cmic3desc">
                    &nbsp;
                    <input type="checkbox" id="lmic3desc" name="lmic3desc"></input>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="number" class="textkey" name="nmic3desc" id="nmic3desc">

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic3desc1" name="lmic3desc1"></input>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic3desc2" name="lmic3desc2"></input>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic3desc3" name="lmic3desc3"></input>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic3desc4" name="lmic3desc4"></input>

                    <br>

                    <label class="labelnormal">Agrupacion  # 4</label>
                    <input type="text" class="textcdesc" name="cmic4desc" id="cmic4desc">
                    &nbsp;
                    <input type="checkbox" id="lmic4desc" name="lmic4desc"></input>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="number" class="textkey" name="nmic4desc" id="nmic4desc">

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic4desc1" name="lmic4desc1"></input>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic4desc2" name="lmic4desc2"></input>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic4desc3" name="lmic4desc3"></input>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic4desc4" name="lmic4desc4"></input>

                    <br>

                    <label class="labelnormal">Agrupacion  # 5</label>
                    <input type="text" class="textcdesc" name="cmic5desc" id="cmic5desc">
                    &nbsp;
                    <input type="checkbox" id="lmic5desc" name="lmic5desc"></input>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="number" class="textkey" name="nmic5desc" id="nmic5desc">

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic5desc1" name="lmic5desc1"></input>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic5desc2" name="lmic5desc2"></input>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic5desc3" name="lmic5desc3"></input>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="lmic5desc4" name="lmic5desc4"></input>
                    <br>
                    <label class="labelnormal"> Agrupar al nivel </label>
                    <input type="number" class="textkey" id="ngrupid" name="ngrupid">
                </div>    
                <div class="contenedor_objetos">
                    <label class="labelsencilla"> Configuracion de Firmas </div>
                    
                    <label class="labelnormal">1er Nombre  </label>
                    <input type="text" class="textcdesc" name="cfirma1" id="cfirma1">
                    <br>
                    <label class="labelnormal">Titulo  </label>
                    <input type="text" class="textcdesc" name="ctitulo1" id="ctitulo1">
                    <input type="checkbox" id="lviewf1" name="lviewf1">Ver Firma 1</input>
                    <br>
                    <label class="labelnormal">2do Nombre  </label>
                    <input type="text" class="textcdesc" name="cfirma2" id="cfirma2">
                    <br>
                    <label class="labelnormal">Titulo  </label>
                    <input type="text" class="textcdesc" name="ctitulo2" id="ctitulo2">
                    <input type="checkbox" id="lviewf2" name="lviewf2">Ver Firma 2</input>
                    <br>
                    <label class="labelnormal">3er Nombre  </label>
                    <input type="text" class="textcdesc" name="cfirma3" id="cfirma3">
                    <br>
                    <label class="labelnormal">Titulo  </label>
                    <input type="text" class="textcdesc" name="ctitulo3" id="ctitulo3">
                    <input type="checkbox" id="lviewf3" name="lviewf3">Ver Firma 3</input>
                </div>
            </div>
            <div class="contenedor_objetos">
                <script>
					get_btprinc("btquit","btquit");
					get_btprinc("btsave","btsave");
					get_msg();
				</script>

            </div>    
        </form>    
    </body>
</html>