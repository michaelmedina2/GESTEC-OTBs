<?php
	include "class/dbmanager.class.php";
	
	$db = ManagerBDPostgres::getInstanceBDPostgres();
	
	$sqlUsuario  = $db->executeQuerySQL("SELECT * FROM usuario");
	$sqlConcepto = $db->executeQuerySQL("SELECT * FROM conceptoingresoegreso");
	$sqlGestion  = $db->executeQuerySQL("SELECT * FROM gestion");
	
	$sqlAporte = $db->executeQuerySQL("SELECT * FROM aporte");
	$monto_total = 0;
	
	while($total_aporte = $db->query_Fetch_Array($sqlAporte))
	{
		$monto_total = $monto_total + $total_aporte['int_ingrmonto'];
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>- GESTEC OTB -</title>

<link rel="icon" href="gotb2.png">

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap-theme.min.css">
<link rel="stylesheet" href="css/style.css">

<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/script.js"></script>

  <style type="text/css">
    .alert-danger-alt { border-color: #B63E5A;background: #E26868;color: #fff; }
    body{
      background-image:url(../img/map-image.png);
    }
  </style>

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
<a class="navbar-brand" href="index.php"><img src="img/logoGestec-OTB.png" alt="logo" width="130"></a>
</div>

<div class="collapse navbar-collapse navbar-right">
<ul class="nav navbar-nav" id="menu">
<li class="active"><a href="index.php">Home</a></li>
<li><a href="#">Acerca de Nosotros</a></li>
<li><a href="#">Servicios</a></li>
<li><a href="#">Contacto</a></li>
</ul>
</div>
</div><!--/.container-->
</nav><!--/nav-->
</header><!--/header-->

<div class="container" style="margin-top:15px; background-image:url(img/map-image.png);">
  <div class="row">

      <div class="col-md-4 col-md-offset-4">
          <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Registrar Egreso</h3>
            </div>
              <div class="panel-body">
                <form accept-charset="UTF-8" name="formIngreso" id="formIngreso" role="form" method="post" action="newAporte.php">
                      <fieldset>
                      <div class="form-group"></div>
                      <div class="form-group"></div>
                      <div class="form-group"></div>
                      <div class="form-group">
                          <input class="form-control" placeholder="Monto a pagar (BS)" name="monto" id="monto" type="text" required>
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
                        <textarea class="form-control" placeholder="Descripcion" name="descrip" id="descrip" required></textarea>
                      </div>
                    <div class="form-group">
                      <input class="btn btn-lg btn-success btn-block" name="enviar" id="enviar" type="submit" value="Aceptar">
                      <input class="btn btn-lg btn-warning btn-block" type="reset" value="Cancelar">
                    </div>
                  </fieldset>
                  </form>
              </div>
          </div>
      </div>
    </div>
</div>


<footer id="footer" class="midnight-blue panel-footer">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        &copy; 2015 <a target="_self" href="index.php">Equipo Anonimos </a>. @Todos los derechos reservados.
      </div>
    </div>
  </div>
</footer><!--/#footer-->

</body>
</html>
