<?php

	if(isset($_POST["cpasword"])){

		include("../modelo/vc_funciones.php");
		vc_funciones::Star_session();
		$oConn = vc_funciones::get_coneccion("CIA");
		
		$lcPasWord = $_POST["cpasword"];
		// obteniendo datos del cliente
		$lcsqlcmd  = " select sum(artran.namount) as nsaldo,
                          		artran.ccustno, 
															arcust.cname,
															arcust.nlimcrd 
															from artran 
															join arcust on arcust.ccustno = artran.ccustno 
															where arcust.cpasword = '". $lcPasWord . "' GROUP by 2 ";
		
		/*	$lcresult = mysqli_query($oConn,$lcsqlcmd);
			$row 			= mysqli_fetch_assoc($lcresult);		
		*/
			$lcresult = mysqli_query($oConn,$lcsqlcmd);
			$row 	    = mysqli_fetch_assoc($lcresult);
			$lnDisp = $row["nlimcrd"] - $row["nsaldo"] ;
		if($row["cname"] == ""){
			echo "<h2>Clave invalida Cliente o Cliente no definido.</h2>";
		}	
		else{
			echo "<H2 id='titulo'>INFORMACION DE CUENTA:</h2>";
			echo "<table>";
			echo "<tr>";
			echo "  <td class='lbnormal'>NOMBRE</td>";
			echo "  <td class='lbdesc'><b>". $row["cname"] ."</b></td>";
			echo "</tr>";

			echo "<tr>";
			echo "  <td class='lbnormal'>SALDO</td>";
			echo "  <td class='lbdesc'><b>". $row["nsaldo"] ."</b></td>";
			echo "</tr>";

			echo "<tr>";
			echo "  <td class='lbnormal'>CREDITO APROBADO</td>";
			echo "  <td class='lbdesc'><b>". $row["nlimcrd"] ."</b></td>";
			echo "</tr>";

			echo "<tr>";
			echo "  <td class='lbnormal'>CREDITO DISPONIBLE</td>";
			echo "  <td class='lbdesc'><b>". $lnDisp ."</b></td>";
			echo "</tr>";

			echo "<tr>";
			echo "  <td class='lbnormal'>FECHA DE PAGO</td>";
			echo "  <td class='lbdesc'><b>No indicada</b></td>";
			echo "</tr>";

			echo "</table>";
			
		}
		//$lnRowsAfect = mysql_affected_rows($oConn);
		mysqli_close($oConn);
		//header("location:arcust.html");
	}
	



?>