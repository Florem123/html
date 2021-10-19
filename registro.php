<?php
include("vistas/conexion.php");

use PHPMailer\PHPMailer\PHPMailer;
use visPHPMailer\PHPMailer\Exception;

require 'vistas/mail/Exception.php';
require 'vistas/mail/PHPMailer.php';
require 'vistas/mail/SMTP.php';

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
        </div>
    </div>
</nav>



<div class="container">
<div class="content">
            
            <hr />

            <?php
            if(isset($_POST['add'])){

                $nombre= mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
                $apellido= mysqli_real_escape_string($con,(strip_tags($_POST["apellido"],ENT_QUOTES)));
                $email= mysqli_real_escape_string($con,(strip_tags($_POST["mail"],ENT_QUOTES))); 
                $institucion= mysqli_real_escape_string($con,(strip_tags($_POST["institucion"],ENT_QUOTES)));

                $coment= mysqli_real_escape_string($con,(strip_tags($_POST["coment"],ENT_QUOTES)));

                if (isset($_POST["docente"])){
                    $d=1;
                    $do='SI';
                } else{
                    $d=0;
                    $do='NO';
                }

                if (isset($_POST["nodocente"])){
                    $nod=1;
                    $ndo='SI';
                } else{
                    $nod=0;
                    $ndo='NO';
                }
                
                $us = explode("@", $email);
                $usuario=$us[0];
                $usubus= $usuario.'%';
                $cek1 = mysqli_query($con, "SELECT * FROM user WHERE usuario LIKE '$usubus'");
                if(mysqli_num_rows($cek1) != 0){
                    $u = mysqli_num_rows($cek1);
                    $usuario=$usuario.$u;                    
                 }

                $tipo='E';
                $activo=0;
                $primer=0;

                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $clave=substr(str_shuffle($permitted_chars), 0, 10);

                $cek = mysqli_query($con, "SELECT * FROM user WHERE mail='$email'");
                if(mysqli_num_rows($cek) == 0){


                        $insert = mysqli_query($con, "INSERT INTO user(nombre, apellido, mail, usuario, docente, nodoc, institucion, coment, tipo, activo, clave,primeracceso) 
                            VALUES('$nombre','$apellido', '$email', '$usuario', '$d', '$nod', '$institucion', '$coment', '$tipo', '$activo', '$clave', '$primer')") or die(mysqli_error());
                        
                        $id_user= mysqli_insert_id($con);
                    
                        if($insert){
                            echo '<br><br><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Su solicitud ha sido procesada correctamente. A la brevedad le enviaremos una respuesta.<a href="index.php">Volver</a></div>';
                            $mail = new PHPMailer(true);
                            $mail2 = new PHPMailer(true);
                            $link ='https://ova.informatica.unaj.edu.ar/gestionreg.php?nik='.$id_user;
                            try {
                                //Server settings
                                //$mail->SMTPDebug = 2;                      //Enable verbose debug output
                                $mail->isSMTP();                                            //Send using SMTP
                                $mail->Host       = 'smtp.gmail.com';                    //Set the SMTP server to send through
                                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                $mail->Username   = 'mailerovaunaj@gmail.com';                     //SMTP username
                                $mail->Password   = 'Mailerunaj21';                              //SMTP password
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                                $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                                //Recipients
                                $mail->setFrom('mailerovaunaj@gmail.com', 'OvaUnaj');
                                $mail->addAddress('florem.ayala.123@gmail.com');     //Add a recipient

                                //Content
                                $mail->isHTML(true);                                  //Set email format to HTML
                                $mail->Subject = 'REGISTRO de '.$nombre.' '.$apellido;
                                $mail->Body    = 'Este mensje lo envía '.$nombre.' '.$apellido.'.<br>Desea registrarse como usuario externo en el banco de OVA.<br>Su correo es: '.$email.'.<br>Envia la siguiente informacion:<br>Es docente: '.$do. '<br>Es no docente: '.$ndo.'<br>Trabaja en: '.$institucion.'<br>Comentario: '.$coment.'<br>Para resolver el registro ingrese: '.$link;

                                $mail->send();
                                
                                //MAIL AL USUARIO QUE SE REGISTRA
                                $mail2->isSMTP();                                            //Send using SMTP
                                
                                //CONFIGURACION MAIL UNAJ
                                /* $mail2->Host       = 'mail.unaj.edu.ar';                    //Set the SMTP server to send through
                                $mail2->SMTPAuth   = true;                                   //Enable SMTP authentication
                                $mail2->Username   = 'noresponder@unaj.edu.ar';                     //SMTP username
                                $mail2->Password   = 'qwew1232';                               //SMTP password */
                                
                                $mail2->Host       = 'smtp.gmail.com';                    //Set the SMTP server to send through
                                $mail2->SMTPAuth   = true;                                   //Enable SMTP authentication
                                $mail2->Username   = 'mailerovaunaj@gmail.com';                     //SMTP username
                                $mail2->Password   = 'Mailerunaj21';
                                
                                $mail2->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                                $mail2->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                                //Recipients
                                $mail2->setFrom('noresponder@unaj.edu.ar', 'OvaUnaj');
                                $mail2->addAddress($email);     //Add a recipient

                                //Content
                                $mail2->isHTML(true);                                  //Set email format to HTML
                                $mail2->Subject = 'REGISTRO BANCO DE OVA UNAJ - no responder';
                                $mail2->Body    = 'BIENVENIDO '.$nombre.' '.$apellido.'. GRACIAS POR REGISTRARSE AL BANCO DE OVA UNAJ, A LA BREVEDAD RECIBIRA UNA RESPUESTA';

                                $mail2->send();
                            } catch (Exception $e) {
                                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            }

                        }else{
                            echo '<br><br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
                        }
                     
                }else{
                    echo '<br><br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>El usuario que intenta registrar está en proceso de revisión</div>';
                }
            }

            
            ?>

<form class="form-horizontal" action="" method="post">
<br><br><br>


                <div class="form-group">
                    <label class="col-sm-3 control-label">Nombre: </label>
                    <div class="col-sm-4">
                        <input type="text" name="nombre" class="form-control"  required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Apellido: </label>
                    <div class="col-sm-4">
                        <input type="text" name="apellido" class="form-control"  required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Mail: </label>
                    <div class="col-sm-4">
                        <input type="email" name="mail" class="form-control"  required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Puesto: </label>
                    <div class="col-sm-4">
                        <input type='checkbox' value='docente' name='docente'>Docente</br>
                        <input type='checkbox' value='nodocente' name='nodocente'>No docente</br>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Institución donde se desempeña: </label>
                    <div class="col-sm-4">
                        <input type="text" name="institucion" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Comentarios: </label>
                    <div class="col-sm-4">
                        <textarea name="coment" class="form-control" maxlength="500"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">&nbsp;</label>
                    <div class="col-sm-6">
                        <input type="submit" name="add" class="btn btn-sm btn-primary" value="Enviar">
                        <a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
                    </div>
                </div>

        </form>
    </div>
</div>

<br><br><br>
 
    <center>
    <p>&copy; Banco de Objetos Virtuales de Aprendizaje-UNAJ <?php echo date("Y");?></p>
        </center>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="vistas/js/funcion.js"></script>
    <script src="plugins/sweet_alert2/sweetalert2.all.min.js"></script>
    
   
</body>
</html>
