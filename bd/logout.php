<?php
session_start();
include("vistas/conexion.php");
$saml_lib_path = '/var/simplesamlphp/lib/_autoload.php';
require_once $saml_lib_path;

if ($_SESSION["s_tipo"]== 'I'){
    	 //check for sso session and invalidate
    	 $as = new \SimpleSAML_Auth_Simple('default-sp');
    	 if ($as->isAuthenticated()) {
        	 $as->logout();
    	 }
	unset($_SESSION["s_usuario"]);
    unset($_SESSION["s_tipo"]);
    unset($_SESSION["s_mail"]);
	unset($_SESSION["s_time"]);
	$idlog=$_SESSION["s_idlog"];
	date_default_timezone_set("America/Argentina/Buenos_Aires");
	$fin=date("Y-m-d H:i:s");
	$update = mysqli_query($con, "UPDATE logs SET  fecha_logout='$fin'
	WHERE id='$idlog'") or die(mysqli_error());	 
	unset($_SESSION["s_idlog"]);
	session_destroy();
	header("Location: ../index.php");
} elseif ($_SESSION["s_tipo"] == 'E'){
        unset($_SESSION["s_usuario"]);
        unset($_SESSION["s_tipo"]);
        unset($_SESSION["s_idRol"]);
        unset($_SESSION["s_rol_descripcion"]);
	unset($_SESSION["s_time"]);
        session_destroy();
        header("Location: ../index.php");
}

?>
