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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Banco OVAs UNAJ</title>

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



            <div class="table-responsive">

                <h3>Buscador</h3>

                <div class="form-group">
                    <div class="col-sm-4">
                        <img src="https://drive.google.com/uc?export=download&id=1D0ujgFBzCwvxjQ4RNJu718b1TUKO0-bB" height="200" width="200"/> <a  href="busquedarecu.php"> <button type="button" class="btn2 btn-primary">Tipo de recurso</button> </a>
                    </div>
                
                
                    <div class="col-sm-4">
                    <img src="https://drive.google.com/uc?export=download&id=1282ri4d4J2q_lZcyLx2pYSoLH8K18dnP" height="100" /> <a  href="busquedaareas2.php"> <button type="button" class="btn2 btn-primary">Áreas de conocimiento</button></a>
                    </div>
                
                
                    <div class="col-sm-4">
                        <img src="https://drive.google.com/uc?export=download&id=1xSThDplIMA92FzhTpT5MmMcpDdvZpb5f" height="100" /> <a  href="busquedapal.php"> <button type="button" class="btn2 btn-primary">Palabras claves</button></a>
                    </div>
                </div>
           </div>


        </div>
    </br></br>
        <a href="index.php" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-backward" aria-hidden="true"></span> Inicio</a>
    </div><center>
    <footer>&copy; Banco de Objetos Virtuales de Aprendizaje-UNAJ <?php echo date("Y");?></footer>
        </center>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
