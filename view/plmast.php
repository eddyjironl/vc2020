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
        <title>Definicion de planilla</title>
        <link rel="stylesheet" href="../css/vc_estilos.css?v1">
		<script src="../js/vc_funciones.js?v1"></script>
		<script src="../js/plmast.js?v1"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <style>    
        #plmast_add{
            width:450px;
            height:130px;
            padding:10px;
            top:0px;
            left:0;
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
            width:380px;
            height:170px;	
	        overflow: auto;
	        background-color:black;
        }
        #plmast{
            width:400px;
        }
    </style>
    <body>
        <form id="plmast" name="plmast" method="post" class="form2" action="../modelo/crud_plmast.php?accion=NEW">
            <SCRIPT>get_barraprinc_x("Definir Planilla","Ayuda de Definicion de planillas",800);</SCRIPT> 
            <fieldset class="fieldset">
                <label class="labelnormal"> Planilla id </label>
                <input type="text" id="cplano" name="cplano" class="textkey">
                <script>get_btmenu("btcplano","Listado de Planillas activas");</script>
                <br>
                <label class="labelnormal">Descripcion </label>
                <input type="text" id="cdesc" name="cdesc" class="textcdesc">
                <br>
                <label class="labelnormal">Estado</label>
                <select  class="listas" name="cstatus" id="cstatus">
                    <option value="">Elija el Estado</option>
                    <option value="OP">Activa</option>
                    <option value="CL">Cerrada</option>
                </select>
                <br>
                <label class="labelnormal">Tipo Empleado</label>
                <select class="listas" name="ctypemp" id="ctypemp"> 
                        <option value="">Elija Tipo Empleado</option>    
                        <option value="CF">Contrato Indefinido</option>    
                        <option value="CD">Contrato Determinado</option>   
                </select>
                <br>
                <label class="labelnormal" >Forma de Pago</label>
                    <select class="listas" name="ctyppay" id="ctyppay"> 
                        <option value="">Elija Forma de Pago</option>    
                        <option value="PQ">Quincenal</option>    
                        <option value="PS">Semanal</option>    
                        <option value="PM">Mensual</option>    
                        <option value="PK">Catorcenal</option>    
                    </select>
                <br>
                <label class="labelnormal">Mes de Inss</label>
                <select class="listas" name="cmonth" id="cmonth"> 
                        <option value="">Elija Mes de INS</option>    
                        <option value="01">Enero</option>    
                        <option value="02">febrero</option>    
                        <option value="03">Marzo</option>    
                        <option value="04">Abril</option>    
                        <option value="05">Mayo</option>    
                        <option value="06">Junio</option>    
                        <option value="07">Julio</option>    
                        <option value="08">Agosto</option>    
                        <option value="09">Septiembre</option>    
                        <option value="10">Octubre</option>    
                        <option value="11">Noviembre</option>    
                        <option value="12">Diciembre</option>    
                </select>
                <br>
                <label class="labelnormal">Inicia</label>
                <input type="date" id="tstar" name="tstar" class="textdate">
                <br>
                <label class="labelnormal">Finaliza</label>
                <input type="date" id="tend" name="tend" class="textdate">
                <br>
                <label class="labelnormal">Dia de Pago</label>
                <input type="date" id="dpay" name="dpay" class="textdate">
            </fieldset>
            <br><br>
            <fieldset class="fieldset">
                <div id="msg">
                    <?php  if (isset($_GET["msg"])){ ?>
                    <br>
                    <strong id="msg"> <?php   echo $_GET["msg"];  ?> </strong>
                    <?php } ?>
                </div>

                <table id="cable_header">
                    <tr>
                        <td width="50px">id</td>
                        <td width="80px">Dept id</td>
                        <td width="170px">Descripcion</td>
                        <td width="50px"></td>
                    </tr>
                </table>
                <div id="container">
                    <table id="mx_detalle" >
                    </table>
                </div>
                <br>
                <input type="button" id="add" value="Agregar"> </input>
            </fieldset>
        </form>

        <form id="plmast_add" name="plmast_add" method="post" class="form2" action="">
            <h3>Adicionar Departamento</h3>
            <label class="labelnormal">Id</label>
            <input type="text" id="cuid" name="cuid" class="saykey">
            <br>
            <label class="labelnormal">Dept Id</label>
            <input type="text" id="cdeptno" name="cdeptno" class="textqty">
            <script>get_btmenu("btcdptno","Listado de Departamentos");</script>
            <input type="text" id="cdesc1" name="cdesc1" class="saytext">
            <br>
            <br>
            <input type="button" id="add2" value="Guardar"> </input>
            <input type="button" id="quit2" value="Salir"> </input>
        </form>
    <div id="showmenulist"></div>
    <script>
		get_msg();
	</script>
    </body>
</html>