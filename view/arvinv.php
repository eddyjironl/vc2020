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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/vc_estilos.css"> 
    <script>
        function init(){
            document.getElementById("btquit").addEventListener("click",salir,false)
        }
        function salir(){
             document.getElementById("arvinv").style.display="none"
        }
        window.onload=init;
    </script>

    <script src="../js/vc_funciones.js"></script> 
 	<!-- Bootstrap CSS 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    -->
    <title>Anulacion de Facturas</title>
  </head>
  <body>
   <style>
       #msg{
           color:red;
       }

   </style>

    <form id="arvinv" class="form2" method="post" action="../modelo/crud_arinvc.php">
        <div class="barra_info">
            <strong>Anulacion de Facturas Clientes</strong>
        </div>
        <div class="contenedor_objetos">
            <label name="anular" class="labelnormal" >Factura id</label>
            <input type="text" class="textkey" name="cinvno" id="cinvno">
            <input type="hidden" name="accion" id="accion" value="ANULAR">

            <?php  if (isset($_GET["msg"])){ ?>
                    <br>
                    <strong id="msg"> <?php   echo $_GET["msg"];  ?> </strong>
            <?php } ?>
        </div>    
        <div class="contenedor_objetos">
            <button type="submit"> anular</button>
            <input type="button"  id="btquit" value="Salir">
        </div>
    </form>
  </body>
</html>