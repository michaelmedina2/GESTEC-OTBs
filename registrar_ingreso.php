<?php
include 'conectar.php';
$con = pg_connect ($cadenaConexion) or die ("Error de conexion.". pg_last_error());

$resultado = pg_query($con, "SELECT * FROM usuario");
$concepto = pg_query($con, "SELECT * FROM conceptoingresoegreso");
//$arr = pg_fetch_array($resultado,NULL,PGSQL_ASSOC);
//echo $arr['vch_usuanombre'];


/// Valores del formulario///
if ($_POST)
{
$id_vecino=$_POST['nombre_vecino'];
$id_actividad_aporte=$_POST['actividad'];
$monto_aporte=$_POST['monto'];
$descripcion_aporte=$_POST['descripcion'];

//echo $monto_aporte.$id_actividad_aporte.$id_vecino.$descripcion_aporte ;
$fecha_hoy= date("Y-m-d");
$query = "INSERT INTO aporte(pk_gestion, pk_usuario, dat_ingrfecha, int_ingrmonto, vch_ingrnotadetalle, vch_ingrconceptoingresoegreso, vch_ingrmetodopago, vch_ingrtipoestadoie, pk_conceptoingresoegreso)
 VALUES (1, $id_vecino, '$fecha_hoy', $monto_aporte, 'test', 'test', null, null, $id_actividad_aporte );";
$insertar = pg_query($con, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$cmdtuples = pg_affected_rows($insertar);
}
////////////////////////
$aporte = pg_query($con, "SELECT * FROM aporte");
$monto_total = 0;
while($total_aporte = pg_fetch_array($aporte,NULL,PGSQL_ASSOC))
{ $monto_total = $monto_total + $total_aporte['int_ingrmonto'];

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
<script src="js/script.js"></script>

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

<div class="container" id="central" style="background-image:url(img/map-image.png)>

<div class="row">
  <form action="registrar_ingreso.php" method="post" name="registrar_ingreso">
  <table width="200" border="0" bgcolor="#FFFFFF" >
    </table>
  <table width="200" border="0" bgcolor="#FFFFFF" >
    </table>
  <div class="container" id="central2" style="background-image:url(img/map-image.png)>

<div class="row">
    <table width="200" border="0" bgcolor="#FFFFFF" >
      <tr>
        <th width="141" scope="row"><h2>Saldo: </h2></th>
        <td width="10">&nbsp;</td>
        <td width="27"><h2>
          <?php echo $monto_total;?>
        </h2></td>
      </tr>
      <tr>
        <th scope="row">&nbsp;</th>
        <td></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <th scope="row"><h2>Registrar </h2></th>
        <td></td>
        <td><h2> Aporte</h2></td>
      </tr>
      <tr>
        <th scope="row">Nombre Vecino:</th>
        <td></td>
        <td><select name="nombre_vecino">
          <option value="Seleccionar_nombre_Vecino">--Seleccionar Vecino--</option>
          <?php 
                    while($arr = pg_fetch_array($resultado,NULL,PGSQL_ASSOC))
                    {echo"<option value=".$arr['pk_usuario'].">".$arr['vch_usuanombre']." ".$arr['vch_usuaapp']."</option>";
                    
                    }
                    ?>
        </select></td>
      </tr>
      <tr>
        <th scope="row">Actividad: </th>
        <td></td>
        <td><select name="actividad">
          <option value="Seleccionar_actividad">--Seleccionar Actividad--</option>
          <?php 
                    while($arr = pg_fetch_array($concepto,NULL,PGSQL_ASSOC))
                    {echo"<option value=".$arr['pk_concepto'].">".$arr['vch_catenombre']."</option>";
                    
                    }
                    ?>
        </select></td>
      </tr>
      <tr>
        <th scope="row">Monto (Bs.):</th>
        <td>&nbsp;</td>
        <td>
          <input name="monto" type="text"  dir="rtl"/>
        </td>
      </tr>
      <tr>
        <th height="75" scope="row">Descripción:</th>
        <td>&nbsp;</td>
        <td><textarea name="descripcion" cols="40" rows="8" id="descripcion" ></textarea></td>
      </tr>
      <tr>
        <th scope="row">&nbsp;</th>
        <td>&nbsp;</td>
        <td><input name="Guardar" type="submit" value="Guardar">          <input name="Cancelar" type="reset" value="Cancelar"></td>
      </tr>
    </table>
    <div>
      <p></p>
    </div>
  </div>
  <table width="200" border="0" bgcolor="#FFFFFF" >
    <tr></tr>
  </table>
  <table width="200" border="0" bgcolor="#FFFFFF" >
    <tr></tr>
</table>
  </form>
</div>
</div>

<div class="row"></div>

</div> <!--/#end container-->

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
