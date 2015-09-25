<?php
	include_once("../../class/dbmanager.class.php");
	$db = ManagerBDPostgres::getInstanceBDPostgres();

	$idAnuncio = $_POST['idAnuncio'];
	$idUsuario = $_POST['idUsuario'];
	$titulo = $_POST['nombreAnuncio'];
	$descripcion = $_POST['descripcionAnuncio'];
	$fecha_inicio = $_POST['dtp_input1'];
	$fecha_fin = $_POST['dtp_input2'];
	$estado = $_POST['estadoAnuncio'];;
	
	$sqlRol = $db->executeQuerySQL("UPDATE anuncio SET pk_usuario = '$idUsuario', vch_anuntitulo = '$titulo', vch_anuncontenido = '$descripcion',
									dtt_anunfechainicio = '$fecha_inicio', dtt_anunfechafin = '$fecha_fin', vch_anunestado = '$estado'  WHERE pk_anuncio = '$idAnuncio'");
	header("location: index.php");
?>