<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>

	<link rel="icon" href="gotb2.png">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/style.css">

	
    <style type="text/css">
		.alert-danger-alt { border-color: #B63E5A;background: #E26868;color: #fff; }
    </style>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>

<div class="container" style="margin-top:15px;">
	<div class="row">
    	<div class="col-md-4 col-md-offset-4">
        	<div class="panel panel-default">
          		<div class="panel-heading">
            		<h3 class="panel-title">Registrarse!</h3>
        		</div>
          		<div class="panel-body">
            		<form accept-charset="UTF-8" role="form" method="POST" action="newuser.php">
                    	<fieldset>
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
              				<input class="btn btn-lg btn-success btn-block" type="submit" value="Registrarme!">
            			</fieldset>
              		</form>
          		</div>
      		</div>
    	</div>
  	</div>
</div>

</body>
</html>
