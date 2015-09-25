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
			<div class="col-md-4 col-md-offset-4">
			<form accept-charset="UTF-8" role="form" method="POST" action="new.php">
                <fieldset>
                    <div class="form-group">
                        <h2>Nuevo Rol</h2>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="nombre rol" name="nombre" id="nombre" type="text" required>
                    </div>

					<div class="table-responsive hidden">
                    <span>Privilegios</span>
                    <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Modulo</th>
                            <th>Privilegio</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php
						include_once("../../class/dbmanager.class.php");

						$db = ManagerBDPostgres::getInstanceBDPostgres();

						$sqlPriv  = $db->executeQuerySQL("SELECT * FROM privilegio");

                        $id = 0;
                        while($fila = $db->query_Fetch_Array($sqlPriv))
						{
                            $id = $id + 1;
                            $nombrePrivilegio        = $fila[vch_privnombre];
                            $privilegioAdministrador = $fila[bol_privadmin];
                            $privilegioCliente       = $fila[bol_privcliente];
                        ?>
                        <tr>
                            <td><?php echo "$nombrePrivilegio"; ?></td>
                            <td class="radio">
                                <?php
                                    if ($privilegioAdministrador == 1) {
                                        echo "<input type='radio' id='radio-admin-$id' name='radio-$id' value='1' />";
                                        echo "<label for='radio-admin-$id'>Administrador</label>";
                                    }
                                    else {
                                        echo "<input type='radio' id='radio-admin-$id' name='radio-$id' value='1' disabled='disabled' />";
                                        echo "<label for='radio-admin-$id'>Administrador</label>";
                                    }
                                    if ($privilegioCliente == 1) {
                                        echo "<input type='radio' id='radio-client-$id' name='radio-$id' value='2' />";
                                        echo "<label for='radio-client-$id'>Cliente</label>";
                                    }
                                    else {
                                        echo "<input type='radio' id='radio-client-$id' name='radio-$id' value='2' disabled='disabled' />";
                                        echo "<label for='radio-client-$id'>Cliente</label>";
                                    }
                                    echo "<input type='radio' id='radio-none-$id' name='radio-$id' value='0' checked='checked' />";
                                    echo "<label for='radio-none-$id'>Ninguno</label>";
                                ?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    </table>
					</div>

                    <div class="form-group">
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
