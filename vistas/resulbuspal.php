<?php
include("conexion.php");

session_start();

if ($_SESSION["s_usuario"] === null){
    header("Location: ../index.php");
}


?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>OVA UNAJ</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
	<style>
		.content {
			margin-top: 80px;
		}
	</style>

</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include("nav.php");?>
	</nav>
	<div class="container">
		<div class="content">
			<h4>Búsqueda por palabras claves</h4>
			<hr />
		<div class="grid-1">
			

			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$cadena = (isset($_POST['cadenabusqueda'])) ? $_POST['cadenabusqueda'] : '';
			


			$sql = mysqli_query($con,"SELECT * FROM objeto_ova WHERE pal_clave1 LIKE '%$cadena%' OR pal_clave2 LIKE '%$cadena%' OR pal_clave3 LIKE '%$cadena%' OR pal_clave4 LIKE '%$cadena%' OR pal_clave5 LIKE '%$cadena%'");
			
		
			if(mysqli_num_rows($sql) == 0){
				echo "No se encontraron OVAS asociados";
			}else{
					while($row = mysqli_fetch_assoc($sql)){                            
 								echo '
								
								  <div>
								    <div class="thumbnail">
								      <img src="'.$row['miniatura'].'" width="100" height="100">
								      <div class="caption">
								        <h3>'.$row['nombre'].'</h3>
								        <p>Modelización: ';
								        $tipomodel=$row['tipo_model'];
								        $sql2 = mysqli_query($con, "SELECT descripcion FROM tipo_modelizacion WHERE id='$tipomodel'");

								    	while($row2 = mysqli_fetch_assoc($sql2))
								        	echo $row2['descripcion'].'</p>';

							echo '
								        <p>Tipo de recurso: ';
								        $tiporecu=$row['id_tipo'];
								        $sql3 = mysqli_query($con, "SELECT nombre_tipo FROM tipo_ova WHERE id='$tiporecu'");

								    	while($row3 = mysqli_fetch_assoc($sql3))
								        	echo $row3['nombre_tipo'].'</p>';


							echo '
								        <p>
								        <a href="profile.php?nik='.$row['id'].'"> <button type="button" class="btn btn-primary">Ver más</button></a>
								        
								        </p>
								      </div>
								    </div>
								  </div>
								
						';
					}
			}
			
			?>


		
			</div>
			
			<a href="index.php" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-backward" aria-hidden="true"></span> Inicio</a>
			<a href="busquedapal.php" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span> Búsqueda por palabra clave</a>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>