<?php
    // iniciando validacion de session
    include("../modelo/vc_funciones.php");
    //--------------------------------------------------------------------------------------------------------------
    if (vc_funciones::Star_session() == 1){
        return;
    }
?>
<html>
    <head>
        <title>Generacion de Registros de planilla</title>
        <link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/plimpd.js?v1"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <style>    

    </style>
    <body>
        <form id="plimpd" name="plimpd" method="post" class="form2" action="../modelo/crud_plimpd.phps">
            <div class="barra-standar">
                <strong>Procesamiento de planillas</strong>
            </div>
            <div class="contenedor_objetos">
            <label class="labelnormal"> Planilla id </label>
            <input type="text" id="cplano" name="cplano" class="textkey">
            <script>get_btmenu("btcplano","Listado de Planillas activas");</script>
            <input type="text" id="cdesc" name="cdesc" class="saytext">

            <br>
            <label class="labelnormal"> Acciones</label>
            <select id='option' class="listas">
                <option value="">Elija una opcion</option>
                <option value="A">Generar Registros de Planillas</option>
                <option value="B">Eliminar y Volver a Cancular</option>
                <option value="C">Recalcular Planilla</option>
            </select>

            <br><br>

            <div id="msg">
                    <?php  if (isset($_GET["msg"])){ ?>
                    <br>
                    <strong id="msg"> <?php   echo $_GET["msg"];  ?> </strong>
                    <?php } ?>
            </div>
            <br>            
            <input type="button" id="add" value="Procesar"> </input>
            <input type="button" id="quit" value="salir"> </input>
            </div>
        </form>

      
    <div id="showmenulist"></div>
    <script>
		get_msg();
	</script>
    </body>
</html>