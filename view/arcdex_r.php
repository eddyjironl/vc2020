<html>
	<head>
		<title>Analisis de Kardex</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/vc_estilos.css"> 
 		<script src="../js/vc_funciones.js"></script> 
 		<script src="../js/arcdex_r.js"></script> 
	</head>
	<body>
		<form target="_blank" method="POST" action="../reports/rpt_arcdex.php" id="arcdex_r" name="aradjt_t" class= "form2">
			<script> get_barraprint("Analisis de Kardex","Analisis de Kardex");</script>
			<fieldset id="area_filtros" class="fieldset">
					<label class= "labelsencilla">Area de Filtro</label>
					<br>
						<label class = "labelfiltro">Articulo Id</label>
						<input type="text" id="cservno_1"  name="cservno_1" class="ckey">
						<script>get_btmenu("btcservno_1","Lista de Articulos"); </script>
    				<br>
                        <label class = "labelfiltro">Bodega</label>
						<input type="text" id="cwhseno_1"  name="cwhseno_1" class="ckey">
						<script>get_btmenu("btcwhseno_1","Lista de Bodegas"); </script>
						<input type="text" id="cwhseno_2"  name="cwhseno_2" class="ckey">
						<script>get_btmenu("btcwhseno_2","Lista de Bodegas"); </script>
                    </br>
                    <label class="labelfiltro">Fechas</label>
					<input type="date" id="dtrndate_1" name="dtrndate_1" >
					<input type="date" id="dtrndate_2" name="dtrndate_2" >
					<br>
					<!-- -->
				</fieldset>
		</form>
        <div id="showmenulist"></div>
		<script>
			get_msg();
		</script>
		
	</body>
</html>