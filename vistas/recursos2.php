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
	<title>Datos del OVA</title>

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
			<h4>Búsqueda por tipo de recursos</h4>
			<hr />

			<form class="form-horizontal" action="" method="post">

				<div class="form-group">
					
					<div class="col-sm-3">
						Categoría:</br>
						<select id="categoria" name="categoria" class="form-control">
					<option value="0"> ----- </option>
					<?php 
					$query = mysqli_query($con, "SELECT id,descripcion FROM categorias");
  					while($valu = mysqli_fetch_array($query)){
  						$c = $valu['id'];
    					echo "<option value='".$c."'>".$valu['descripcion']."</option>";
  					}?>
  					</select>
					</div>
				
					
					<div class="col-sm-3">
						Subcategoría:</br>
						<select name="subcat" id="subcat" class="form-control">
						</select>
					</div>

					<div class="col-sm-3">
						</br>
					<button type="button" class="btn btn-success" id="enviar"><span class="glyphicon glyphicon-search" 
					aria-hidden="true"></span> Buscar</button>
					</div>
				</div>
				<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
				 echo '<input type="hidden" id="idrecurso" name="idrecurso" value="'.$nik.'">';
			?>
				 
			</form>


			<div id="resul" class="grid-1">
			

			<?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
			
			$sql = mysqli_query($con, "SELECT * FROM objeto_ova WHERE id_tipo='$nik' AND ova_activo=1");
			if(mysqli_num_rows($sql) == 0){
				echo "<span class='glyphicon glyphicon-search' aria-hidden='true'></span> No se encontraron OVAS asociados a ese tipo de recurso</br></br>";
			}else{
					while($row = mysqli_fetch_assoc($sql)){                            
                        echo '
							
							  <div>
							    <div class="thumbnail">
							      <img src="'.$row['miniatura'].'" width="100px" height="100px" overflow="hidden">
							      <div class="caption">
							        <h3>'.$row['nombre'].'</h3>
							        <p>Modelización: ';
							        $nikid=$row['id_objeto'];
									$consmod= "SELECT id_tipo FROM relacionm WHERE id_ova='$nikid'";
									$sqlm =  mysqli_query($con,$consmod);
									$cadenam="";
									//var_dump($nikid);
									while ($mod = mysqli_fetch_assoc($sqlm)){

										$idmod=$mod['id_tipo'];
										$qm = mysqli_query($con, "SELECT * FROM tipo_modelizacion WHERE id='$idmod'");
										$rm = mysqli_fetch_assoc($qm);
									 	$cadenam=$rm['descripcion']."</br>".$cadenam;
									} 				
									echo $cadenam.'</p>';
									

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
			<a href="busquedarecu.php" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span> Búsqueda por tipo de recurso</a>
			
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/eventos.js"></script>
</body>
</html>