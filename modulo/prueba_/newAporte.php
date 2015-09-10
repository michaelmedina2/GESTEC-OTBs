<?php
	include "class/dbmanager.class.php";
	
	$db = ManagerBDPostgres::getInstanceBDPostgres();
	
	if(isset($_POST["enviar"]))
	{
		$pk_Gestion   = $_POST["gestion"];
		$pk_Vesino    = $_POST["usuario"];
		$montoAporte  = $_POST["monto"];
		$descrip      = $_POST["descrip"];
		$pk_ConceptoIE= $_POST["actividad"];
		$fechaIngreso = date("Y-m-d");
		$estado       = "I"; //estado - I -> Ingreso
		
		$sql = $db->executeQuerySQL("INSERT INTO aporte VALUES(default, $pk_Gestion, $pk_Vesino, '$fechaIngreso', $montoAporte, '$descrip', '$pk_ConceptoIE', '$estado')");
		header("location: registrar_ingreso.php");
	}
?>