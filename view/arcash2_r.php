<html>
	<head>
		<title>Vencimiento de Cartera </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/vc_estilos.css"> 
		<!--<link rel="stylesheet" href="../css/arcash2_r.css"> -->
 		<script src="../js/vc_funciones.js"></script> 
 		<script src="../js/arcash2_r.js"></script> 
	</head>
	<body>
		<form target="_blank" method="POST" action="../reports/rpt_arcash2.php" id="arcash2_r" name="arcash2_r" class= "form2">
			<script> get_barraprint("Vencimiento de Cartera");</script>
			<fieldset class="fieldset" id="area_visualizaciones">
				<label class="labelsencilla">Visualizacion</label>
				<br>
				<label class="labelnormal">Presentacion </label>
				<select id="cgrupo" name="cgrupo" class="listas">
					<option value = "1">Detallado</option>
					<option value = "2">Agrupado</option>
				</select>

    			<br>
				<label class="labelnormal">Ordenamiento por </label>
				<select id="corden" name="corden" class="listas">
					<option value = "''">Listado General</option>
					<option value = "crespno">Por Vendedor</option>
					<option value = "ccustno">Por Cliente</option>
				</select>
			</fieldset>
			<br>
			<fieldset id="area_filtros" class="fieldset">
					<label class= "labelsencilla">Area de Filtro</label>
					<br>
						<label class = "labelfiltro">Vendedor ID</label>
						<input type="text" id="crespno_1"  name="crespno_1" class="ckey">
						<script>get_btmenu("btcrespno_1","Lista de Proveedores"); </script>
						<input type="text" id="crespno_2"  name="crespno_2" class="ckey">
						<script>get_btmenu("btcrespno_2","Lista de Proveedores"); </script>
    				<br>
                        <label class = "labelfiltro">Bodega</label>
						<input type="text" id="cwhseno_1"  name="cwhseno_1" class="ckey">
						<script>get_btmenu("btcwhseno_1","Lista de Bodegas"); </script>
						<input type="text" id="cwhseno_2"  name="cwhseno_2" class="ckey">
						<script>get_btmenu("btcwhseno_2","Lista de Bodegas"); </script>
					<br>
                        <label class = "labelfiltro">Condicione / Pago</label>
						<input type="text" id="cpaycode_1"  name="cpaycode_1" class="ckey">
						<script>get_btmenu("btcpaycode_1","Condiciones de Pago en Factura"); </script>
						<input type="text" id="cpaycode_2"  name="cpaycode_2" class="ckey">
						<script>get_btmenu("btcpaycode_2","Condiciones de Pago en Factura"); </script>
                    </br>
						<label class = "labelfiltro">Factura No</label>
						<input type="text" id="cinvno_1"  name="cinvno_1" class="ckey">
						<script>get_btmenu("btcinvno_1","Lista de Facturas"); </script>
						<input type="text" id="cinvno_2"  name="cinvno_2" class="ckey">
						<script>get_btmenu("btcinvno_2","Lista de Facturas"); </script>
                    </br>
						<label class = "labelfiltro">Cliente Id</label>
						<input type="text" id="ccustno_1"  name="ccustno_1" class="ckey">
						<script>get_btmenu("btccustno_1","Lista de Clientes"); </script>
						<input type="text" id="ccustno_2"  name="ccustno_2" class="ckey">
						<script>get_btmenu("btccustno_2","Lista de Clientes"); </script>
                   
                    </br>

					<label class="labelfiltro">Referencia</label>
					<input type="text" id="crefno" name="crefno">
					<br>

					<label class="labelfiltro">Fecha Emision </label>
					<input type="date" id="dstar_1" name="dstar_1" >
					<input type="date" id="dstar_2" name="dstar_2" >
					<br>
					<!-- -->
				</fieldset>
		</form>
		
		<script>get_xm_menu();
				get_msg();
		</script>
		
	</body>
</html>