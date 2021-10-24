<html>
	<head>
		<title>Reimpresion de Facturas</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/vc_estilos.css"> 
		<link rel="stylesheet" href="../css/arinvc_r.css"> 
 		<script src="../js/vc_funciones.js"></script> 
 		<script src="../js/arinvc_r.js"></script> 
	</head>
	<body>
		<form target="_blank" method="POST" action="../reports/rpt_arinvc_tiquete.php" id="arinvc_r" name="arinvc_r" class= "form2">
			<script> get_barraprint("Reimpresion de Facturas","Ayuda Formulario de Factura");</script>
    		<br>
			<fieldset id="area_filtros" class="fieldset">
					<label class = "labelfiltro">Factura No</label>
					<input type="text" id="ctrnno1" name="ctrnno1" class="ckey">
					<script>get_btmenu("btcinvno","Lista de Facturas"); </script>				
			</fieldset>
		</form>
		
		<script>get_xm_menu();
				get_msg();
				//get_btdtrn("btprint2","Imprimiendo reporte", "../reports/rpt_arinvc.php");aradjm_r
		</script>
		
	</body>
</html>