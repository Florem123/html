<!doctype html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="#" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ABM-Banco OVA</title>
    
     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="estilos.css">
    
    <link rel="stylesheet" href="plugins/sweet_alert2/sweetalert2.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" role="navigation">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="img/logo-transparente.png" height="40"></a>
        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
            &#9776;
        </button>
        <div class="collapse navbar-collapse" id="exCollapsingNavbar">
            <ul class="nav navbar-nav">
                <li class="nav-item"><a href="#" class="nav-link">Acerca</a></li>
                <li class="nav-item"><a href="#" class="nav-link">¿Qué son los OVA?</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Contáctenos</a></li>
            </ul>
        </div>
    </div>
</nav>



<div class="container">
<div class="content">
            
            <hr />

<form class="form-horizontal" action="" method="post">
<br><br><br>


                <div class="form-group">
                    <label class="col-sm-3 control-label">Nombre: </label>
                    <div class="col-sm-4">
                        <input type="text" name="nombre" class="form-control"  required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Apellido: </label>
                    <div class="col-sm-4">
                        <input type="text" name="apellido" class="form-control"  required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Mail: </label>
                    <div class="col-sm-4">
                        <input type="email" name="mail" class="form-control"  required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Puesto: </label>
                    <div class="col-sm-4">
                        <input type='checkbox' value='docente' name='docente'>Docente</br>
                        <input type='checkbox' value='nodocente' name='nodocente'>No docente</br>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Apellido: </label>
                    <div class="col-sm-4">
                        <input type="text" name="apellido" class="form-control"  required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Comentarios: </label>
                    <div class="col-sm-4">
                        <textarea name="coment" class="form-control" maxlength="500"></textarea>
                    </div>
                </div>

        </form>
    </div>
</div>

<br><br><br>
 
    <center>
    <p>&copy; Banco de Objetos Virtuales de Aprendizaje-UNAJ <?php echo date("Y");?></p>
        </center>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
    <script src="plugins/sweet_alert2/sweetalert2.all.min.js"></script>
    <script src="codigo.js"></script>
</body>
</html>
