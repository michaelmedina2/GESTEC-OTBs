<?php
	session_start();
  include_once ('class/setting.class.php');
	include_once("class/library.class.php");

	$librerias = new Library();
  $setting = new Setting();
	include_once("class/sesion.class.php");

	$sesion = Sesion::getInstance();

	if($sesion->iniciado() == TRUE)
	{
		header('location: ' . $librerias->getDirectory('dir_module') . "inicio/index.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $setting->getTitle(); ?></title>

	  <link rel="icon" href="gotb2.png">

    <link rel="stylesheet" href="<?php echo $librerias->getCSS("css_bootstrap1"); ?>">
    <link rel="stylesheet" href="<?php echo $librerias->getCSS("css_bootstrap2"); ?>">
    <link rel="stylesheet" href="<?php echo $librerias->getCSS("css_style"); ?>">

	<style type="text/css">
		.alert-danger-alt { border-color: #B63E5A;background: #E26868;color: #fff; }
    </style>

    <script src="<?php echo $librerias->getJS("lib_jquery"); ?>"></script>
    <script src="<?php echo $librerias->getJS("lib_bootstrap"); ?>"></script>
	<script src="<?php echo $librerias->getJS("lib_jscript"); ?>"></script>

</head>
<body>

<div class="container" style="margin-top:100px;">
	<div class="row">
    	<div class="col-md-4 col-md-offset-4">
        	<center>
        	<img src="<?php echo $setting->getLogoLogin(); ?>" height="110">
            </center>
        	<div class="panel panel-default">
                <div class="panel-heading">
            		<h3 class="panel-title">Acceso</h3>
        		</div>
          		<div class="panel-body">
					<?php
        				if (isset($_GET['error']))
						{
            				echo '<div class="alert alert-danger-alt alert-dismissable">
                        		  	<span class="glyphicon glyphicon-certificate"></span>
                        			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<strong>Acceso Denegado</strong>
									Revise que sus datos de acceso al sistema sean correctos y vuelva a intentarlo.
							      </div>';
        				} else {
            				echo '';
        				}
        			?>

            		<form  method="post" action="login.php">
                    	<fieldset>
                			<div class="form-group">
                  				<input class="form-control" placeholder="username" name="username" id="username" type="text" required>
              				</div>
              				<div class="form-group">
                				<input class="form-control" placeholder="password" name="password" id="password" type="password" value="" required>
              				</div>
              				<input class="btn btn-lg btn-success btn-block" type="submit" name="login" id="login" value="Iniciar sesión">
            			</fieldset>
              		</form>
              		<p></p>
               		<a class="btn btn-lg btn-info btn-block" href="registro.php">Registrarme</a>
          		</div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
