<?php
	include_once("../../class/dbmanager.class.php");
	$db = ManagerBDPostgres::getInstanceBDPostgres();
	
	$id     = $_POST['idrol'];
	$nombre = $_POST['nombre'];
	$estado = $_POST['estado'];
	
	$sqlRol = $db->executeQuerySQL("UPDATE rol SET vch_rolnombre = '$nombre', vch_rolestado = '$estado' WHERE pk_rol = '$id'");
	header("location: index.php");
?>