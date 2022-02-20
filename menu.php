
<?php
    $lcid        = "bt_menu_salir";
    $pcpicture   = "./photos/salir.ico";
    $pcDescShort = "cerrar";

    $lcbt = '<button class="btbarra" 
                style="width:60px; height:60px" 
                type="button" 
                name="' . $lcid . '" id="' . $lcid . '" 
                title="" 
                accesskey="g"> 
                    <img style="width:30px; height:30px" src="' . $pcpicture . '" alt="x" /> 
                    <br>' . $pcDescShort .
            '</button>';

?>

<head>
	<title>Menu</title>
	<link rel="stylesheet" href="./css/vc_estilos.css?v1">
	<script src="./js/vc_funciones.js?v1"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<div class="menu_area_bloqueo" id="xm_area_menu">
	<div class="form_menu">
		<div class="menu_barra" id="mx_barra_sencilla">
			<strong id="mx_titulo">Listado de Menu generico</strong>
			<br>
			<label class="labelnormal">Ordenado por </label>
			<select class="listas">
                <option value=""> primer key </option>
                <option value="2"> segundo key </option>
            </select>
			<br>				
		
            <label class="labelnormal">Buscar</label>
			<input type="text" id="mx_cbuscar" name="mx_cbuscar" class="textnormal">
		</div>
		
        <br>
		
        <div>
			<table class="menu_encabezado">
                <tr>
                <th width="180px">Nombre completo</th>
                <th width="170px">Telefono</th>
                </tr>
            </table>
		</div>

        
		<div class="menu_area_detalles">
            <table  class="menu_detalles">
            <tr><td width="180px"> Eddy jiron guillen</td><td width="170px"> 9961-2627</td></tr>
                <tr><td width="180px"> Yosy jiron guillen</td><td width="170px"> 9961-2627</td></tr>
                <tr><td width="180px"> Ivan jiron guillen</td><td width="170px"> 9961-2627</td></tr>
                <tr><td width="180px"> Virginia jiron guillen</td><td width="170px"> 9961-2627</td></tr>
                <tr><td width="180px"> Eddy jiron guillen</td><td width="170px"> 9961-2627</td></tr>
                <tr><td width="180px"> Yosy jiron guillen</td><td width="170px"> 9961-2627</td></tr>
                <tr><td width="180px"> Ivan jiron guillen</td><td width="170px"> 9961-2627</td></tr>
                <tr><td width="180px"> Virginia jiron guillen</td><td width="170px"> 9961-2627</td></tr>
                <tr><td width="180px"> Eddy jiron guillen</td><td width="170px"> 9961-2627</td></tr>
                <tr><td width="180px"> Yosy jiron guillen</td><td width="170px"> 9961-2627</td></tr>
                <tr><td width="180px"> Ivan jiron llen</td><td width="170px"> 9961-2627</td></tr>
                <tr><td width="180px"> Virginia jiron guillen</td><td width="170px"> 9961-2627</td></tr>
                <tr><td width="180px"> Eddy jiron guillen</td><td width="170px"> 9961-2627</td></tr>
                <tr><td width="180px"> Yosy jiron guillen</td><td width="170px"> 9961-2627</td></tr>
                <tr><td width="180px"> Ivan jiron guillen</td><td width="170px"> 9961-2627</td></tr>
                <tr><td width="180px"> Virginia jiron guillen</td><td width="170px"> 9961-2627</td></tr>
            </table>
		</div>
        
        <div class="contenedor_objetos">    
            <?php echo $lcbt; ?>
        </div>
	</div>
</div>
