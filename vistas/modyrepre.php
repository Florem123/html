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
			
			<p class="titulo2">Sobre modelos y representaciones didácticas</p></br>


<p>Los Objetos Virtuales de Aprendizaje que se encuentran alojados en este sitio involucran distintos tipos de modelos o representaciones didácticas (Galagovsky y Adúriz Bravo, 2001).</p>

<p>El corazón de la conceptualización en ciencia tanto en la academia como en las aulas y en la vida cotidiana está basado en procesos de modelización. </p>

<p>Pero el concepto de modelo es polisémico ya que involucra diversos significados según sus contextos de utilización, en ocasiones se usa para designar [algo]”...ejemplar, es decir indica aquellas cosas, actitudes o personas que se propone imitar.”(J. A. Chamizo Guerrero, 2010).  Pero en este contexto acordaremos con la siguiente definición dada por Oh y Oh en 2011 (extraído de Gutierrez, 2014):</p>

<p>“Aunque las definiciones de modelo pueden ser diversas, un modelo se entiende como la representación de un referente. Los referentes representados por los modelos pueden ser varias entidades, como objetos, fenómenos, procesos, ideas, o sistemas.  Un modelo también se considera como un puente o mediador que conecta una teoría y un fenómeno, ya que ayuda a desarrollar una teoría desde los datos, y pone en relación la teoría con el mundo natural.”</p>

<p>Olimpia Lombardi, a su vez, define un modelo como “un objeto abstracto, conceptualmente construido, en el cual se consideran como variables sólo los factores relevantes, a veces se suponen las propiedades de los elementos inobservables en el sistema real e incluso a veces se introducen entidades ideales inexistentes en la realidad” (en Galagovsky, 2011). Los modelos en ciencias ayudan a la representación de ideas, procesos y sistemas complejos. No son representaciones completas de las realidades que se supone representan. Son simulaciones de esa realidad basadas en la teoría. </p>

<p>Los modelos son de gran importancia en la enseñanza y el aprendizaje ya que permiten explicar fenómenos, hacer inferencias y predicciones. Siguiendo con Oh y Oh, 2011, podemos pensar en los propósitos de los modelos que los hacen insumos centrales en los procesos de enseñanza:</p>

<p>“Un modelo científico, como instrumento para pensar y comunicarse, tiene el propósito de describir, explicar y predecir fenómenos naturales y comunicar ideas científicas a otros. Estos roles funcionales se potencian expresando los modelos con recursos semióticos no lingüísticos, usando analogías y permitiendo simulaciones mentales y externas del mismo.”</p>



<p>Muchas son las formas en que podemos organizar los modelos. En este banco de OVAs tomamos la siguiente clasificación:</p>

			<div class="container-wrapper-genially" style="position: relative; min-height: 400px; max-width: 100%;"><video class="loader-genially" autoplay="autoplay" loop="loop" playsinline="playsInline" muted="muted" style="position: absolute;top: 45%;left: 50%;transform: translate(-50%, -50%);width: 80px;height: 80px;margin-bottom: 10%"><source src="https://static.genial.ly/resources/panel-loader-low.mp4" type="video/mp4" />Your browser does not support the video tag.</video><div id="6034036e68d1ae0d10adf6dc" class="genially-embed" style="margin: 0px auto; position: relative; height: auto; width: 100%;"></div></div><script>(function (d) { var js, id = "genially-embed-js", ref = d.getElementsByTagName("script")[0]; if (d.getElementById(id)) { return; } js = d.createElement("script"); js.id = id; js.async = true; js.src = "https://view.genial.ly/static/embed/embed.js"; ref.parentNode.insertBefore(js, ref); }(document));</script>

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
