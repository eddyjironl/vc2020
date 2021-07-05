<?PHP

CLASS vc_funciones{
	// inicializa la funcion del lado del servidor.
	public static function arsetup_init(){
		$oConn = vc_funciones::get_coneccion("CIA");		
		$lcsqlcmd = "select * from arsetup ";
		$lcresult = mysqli_query($oConn,$lcsqlcmd);
		$oArSetup = mysqli_fetch_assoc($lcresult);
		// convirtiendo este array en archivo jason.
		return $oArSetup;
	}

	public static function Star_session(){
		// iniciando session
		session_start();
		// Verificando la session.
		IF (isset($_SESSION["cuserid"])) {
			//session_start();
			return false;
		}else{
			//echo "<SPAN STYLE='COLOR:YELLOW'> NO HA INICIADO SESSION </SPAN>";
			header("location:../index.php");
			return true;
		}
	}
	public static function End_session(){
		// iniciando session
		session_start();
		// cerrando sesion.
		session_destroy();
		//llamando el login.
		header("location:index.php");
	}
	public static function init_index(){
		session_start();
		// cerrando sesion.
		session_destroy();
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
			$oConn = mysqli_connect($_SESSION["chost"],$_SESSION["cuser"],$_SESSION["ckeyid"],$_SESSION["dbname"]);
		}
		//if(!mysqli_connect_errno($oConn)){
		if(!mysqli_connect_errno()){
			mysqli_set_charset($oConn,"utf8");
		}else{
			echo "Coneccion NO Establecida.";
		}
		return $oConn;
	}		
	public static function get_msg2(){
		/*
		var lcbt  = '<button class="btbarra" ';
		lcbt +=	'style="width:60px; height:60px" ';
		lcbt +=	'type="button" ';
					lcbt +=	'name="' + lcid + '" id="' + lcid + '" ';
			lcbt +=	'title="Cierra la pantalla" ';
			lcbt +=	'accesskey="s"> ';
			lcbt +=	'<img style="width:30px; height:30px" src="../photos/salir.ico" alt="x" /> '
			lcbt +=	'<br>Salir ';
			lcbt +=	'</button>';
		*/
		echo '<section class="getmsgalert" id="getmsgalert">';
		echo '		<section id="stitle">';
		echo '			<STRONG>SISTEMA VISUAL CONTROL</STRONG>';
		echo '		</section>';
		echo '		<p id="msgerror"></p>';
		echo '		<br>';
		//echo '<script>get_btprinc("btquit","msgquit")</script> ';
		echo '	</section>';
	}
}
?>	