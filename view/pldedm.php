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
    <script src="../js/pldedm.js?v2"></script> 


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Catalogo de Ingresos</title>
  </head>

  <style>
    #pldedm{
      padding:5px;
      width:500px;
    }
  </style>  

  <body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
    <form class="form2" id="pldedm" name="pldedm" method="post" action="../modelo/crud_pldedm.php?accion=NEW">
        <script>get_barraprinc_x("Catalogo de Deducciones","Ayuda de Catalogo de Deducciones");</script> 	
        <label class="labelnormal">Deduccion Id</label>
				<input type="text" id="cdedid" name="cdedid" class="textkey" autocomplete="off" autofocus>
				<script>get_btmenu("btcdedid","Listado de Deducciones");</script>
				<br>
				<label class="labelnormal">Descripcion</label>
				<input type="text" id="cdesc" name="cdesc" class="textcdesc" autocomplete="off">
        <br>
				<label class="labelnormal">Descripcion Corta</label>
				<input type="text" id="cdescsh" name="cdescsh" class="textcdesc" autocomplete="off">
        <br>
				<label class="labelnormal">Valor</label>
				<input type="numeric" id="nvalue" name="nvalue" class="" title="valor por defecto, no obligatorio">

        <br>
				<label class="labelnormal">Cuenta Debe</label>
				<input type="text" id="cctaid_d" name="cctaid_d" class="textcdesc" autocomplete="off">
        <br>
				<label class="labelnormal">Cuenta Haber</label>
				<input type="text" id="cctaid_h" name="cctaid_h" class="textcdesc" autocomplete="off">
        <br>
				<label class="labelnormal">Estado</label>
        <select class="listas" id="cstatus" name="cstatus">
          <option value= "">Elija una opcion </option>
          <option value= "OP">Activo </option>
          <option value= "CL">Inactivo</option>
        </select>
        <br>
				<label class="labelsencilla">Comentarios</label>
				<textarea id="mnotas" name="mnotas" class="mnotas" rows=6 cols=72></textarea>

        <br><br>
        <input type="checkbox" id="lclear" name="lclear">Borrar en la siguiente planilla</textarea>

    </form>
    
    <div id="showmenulist"></div>
    <script>
				get_msg();
				//get_btdtrn("btprint2","Imprimiendo reporte", "../reports/rpt_arinvc.php");aradjm_r
		</script>
  </body>
</html>

