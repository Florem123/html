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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	<title>Banco OVA Unaj</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
	<link href="css/popup.css" rel="stylesheet">
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
					
			<?php
			date_default_timezone_set("America/Argentina/Buenos_Aires");
			$fecha_actual=date("Y-m-d H:i:s");

			$usu=mysqli_real_escape_string($con,(strip_tags($_SESSION["s_usuario"],ENT_QUOTES)));

			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
			
			$sql = mysqli_query($con, "SELECT * FROM objeto_ova WHERE id='$nik'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			
			$est1=mysqli_query($con, "INSERT INTO estadi(id_ova, usuario, fecha) 
							VALUES('$nik','$usu', '$fecha_actual')") or die(mysqli_error());
			$id_objeto= $row ['id_objeto'];
			$obs='Visita OVA: '.$id_objeto;
        		$tipo=$_SESSION["s_tipo"];
        		$est2=mysqli_query($con, "INSERT INTO logs(usuario,tipo,fecha_logueo,obs) 
			VALUES('$usu','$tipo','$fecha_actual','$obs')") or die(mysqli_error());

			?>

					<p class="titulo2">OVA: <?php echo $row['nombre']; ?></p></br>

					<p class="titulo">Breve descripción</p>
					<pre><?php echo $row ['descripcion']; ?></pre>

					<p class="titulo">Análisis para la utilización del tipo de recurso: </p>
					<pre><?php echo $row ['ejem_sugerencias']; ?></pre>

					<p class="titulo">Sugerencias de uso: </p>
					<pre><?php echo $row ['usos']; ?></pre>

		
					<p class="titulo">Palabras Claves</p>
					<p><?php 
						if ($row['pal_clave1']!="")
							echo $row['pal_clave1']."</br>";

						if ($row['pal_clave2']!="")
							echo $row['pal_clave2']."</br>";

						if ($row['pal_clave3']!="")
							echo $row['pal_clave3']."</br>";

						if ($row['pal_clave4']!="")
							echo $row['pal_clave4']."</br>";

						if ($row['pal_clave5']!="")
							echo $row['pal_clave5']."</br>";
						 ?></p>

				


					<p class="titulo">Autoría</p>
					<p><?php echo $row['autoria']; ?></p>

					<p class="titulo">Idioma</p>
					<p><?php echo $row['idioma']; ?></p>

					<p class="titulo">Derechos de autor</p>
					<p><?php echo $row['der_autor']; ?></p>

					<p class="titulo">Tipos de modelización</p>
					<p><?php
					//MODELIZACIONES SELECCIONADAS PARA UN OVA EN PARTICULAR
					$nikid=$row['id_objeto'];
					$consmod= "SELECT id_tipo FROM relacionm WHERE id_ova='$nikid'";
					$sqlm =  mysqli_query($con,$consmod);
					$cadenam="";
					while ($mod = mysqli_fetch_assoc($sqlm)){
						$idmod=$mod['id_tipo'];
						$qm = mysqli_query($con, "SELECT * FROM tipo_modelizacion WHERE id='$idmod'");
						$rm = mysqli_fetch_assoc($qm);
					 	$cadenam=$rm['descripcion']." - ".$cadenam;
					} 				
					echo $cadenam; 
					?>
					</p>

					<p class="titulo">Área general del conocimiento</p>
					<p><?php
					//CATEGORIAS SELECCIONADAS PARA UN OVA EN PARTICULAR
					$nikid=$row['id_objeto'];
					$conscat= "SELECT DISTINCT id_cat FROM relacion WHERE id_ova='$nikid'";
					$sql2 =  mysqli_query($con,$conscat);
					$cadena="";
					while ($cat = mysqli_fetch_assoc($sql2)){
						$idcat=$cat['id_cat'];
						$q2 = mysqli_query($con, "SELECT * FROM categorias WHERE id='$idcat'");
						$r2 = mysqli_fetch_assoc($q2);
					 	$cadena=$r2['descripcion']."</br>".$cadena;
					} 				
					echo $cadena; 
					?>
					</p>

					<p class="titulo">Área específica del conocimiento</p>
					<p><?php
					$conssubcat= "SELECT DISTINCT id_subcat FROM relacion WHERE id_ova='$nikid' AND id_subcat IS NOT NULL";
					$sql2_2 =  mysqli_query($con,$conssubcat);
					$cadena2="";
					while ($subcat = mysqli_fetch_assoc($sql2_2)){
						$idsubcat=$subcat['id_subcat'];
						$q3 = mysqli_query($con, "SELECT * FROM subcat WHERE id='$idsubcat'");
						$r3 = mysqli_fetch_assoc($q3);
					 	$cadena2=$r3['descripcion']."</br>".$cadena2;
					} 				
					echo $cadena2; 
					?>
					</p>

					<p><?php echo $row['cont_tematico']; ?></p>

					<p class="titulo2">Recurso</p></br>

					<?php
					$tipo=$row['id_tipo'];
					$consulta = mysqli_query($con, "SELECT * FROM tipo_ova WHERE id='$tipo'");
					$result = mysqli_fetch_assoc($consulta);
					
								if($result['identificador'] != 'IMG' ){
									echo '<p><iframe src="'.$row['enlace'].'" height="400" width="600" name="demo" referrerpolicy="unsafe-url">
										</iframe></p>';
								}else{
									echo '<p><img src="'.$row['enlace'].'" height="400" width="600" name="demo">
										</p>';
								}

					?> 

					<pre class="titulo">Enlace: <a href="<?php echo $row['enlace']; ?>"> <?php echo $row['enlace']; ?></a></pre></br>

	<button class="open-button" id="botonen" onclick="openForm()"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> Consultas y sugerencias</button>

<div class="form-popup" id="myForm">
  <form action="" method="post" class="form-container">
    <h3>Encuesta</h3>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Ingrese su mail" name="email" id="email" required>

    <label for="email"><b>Nombre</b></label>
    <input type="text" placeholder="Ingrese su nombre" name="nombre" id="nombre" required>

    <label for="coment"><b>Comentario</b></label></br>
    <textarea  id="coment" rows="5" style="resize: none; width: 100%;"></textarea>
	
	<input type="hidden" name="usu" id="usu" value="<?php echo $usu; ?>">
	<input type="hidden" name="tipo" id="tipo" value="<?php echo $tipo; ?>">
  	<input type="hidden" name="id_objeto" id="id_objeto" value="<?php echo $row['id_objeto']; ?>">

    <button type="button" class="btn" id="enviarop">Enviar</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Cerrar</button>
  </form>
</div>

			
			<a href="index.php" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-backward" aria-hidden="true"></span> Inicio</a>



		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/eventos.js"></script>
	<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
</body>
</html>
