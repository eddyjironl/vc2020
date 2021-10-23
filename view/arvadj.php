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
             document.getElementById("arvadj").style.display="none"
        }
        window.onload=init;
    </script>

    <script src="../js/vc_funciones.js"></script> 
 	<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <title>Anulacion de Facturas</title>
  </head>
  <body>
   <style>
       #arvadj{
           padding: 5px 10px;
           margin: 5px;
       }
       #msg{
           color:red;
       }

   </style>
   


    <form id="arvadj" class="form2" method="post" action="../modelo/crud_aradjm.php">
        <h2>Anulacion de Requisas</h2>
        <label name="anular" class="labelnormal" >Ajuste id</label>
        <input type="text" class="textkey" name="cadjno" id="cadjno">
        <input type="hidden" name="accion" id="accion" value="ANULAR">
        <?php  if (isset($_GET["msg"])){ ?>
                <br>
                <strong id="msg"> <?php   echo $_GET["msg"];  ?> </strong>
        <?php } ?>
        <br>
      
        <br><br><br>
        <button type="submit"> anular</button>
        <input type="button"  id="btquit" value="Salir">
    </form>


  </body>
</html>