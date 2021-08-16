
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ABM OVAS</title>

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
</div>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include('../nav.php');?>
	</nav>
	<div class="container">
		<div class="content">
			<h2>Lista de OVAS</h2>

			<h5>Bienvenida/o: <?php echo $_SESSION["s_usuario"];?> </h5>

			<hr />



			<form name="frmContacto" method="post" action="sendbymail.php">
<table width="500px">
<tr>
<td>
<label for="first_name">Nombre: *</label>
</td>
<td>
<input type="text" name="first_name" maxlength="50" size="25">
</td>
</tr>
<tr>
<td valign="top"">
<label for="last_name">Apellido: *</label>
</td>
<td>
<input type="text" name="last_name" maxlength="50" size="25">
</td>
</tr>
<tr>
<td>
<label for="email">Dirección de E-mail: *</label>
</td>
<td>
<input type="text" name="email" maxlength="80" size="35">
</td>
</tr>
<tr>
<td>
<label for="telephone">Número de teléfono:</label>
</td>
<td>
<input type="text" name="telephone" maxlength="25" size="15">
</td>
</tr>
<tr>
<td>
<label for="comments">Comentarios: *</label>
</td>
<td>
<textarea name="comments" maxlength="500" cols="30" rows="5"></textarea>
</td>
</tr>
<tr>
<td colspan="2" style="text-align:right">
<input type="submit" value="Enviar">
</td>
</tr>
</table>
</form>
	</div><center>
	<p>&copy; Banco de Objetos Virtuales de Aprendizaje-UNAJ <?php echo date("Y");?></p>
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
