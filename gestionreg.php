<?php
include("vistas/conexion.php");

use PHPMailer\PHPMailer\PHPMailer;
use visPHPMailer\PHPMailer\Exception;

require 'vistas/mail/Exception.php';
require 'vistas/mail/PHPMailer.php';
require 'vistas/mail/SMTP.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="shortcut icon" href="#" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registro de Usuarios</title>
    
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
					
			<?php

			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
			
			$sql = mysqli_query($con, "SELECT * FROM user WHERE id='$nik'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			



	if(isset($_POST['add'])){

				$activo=1;
				$email= $row['mail'];
				$pass= $row['clave'];
				$usuario= $row['usuario'];
				$link ='http://ovasunaj.informatica.unaj.edu.ar/primeracceso.php?nik='.$nik;
				$u = mysqli_query($con, "UPDATE user SET activo='$activo' WHERE id='$nik'") or die(mysqli_error());

        $mail2 = new PHPMailer(true);

        try {
            //MAIL AL USUARIO QUE SE REGISTRA
            $mail2->isSMTP();                                            //Send using SMTP
            $mail2->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail2->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail2->Username   = 'mailerovaunaj@gmail.com';                     //SMTP username
            $mail2->Password   = 'Mailerunaj21';                               //SMTP password
            $mail2->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail2->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail2->setFrom('mailerovaunaj@gmail.com', 'OvaUnaj');
            $mail2->addAddress($email);     //Add a recipient

            //Content
            $mail2->isHTML(true);                                  //Set email format to HTML
            $mail2->Subject = 'ACTIVACIÓN DE USUARIO OVA UNAJ';
            $mail2->Body    = 'HOLA '.$nombre.' '.$apellido.'!. GRACIAS POR REGISTRARSE AL BANCO DE OVA UNAJ, YA PODÉS ACCEDER. TUS DATOS PARA ACCEDER SON: <br>USUARIO: '.$usuario.'<br>CLAVE: '.$pass.'<br> Ingresá a  '.$link.' para cambiar tu clave inicial';

            $mail2->send();



        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        
        echo  "<script type='text/javascript'>";
        echo "window.close();";
        echo "</script>";
     }

			?>
			<form method="post">
					<br><br><br>
					<p class="titulo2">Registro de:</p></br>

					<p class="titulo"><?php echo $row['nombre']." ".$row['apellido']; ?></p>
					<pre>El correo electrónico con el que se registra es: <?php echo $row ['mail']; ?></pre>
					<pre>La institución a la que pertenece es: <?php echo $row ['institucion']; ?></pre>
					
		      <div class="form-group">
              <label class="col-sm-3 control-label">¿Desea regitrar a este usuario?</label>
              <div class="col-sm-6">
                  <input type="submit" name="add" class="btn btn-sm btn-success" value="Aceptar Solicitud">
                  <a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
              </div>
          </div>
		</form>	





		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

</body>
</html>
