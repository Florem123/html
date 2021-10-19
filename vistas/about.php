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



            <div class="table-responsive">

                <h3>Marco pedagógico-didáctico</h3>

                <div class="form-group" align="center">
                    <div class="col-sm-4">
                        <img src="https://drive.google.com/uc?export=download&id=1rKyTkJHcj9liMGJLYZLL1zvQRLi5Zrpy" width="100" height="100"/> <a  href="modyrepre.php"> <button type="button" class="btn2 btn-success">Sobre las representaciones</button> </a>
                    </div>
                
                
                    <div class="col-sm-4">
                    <img src="https://drive.google.com/uc?export=download&id=1gkpbehjeeEbC3l6rmDyEDuc5N2u2vBKG" width="100" height="100" /> <a  href="biblio.php"> <button type="button" class="btn2 btn-success">Bibliografía</button></a>
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
