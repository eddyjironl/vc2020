<?PHP



if (isset($_POST["accion"])){
	get_list_ccustno($_POST["ccustno"]);
}

function get_list_ccustno($pcubino){
    $llcont=class_exists("vc_funciones")== false; 
    if ($llcont) {
        include("vc_funciones.php");
    }
	$oConn = vc_funciones::get_coneccion("CIA");
	
	echo "<select id='ccustno' name='ccustno'>";
	if($pcubino == ""){
		echo "<option value=''>Clientes Indefinidos</option>";
	}else{
		echo "<option value=''>Cliente ???</option>";
		$lcSqlCmd = " select ccustno, cname from arcust where cubino='$pcubino'";
		$lcresult = mysqli_query($oConn,$lcSqlCmd);
		while ($rows = mysqli_fetch_assoc($lcresult)){
			echo "<option value ='". $rows["ccustno"] ."'>". $rows["cname"] ."</option>";
		}
	}
	echo "</select>";
}

function get_list_arubim(){
	$oConn = vc_funciones::get_coneccion("CIA");
	echo "<select id='cubino' name='cubino'>";
	echo "<option value=''>Seleccine Ruta</option>";
	$lcSqlCmd = " select cubino, cdesc from arubim";
	$lcresult = mysqli_query($oConn,$lcSqlCmd);
	while ($rows = mysqli_fetch_assoc($lcresult)){
		echo "<option value ='". $rows["cubino"] ."'>". $rows["cdesc"] ."</option>";
	}
	echo "</select>";
}

?>