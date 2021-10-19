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
<link rel="shortcut icon" href="img/iconunaj.ico" />
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
			<?php
			if(isset($_GET['aksi']) == 'click'){
				$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
				$sql = mysqli_query($con, "SELECT * FROM subcat WHERE cat_padre='$nik'");
				$salida='';		
				while($valores = mysqli_fetch_array($sql)){
						$salida .= '<a href="perfilovas.php?nik='.$valores['id'].'">'.$valores['descripcion'].' </a><br>';
						
				}
				if ($salida==''){
						$salida .= 'No posee áreas específicas';
				}
				echo $salida;
				

			
			}
			?>


			<h4>Búsqueda por áreas generales del conocimiento</h4>

			<hr />


			<div class="table-responsive">
			<table class="table table-striped table-hover">

				<?php
				$sql = mysqli_query($con, "SELECT * FROM categorias ORDER BY id ASC");

				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay áreas generales para buscar.</td></tr>';
				}else{
					
					while($row = mysqli_fetch_assoc($sql)){                            
                        echo '
                        <tr>
	                <div class="form-group">
						
							<img src="../img/areas.jpg" width="60" height="60"/> <button class="boton" type="button" class="btn btn-primary" id="'.$row['id'].'" onclick="escucha(this)">'.$row['descripcion'].'</button>

							<div id="nuevasubc'.$row['id'].'" name="nuevasubc" class="form-control">';

				$idcat=$row['id'];
				
				$sql2 = mysqli_query($con, "SELECT * FROM subcat WHERE cat_padre='$idcat'");

				if(mysqli_num_rows($sql2) == 0){
					echo '<tr><td colspan="8">No hay áreas específicas para buscar.</td></tr>';
				}else{
					
					while($row2 = mysqli_fetch_assoc($sql2)){ 
						

							echo '<button class="boton" type="button" class="btn btn-danger" id="'.$row2['id'].'" onclick="escucha(this)">'.$row2['descripcion'].'</button><br>';


							}
				}

					echo '
							
												
					</div>

					
					</tr>
					';
					}
				}
				?>



			</table>
			</div>
		</div>
		</div>
	</div><center>
	<footer>&copy; Banco de Objetos Virtuales de Aprendizaje-UNAJ <?php echo date("Y");?></footer>
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		escucha(boton){
    var botonid= boton.id;
    alert(botonid);

	</script>

</body>
</html>
