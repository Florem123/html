<?php
session_start();
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
	session_destroy();
	header("Location: ../index.php");
} elseif ($_SESSION["s_tipo"] == 'E'){
        unset($_SESSION["s_usuario"]);
        unset($_SESSION["s_tipo"]);
        unset($_SESSION["s_idRol"]);
        unset($_SESSION["s_rol_descripcion"]);
        session_destroy();
        header("Location: ../index.php");
}

?>
