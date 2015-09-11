<?php
	session_start();
	
	include_once("class/library.class.php");
	
	$librerias = new Library();
	
	include_once("class/sesion.class.php");
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$login = Sesion::getInstance();
	
	$login->iniciarSesion($username, $password);	
	$login->getError();
	
	if( $login->iniciado() ) 
	{    
		header('location: modulo/inicio/index.php');
	}
	else {
		$error = "";		
		header("location: index.php");
	}
?>
