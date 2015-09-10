<?php
	require_once "class/dbmanager.class.php";

	$db = ManagerBDPostgres::getInstanceBDPostgres();
	
	$pk_otb   = "1";
	$pk_rol   = "2";
	$tipoUser = "Vesino";
	$username = $_POST["username"];
	$nombre   = $_POST["nombre"];
	$app      = $_POST["app"];
	$apm      = $_POST["apm"]; 
	$sexo     = $_POST["sexo"];
	$fnaci    = $_POST["fnaci"];
	$ci       = $_POST["ci"];
	$telefono = $_POST["telefono"];
	$direccion= $_POST["direc"];
	$foto     = "../img/foto.png";
	$estado   = "A";
	
	$sql = $db->executeQuerySQL("INSERT INTO usuario VALUES(default, '$pk_otb', '$pk_rol', '$tipoUser', '$username', '$nombre', '$app', '$apm', '$sexo', '$fnaci', '$ci', '$telefono', '$direccion', '$foto', '$estado')");
	
	header("location: index.php")
?>
