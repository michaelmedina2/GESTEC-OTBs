<?	
	session_start();

	if(isset($_SESSION['name']))
	{}else{
		header("Location: index.php");
	} 	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Usuarios - Bienvenido <?php echo $_SESSION['name'] ?></title>

    
	<link rel="icon" href="../gotb2.png">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/style.css">

	
	<style type="text/css">
		.alert-danger-alt { border-color: #B63E5A;background: #E26868;color: #fff; }
    </style>

	<script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/script.js"></script>
 	<style type="text/css">
    	.usuariosregistrados
		{
      		background: #148add;
			color: #fff;
			display: block;
			width: 350px;
			margin: 3px auto;
			border-radius: 3px;
			padding: 20px 10px 20px 10px;
			font-size: 22px;
      	}
    </style>
    <script type="text/javascript" language="javascript">

    </script>
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
                <a class="navbar-brand" href="index.php"><img src="../img/logoGestec-OTB.png" alt="logo" width="130"></a>
            </div>

            <div class="collapse navbar-collapse navbar-right">
            	<ul class="nav navbar-nav" id="menu">
                	<li class="active"><a href="home.php">Home</a></li>
                    <li><a href="page1.php">Hacerca de Nosotros</a></li>
                    <li><a href="page2.php">Servicios</a></li>
                    <li><a href="page3.php">Contacto</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                	<li><a href="logout.php">Cerrar Sesion [<?php echo $_SESSION['name']; ?>]</a></li>
              	</ul>
            </div>
        </div><!--/.container-->
        
    </nav><!--/nav-->
</header><!--/header-->


<div class="container" id="central" style="background-image:url(../img/map-image.png)">

	<div class="row">
    	<div class="col-md-12" style="text-align:center; margin-top:100px;">
     		<label>Usuarios Registrados</label>
    		<?php
				require_once("../class/dbmanager.class.php");
				$db  = ManagerBDPostgres::getInstanceBDPostgres();
				$sql = $db->executeQuerySQL("SELECT * FROM usuario");
		
				while($row = $db->query_Fetch_Array($sql))
				{
					echo "<p class='usuariosregistrados'>".$row[vch_usuanombre]."</p>";
				}
			?>
     	</div>
  	</div>

</div> <!--/#end container-->



</div> <!--/#end container-->

<footer id="footer" class="midnight-blue panel-footer">
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12">
            	&copy; 2013 <a target="_self" href="index.php">SurfSoftBol srl</a>. Todos los derechos reservados.
            </div>
        </div>
    </div>
</footer><!--/#footer-->

</body>
</html>
