<?php
include("conexion.php");
session_start();
			$nik = 2;
			$sql = mysqli_query($con, "SELECT * FROM biblio WHERE id='$nik'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){

				$descripcion= mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));
				$titulo= mysqli_real_escape_string($con,(strip_tags($_POST["titulo"],ENT_QUOTES)));
				$update = mysqli_query($con, "UPDATE biblio SET titulo='$titulo',descripcion='$descripcion' WHERE id='$nik'") or die(mysqli_error());
				if($update){
					header("Location: index.php");
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
			}
?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bibliografía banco OVA</title>

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
	<div class="container">
		<div class="content">
			<h2>Bibliografía &raquo; Editar datos</h2>
			<hr />
			
			
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Titulo: </label>
					<div class="col-sm-4">
						<textarea name="titulo" class="form-control"><?php echo $row ['titulo']; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Descripción: </label>
					<div class="col-sm-4">
						<textarea name="descripcion" class="form-control"><?php echo $row ['descripcion']; ?></textarea>
					</div>
				</div>	
			
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="tipoova.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>
