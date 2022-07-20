<html lang="es">
	<head> 
		<title>Importacion de datos</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

        <!-- Latest compiled and minified CSS -->
       <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">  -->
        <link rel="stylesheet" href="../css/vc_estilos.css"> 

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	</head>
	<body>
            <form action="../modelo/import_data.php" method="post" id="filesForm" class="form2" >
                <div class="barra_info">
                     <strong>Importacion de Catalogos del Sistema </strong>
                </div>
                <div class="contenedor_objetos">
                    <label class="labelnormal"> Tipo de Importacion </label>
                    <select class="listas" id="coption">
                        <option value ="">Elija una Accion</option>
                        <option value ="htserv"> Catalogo de productos</option>
                        <option value ="arcust"> Catalogo de Clientes</option>
                    </select>
                    <br>
                    <input type="file" name="fileContacts" >
                    <div class="contenedor_objetos">
                        <button type="button" onclick="uploadContacts()"  id="btcargar" >Cargar</button>
                        <!-- class="btn btn-primary form-control" -->
                        <button type="button" onclick="closescreen()" >Cerrar</button>
                    </div>
                </div>
            </form>
    </body>

</html>
<style>
    .btn-food{
        margin-top: 50px;
        margin-left: 33%;
        margin-bottom:5px;
    }
    h1{
        margin-left:33%;
    }
</style>

<script type="text/javascript">
    function closescreen(){
        document.getElementById("filesForm").style.display="none";
    }
    function uploadContacts()
    {
        // validaciones previas 
        if(document.getElementById("coption").value == ""){
            alert("Elija que accion realizara");
            return; 
        }
       

        var Form = new FormData($('#filesForm')[0]);
        Form.append("accion",document.getElementById("coption").value);
        $.ajax({

            url: "../modelo/import_data.php",
            type: "post",
            data : Form,
            processData: false,
            contentType: false,
            success: function()
            {
                document.getElementById("filesForm").style.display="none";
            }
        });
    }

</script>