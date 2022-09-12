<?php
    include("../modelo/cgmodule.php");
    include("../modelo/vc_funciones.php");
    //use cgmodule;
    if (isset($_POST["accion"])){
        $laccion = $_POST["accion"];
    }
    if($laccion == "get_lista_periodos"){
        cgmodule::get_perid_list($_POST["cyear"]);
    }

    if($laccion == "set_change_cperid"){
        cgmodule::set_change_cperid($_POST["cperid"], $_POST["cyear"]);
    }   
?>