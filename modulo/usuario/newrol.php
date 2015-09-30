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

    $idUsuario = $sesion->obtener('idUsuario');
    $nombreModulo = 'Usuario';
	
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
        include_once("../../system/header.php");
    ?>
</header>


<nav class="navbar navbar-inverse">
     <?php

        $idRol    = $sesion->obtener('idRol');
        $nameUser = $sesion->obtener("nombreUsuario");
		$nameRol  = $sesion->obtener('nombreRol');
        include_once("../../system/menu.php");
    ?>
</nav><!--/nav-->


<div class="container-fluid contenedor">
    <div class="row">
        <div class="col-xs-8 contenido" id="central">

            <center>
			<div class="col-md-5 col-md-offset-3">
			
            
            <div class="panel panel-default">
          		<div class="panel-heading">
            		<h3 class="panel-title">Registro de Usuario</h3>
        		</div>
          		<div class="panel-body">
            		<form role="form" method="POST" action="new.php" enctype='multipart/form-data'>
                    	<fieldset>
                        	<div class="form-group">
                            	<select name="tipoUser" id="tipoUser" class="form-control">
                                <?php
                                	include_once("../../class/dbmanager.class.php");
									$db = ManagerBDPostgres::getInstanceBDPostgres();
									
									$sqlRol = $db->executeQuerySQL("SELECT * FROM rol");
									while($row = $db->query_Fetch_Array($sqlRol)){
								?>
                            	  <option value="<?php echo $row[pk_rol]; ?>" selected><?php echo $row[vch_rolnombre]; ?></option>
                            	<?php
									}
                                ?>
                                </select>
                            </div>
                			<div class="form-group">
                  				<input class="form-control" placeholder="Username" name="username" id="username" type="text" required>
              				</div>
                			<div class="form-group">
                  				<input class="form-control" placeholder="Nombre" name="nombre" id="nombre" type="text" required>
              				</div>
              				<div class="form-group">
                				<input class="form-control" placeholder="Apellido paterno" name="app" id="app" type="text" value="" required>
              				</div>
                            <div class="form-group">
                  				<input class="form-control" placeholder="Apellido materno" name="apm" id="apm" type="text" required>
              				</div>
                			<div class="form-group">
                  				<input class="form-control" placeholder="Sexo" name="sexo" id="sexo" type="text" required>
              				</div>
              				<div class="form-group">
                				<input class="form-control" placeholder="Fecha nacimiento" name="fnaci" id="fnaci" type="text" value="" required>
              				</div>
                            <div class="form-group">
                  				<input class="form-control" placeholder="Cedula de identidad" name="ci" id="ci" type="text" required>
              				</div>
                			<div class="form-group">
                  				<input class="form-control" placeholder="Telefono" name="telefono" id="telefono" type="text" required>
              				</div>
              				<div class="form-group">
                				<input class="form-control" placeholder="Direccion" name="direc" type="direc" value="" required>
              				</div>
                            <div class="form-group">
                            	<input class="form-control" name="fotoUser" id="fotoUser" placeholder="Suba su foto de usuario" type="file" required>
              				</div>
                            <div class="form-group">
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Registrarme!">                                
                                <a class="btn btn-lg btn-primary btn-block" href="index.php">Volver</a>
                            </div>              				
            			</fieldset>
              		</form>
          		</div>
            </div>
            
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
