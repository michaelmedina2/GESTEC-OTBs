<?php
	include_once("../../class/dbmanager.class.php");
	
	$db = ManagerBDPostgres::getInstanceBDPostgres();

	$id 	   = $_POST['idactividad'];
	$actividad = $_POST['actividad'];
	$tipo	   = $_POST['tipo'];

	$sqlActividad = $db->executeQuerySQL("UPDATE conceptomovimiento SET vch_catenombre='$actividad', vch_tipoconcepto='$tipo' WHERE pk_concepto=$id;");
	header("location: index.php");

?>
