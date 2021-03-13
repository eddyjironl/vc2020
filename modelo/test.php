<?php
	
	include("../modelo/vc_funciones.php");
	if (vc_funciones::Star_session() == 1){
		return;
	}
	$oConn = vc_funciones::get_coneccion("CIA");
	if (!empty($_POST["ckey"])){
		$lcsql = " insert into arcust( ccustno,cname) values('".$_POST['ckey']."','registro manual')";
		$lcresult = mysqli_query($oConn,$lcsql);
	}else{
		$lcsql = " select * from arcust ";
		$lcresult = mysqli_query($oConn,$lcsql);
		// sacando datos.
		while ($lcrow = mysqli_fetch_assoc($lcresult))
		{
			echo $lcrow["ccustno"]. ' - '. $lcrow["cname"]. '<br>';
		}
	}
?>