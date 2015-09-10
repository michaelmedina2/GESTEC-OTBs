<?php
	include_once("../../class/dbmanager.class.php");
	$db = ManagerBDPostgres::getInstanceBDPostgres();
	
	$nombre = $_POST['nombre'];
	$estado = $_POST['estado'];
	
	$sqlRol = $db->executeQuerySQL("INSERT INTO rol VALUES(default, '$nombre', '$estado')");
	header("location: ../index.php");
?>