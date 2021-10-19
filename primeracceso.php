<?php
include("vistas/conexion.php");


// escaping, additionally removing everything that could be (html/javascript-) code
$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));

$sql = mysqli_query($con, "SELECT * FROM user WHERE id='$nik'");
if(mysqli_num_rows($sql) == 0){
	header("Location: index.php");
}else{
	$row = mysqli_fetch_assoc($sql);
}
			
if(isset($_POST['submit'])){
  $passvieja= mysqli_real_escape_string($con,(strip_tags($_POST["passvieja"],ENT_QUOTES)));
	$password= mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES)));
  $password2= mysqli_real_escape_string($con,(strip_tags($_POST["password2"],ENT_QUOTES)));

  if( $row['primeracceso'] == 0){
     if( $row['clave'] == $passvieja && $password==$password2 ){
				$primeracceso=1;
        $p= md5($password);
	$u = mysqli_query($con, "UPDATE user SET clave='$p',primeracceso='$primeracceso' WHERE id='$nik'") or die(mysqli_error());
        echo'<script type="text/javascript">
        alert("Clave cambiada con éxito");
        window.location.href="index.php";
        </script>';
       }else{
		echo'<script type="text/javascript">
            alert("Revise los campos ingresados");
            </script>';
			}
  }else{
		echo'<script type="text/javascript">
            alert("Usted ya ha cambiado su clave inicial");
            window.location.href="index.php";
            </script>';
	}
}
			
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="shortcut icon" href="img/iconunaj.ico" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cambio clave</title>
    
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="vistas/css/style_nav.css">

    
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
                <li class="nav-item"><a href="#" class="nav-link">Acerca</a></li>
                <li class="nav-item"><a href="#" class="nav-link">¿Qué son los OVA?</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Contáctenos</a></li>
            </ul>
        </div>
    </div>
</nav>
	<div class="container">
		<div class="content">
					
    <div id="cambiopass">
	    <br><br>
        <h4 class="text-center text-white display-5">Bienvenida/o <?php echo $row['nombre']." ".$row['apellido']; ?> </h4>
           <div class="container">                        
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12  bg-light text-dark">
                        <form id="formPass" class="form" action="" method="post">
                            <div class="form-group">
                                <label for="passvieja" class="text-dark">Contraseña actual</label><br>
                                <input type="password" name="passvieja" id="passvieja" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-dark">Contraseña nueva</label><br>
                                <input type="password" name="password" id="password" minlength="8" class="form-control">
                            </div>
                          <div class="form-group">
                                <label for="password2" class="text-dark">Confirme contraseña nueva</label><br>
                                <input type="password" name="password2" id="password2" minlength="8" class="form-control">
                            </div>
                            <div class="form-group text-center">                                
                                <input type="submit" name="submit" class="btn btn-dark btn-lg btn-block" value="Cambiar">
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

</body>
</html>
