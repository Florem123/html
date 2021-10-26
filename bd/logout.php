<?php
session_start();
$saml_lib_path = '/var/simplesamlphp/lib/_autoload.php';
require_once $saml_lib_path;
include_once 'conexion.php';
$flag=true;


$usuario= $_SESSION["s_usuario"];
$tipo=$_SESSION["s_tipo"];
date_default_timezone_set("America/Argentina/Buenos_Aires");
$fecha_actual=date("Y-m-d H:i:s");
$obs='Salida';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


	

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
	session_destroy();
	if($flag==true){
		$consulta2 ="INSERT INTO logs(usuario,tipo,fecha_logueo,obs) VALUES('$usuario','$tipo','$fecha_actual','$obs')";
		$resultado2 = $conexion->prepare($consulta2);
		$resultado2->execute();
		$flag=false;
		}
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
