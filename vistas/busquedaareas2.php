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

	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include('nav.php');?>
	</nav>
	<div class="container">
		<div class="content">



			<h4>Búsqueda por áreas de conocimiento</h4>

			<hr />


			<div id="accordion">

				<?php
				$sql = mysqli_query($con, "SELECT * FROM categorias ORDER BY id ASC");

				if(mysqli_num_rows($sql) == 0){
					echo '<div></div>';
				}else{
					echo '<div class="grid-1">';
					while($row = mysqli_fetch_assoc($sql)){                           
                        echo '
					  <div class="thumbnail">
					    <div class="card-header" id="headingOne">
					      <h5 class="mb-0">
					        <img src="'.$row['miniatura'].'" width="100" height="100"/>   <button class="btn btn-primary" data-toggle="collapse" data-target="#'.$row['id'].'" aria-expanded="true" aria-controls="collapseOne">
					          '.$row['descripcion'].'
					        </button>
					      </h5>
					    </div>

					    <div id="'.$row['id'].'" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
					      <div class="card-body">';
					      		$idcat=$row['id'];
					      		$sql2 = mysqli_query($con, "SELECT DISTINCT s.id,s.descripcion
							FROM relacion r
							LEFT JOIN subcat s ON s.id=r.id_subcat
							LEFT JOIN objeto_ova o ON o.id_objeto=r.id_ova
							WHERE r.id_subcat IS NOT NULL
							AND o.ova_activo=1
							AND s.cat_padre='$idcat'");

					      		if(mysqli_num_rows($sql2) == 0){
									echo '<a class="btn-danger" href="recucat.php?nik='.$row['id'].'">Todas</a>';
								}else{
					
									while($row2 = mysqli_fetch_assoc($sql2)){
										echo '
										<a class="btn-danger"  href="recusub.php?nik='.$row2['id'].'">'.$row2['descripcion'].'</a>

					        	';

									}
									echo '<a  class="btn-danger" href="recucat.php?nik='.$row['id'].'">Todas</a>';
								}
					        


					  	echo '
					      </div>
					    </div>
					  </div>
					 
					';
					}
					echo '</div>';

				}
				?>


			</div>
			<a href="index.php" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-backward" aria-hidden="true"></span> Inicio</a>
		</div>

		</div>
	<center>
	<footer>&copy; Banco de Objetos Virtuales de Aprendizaje-UNAJ <?php echo date("Y");?></footer>
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

</body>
</html>
