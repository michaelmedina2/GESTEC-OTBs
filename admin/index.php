<?
	require_once 'login.class.php';

	if($_SESSION["name"])
	{
		header ("Location: panel.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso</title>

	<link rel="icon" href="../gotb2.png">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/style.css">

	<style type="text/css">
		.alert-danger-alt { border-color: #B63E5A;background: #E26868;color: #fff; }
		body{
			background-image:url(../img/map-image.png);
		}
    </style>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>

</head>
<body>

<div class="container" style="margin-top:150px;">
	<div class="row">
    	<div class="col-md-4 col-md-offset-4">
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
