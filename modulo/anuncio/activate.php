<?php
	include "../../class/dbmanager.class.php";
	$db = ManagerBDPostgres::getInstanceBDPostgres();
	
	$actividad = $_GET["id"];
	echo $actividad;
	$estado	   = $_GET["est"];
	$accion = '';
	if ($estado > 0) {
		$accion = 'A';
	} else {
		$accion = 'I';
	}
	$sql = $db->executeQuerySQL("UPDATE anuncio SET vch_anunestado = '$accion' WHERE pk_anuncio = '$actividad';");

	header("location: index.php");

?>