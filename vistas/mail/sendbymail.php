<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

include("../conexion.php");

$nom = (isset($_POST['nom'])) ? $_POST['nom'] : '';
$correo = (isset($_POST['mail'])) ? $_POST['mail'] : '';
$comentario = (isset($_POST['coment'])) ? $_POST['coment'] : '';
$usu = $_POST['usu'];
$tipo =$_POST['tipo'];
$id_objeto = $_POST['id_objeto'];

date_default_timezone_set("America/Argentina/Buenos_Aires");
$fecha_actual=date("Y-m-d H:i:s");

$obs='Comentario OVA: '.$id_objeto;
$est2=mysqli_query($con, "INSERT INTO logs(usuario,tipo,fecha_logueo,obs) 
			VALUES('$usu','$tipo','$fecha_actual','$obs')") or die(mysqli_error());



$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'mailerovaunaj@gmail.com';                     //SMTP username
    $mail->Password   = 'Mailerunaj2021';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('mailerovaunaj@gmail.com', 'OvaUnaj');
    $mail->addAddress('florem.ayala.123@gmail.com');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'COMENTARIO de '.$nom;
    $mail->Body    = 'Este mensje lo envía '.$nom.' para ser respondido en la casilla de correo '.$correo.'. Envia la siguiente sugerencia: '.$comentario;

    $mail->send();
    echo 'El mensaje se ha enviado correctamente';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
