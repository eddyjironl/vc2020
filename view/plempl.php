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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     Bootstrap CSS 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   -->
    <title>Ficha Empleado</title>
	<link rel="stylesheet" href="../css/vc_estilos.css?v1">
	<script src="../js/vc_funciones.js?v1"></script>
	<script src="../js/plempl.js?v1"></script>

    <style>
            #informacion_1,#informacion_2{
	            float:left;
            }
            .adetalles {
                height:50;  /*300px;	*/
                overflow: auto;
                margin-bottom:15px;
                margin-left:7.5%;
            }
            .table_det{	
                background-color:#dcdcdc;
                color:#000000;
                font-size:12px;
                font-family:arial;
            }
            .barra_info{
                background:green;
                top:0px;
                left:0px;
                box-shadow:white 0px 10px 10px;
                color:yellow;
                text-align:center;
                padding:1px;
                margin-bottom:5px;
                border-radius:10px 10px 0px 0px;
            }
            #add_deduction,#add_ingresos{
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                /*transition: opacity 400ms ease-in;*/
            }
    </style>
  </head>
    <body>
        <form class="form2" id="plempl" name="plempl" method="post" action="../modelo/crud_plempl.php?accion=NEW">
			<script>get_barraprinc_x("Catakigo de Empleados","Ayuda Catalogo de Empleados");</script> 	

            <div>
                <label class="labelnormal">Empleado Id</label>
				<input type="text" id="cempno" name="cempno" class="textkey" autocomplete="off" autofocus>
				<script>get_btmenu("btccempno","Listado de Empleados");</script>
                &nbsp  &nbsp
                <label class="labelnormal">Nombre Completo</label>
				<input type="text" id="cfullname" name="cfullname" class="textcdesc" autocomplete="off">
                
			</div>
            <br>
			<div class="tab">
				<button  class="tablinks" id="tbinfo1" >Informacion General</button>
				<button  class="tablinks" id="tbinfo2" >Configuracion de pago</button>
				<button  class="tablinks" id="tbinfo3" >Detalle de Ingresos y Deducciones </button>
			</div>		
			<div id="finfo1" class="tabcontent">
                <div id="informacion_1">

                    <label class="labelnormal" >Cedula</label>
                    <input tyoe="type" class="textnormal" id="ccedid" name="ccedid">
                    <br>
                    <label class="labelnormal" >Fecha Nacimiento</label>
                    <input type="date" class="textdate"  id="dnacday" name="dnacday">
                    <br>
                    
                    <label class="labelnormal" >Estado Civil</label>
                    <select class="listas" id="cmarital" name="cmarital">
                        <option value="">Elija un Estado Civil</option>
                        <option value="SO">Solterio</option>
                        <option value="CA">Casado</option>
                        <option value="DI">Divorciado</option>
                        <option value="VI">Viudo</option>
                        <option value="OT">Otros</option>
                    </select>
                    <br>	
                    <label class="labelnormal" >Sexo </label>
                    <select class="listas" id="csexo" name="csexo">
                        <option value="">Elija el Sexo</option>
                        <option value="H">Masculino</option>
                        <option value="M">Femenino</option>
                    </select>
                    <br>
                    <label class="labelsencilla" >Direccion </label><br>
                    <textarea id="mdirecc" name="mdirecc" class="mnotas" rows=4 cols=55> </textarea>
                    <br>
                    <label class="labelsencilla" >Telefono</label><br>
                    <textarea id="mtels" name="mtels" class="mnotas" rows=4 cols=55> </textarea>
                    <br>
                    <label class="labelsencilla">Comentarios Generales</label><br>
                    <textarea id="mnotas" name="mnotas" class="mnotas" rows=4 cols=55> </textarea>
                    <br>
                    <label class="labelnormal" >Fecha Inicio</label>
                    <input type="date" id="dstar" name="dstar" class="textdate">
                    <br>
                    <label class="labelnormal" >Fecha Retiro</label>
                    <input type="date" id="dend" name="dend" class="textdate">
                    <br>
                    <label class="labelnormal" >Estado </label>
                    <select class="listas" id="cstatus" name="cstatus">
                        <option value="">Elija el Estado </option>
                        <option value="OP">Empleado Activo</option>
                        <option value="CL">Empleado Inactivo</option>
                    </select>
                    <br>
                    <label class="labelnormal" >Motiva Despido</label>
                    <input tyoe="text" class="textnormal" id="cdescmot" name="cdescmot">
                    <br>
                    <label class="labelnormal" >Puesto Id </label>
                    <select class="listas" id="cworkid" name="cworkid">
                        <option value="">Elija un Puesto de trabajo</option>
                        <?php
                            $lcsqlcmd = "select * from plworm";
                            $oConn = vc_funciones::get_coneccion("CIA");
                            $lcresult = mysqli_query($oConn,$lcsqlcmd);
                            if ($lcresult->num_rows > 0){
                                while($odata = mysqli_fetch_assoc($lcresult)){
                                    echo "<option value= '". $odata["cworno"]."'>".$odata["cdesc"]."</option>";
                                }
                            }
                            $oConn->close();
                        ?>
                    </select>
                    <br>
                    <label class="labelnormal" >Departamento Id </label>
                    <select class="listas" id="cdeptno" name="cdeptno">
                        <option value="">Elija un Departamento</option>
                        <?php
                            $lcsqlcmd = "select * from pldept";
                            $oConn = vc_funciones::get_coneccion("CIA");
                            $lcresult = mysqli_query($oConn,$lcsqlcmd);
                            if ($lcresult->num_rows > 0){
                                while($odata = mysqli_fetch_assoc($lcresult)){
                                    echo "<option value= '". $odata["cdeptno"]."'>".$odata["cdesc"]."</option>";
                                }
                            }
                            $oConn->close();
                        ?>
                    </select>
                    <br>
                    <label class="labelnormal" >Turno Id </label>
                    <select class="listas" id="cturno" name="cturno">
                        <option value="">Elija un Turno </option>
                        <?php
                            $lcsqlcmd = "select * from plturm";
                            $oConn = vc_funciones::get_coneccion("CIA");
                            $lcresult = mysqli_query($oConn,$lcsqlcmd);
                            if ($lcresult->num_rows > 0){
                                while($odata = mysqli_fetch_assoc($lcresult)){
                                    echo "<option value= '". $odata["cturno"]."'>".$odata["cdesc"]."</option>";
                                }
                            }
                            $oConn->close();
                        ?>
                    </select>
                </div>

                <div id="informacion_2">
                    <label class="labeltitle" align="center">Fotografia del cliente</label><br>
                    <figure>
                        <img align= "center" id="cfoto1" name="cfoto1" src="" width="292" height="292" alt="Foto no especificada"><br>
                    </figure>
                    <br>
                    <input type="file"	name="cfoto" id="cfoto" >
                </div>
            </div>
            <!-- Configuracion de pago -->
            <div id="finfo2" class="tabcontent">
                <label class="labelnormal">Salario Mensual</label>
                <input type="number" id="nsalary" name="nsalary" class="textqty">
                <br>
                <label class="labelnormal">Costo Hora Ord.</label>
                <input type="number" id="nhrate" name="nhrate" class="textqty">
                <br>
                <label class="labelnormal">Costo Hora Extra</label>
                <input type="number" id="nhratext" name="nhratext" class="textqty">
                <br>
                <label class="labelnormal">Tipo de Empleado</label>
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
                <label class="labelnormal">Medio de pago</label>
                <select class="listas" name="ctyppay2" id="ctyppay2"> 
                    <option value="">Elija Medio de pago</option>    
                    <option value="E">Efectivo</option>    
                    <option value="T">Targeta / Banco deposito</option>    
                </select>
                <br>
                <label class="labelnormal">Septimo</label>
                <input type="number" id="nsetpay" name="nsetpay" class="textqty">
                <br>
                <label class="labelnormal">Numero INSS</label>
                <input type="text" id="cins" name="cins" class="textqty">
                <br>
                <input type="checkbox" id="lnotausent" name="lnotausent">No incluir en el calculo de ausentismo</input>

            </div>
            <!-- Deducciones e Ingresos -->
            <div id="finfo3" class="tabcontent">

                <table id="table_deducciones" >
					<thead>
						<tr class="table_det">
							<th width="70px">Ded Id</th>
							<th width="200px">Descripcion</th>
							<th width="75px">Monto / %</th>
							<th width="70px">Cuota</th>
							<th width="90px">Saldo</th>
							<th width="70px">Aplicar </th>
							<th width="70px">Omitir / NP</th>
							<th width="90px">Referencia </th>
						</tr>
					</thead>
					<tbody id="det_deducciones" class="mx_formato_datos"></tbody>
				</table>

                <input type="button" id="btadd" value="Adicionar">
          
                <table id="table_ingresos" >
					<thead>
						<tr class="table_det">
							<th width="70px">Ingreso ID</th>
							<th width="200px">Descripcion</th>
							<th width="75px">Monto / %</th>
							<th width="50px">Aplicar</th>
							<th width="70px">Omitir / NP</th>
						</tr>
					</thead>
					<tbody id="det_ingresos" class="mx_formato_datos"></tbody>
				</table>
                <input type="button" id="btadd2" value="Adicionar">
          
            </div>
            
        </form>
        <fieldset class="form2" id="add_deduction" name="add_deduction">
                <div class="barra_info">
					<h3>Creacion / Edicion Deducciones</h3>
		    	</div>
				<br>

                <label class="labelnormal">Identificador</label>
                <input type="text" id="cuid" readonly class="textkey">
                <br>
                <label class="labelnormal">Ded Id</label>
                <input type="text" id="cdedid1" class="textkey">
                <script>get_btmenu("btcdedid1","Listado de deducciones");</script>
                <br>
                <label class="labelnormal">Descripcion</label>
                <input type="text" name="cdesc_ded" id="cdesc_ded" readonly class="textcdescreadonly">
                <br>
                <label class="labelnormal">Monto</label>
                <input type="number" name="nvalue_d" id="nvalue_d"  class="textqty">
                <br>
                <label class="labelnormal">Cuota</label>
                <input type="number" name="npayamt" id="npayamt" class="textqty">
                <br>
                <label class="labelnormal">Referencia</label>
                <input type="text" name="crefno" id="crefno" class="textkey">
                <br>

                <!-- configurando las deducciones si aplican o no -->
                <label class="labelnormal">Aplicar</label>
                <select class="listas" id="lapply_d" name="lapply_d">
                    <option value=1>Aplica en esta planilla</option>
                    <option value=0>Omitir en esta planilla</option>
                </select>
                <br><br>
                <input type="button" class= "btbarra" id="btsalvar" value="Guardar">
                <input type="button" class= "btbarra" id="btquit_ded"  value="Salir">
        </fieldset>

        <fieldset class="form2" id="add_ingresos" name="add_ingresos">
                <div class="barra_info">
					<h3>Creacion / Edicion Ingresos</h3>
		    	</div>
				<br>

                <label class="labelnormal">Identificador</label>
                <input type="text" id="cuid_ing" readonly class="textkey">
                <br>
                <label class="labelnormal">Ing Id</label>
                <input type="text" id="cingid" class="textkey" >
                <script>get_btmenu("btcingid","Listado de ingresos");</script>
                <br>
                <label class="labelnormal">Descripcion</label>
                <input type="text" name="cdesc_ing" id="cdesc_ing" readonly class="textcdescreadonly">
                <br>
                <label class="labelnormal">Monto</label>
                <input type="number" name="nvalue_ing" id="nvalue_ing"  class="textqty">
                <br>

                <!-- configurando las deducciones si aplican o no -->
                <label class="labelnormal">Aplicar</label>
                <select class="listas" id="lapply_ing" name="lapply_ing">
                    <option value=1>Aplica en esta planilla</option>
                    <option value=0>Omitir en esta planilla</option>
                </select>
                <br><br>
                <input type="button" class= "btbarra" id="btsalvar_ing" value="Guardar">
                <input type="button" class= "btbarra" id="btquit_ing"  value="Salir">
        </fieldset>
        
        <div id="showmenulist"></div>    

		<script>
			get_msg();
		</script>

    </body>
</html>