<?php
	session_start();
	
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
	$nombreModulo = 'Anuncio';
	
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
        $menuItem = 'Anuncio';        
        $idRol    = $sesion->obtener('idRol');
		$nameUser = $sesion->obtener("nombreUsuario"); 
        $nameRol  = $sesion->obtener("nombreRol");		
		include_once($path."system/menu.php");
    ?>
</nav><!--/nav-->


<div class="container-fluid contenedor">
	<div class="row">
    	<div class="col-xs-8 contenido" id="central">
    		
            <a href="nuevoAnuncio.php" class="btn btn-primary" id="btnNew">A&ntildeadir Anuncio</a>
            <center>
            
            <caption> <h1>Gesti&oacute;n de Anuncios</h1></caption>
            <table id="gridx" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">	       
                <thead>
                    <tr>
                        <th>Titulo Anuncio</th>
                        <th>Fecha Inicio</th>
						<th>Fecha Fin</th>
						<th>Estado</th>
						<th>Control</th>
						<th>Descripcion</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php
                        $sql = $db->executeQuerySQL("UPDATE anuncio SET vch_anunestado = 'I' WHERE dtt_anunfechafin < current_date;");
						$sqlAnuncio = $db->executeQuerySQL("select * from anuncio");
                        
                        while($row=$db->query_Fetch_Array($sqlAnuncio))
                        {
                    ?>      	
                    <tr>
                        <td><?php echo $row[vch_anuntitulo]; ?></td>
						<td><?php echo $row[dtt_anunfechainicio]; ?></td>
						<td><?php echo $row[dtt_anunfechafin]; ?></td>
                        <td><center><?php if ($row[vch_anunestado] == 'A') { echo "Activo"; } if ($row[vch_anunestado] == 'I') { echo "Inactivo"; } ?></center></td>
                        <td><center>
                            <div class="btn-group btn-group-xs">
                              <a href="actualizarAnuncio.php?id=<?php echo $row[pk_anuncio]; ?>" class="btn btn-warning" id="btnUpdate">Actualizar</a>
                              <a href="activate.php?id=<?php echo $row[pk_anuncio]; ?>&est=<?php $accion = '';
							  if ($row['vch_anunestado'] == 'A') { $accion = 'Baja'; echo '0'; } else { $accion = 'Alta'; echo '1'; } ?>" 
							  class="btn btn-info" id="btnUpdate"><?php echo $accion; ?></a>
                            </div>
                            </center></td>
						<td><?php echo $row[vch_anuncontenido]; ?></td>
                    </tr>                 
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            </center>
            
            
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
