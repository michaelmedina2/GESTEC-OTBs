<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <title>.- GESTEC OTB -.</title>

    <link rel="icon" href="gotb2.png">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>

</head>

<body>

<header id="header">
	<nav class="navbar navbar-inverse">
    	<div class="container">
        	<div class="navbar-header">
            	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                	<span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="img/logoGestec-OTB.png" alt="logo" width="130"></a>
            </div>

            <div class="collapse navbar-collapse navbar-right">
            	<ul class="nav navbar-nav" id="menu">
                	<li class="active"><a href="home.php">Home</a></li>
                    <li><a href="page1.php">Acerca de Nosotros</a></li>
                    <li><a href="page2.php">Servicios</a></li>
                    <li><a href="page3.php">Contactos</a></li>
                </ul>
            </div>
        </div><!--/.container-->
    </nav><!--/nav-->
</header><!--/header-->

<div class="container" id="central" style="background-image:url(img/map-image.png)">

	<div class="row">
    	<div class="col-xs-5"> <img src="img/portada.png" class="img-responsive"> </div>
        <div class="col-xs-7">
            <div class="jumbotron ">
            	<h1>Gestec-OTBs Modificado</h1>
            	<p class="lead">Sistema de gestion economico de OTBs <br> Manejo y control de vecinos</p>
            </div>
        </div>
    </div>

    <div class="row">
    	<div class="col-xs-6">
        	<div class="panel panel-primary">
            	<div class="panel-heading">
                	<h3 class="panel-title">Gestion de OTBs</h3>
                </div>
                <div class="panel-body">
                	<div class="pull-left">
                       	<img class="img-responsive" src="img/services3.png">
                    </div>
                    <div class="media-body">
                      	<h3 class="media-heading"><a href="#">Control de Vecinos</a></h3>
                        <p>Maneja usuarios, gestiona el control de asistencia a reuniones y control de faltas y sanciones</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-6">
          	<div class="panel panel-primary">
               	<div class="panel-heading">
                   	<h3 class="panel-title">Gestion Monetario</h3>
                </div>
                <div class="panel-body">
                   	<div class="pull-left">
                       	<img class="img-responsive" src="img/services6.png">
                    </div>
                    <div class="media-body">
                       	<h3 class="media-heading"><a href="registrar_movimiento.php">Administracion Contable</a></h3>
                        <p>Manejo de dinero de las otbs, se encarga del estado financiero tanto como ingresos y egresos, emite reportes para la toma de decisiones</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> <!--/#end container-->

<footer id="footer" class="midnight-blue panel-footer">
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12">
			&copy; 2015 <a target="_self" href="index.php">Equipo Anonimos </a>. @Todos los derechos reservados.
			</div>
        </div>
    </div>
</footer><!--/#footer-->

</body>
</html>
