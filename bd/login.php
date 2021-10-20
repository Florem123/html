<?php
session_start();
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';

$pass = md5($password);

$consulta = "SELECT mail,usuario,tipo,activo,primeracceso
FROM user
WHERE usuario='$usuario' 
AND clave='$pass'
AND activo=1 ";	
$resultado = $conexion->prepare($consulta);
$resultado->execute(); 


if($resultado->rowCount() >= 1){ 
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    if($data["primeracceso"] == 1){
        echo'<script type="text/javascript">
            alert("Usted no ha accedido por primera vez a cambiar su clave inicial. Por favor revise su mail.");
            window.location.href="../index.php";
            </script>';      
    }else{
        $_SESSION["s_usuario"] = $usuario;
        $_SESSION["s_tipo"] = 'E';
        $_SESSION["s_mail"]=$data["mail"];
        $_SESSION['s_time'] = time();
        $tipo=$_SESSION["s_tipo"];
        $consulta2 ="INSERT INTO logs(usuario,tipo) VALUES('$usuario','$tipo')";
	$resultado2 = $conexion->prepare($consulta2);
	$resultado2->execute(); 
    }
}else{
    $_SESSION["s_usuario"] = null;  
    $data=null;
}

print json_encode($data);//envio el array final el formato json a AJAX
$conexion=null;
