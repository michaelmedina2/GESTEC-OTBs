<?php
	include_once("../../class/dbmanager.class.php");
	
	$db = ManagerBDPostgres::getInstanceBDPostgres();

	$actividad = $_POST['actividad'];
	$tipo	   = $_POST['tipo'];

	$sqlActividad = $db->executeQuerySQL("INSERT INTO conceptomovimiento VALUES(default, '$actividad', 'A', '$tipo');");
	header("location: index.php");

?>
