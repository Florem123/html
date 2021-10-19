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
        $_SESSION['s_time'] = time();
        header("Location: vistas/index.php");
         }

}

?>

<!doctype html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="img/iconunaj.ico" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Banco OVA Unaj</title>
    
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="estilos.css">
    
    <link rel="stylesheet" href="plugins/sweet_alert2/sweetalert2.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" role="navigation">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="img/logo-transparente.png" height="40"></a>
        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
            &#9776;
        </button>
        <div class="collapse navbar-collapse" id="exCollapsingNavbar">
            <ul class="nav navbar-nav">
                <li class="nav-item"><a href="whats.php" class="nav-link">¿Qué son los OVA?</a></li>
            </ul>
            <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
                <li class="dropdown order-1">
                    <button type="button" id="dropdownMenu1" data-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle">Iniciar Sesión <span class="caret"></span></button>
                    <ul class="dropdown-menu dropdown-menu-right mt-2">
                       <li class="px-3 py-2">
                           <form class="form" role="form" id="formLogin" action="" method="post">
                                <div class="form-group">
                                    <a href="?sso" class="btn btn-dark btn-block"><img src="img/logopeque2.png" height="25"> Usuario UNAJ</a>
                                </div>
                                <div class="form-group">
                                    <input name="usuario" id="usuario" placeholder="Usuario" class="form-control form-control-sm" type="text" required="">
                                </div>
                                <div class="form-group">
                                    <input name="password" id="password" placeholder="Clave" class="form-control form-control-sm" type="password" required="">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary btn-block">Ingresar</button>
                                </div>
                                <div class="form-group text-center">
                                    <small><a href="registro.php">Registrarse</a></small>
                                </div>
                                <div class="form-group text-center">
                                    <small><a href="olvidemiclave.php">Olvidé mi clave</a></small>
                                </div>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<br><br><br>
 
        <div class="container">    
                            <div class="content">
        

    <div class="content" align="center">
            <h3>Banco de Objetos Virtuales de Aprendizaje</h3>



            
    <img src="img/imagenova.gif" class="img-thumbnail" width="700" height="700" />
            

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
