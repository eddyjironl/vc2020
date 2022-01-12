<?php
// iniciando validacion de session
include("../modelo/vc_funciones.php");
//--------------------------------------------------------------------------------------------------------------
if (vc_funciones::Star_session() == 1){
	return;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
    <script src="../js/vc_funciones.js?v1"></script>
    <script src="../js/plworm.js?v2"></script> 


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Catalogo de Puestos </title>
  </head>

  <style>
    #plworm{
      padding:5px;
      width:500px;
    }
  </style>  

  <body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
    <form class="form2" id="plworm" name="plworm" method="post" action="../modelo/crud_plworm.php?accion=NEW">
        <script>get_barraprinc_x("Catalogo de Trabajo","Ayuda de Catalogo de Puestos de Trabajo");</script> 	
        <label class="labelnormal">Puesto Id</label>
			<input type="text" id="cworkno" name="cworkno" class="textkey" autocomplete="off" autofocus>
			<script>get_btmenu("btcworkno","Listado de Puestos de Trabajo");</script>
			<br>
			<label class="labelnormal">Descripcion</label>
			<input type="text" id="cdesc" name="cdesc" class="textcdesc" autocomplete="off">
            <br>
			<label class="labelsencilla">Comentarios</label>
            <BR>
			<textarea id="mnotas" name="mnotas" class="mnotas" rows=6 cols=72></textarea>
    </form>
    
    <div id="showmenulist"></div>
    <script>
		get_msg();
	</script>
  </body>
</html>

