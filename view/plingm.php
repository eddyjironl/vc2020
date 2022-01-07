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
    <script src="../js/plingm.js?v2"></script> 


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Catalogo de Ingresos</title>
  </head>

  <style>
    #plingm{
      padding:5px;
      width:500px;
    }
  </style>  

  <body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
    <form class="form2" id="plingm" name="plingm" method="post" action="../modelo/crud_plingm.php?accion=NEW">
        <script>get_barraprinc_x("Catalogo de Ingresos","Ayuda de Catalogo de Ingresos");</script> 	
        <label class="labelnormal">Ingreso Id</label>
				<input type="text" id="cingid" name="cingid" class="textkey" autocomplete="off" autofocus>
				<script>get_btmenu("btcingid","Listado de Ingresos");</script>
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
				<label class="labelnormal">Cuenta Id</label>
				<input type="text" id="cctaid" name="cctaid" class="textcdesc" autocomplete="off">
        <br>
				<label class="labelnormal">Estado</label>
        <select class="listas" id="cstatus" name="cstatus">
          <option value= "">Elija una opcion </option>
          <option value= "OP">Activo </option>
          <option value= "CL">Inactivo</option>
        </select>

        <br><br>
				<label class="labeltitle">Parametros para Calculo</label>
        <br>
        <input type="checkbox" id="lvac" name="lvac">Incluir en Calculo de Vacaciones</input>
        <br>
        <input type="checkbox" id="lprest" name="lprest">Incluir en Calculo de Liquidacion</input>
        <br>
        <input type="checkbox" id="l1314avo" name="l1314avo">Incluir en Calculo de Aguinaldo</input>
        <br>
        <input type="checkbox" id="lIhsApl" name="lIhsApl">Incluir en Calculo de INS</input>
        <br>
        <input type="checkbox" id="lvecinal" name="lvecinal">Incluir en Calculo Impuesto sobre la Renta</input>
        <br>
        <input type="checkbox" id="lclear" name="lclear">Borrar en la siguiente planilla</input>

    </form>
    
    <div id="showmenulist"></div>
    <script>
				get_msg();
				//get_btdtrn("btprint2","Imprimiendo reporte", "../reports/rpt_arinvc.php");aradjm_r
		</script>
  </body>
</html>

