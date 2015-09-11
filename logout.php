<?php
	session_start();
	include_once("class/library.class.php");	
	$librerias = new Library();	
	include_once("class/sesion.class.php");	
	$sesion = Sesion::getInstance();	
	$sesion->cerrarSesion();	
	header('location: index.php');
?>