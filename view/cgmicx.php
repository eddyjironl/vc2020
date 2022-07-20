<?php
// iniciando validacion de session
include("../modelo/vc_funciones.php");
//--------------------------------------------------------------------------------------------------------------
$lcStarSession = vc_funciones::Star_session();
//--------------------------------------------------------------------------------------------------------------
if ($lcStarSession == 1){
	return;
}
$lcid = "1";
if(isset($_GET["cid"])){
  $lcid = $_GET["cid"];
}
  // vinculando el java script
  $lcjs = "../js/cgmic". $lcid .".js?v1";                              //"../js/cgmic1.js?v1"
  $lcaction = "../modelo/crud_cgmicx.php?accion=NEW&cid=".$lcid;     // "../modelo/crud_cgmicx.php?accion=NEW&cid=1"
  $lcgrp    = "Agrupacion # ". $lcid;
?>
<!doctype html>
<html lang="en">

  <head>
    	<title>Agrupaciones de Catalogo</title>
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
        <script src= "<?php echo $lcjs;?>"></script>
  </head>
  
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <form class="form2" id="cgmicx" method="post" action="<?php echo $lcaction;?>" >
        <SCRIPT>get_barraprinc_x("<?php echo $lcgrp;?>","Ayuda ");</SCRIPT> 
        <div class="contenedor_objetos"  style="float:left;">
            <label class="labelnormal" >Grupo id</label>
            <input type="text" class="ckey" name="cmicxno" id="cmicxno">
            <script>get_btmenu("btcmicxno","<?php echo "Listado de ".$lcgrp;?>");</script>
            <br>
            <label class="labelnormal" >Descripcion</label>
            <input type="text" class="textcdesc" name="cdesc" id="cdesc">
            <br>
            <label class="labelsencilla">Comentarios Generales</label><br>
            <textarea id="mnotas" name="mnotas" class="mnotas" rows=6 cols=63> </textarea>
        </div>    
       

    </form>
    <script>get_msg();</script>
    <div id="showmenulist"></div>
  </body>
</html>