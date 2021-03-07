<?php
include("coneccion.php");
	function getcialist(){
		$oConn = get_coneccion("SYS");
		$lcSqlCiaList = " select ccompid, compdesc from syscomp where cstatus = 'OP'";
		$lcresult = mysqli_query($oConn,$lcSqlCiaList);
		echo "<label>Elija Empresa</label>";
		echo "<select id='ccompid'>";
			while ($rows = mysqli_fetch_assoc($lcresult)){
				echo "<option value ='". $rows["ccompid"] ."'>". $rows["compdesc"] ."</option>";
			}
		echo "</select>";
	}


?>