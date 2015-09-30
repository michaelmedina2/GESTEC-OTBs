<?php

	include_once("../../class/dbmanager.class.php");
	$db = ManagerBDPostgres::getInstanceBDPostgres();
	
	$id     = $_GET['id'];
	$estado = $_GET['est'];
	$accion = '';
	
	if ($estado > 0) {
		$accion = 'A';
	} else {
		$accion = 'I';
	}
	$sqlRol = $db->executeQuerySQL("UPDATE usuario SET vch_usuaestado = '$accion' WHERE pk_usuario = '$id';");
	header("location: index.php");

?>