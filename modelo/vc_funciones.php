<?PHP
	// mensajes generales de la aplicacion.
	CONST NOT_DATA_RPT = "<H3>No hay datos que coincidan con estos criterios.</H3>";
	CONST NOT_ALLOW_USER = "Usuario Denegado el Acceso";
CLASS vc_funciones{
	// obteniendo listado de menus de cualquier tabla en formato generico.
	
	// inicializa la funcion del lado del servidor.
	public static function arsetup_init(){
		$oConn = vc_funciones::get_coneccion("CIA");		
		$lcsqlcmd = "select * from arsetup ";
		$lcresult = mysqli_query($oConn,$lcsqlcmd);
		$oArSetup = mysqli_fetch_assoc($lcresult);
		// convirtiendo este array en archivo jason.
		return $oArSetup;
	}
	public static function initEntornoGeneral(){
		session_start();
		// definiendo variables.
		$_SESSION["cuserid"]   = "";
		$_SESSION["cpasword"]  = "";
		$_SESSION["cfullname"] = "";
		$_SESSION["cinvno"]    = "";
		$_SESSION["ccompid"]   = "";
		$_SESSION["compdesc"]  = "";
		$_SESSION["ctel"] 	   = "";
		$_SESSION["dbname"]    = "";
		$_SESSION["chost"]     = "";
		$_SESSION["ckeyid"]    = "";
		$_SESSION["cuser"]     = "";
		// datos del modulo contable.
		$_SESSION["cyearw"]  = "1972";
		$_SESSION["cperidw"] = "NO DEFINIDO TODABIA.";
	}
	public static function Star_session(){
		session_start();
		// Verificando la session.
		IF (isset($_SESSION["cuserid"])) {
			return false;
		}else{
			//echo "<SPAN STYLE='COLOR:YELLOW'> NO HA INICIADO SESSION </SPAN>";
			session_destroy();
			header("location:../index.php");
			return true;
		}
	}
	public static function End_session(){
		// cerrando sesion.
		session_destroy();
		header("location:index.php");
	}
	public static function init_index(){
		// cerrando sesion.
		/*
		session_destroy();
		session_start();
		*/
	}
	public static function getcialist(){
		$oConn = vc_funciones::get_coneccion("SYS");
		$lcSqlCiaList = " select ccompid, compdesc from syscomp where cstatus = 'OP'";
		$lcresult = mysqli_query($oConn,$lcSqlCiaList);
		echo "<select id='ccompid' name='ccompid'>";
			while ($rows = mysqli_fetch_assoc($lcresult)){
				echo "<option value ='". $rows["ccompid"] ."'>". $rows["compdesc"] ."</option>";
			}
		echo "</select>";
	}
	public static function get_coneccion($opc){	
		include("parameters_conection.php");
		// Iniciando la session si por alguna razon se apago.	
		IF (!isset($_SESSION["cuserid"])) {
			session_start();
		}	
		if($opc == 'SYS'){		
			$lcDbb=$oPSys;
			$oConn = mysqli_connect($gHostId,$gUserId,$gPasWord,$lcDbb);
		}else{
			// conectando con la compañia a la cual entro y esta definida en el sistema.
			$oConn = mysqli_connect($_SESSION["chost"],$_SESSION["cuser"],$_SESSION["ckeyid"],$_SESSION["dbname"]);
		}
		//if(!mysqli_connect_errno($oConn)){
		if(!mysqli_connect_errno()){
			mysqli_set_charset($oConn,"utf8");
		}else{
			echo "<br><br>";
			echo "<strong style='color:yellow;'>CONECCION NO ESTABLECIDA.</strong>";
		}
		return $oConn;
	}		
	public static function get_msg2(){
		echo '<section class="getmsgalert" id="getmsgalert">';
		echo '		<section id="stitle">';
		echo '			<STRONG>SISTEMA VISUAL CONTROL</STRONG>';
		echo '		</section>';
		echo '		<p id="msgerror"></p>';
		echo '		<br>';
		//echo '<script>get_btprinc("btquit","msgquit")</script> ';
		echo '	</section>';
	}
	public static function get_btn($pcname, $pcfoto, $pccaption, $pcplaceholder = "Accion no ilustrada" ){

		echo '<button class="btbarra" ';
		echo	'style="width:60px; height:60px" ';
		echo	'type="button" ';
		echo	'name="' . $pcname . '" id="' . $pcname . '" ';
		echo	'title=" '.$pcplaceholder .'"' ;
		echo	'accesskey="g"> ';
		echo	'<img style="width:30px; height:30px" src="../photos/'. $pcfoto. '" alt="x" /> ';
		echo	'<br>'. $pccaption;
		echo	'</button>';
	}
}
?>	