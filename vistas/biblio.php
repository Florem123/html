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
	<title>Banco OVAs UNAJ</title>

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
			
			<p class="titulo2">Bibliografía</p></br>
			
		<?php
			
			$sql = mysqli_query($con, "SELECT * FROM objeto_ova WHERE id=1");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
		

			?>
			
			<p class="titulo2">Bibliográfía</p></br>

			<pre><?php echo $row ['descripcion']; ?></pre>
			<hr />


			<hr />

		</div>
		<a href="index.php" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-backward" aria-hidden="true"></span> Inicio</a>
		<a href="about.php" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span> Atrás</a>
	</div><center>
	<footer>&copy; Banco de Objetos Virtuales de Aprendizaje-UNAJ <?php echo date("Y");?></footer>
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
