<?php
include("vistas/conexion.php");


if(isset($_POST['submit'])){
  $email= mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
  $sql = mysqli_query($con, "SELECT * FROM user WHERE mail='$email'");

  if(mysqli_num_rows($sql) == 0){
    echo'<script type="text/javascript">
        alert("El correo ingresado no coincide con un usuario registrado");
        window.location.href="index.php";
        </script>';
  }else{
    $row = mysqli_fetch_assoc($sql);
    if( $row['primeracceso'] == 1){
      $primeracceso=0;
      $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $clave=substr(str_shuffle($permitted_chars), 0, 10);
      $nik=$row['id'];
	    $u = mysqli_query($con, "UPDATE user SET clave='$clave',primeracceso='$primeracceso' WHERE id='$nik'") or die(mysqli_error());
      $link ='https://ova.informatica.unaj.edu.ar/primeracceso.php?nik='.$nik;
      
      //ENVIAR EL MAIL PARA INGRESAR NUEVAMENTE
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
			    $mail2->Subject = 'RECUPERO DE CLAVE OVA UNAJ';
			    $mail2->Body    = 'HOLA '.$nombre.' '.$apellido.'! TE ENVIAMOS LOS DATOS PARA REESTABLECER TU CLAVE:<br>CLAVE: '.$clave.'<br> Ingresá a  '.$link.' para cambiar tu clave provisoria';

			    $mail2->send();



			} catch (Exception $e) {
			    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
           
      echo'<script type="text/javascript">
      alert("Revisa tu correo para reestablacer la clave. No olvides mirar en tu bandeja de spam o correo no deseado!");
      window.location.href="index.php";
      </script>';
    

  }
}
			
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="shortcut icon" href="#" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Olvido de clave</title>
    
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
                                <label for="passvieja" class="text-dark">Ingrese su correo electrónico</label><br>
                                <input type="email" name="email" id="email" class="form-control">
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
