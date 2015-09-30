<?php
    session_start();

    $path = "../../";
    include_once("../../class/library.class.php");
<<<<<<< HEAD
    include_once("../../class/setting.class.php");
    $lib = new Library($path);
    $setting = new Setting();
=======
<<<<<<< HEAD
    include_once("../../class/setting.class.php");
    $lib = new Library($path);
    $setting = new Setting();
=======

    $lib = new Library($path);

>>>>>>> origin/master
>>>>>>> origin/master
    include_once("../../class/sesion.class.php");

    $sesion = Sesion::getInstance();

    if($sesion->iniciado() == 0) {
        header('location: ' . $path . 'index.php');
    }

    $idUsuario = $sesion->obtener('idUsuario');
    $nombreModulo = 'Actividad';

    $dirModulos = $lib->getDirectory('dir_module');
    $dirUpload  = $lib->getDirectory('dir_upload');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<<<<<<< HEAD
    <title><?php echo $setting->getTitle(); ?></title>
=======
<<<<<<< HEAD
    <title><?php echo $setting->getTitle(); ?></title>
=======
    <title>.- GESTEC OTB -.</title>
>>>>>>> origin/master
>>>>>>> origin/master

    <!-- Bootstrap -->
    <link rel="icon" href="../../gotb2.png">

    <link rel="stylesheet" href="<?php echo $lib->getCSS("css_bootstrap1"); ?>">
    <link rel="stylesheet" href="<?php echo $lib->getCSS("css_bootstrap2"); ?>">
     <link rel="stylesheet" href="<?php echo $lib->getCSS("css_dataTable1"); ?>">
    <link rel="stylesheet" href="<?php echo $lib->getCSS("css_dataTable2"); ?>">
    <link rel="stylesheet" href="<?php echo $lib->getCSS("css_style"); ?>">

    <script src="<?php echo $lib->getJS("lib_jquery"); ?>" type="text/javascript"></script>
    <script src="<?php echo $lib->getJS("lib_bootstrap"); ?>" type="text/javascript"></script>
    <script src="<?php echo $lib->getJS("lib_dataTables1"); ?>" type="text/javascript"></script>
    <script src="<?php echo $lib->getJS("lib_dataTables2"); ?>" type="text/javascript"></script>
    <script src="<?php echo $lib->getJS("lib_dataTables3"); ?>" type="text/javascript"></script>
    <script src="<?php echo $lib->getJS("lib_jscript"); ?>" type="text/javascript"></script>

</head>
<body>

<header id="header">
    <?php
        include_once("../../system/header.php");
    ?>
</header>


<nav class="navbar navbar-inverse">
     <?php

        $idRol    = $sesion->obtener('idRol');
        $nameUser = $sesion->obtener("nombreUsuario");
<<<<<<< HEAD
        $nameRol  = $sesion->obtener("nombreRol");
=======
<<<<<<< HEAD
        $nameRol  = $sesion->obtener("nombreRol");
=======
>>>>>>> origin/master
>>>>>>> origin/master
        include_once("../../system/menu.php");
    ?>
</nav><!--/nav-->


<div class="container-fluid contenedor">
    <div class="row">
        <div class="col-xs-8 contenido" id="central">
<<<<<<< HEAD

=======
<<<<<<< HEAD

=======
			
>>>>>>> origin/master
>>>>>>> origin/master
            <center>
			<div id="contenidoCRUD">

            <?php
                include_once("../../class/dbmanager.class.php");
                $db = ManagerBDPostgres::getInstanceBDPostgres();
<<<<<<< HEAD

                $id = $_GET['id'];

=======
<<<<<<< HEAD

                $id = $_GET['id'];

=======
                
                $id = $_GET['id'];
                
>>>>>>> origin/master
>>>>>>> origin/master
                $sqlActividad = $db->executeQuerySQL("SELECT * FROM conceptomovimiento WHERE pk_concepto=$id;");
                $row = $db->query_Fetch_Array($sqlActividad);
            ?>

			<form accept-charset="UTF-8" role="form" method="POST" action="update.php">
                <fieldset>
                    <div class="form-group">
                        <h2>Actualizar Actividad</h2>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="nombre actividad" name="actividad" id="actividad" type="text" value="<?php echo $row['vch_catenombre']; ?>" required>
                    </div>
                    <div class="form-group">
                        <select class="form-control" placeholder="tipo concepto" name="tipo" id="tipo">
                            <option value="I" <?php if ($row['vch_tipoconcepto'] == 'I') echo "selected"; ?>>Ingreso</option>
                            <option value="E" <?php if ($row['vch_tipoconcepto'] == 'E') echo "selected"; ?>>Egreso</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" value="<?php echo $row[pk_concepto]; ?>" id="idactividad" name="idactividad" />
                        <input class="btn btn-lg btn-success btn-block" type="submit" value="Aceptar">
                        <a class="btn btn-lg btn-primary btn-block" href="index.php">Volver</a>
                    </div>
                </fieldset>
            </form>
			</div>
			</center>

        </div>
        <div class="col-xs-4 sidebar" id="noticia">
              <?php include_once("../../system/side.php"); ?>
        </div>
    </div>
</div>


<footer id="footer" class="panel-footer">
    <?php include_once("../../system/footer.php"); ?>
</footer><!--/#footer-->

</body>
</html>
