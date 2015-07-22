<?php
include 'conectar.php';
/// Valores del formulario///
if ($_POST['nombre_vecino']!=null)
{
	$nombre_vecino=$_POST['nombre_vecino'];
	$actividad_aporte=$_POST['actividad'];
	$monto_aporte=$_POST['monto'];
	$descripcion_aporte=$_POST['descripcion'];

	echo $monto_aporte;
}
////////////////////////
locat
?>