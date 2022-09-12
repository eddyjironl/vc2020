<?php
// iniciando validacion de session
include("../modelo/cgmodule.php");
include("../modelo/vc_funciones.php");
//--------------------------------------------------------------------------------------------------------------
if (vc_funciones::Star_session() == 1){
	return;
}
    // creando una instancia de la clase
    $oCg = new cgmodule;
    $oCg::init();

    echo " periodo :<p style='color:white;'>" .$_SESSION["cperidw"]."</p>";
?>
<html>
	<head>
		<title>ingresar a periodo</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/cgperd_a.js?v1"></script>
	</head>
    <style>
        .dinline{
            display:inline-block;
        }
        #atencion{
            font-size:40px;
            border:solid 1px red;
            color:red;
        }
        .mensaje{
            width:400px;
        }
        .listas2{
            width: 60px;
        }
        #cperid{
            width:200px;
        
        }
            
    </style>
	<body>
		<form class="form2 mensaje" id="cgperd_a" >
            <div class="barra_info"><strong>Seleccion de Periodo de Trabajo</strong></div>
            <div class = "contenedor_objetos">
                <div class="contenedor_objetos dinline">
                    <img src="../photos/stop1.ico">

                </div>
                <strong id="atencion">ATENCION</strong>

                <div class="contenedor_objetos dinline">
                    <img src="../photos/stop1.ico" >
                </div>
            </div>
            <div class="contenedor_objetos">
                <strong id="atencion2">
                    Para efectos del registro de asientos de diario y cheques es necesario
                    indicar aqui que periodo se trabajara 
                    Todo comprobante registrado sera contabilizado en este periodo especificamente.
                </strong>
            </div>
            <div class="contenedor_objetos">
                <label class="labelnormal">Periodo</label>
                <select id="cyear" class="listas listas2">
                    <?php  $oCg::get_year_list(); ?>
                </select>
                <select id="cperid" class="listas">
                    <?php $oCg::get_perid_list(); ?>
                </select>
            </div>
            <div class="contenedor_objetos">
                <?php 
                    vc_funciones::get_btn("cmdquit","salir.ico","Salir","Cierra la pantalla");
                    vc_funciones::get_btn("cmdok","transacciones.ico","Ingresar","Cambia periodo contable");
                ?>
            </div>
        </form>	
		<!-- Presentacion del menu -->
		<script>get_msg();</script>
		<div id="showmenulist"></div>
	</body>
</html>