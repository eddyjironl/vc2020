<html>
	<head>
		<title>Resumen de Entradas y Salidas</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/vc_estilos.css"> 
		<link rel="stylesheet" href="../css/aradjt_r.css"> 
 		<script src="../js/vc_funciones.js"></script> 
 		<script src="../js/aradjt_r.js"></script> 
	</head>
	<body>
		<form target="_blank" method="POST" action="../reports/rpt_aradjt.php" id="aradjt_r" name="aradjt_t" class= "form2">
			<script> get_barraprint("Resumen Entradas y Salidas","Resumen Entradas y Salidas");</script>
			<fieldset class="fieldset" id="area_visualizaciones">
				<label class="labelsencilla">Visualizacion</label>
				<br>
				<!--
				<fieldset id="botones">
					<input type="radio" id="detalle" name="cgrupo" value="1" checked>Detallado
    				<br>
					<input type="radio" id="agrupado" name="cgrupo" value="2">Subtotales
				</fieldset>
				-->
				<label class="labelnormal">Presentacion </label>
				<select id="cgrupo" name="cgrupo" class="listas">
					<option value = "1">Detallado</option>
					<option value = "2">Agrupado</option>
				</select>

    			<br>
				<label class="labelnormal">Ordenamiento por </label>
				<select id="corden" name="corden" class="listas">
					<option value = "''">Listado General</option>
					<option value = "crespno">Por Proveedor</option>
					<option value = "ccateno">Por Tipo Requisa</option>
					<option value = "cwhseno">Por Bodega</option>
					<option value = "dtrndate">Por Fecha Requisa</option>
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
                        <label class = "labelfiltro">Tipo Requisa</label>
						<input type="text" id="ccateno_1"  name="ccateno_1" class="ckey">
						<script>get_btmenu("btccateno_1","Lista de Tipo de Requisa"); </script>
						<input type="text" id="ccateno_2"  name="ccateno_2" class="ckey">
						<script>get_btmenu("btccateno_2","Lista de Tipos de Requisa"); </script>
    				<br>
                        <label class = "labelfiltro">Bodega</label>
						<input type="text" id="cwhseno_1"  name="cwhseno_1" class="ckey">
						<script>get_btmenu("btcwhseno_1","Lista de Bodegas"); </script>
						<input type="text" id="cwhseno_2"  name="cwhseno_2" class="ckey">
						<script>get_btmenu("btcwhseno_2","Lista de Bodegas"); </script>
                    </br>

					<label class="labelfiltro">Referencia</label>
					<input type="text" id="crefno" name="crefno">
					<br>

					<label class="labelfiltro">Fecha Emision </label>
					<input type="date" id="dtrndate_1" name="dtrndate_1" >
					<input type="date" id="dtrndate_2" name="dtrndate_2" >
					<br>
					<!-- -->
				</fieldset>
		</form>
		
		<script>get_xm_menu();
				get_msg();
		</script>
		
	</body>
</html>