<html>
	<head>
		<title>Maximos y Minimos</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/vc_estilos.css"> 
		<link rel="stylesheet" href="../css/arserm2_r.css"> 
 		<script src="../js/vc_funciones.js"></script> 
 		<script src="../js/arserm2_r.js"></script> 
	</head>
	<body>
		<form target="_blank" method="POST" action="../reports/rpt_arserm2.php" id="arserm2_r" name="arserm2_r" class= "form2">
			<script> get_barraprint("Maximos y Minimos de Inventarios","Maximos y Minimos de Inventarios");</script>
			<fieldset class="fieldset" id="area_visualizaciones">
				<label class="labelsencilla">Visualizacion</label>
				<br>
				<!--
				    <fieldset id="botones">
					<input type="radio" id="detalle" name="cgrupo" value="1" checked>Detallado
    				<br>
					<input type="radio" id="agrupado" name="cgrupo" value="2">Subtotales
				    </fieldset>
				
				    <label class="labelnormal">Presentacion </label>
				    <select id="cgrupo" name="cgrupo" class="listas">
					    <option value = "1">Detallado</option>
				    </select>

    			    <br>
				-->    
				<label class="labelnormal">Ordenamiento por </label>
				<select id="corden" name="corden" class="listas">
					<option value = "''">Por Bodega</option>
					<option value = "crespno">Por Proveedor</option>
					<option value = "ctserno">Por Tipo Articulo</option>
				</select>
			</fieldset>
			<br>
			<fieldset id="area_filtros" class="fieldset">
					<label class= "labelsencilla">Area de Filtro</label>
					<br>
						<label class = "labelfiltro">Proveedor ID</label>
						<input type="text" id="crespno_1"  name="crespno_1" class="ckey">
						<script>get_btmenu("btcrespno_1","Lista de Proveedores"); </script>
						<input type="text" id="crespno_2"  name="crespno_2" class="ckey">
						<script>get_btmenu("btcrespno_2","Lista de Proveedores"); </script>
					<br>
                        <label class = "labelfiltro">Tipo Articulo</label>
						<input type="text" id="ctserno_1"  name="ctserno_1" class="ckey">
						<script>get_btmenu("btctserno_1","Lista de Tipos de Articulos"); </script>
						<input type="text" id="ctserno_2"  name="ctserno_2" class="ckey">
						<script>get_btmenu("btctserno_2","Lista de Tipos de Articulos"); </script>
    				
					<br>
                        <label class = "labelfiltro">Bodega</label>
						<input type="text" id="cwhseno_1"  name="cwhseno_1" class="ckey">
						<script>get_btmenu("btcwhseno_1","Lista de Bodegas"); </script>
						<input type="text" id="cwhseno_2"  name="cwhseno_2" class="ckey">
						<script>get_btmenu("btcwhseno_2","Lista de Bodegas"); </script>
					<!-- -->
					<br><br>
					<label class="labelnormal">Mostrar </label>
					<select id="cver" name="cver" class="listas">
						<option value = "''">Todos los Articulos</option>
						<option value = "1">Por debajo del Minimo</option>
						<option value = "2">Por Encima del Maximo</option>
					</select>

				</fieldset>
		</form>
		
		<script>get_xm_menu();
				get_msg();
		</script>
		
	</body>
</html>