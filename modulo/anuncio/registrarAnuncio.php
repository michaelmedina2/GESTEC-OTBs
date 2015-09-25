<?php
	include_once("../../class/dbmanager.class.php");
	$db = ManagerBDPostgres::getInstanceBDPostgres();

	$idUsuario = $_POST['idUsuario'];
	$titulo = $_POST['nombreAnuncio'];
	$descripcion = $_POST['descripcionAnuncio'];
	$fecha_inicio = $_POST['dtp_input1'];
	$fecha_fin = $_POST['dtp_input2'];
	$estado = $_POST['estadoAnuncio'];

	$sqlRol = $db->executeQuerySQL("INSERT INTO anuncio VALUES(default, '$idUsuario', '$titulo', '$descripcion', '', '$fecha_inicio', '$fecha_fin', '$estado')");
	header("location: index.php");
?>
