
<?php
// iniciando validacion de session
include("../modelo/vc_funciones.php");
//--------------------------------------------------------------------------------------------------------------
if (vc_funciones::Star_session() == 1){
	return;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Definir periodos contables</title>
    <link rel="stylesheet" href="../css/vc_estilos.css?v1">
    <script src="../js/vc_funciones.js?v1"></script>
    <script src="../js/cgperd.js?v1"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <form id="cgperd" name="cgperd" action="" method="post" class="form2" action="../modelo/crud_cgperd.php?accion=NEW">
        <div class="barra_info">
            <strong>
                Generacion de periodos contables
            </strong>
        </div>
        <div class="contenedor_objetos">
            <label class="labelnormal">Año</label>
            <input type="number" class="textqty" id="cyear"    name="cyear" required placeholder="indique el año">
            <br>
            <label class="labelnormal">Fecha de inicia</label>
            <input type="date" class="textqty"   id="dtrndate" name="dtrndate" required placeholder="Indique la fecha">
            <br>
            <label class="labelnormal">Periodos a crear</label>
            <input type="number" class="saykey" value="12" id= "nperid" name="nperid" readonly>
        </div>
        <div class="contenedor_objetos">
            <script>get_btprinc("btnew", "cmdadd");</script>
            <script>get_btprinc("btquit", "cmdexit");</script>
        </div>
    </form>

</body>


</html>
