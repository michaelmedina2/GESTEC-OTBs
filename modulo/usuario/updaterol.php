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
		$nameRol  = $sesion->obtener("nombreRol");
        include_once("../../system/menu.php");
    ?>
</nav><!--/nav-->


<div class="container-fluid contenedor">
    <div class="row">
        <div class="col-xs-8 contenido" id="central">
			
            <center>
			<div class="col-md-8 col-md-offset-2">
			            
            <div class="panel panel-default">
          		<div class="panel-heading">
            		<h3 class="panel-title">Registro de Usuario</h3>
        		</div>
          		<div class="panel-body">
            	<?php
					include_once("../../class/dbmanager.class.php");
					$db = ManagerBDPostgres::getInstanceBDPostgres();
	
					$id = $_GET['id'];
	
					$sqlRol = $db->executeQuerySQL("select * from usuario where pk_usuario='$id'");
					$rowUser = $db->query_Fetch_Array($sqlRol);
				?>

            		<form role="form" method="POST" action="update.php" enctype='multipart/form-data'>
                    	<fieldset>
                        
                        <div class="row">
                        	<div class="col-xs-6">
                            <div class="form-group">
                            	<img src="<?php echo $rowUser[vch_usuafoto]; ?>" width="100%">
                            	<input class="form-control" name="fotoUser" id="fotoUser" placeholder="Suba su foto de usuario" type="file" required>
              				</div>
                            </div>
                            
                            <div class="col-xs-6">
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
                                <option value="<?php echo $rowUser[pk_rol]; ?>" selected><?php echo $rowUser[vch_usuatipousuario]; ?></option>
                                </select>
                            </div>
                			<div class="form-group">
                  				<input class="form-control" placeholder="Username" name="username" id="username" type="text" value="<?php echo $rowUser[vch_usuausername]; ?>" required>
              				</div>
                			<div class="form-group">
                  				<input class="form-control" placeholder="Nombre" name="nombre" id="nombre" type="text" value="<?php echo $rowUser[vch_usuanombre]; ?>" required>
              				</div>
              				<div class="form-group">
                				<input class="form-control" placeholder="Apellido paterno" name="app" id="app" type="text" value="<?php echo $rowUser[vch_usuaapp]; ?>" required>
              				</div>
                            <div class="form-group">
                  				<input class="form-control" placeholder="Apellido materno" name="apm" id="apm" type="text" value="<?php echo $rowUser[vch_usuaapm]; ?>" required>
              				</div>
                			<div class="form-group">                            	
                  				<input class="form-control" placeholder="Sexo" name="sexo" id="sexo" type="text" value="<?php echo $rowUser[vch_usuasexo]; ?>" required>
              				</div>
              				<div class="form-group">
                				<input class="form-control" placeholder="Fecha nacimiento" name="fnaci" id="fnaci" type="text" value="<?php echo $rowUser[dat_usuafechanacimiento]; ?>" required>
              				</div>
                            <div class="form-group">
                  				<input class="form-control" placeholder="Cedula de identidad" name="ci" id="ci" type="text" value="<?php echo $rowUser[vch_usuaci]; ?>" required>
              				</div>
                			<div class="form-group">
                  				<input class="form-control" placeholder="Telefono" name="telefono" id="telefono" type="text" value="<?php echo $rowUser[vch_usuatelefono]; ?>" required>
              				</div>
              				<div class="form-group">
                				<input class="form-control" placeholder="Direccion" name="direc" type="direc" value="<?php echo $rowUser[vch_usuadireccion]; ?>" required>
              				</div>
                            <div class="form-group">
                            	<input type="text" class="form-control" name="estado" id="estado" placeholder="Estado" value="<?php echo $rowUser[vch_usuaestado]; ?>" required>
              				</div>
                                
                            </div>
                        </div>
                        
                        	
                        <div class="form-group">
                        	<input type="hidden" value="<?php echo $rowUser[pk_usuario]; ?>" id="idUser" name="idUser" />
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Aceptar">
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
