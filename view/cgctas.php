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
    	<title>Catalogo Cuentas Operativas</title>
		<link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
        <script src="../js/cgctas.js?v1"></script>
		
  </head>
  
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <form class="form2" id="cgctas" method="post" action="../modelo/crud_cgctas.php?accion=NEW" >
        <SCRIPT>get_barraprinc_x("Catalogo de Cuentas Operativas","Ayuda ");</SCRIPT> 
        <div class="contenedor_objetos"  style="float:left;">
            <label class="labelnormal" >Cuenta Id</label>
            <input type="text" class="ckey" name="cctaid" id="cctaid">
            <script>get_btmenu("btcctaid","Listado de Cuentas operativas");</script>
            <br>
            <label class="labelnormal" >Descripcion</label>
            <input type="text" class="textcdesc" name="cdesc" id="cdesc">
            <br>
            <label class="labelnormal" >Categoria</label>
            <select class="listas" id="cgrupid" name="cgrupid">
                <option Value = "">Elija un Tipo de Cuenta</option>
                <option Value = "A">Activo</option>
                <option Value = "B">Pasivo</option>
                <option Value = "C">Capital</option>
                <option Value = "D">Ingresos</option>
                <option Value = "E">Gastos</option>
                <option Value = "F">Cta de Orden Deudor</option>
                <option Value = "X">Cta de Orden Acreedor</option>
            </select>
            <label class="labelnormal" >Saldo Tipo</label>
            <input type="text" class="ckey" name="ctype" id="ctype">
            <br><br>
            <input type="checkbox" id="lpost" name="lpost">Cuenta Posteable por el usuario</input>
            <br>
            <input type="checkbox" id="lapplyir"  name="lapplyir">Incluir esta cuenta en los calculos del IR-</input>
            <br>
            <label class="labelsencilla">Comentarios Generales</label><br>
            <textarea id="mnotas" name="mnotas" class="mnotas" rows=6 cols=63> </textarea>
            <br>
            <label class="labelsencilla">Agrupaciones del Catalogo Contable</label><br>
            <label class="labelnormal" >Grupo 1</label>
            <input type="text" class="ckey" name="cmic1no" id="cmic1no">
            <script>get_btmenu("btcmic1no","Listado de Agrupacion 1");</script>
            <input type="text" id="cdescmic1" class="textcdescreadonly">
            <br>
            <label class="labelnormal" >Grupo 2</label>
            <input type="text" class="ckey" name="cmic2no" id="cmic2no">
            <script>get_btmenu("btcmic2no","Listado de Agrupacion 2");</script>
            <input type="text" id="cdescmic2" class="textcdescreadonly">
            <br>
            <label class="labelnormal" >Grupo 3</label>
            <input type="text" class="ckey" name="cmic3no" id="cmic3no">
            <script>get_btmenu("btcmic3no","Listado de Agrupacion 3");</script>
            <input type="text" id="cdescmic3" class="textcdescreadonly">
            <br>
            <label class="labelnormal" >Grupo 4</label>
            <input type="text" class="ckey" name="cmic4no" id="cmic4no">
            <script>get_btmenu("btcmic4no","Listado de Agrupacion 4");</script>
            <input type="text" id="cdescmic4" class="textcdescreadonly">
            <br>
            <label class="labelnormal" >Grupo 5</label>
            <input type="text" class="ckey" name="cmic5no" id="cmic5no">
            <script>get_btmenu("btcmic5no","Listado de Agrupacion 5");</script>
            <input type="text" id="cdescmic5" class="textcdescreadonly">

        </div>    
        <div class="contenedor_objetos" style="float:left;">
            <label class="labelnormal" >Debe</label>
            <input type="text" class="textkeyreadonly" name="ndebe" id="ndebe">
            <br>
            <label class="labelnormal" >Haber</label>
            <input type="text" class="textkeyreadonly" name="nhaber" id="nhaber">
            <br>
            <label class="labelnormal" >Saldo</label>
            <input type="text" class="textkeyreadonly" name="namount" id="namount">
            <br>
            <label class="labelnormal" >Debe Dolares</label>
            <input type="text" class="textkeyreadonly" name="ndebe_d" id="ndebe_d">
            <br>
            <label class="labelnormal" >Haber Dolares </label>
            <input type="text" class="textkeyreadonly" name="nhaber_d" id="nhaber_d">
            <br>
            <label class="labelnormal" >Saldo Dolares </label>
            <input type="text" class="textkeyreadonly" name="namount_d" id="namount_d">
        
        </div>

    </form>
    <script>get_msg();</script>
    <div id="showmenulist"></div>
  </body>
</html>