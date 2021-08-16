<?php
session_start();
//PROBAND LOS CAMBIOS
require_once '/var/simplesamlphp/lib/_autoload.php';

$as = new SimpleSAML_Auth_Simple('default-sp');

if (isset($_GET['sso'])) {
        $as->requireAuth();
        $attributes = $as->getAttributes();
	 $_SESSION['AuthNRequestID'] = $attributes;

	if (empty($attributes)) {
             echo 'No se obtuvieron atributos del usuario';
         } else {
		$_SESSION["s_usuario"]=$_SESSION['AuthNRequestID']['uid'][0];
		$_SESSION["s_mail"]=$_SESSION['AuthNRequestID']['mail'][0];
		$_SESSION["s_tipo"]='I';
		header("Location: vistas/index.php");
         }

} else {
    echo '<p><a href="?sso" >Login</a></p>';
}

//$_SESSION["s_usuario"]=$_SESSION['AuthNRequestID']['uid'][0];
//var_dump($_SESSION['AuthNRequestID']['mail'][0]);
//var_dump($_SESSION["s_usuario"]);

?>

<!doctype html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="#" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ABM-Banco OVA</title>
    
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
    
    <link rel="stylesheet" href="plugins/sweet_alert2/sweetalert2.min.css">
</head>
<body>
    <div class="header">
  <img src="img/logo.jpg" />
  <div class="header-right">
                        <form id="formLogin" class="form-inline" action="" method="post">


                            <div class="form-group mx-sm-3 mb-2">
                                <label>Usuario</label>
                                <input type="text" name="usuario" id="usuario" class="form-control form-control-sm font-italic">
                                </div>
                              <div class="form-group mx-sm-3 mb-2">
                                Contraseña
                                <input type="password" name="password" id="password" class="form-control form-control-sm">
                                </div>
                            
                            <div class="form-group mb-2">                              
                                <input type="submit" name="submit" class="btn btn-primary mb-2" value="Conectar">
                            </div>  

                        </form>
  </div>
</div>
<br>
 
        <div class="container">    
                            <div class="content">
        

    <div class="content" align="center">
            <h3>Banco de Objetos Virtuales de Aprendizaje</h3>



            
    <img src="img/imagenova.gif" class="img-thumbnail" />
            

            <hr />
            

        </div>
    </div>
    </div>
    <center>
    <p>&copy; Banco de Objetos Virtuales de Aprendizaje-UNAJ <?php echo date("Y");?></p>
        </center>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
    <script src="plugins/sweet_alert2/sweetalert2.all.min.js"></script>
    <script src="codigo.js"></script>
</body>
</html>
