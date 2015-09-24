<?php
	include "../../class/dbmanager.class.php";
	
	$db = ManagerBDPostgres::getInstanceBDPostgres();
	
	$actividad = $_GET["id"];
	$estado	   = $_GET["est"];
	$accion	   = '';
	if ($estado > 0) {
		$accion = 'A';
	} else {
		$accion = 'I';
	}
	$sql = $db->executeQuerySQL("UPDATE conceptomovimiento SET vch_cateestado = '$accion' WHERE pk_concepto = '$actividad';");

	header("location: index.php");

?>