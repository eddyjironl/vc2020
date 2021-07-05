<html>
	<head>
		<title>Lista de Precios</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/vc_estilos.css"> 
		<link rel="stylesheet" href="../css/arserm_r.css"> 
 		<script src="../js/vc_funciones.js"></script> 
 		<script src="../js/arserm_r.js"></script> 
	</head>
	<body>
		<form target="_blank" method="POST" action="../reports/rpt_arserm.php" id="arserm_r" name="arserm_r" class= "form2">
			<script> get_barraprint("Lista de Precios","Ayuda Lista de Precios.");</script>
			<fieldset class="fieldset" id="area_visualizaciones">
				<label class="labelnormal">Ordenamiento por </label>
				<select id="corden" name="corden" class="listas">
                    <option value = "cservno">Por Codigo Articulo</option>
                    <option value = "cdesc">Por Descripcion</option>
					<option value = "ctserno">Por Tipo de Articulo</option>
					<option value = "ccateno">Por Categoria</option>
				</select>
			</fieldset>
			<br>
			<fieldset id="area_filtros" class="fieldset">
					<label class= "labelsencilla">Area de Filtro</label>
					<br>
						<label class = "labelfiltro">Proveedor id</label>
						<input type="text" id="crespno_1" name="crespno_1" class="ckey">
						<script>get_btmenu("btcrespno_1","Lista de Responsables"); </script>
						<input type="text" id="crespno_2" name="crespno_2" class="ckey">
						<script>get_btmenu("btcrespno_2","Lista de Responsables"); </script>
					<br>
						<label class="labelfiltro">Tipo de Articulo</label>
						<input type="text" id="ctserno_1" name="ctserno_1" class="ckey">
						<script>get_btmenu("btctserno_1","Lista de Tipos de Articulos"); </script>
						<input type="text" id="ctserno_2" name="ctserno_2" class="ckey">
						<script>get_btmenu("btctserno_2","Lista de Tipos de Articulos"); </script>
					<br>
					<label class="labelfiltro">Categoria</label>
                    <select class="listas" id="citemtype" name="citemtype">
                        <option value="">Cualquier Categoria</option>
						<option value="PT">Bienes / Productos Terminados</option>
						<option value="SV">Servicios</option>
						<option value="MP">Materia Prima / Insumo</option>
						<option value="AC">Acticulo Compuesto</option>
                    </select>    
					<br>
					<label class="labelfiltro">Estado</label>
                    <select class="listas" id="cstatus" name="cstatus">
						<option value="">Elija un Estado</option>
						<option value="OP">Activo</option>
						<option value="CL">Desactivado</option>
					</select>                  
                    <br>
					<input type="checkbox" id="llshowcost"    name="llshowcost">Mostrar costos</input>
					<br>
					<input type="checkbox" id="llshowonhand"  name="llshowonhand">Mostrar Existencia</input>
				</fieldset>
		</form>
		<script>get_xm_menu();
				get_msg();
				//get_btdtrn("btprint2","Imprimiendo reporte", "../reports/rpt_arinvc.php");
		</script>
		
	</body>
</html>