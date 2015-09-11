<?php
	include_once("../../class/dbmanager.class.php");
	$db = ManagerBDPostgres::getInstanceBDPostgres();
	
	$id     = $_GET['id'];
	
	$sqlRol = $db->executeQuerySQL("UPDATE rol SET vch_rolestado = 'I' WHERE pk_rol = '$id'");
	header("location: index.php");
?>