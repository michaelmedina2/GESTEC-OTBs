<?php
	session_start();

	$path = "../../";
	include_once("../../class/library.class.php");
    include_once("../../class/setting.class.php");
    $lib = new Library($path);
    $setting = new Setting();
	include_once("../../class/sesion.class.php");

	$sesion = Sesion::getInstance();

	if($sesion->iniciado() == 0) {
		header('location: ' . $path . 'index.php');
	}

	if(isset($_GET['id'])) {
		header('location: editar.php?id=' . $_GET['id']);
	}

	$idUsuario = $sesion->obtener('idUsuario');

	$nombreModulo = 'Privilegio';

	$dirModulos = $lib->getDirectory('dir_module');
	$dirUpload  = $lib->getDirectory('dir_upload');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $setting->getTitle(); ?></title>

    <!-- Bootstrap -->
    <link rel="icon" href="../../gotb2.png">

    <link rel="stylesheet" href="<?php echo $lib->getCSS("css_bootstrap1"); ?>">
    <link rel="stylesheet" href="<?php echo $lib->getCSS("css_bootstrap2"); ?>">
 	<link rel="stylesheet" href="<?php echo $lib->getCSS("css_dataTable1"); ?>">
    <link rel="stylesheet" href="<?php echo $lib->getCSS("css_dataTable2"); ?>">
    <link rel="stylesheet" href="<?php echo $lib->getCSS("css_jqueryui"); ?>">
    <link rel="stylesheet" href="<?php echo $lib->getCSS("css_style"); ?>">

    <script src="<?php echo $lib->getJS("lib_jquery"); ?>" type="text/javascript"></script>
    <script src="<?php echo $lib->getJS("lib_bootstrap"); ?>" type="text/javascript"></script>
    <script src="<?php echo $lib->getJS("lib_dataTables1"); ?>" type="text/javascript"></script>
    <script src="<?php echo $lib->getJS("lib_dataTables2"); ?>" type="text/javascript"></script>
    <script src="<?php echo $lib->getJS("lib_dataTables3"); ?>" type="text/javascript"></script>
    <script src="<?php echo $lib->getJS("lib_jqueryui"); ?>" type="text/javascript"></script>
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
        $nameRol  = $sesion->obtener("nombreRol");
		include_once("../../system/menu.php");
    ?>
</nav><!--/nav-->


<div class="container-fluid contenedor">
	<div class="row">
    	<div class="col-xs-8 contenido" id="central">


            <div id="div-content">
            <div id="div-middle-content">
                <div class="div-panel div-panel-gray">
                    <span class="titulo titulo-h1">Privilegios</span>
                 <div id="roles-tabs">

            <ul>
            <?php
				include_once("../../class/dbmanager.class.php");

				$db = ManagerBDPostgres::getInstanceBDPostgres();

				$sqlRol  = $db->executeQuerySQL("SELECT * FROM rol WHERE vch_rolestado='A'");
                $numRows = $db->query_Num_Rows($sqlRol);
                $listaIDRoles = array();

                for($i=0 ; $i < $numRows ; $i++)
				{
					$row   = $db->query_Fetch_Array($sqlRol);
                    $rolId = $row[pk_rol];
                    $rolNombre = $row[vch_rolnombre];
                    echo "<li><a href='#tab-$rolId'>$rolNombre</a></li>";
                    $listaIDRoles[] = $rolId;
                }
            ?>
            </ul>
            <?php
            	$size = count($listaIDRoles);
                for($i=0 ; $i < $size ; $i++)
				{
                	$rolId = $listaIDRoles[$i];
                    include 'lista.php';
                }
            ?>
            </div>
            </div>
            </div>
            </div>

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
