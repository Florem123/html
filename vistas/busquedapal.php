<?php
include("conexion.php");

session_start();

if ($_SESSION["s_usuario"] === null){
    header("Location: ../index.php");
}
if((time() - $_SESSION['s_time']) > 7200){
	header('location: ../bd/logout.php');
}

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
</div>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include('nav.php');?>
	</nav>
	<div class="container">
		<div class="content">
			<h4>Búsqueda por palabras clave</h4>

			<hr />


			<div class="table-responsive">
				<form action="resulbuspal.php" method="post">
					<label class="col-sm-2 control-label">Palabra Clave:</label>
					<div class="col-sm-4">
						<input type="text" name="cadenabusqueda" class="form-control"><br>
						<a  href=""> <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button></a>
					</div>
						
				</form>
			
			</div>
			<a href="index.php" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-backward" aria-hidden="true"></span> Inicio</a>
		</div>
	</div><center>
	<footer id="pie">&copy; Banco de Objetos Virtuales de Aprendizaje-UNAJ <?php echo date("Y");?></footer>
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
