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
		
		$sqlUsuario  = $db->executeQuerySQL("SELECT * FROM usuario");
		$sqlConcepto = $db->executeQuerySQL("SELECT * FROM conceptomovimiento WHERE vch_tipoconcepto='E'");
		$sqlGestion  = $db->executeQuerySQL("SELECT * FROM gestion");
		
		$sqlAporte = $db->executeQuerySQL("SELECT * FROM movimiento");
		$monto_total = 0;
		
		while($total_aporte = $db->query_Fetch_Array($sqlAporte))
		{
			if ($total_aporte['vch_movtipoie'] == 'I')
			{
				$monto_total = $monto_total + $total_aporte['int_movmonto'];
			}else{
					$monto_total = $monto_total - $total_aporte['int_movmonto'];
				 }
		}
    ?>
</nav><!--/nav-->


<div class="container-fluid contenedor">
	<div class="row">
    	<div class="col-xs-8 contenido" id="central">
    	
		<div class="col-md-3 col-md-offset-0">
		<div class="panel panel-primary">
			<div class="panel-heading">
				 <h3 class="panel-title">Saldo Actual</h3>
			</div>
			<div class="panel-body">
				<div class="media-body">
					 <h3 class="media-heading"><?php echo $monto_total; ?></h3>
				</div>
			</div>
		</div>
		</div>
		
		      <div class="col-md-4 col-md-offset-1">
          <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Registrar Salida de dinero</h3>
            </div>
              <div class="panel-body">
                <form accept-charset="UTF-8" name="formIngreso" id="formIngreso" role="form" method="post" action="registrar_egreso.php">
                      <fieldset>
                      <div class="form-group"></div>
                      <div class="form-group"></div>
                      <div class="form-group"></div>
                      <div class="form-group">
                          <input class="form-control" placeholder="Monto a retirar (BS)" name="monto" id="monto" type="text" required>
                      </div>
                      <div class="form-group">
                        <select name="actividad" id="actividad" class="form-control">
                          <option value="">--Seleccionar actividad--</option>
                          <?php
                              	while($dato = $db->query_Fetch_Array($sqlConcepto))
                                {
									echo"<option value=".$dato['pk_concepto'].">".$dato['vch_catenombre']."</option>";
                                }
                              ?>
                        </select>
                      </div>
					  
					  <div class="form-group">
					  <textarea class="form-control" placeholder="Descripcion" name="descrip" id="descrip" required></textarea>
					  </div>
					  <div class="form-group">
                          <input class="form-control" type="hidden" name="monto_total" id="monto_total" value=<?php $monto_total?> required>
                      </div>
                    <div class="form-group">
                      <input class="btn btn-lg btn-success btn-block" name="enviar" id="enviar" type="submit" value="Aceptar">
                      <a class="btn btn-lg btn-primary btn-block" href="index.php">Cancelar</a>
                    </div>
                  </fieldset>
                  </form>
              </div>
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

<script type="text/javascript">

	$(document).ready(function() {
        $("#formIngreso").validate({
			rules: {
				gestion: "required",
				usuario  : "required",
				actividad: "required",
				monto: {
					required: true,
					minlength: 2,
					//maxlength: 3
				},
				descrip: {
					required: true,
					minlength: 10,
					maxlength: 100
				}
			},
			messages: {
				gestion  : "Por favor seleccione la gestion",
				usuario  : "Por favor seleccione un nombre",
				actividad: "Por favor seleccione una actividad",
				monto: {
					required: "Ingrese el monto a pagar",
					minlength: "Minimo debe ingresar 2 digitos enteros",
					maxlength: "Maximo debe ingresar 3 digitos enteros"
				},
				descrip: {
					required: "Ingrese una descripcion",
					minlength: "Minimo debe ingresar 10 caracteres",
					maxlength: "Maximo debe ingresar 100 caracteres"
				}
			}
		});

    });

</script>

</body>
</html>
