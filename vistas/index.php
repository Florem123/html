<?php
include("conexion.php");

session_start();

if ($_SESSION["s_usuario"] === null){
    header("Location: ../index.php");
}

var_dump($_SESSION["s_time"]);

?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Banco OVA UNAJ</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">

	<style>
		.content {
			margin-top: 80px;
		}
	</style>

</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include('nav.php');?>
	</nav>
	<div class="container">
		  <div class="container">
        <div class="content" align="center">
            <h3>Les damos la bienvenida al Banco de Objetos Virtuales de Aprendizaje</h3>
		<?php /*echo $_SESSION["s_usuario"];
		echo $_SESSION["s_mail"];
		echo $_SESSION["s_tipo"];*/ ?>

 			<video class="img-thumbnail" src="../img/ova.mp4" autoplay muted loop controls width="720" height="540"></video>
 			<br><br>
            

        
    

		<div class="table-responsive">

	<a  href="buscador.php"> <button type="button" class="btn2 btn-primary">BUSCADOR DE OVAS</button> </a>
	<a  href="about.php"> <button type="button" class="btn2 btn-primary">MARCO PEDAGÓGICO-DIDÁCTICO</button> </a>
		</div>
		<br><br>


	</div>
	</div>
		
	</div><center>
	<footer>&copy; Banco de Objetos Virtuales de Aprendizaje-UNAJ <?php echo date("Y");?></footer>
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
