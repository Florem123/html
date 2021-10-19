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
 <link rel="shortcut icon" href="../img/iconunaj.ico" />
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

				<h4>Búsqueda por tipos de recurso</h4>

<hr />
		<div class="grid-1">

				<?php
				$sql = mysqli_query($con, "SELECT * FROM tipo_ova ORDER BY id ASC");

				if(mysqli_num_rows($sql) == 0){
					echo "<span class='glyphicon glyphicon-search' aria-hidden='true'></span> No se encontraron OVAS asociados a ese recurso</br></br>";
				}else{
					
					while($row = mysqli_fetch_assoc($sql)){                            
                        echo '
                        <div>
								    <div class="thumbnail">
								      <img src="'.$row['miniatura'].'" width="100" height="100">
								      <div class="caption">
								        
								        <a href="recursos2.php?nik='.$row['id'].'"> <button type="button" class="btn btn-danger">'.$row['nombre_tipo'].'</button> </a>
								        </div>
								    </div>
								  </div>					
					';
					}
				}
				?>
		
			</div>
			<a href="index.php" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-backward" aria-hidden="true"></span> Inicio</a>
		</div>
	</div><center>
	<footer>&copy; Banco de Objetos Virtuales de Aprendizaje-UNAJ <?php echo date("Y");?></footer>
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
