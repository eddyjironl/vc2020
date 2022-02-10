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
        <title>Tanla de impuesto sobre renta</title>
        <link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/plrent.js?v1"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>


    <style>    
        #plrent_add{
            width:300px;
            height:170px;
            padding:10px;
            /*float:none;
            display:inline-block;*/
            top:10px;
            position:absolute;

        }
        #cable_header{
	        margin:auto 10px;
            background:grey;
            border:1px solid grey;
            color:white;
        }
        #add{
            margin-bottom:10px;
        }

        #container{
            height:380px;	
	        overflow: auto;
	        margin:auto 10px;
             background-color:black;
        }
    </style>
    <body>
        
        <form id="plrent" name="plrent" method="post" class="form2" action="">
            <div class="barra-standar">
                <strong>Tabla de rangos de Impuestos sobre la Renta</strong>
            </div>
            <table id="cable_header">
                <tr>
                    <td width="100px">Orden</td>
                    <td width="100px">De</td>
                    <td width="100px">a</td>
                    <td width="100px">% Impuesto</td>
                    <td width="100px">Acumulado</td>
                    <td width="50px"></td>
                </tr>
            </table>
            <div id="container">
                <table id="mx_detalle" class="mx_area_detalles">
                </table>
            </div>
            <br>
            <input type="button" id="add" value="Agregar"> </input>
            <input type="button" id="quit" value= "Salir"> </input>
        
        </form>
        <form id="plrent_add" name="plrent_add" method="post" class="form2" action="">
            <h3>Adicionar Rango</h3>
            <label class="labelnormal"> Id </label>
            <input type="text" id="cuid" name="cuid" class="saytext">
            <br>
            <label class="labelnormal"> De </label>
            <input type="number" id="nstar" name="nstar" class="textqty">
            <br>
            <label class="labelnormal"> A </label>
            <input type="number" id="nend" name="nend" class="textqty">
            <br>
            <label class="labelnormal"> % de inpuesto </label>
            <input type="number" id="nrate" name="nrate" class="textqty">
            <br>
            <label class="labelnormal"> Acumulado </label>
            <input type="number" id="npayamt" name="npayamt" class="textqty">
            <br>
            <input type="button" id="add2" value="Agregar"> </input>
            <input type="button" id="quit2" value="Salir"> </input>
        </form>
        
    </body>
</html>