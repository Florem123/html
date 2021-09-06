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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agregar OVA</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
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

<form class="form-horizontal" action="" method="post">

				<div class="form-group">
					
					<div class="col-sm-3">
						Recurso:</br>
						<select id="recurso" name="recurso" class="form-control">
					<option value="0">Todos los tipos</option>
					<?php 
					$query = mysqli_query($con, "SELECT id,nombre_tipo FROM tipo_ova");
  					while($valu = mysqli_fetch_array($query)){
  						$c = $valu['id'];
    					echo "<option value='".$c."'>".$valu['nombre_tipo']."</option>";
  					}?>
  					</select>
					</div>

					<div class="col-sm-3">
						</br>
					<button type="button" class="btn btn-success" id="enviar2"><span class="glyphicon glyphicon-search" 
					aria-hidden="true"></span> Buscar</button>
					</div>
				</div>
				<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
				 echo '<input type="hidden" id="idsubcat" name="idsubcat" value="'.$nik.'">';
			?>
				 
			</form>


			<div id="resul" class="grid-1">



			</div>

		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/eventos.js"></script>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>
