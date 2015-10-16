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
    <link rel="stylesheet" href="../../css/bootstrap-datetimepicker.min.css" type="text/css" media="screen">
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

	include_once("../../class/dbmanager.class.php");
                $db = ManagerBDPostgres::getInstanceBDPostgres();
                
                $id = $_GET['id'];
                
                $sqlAnuncio = $db->executeQuerySQL("select * from anuncio where pk_anuncio='$id'");
                $row = $db->query_Fetch_Array($sqlAnuncio);
				
				$meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio', 'Agosto','Septiembre','Octubre','Noviembre','Diciembre');
				$orderFechaIni = explode('-', $row[dtt_anunfechainicio]);
				$orderFechaFin = explode('-', $row[dtt_anunfechafin]);
				
				$fechaInicioRec = $orderFechaIni[2].' '.$meses[$orderFechaIni[1]-1].' '.$orderFechaIni[0];
				$fechaFinRec = $orderFechaFin[2].' '.$meses[$orderFechaFin[1]-1].' '.$orderFechaFin[0];
    ?>
</nav><!--/nav-->


<div class="container-fluid contenedor">
    <div class="row">
        <div class="col-xs-8 contenido" id="central">
			
            <center>
			<div id="contenidoCRUD">
			<form accept-charset="UTF-8" role="form" method="POST" action="registrarAnuncioActualizado.php">
                <fieldset>
                    <div class="form-group">
                        <h2>Actualizar Anuncio</h2>
                    </div>
					<input class="form-control" name="idUsuario" id="idUsuario" type="hidden" value="<?php echo $idUsuario;?>">
					<input class="form-control" name="idAnuncio" id="idAnuncio" type="hidden" value="<?php echo $id;?>">
                    <div class="form-group">
                        <input class="form-control" placeholder="Nombre anuncio" name="nombreAnuncio" id="nombreAnuncio" type="text" value="<?php echo $row[vch_anuntitulo]; ?>" required>
                    </div>
                    <div class="form-group">
                         <textarea class="form-control" placeholder="Descripcion" name="descripcionAnuncio" id="descripcionAnuncio" required style="height: 165px"><?php echo $row[vch_anuncontenido]; ?></textarea>
                    </div>
					<div class="form-group">


            <div class="form-group">
				<div class="form-group">
					<div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
						<input class="form-control" type="text" value="<?php echo $fechaInicioRec; ?>" placeholder="Fecha Inicio"  name="fechaInicio" id="fechaInicio" required readonly>
						<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
					</div>
					<input class="form-control" type="hidden" id="dtp_input1" name="dtp_input1" value="<?php echo $row[dtt_anunfechainicio]; ?>" /><br/>
				</div>
			</div>	
			
			<div class="form-group">
				<div class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						<input class="form-control" type="text" value="<?php echo $fechaFinRec; ?>" placeholder="Fecha Fin"  name="fechaFin" id="fechaFin" required readonly>
						<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
				</div>
					<input class="form-control" type="hidden" id="dtp_input2" name="dtp_input2" value="<?php echo $row[dtt_anunfechafin]; ?>" /><br/>
			</div>
			
			
			
					<div class="form-group">
						<select name="estadoAnuncio" class="form-control" required>
						<?php $vch_anunestado = '';
						if ($row[vch_anunestado] == 'A') { $anunestado = "Activo"; } 
						if ($row[vch_anunestado] == 'I') { $anunestado = "Inactivo"; } 
						?>
							<option value="<?php echo substr($anunestado,0,1);?>"><?php echo $anunestado; ?></option>
							<option value="A">Activo</option>
							<option value="I">Inactivo</option>
						</select>
					</div>
                    <div class="form-group">
                        <input class="btn btn-lg btn-success btn-block" type="submit" value="Actualizar">
                        <a class="btn btn-lg btn-primary btn-block" href="index.php">Cancelar</a>
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

<script type="text/javascript" src="../../js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../../js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script type="text/javascript">
	$('.form_date').datetimepicker({
        language:  'es',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
</script>

</body>
</html>
