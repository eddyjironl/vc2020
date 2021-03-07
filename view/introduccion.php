<link rel="stylesheet" href="../css/introduccion.css">
<div class="informacion" id="form_introduccion">
	<div class="star_dv">
		<h1> INTRODUCCION AL USO DEL PROGRAMA</h1>
		
	</div>

	<div class="instructions">
	
		<h1>DATOS DE CONECCION PARA LAS EMPRESAS</h1>
		<?php
			echo $_SESSION["compdesc"] ."<BR>";
			echo $_SESSION["dbname"] ."<BR>";
			echo $_SESSION["chost"] ."<BR>";
			echo $_SESSION["ckeyid"] ."<BR>";
			echo $_SESSION["cuser"] ."<BR>";
			
		
		
		?>
		
		
		

		<H2> DOS PASOS A SEGUIR </h2><br>
		<p> 1)- Elija en la parte de arriba una compañia haciendo click en la lupa amarilla de la etiqueta compañia.</p>
		<br>
		<p> 2)- En la etiqueta Sistema, elija de la lista un modulo de trabajo, despues podra iniciar a navergar en el modulo</p>
		<input type="button" value="Entendido !" id="btok">
	</div>
</div>