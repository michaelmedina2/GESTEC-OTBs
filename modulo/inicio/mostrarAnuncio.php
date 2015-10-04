<?php
	session_start();
	
	$id = $_GET['id'];
	$path = "../../";
	include_once($path."class/library.class.php");
	include_once($path."class/setting.class.php");
	
		
	$lib = new Library($path);
	$setting = new Setting();
	
	include_once($path."class/sesion.class.php");
		
	$sesion = Sesion::getInstance();
	
	if($sesion->iniciado() == 0) {
		header('location: ' . $path . 'index.php');
	}
	$idUsuario = $sesion->obtener('idUsuario');
		
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
    	include_once($path."system/header.php");
	?>
</header>


<nav class="navbar navbar-inverse">
     <?php      
        $idRol    = $sesion->obtener('idRol');
		$nameUser = $sesion->obtener("nombreUsuario"); 
        $nameRol  = $sesion->obtener("nombreRol");		
		include_once($path."system/menu.php");
    ?>
</nav><!--/nav-->


<div class="container-fluid contenedor">
	<div class="row">
	<?php
		$sqlAnuncio = $db->executeQuerySQL("select * from anuncio where pk_anuncio=$id");
		
		$row=$db->query_Fetch_Array($sqlAnuncio)
	?> 
    	<div class="col-xs-8 contenido" id="central">
    		
        <div class="alert alert-info" role="alert">
		<h3><strong><?php echo $row[vch_anuntitulo]; ?></strong></h3>
		</div>
        <div class="panel panel-primary">
				<div class="panel-body">
				<strong>Detalle: </strong><?php echo $row[vch_anuncontenido]; ?> </br></br>
				<strong>Fecha de publicacion: </strong><?php echo $row[dtt_anunfechainicio]; ?> </br>
				<strong>Fecha de finalzacion: </strong><?php echo $row[dtt_anunfechafin]; ?>
				</div>
		</div>    
            
        </div>
        <div class="col-xs-4 sidebar" id="noticia">
      		<?php include_once($path."system/side.php"); ?>
        </div>
	</div>
</div>


<footer id="footer" class="panel-footer">
    <?php include_once($path."system/footer.php"); ?>
</footer><!--/#footer-->

</body>
</html>
